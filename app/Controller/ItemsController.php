<?php

require VENDORS . 'autoload.php';
use WebPay\WebPay;
// require_once "webpay-php-full-2.2.2/autoload.php";
// use WebPay\WebPay;

// App::item('AppController','Controller');
class ItemsController extends AppController
{
  public $name = 'Items';
  public $uses = array('Item','User','Charge','CardHash','Recursion');
  public $helpers = array('Paginator','Html','Form');
  public $components = array('Session','Paginator','Cookie');

  public function index()
  {
    $this->set('maxitem',$this->Item->find('count','all'));
    $p_limit = 5;
    $this->set('p_limit',$p_limit);
    // $this->autoLayout = false;  // レイアウトをOFFにする
    $this->layout = 'itemLayout';
    $this->set('title_for_layout','商材一覧画面 | ELITES') ;
    $this->Paginator->settings = array(
        'limit' => $p_limit,
        'order' => array('created' => 'desc'),
        'recusive' =>3
      );
    $this->set('items',$this->paginate());
    // $this->set('items',$this->Item->find('all'));
  }

  public function id($cha_rec_id = null)
  {
    // $this->autoLayout = false;  // レイアウトをOFFにする

    $this->layout = 'itemLayout';
     $this->set('title_for_layout','一般決済画面 | ELITES') ;
    $this->set('items',$this->Item->findByCha_rec_id($cha_rec_id));

    if(isset($cha_rec_id))
    {
      $items = $this->Item->findByCha_rec_id($cha_rec_id);
    }

    if(empty($items) or empty($cha_rec_id))
    {
      $this->redirect(array('controller'=>'items', 'action'=>'index'));
    }
    else
    {
      $this->set('items',$items);
    }

  }

  public function purchased()
  {
    if($this->request->is('post'))
    {
      $this->layout = 'itemLayout';
      $this->set('title_for_layout','決済完了画面 | ELITES') ;
      // debug($this->User->set($this->request->data));
      // debug($this->request->data);
      $this->User->set($this->request->data);
      // $data=array('nowall_name' => $this->request->data['nowall_name']);
      if($this->User->validates()){
    // API リクエスト
    try {
          $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');
          //エラー日本語化
          $webpay->setAcceptLanguage('ja');
          //取得したdataの定義

          $id = $this->request->data['id'];
          $nowall_name = $this->request->data['nowall_name'];
          $name = $this->request->data['name'];
          $amount = $this->request->data['amount'];
          $email = $this->request->data['email'];
          $token = $this->request->data['webpay-token'];
          $description = $this->request->data['description'];
          $cha_rec_id = $this->request->data['cha_rec_id'];
          //emailあるか確認 なかったらcutomer_id作成
          $finger_tmp = $webpay->token->retrieve($token);
          $finger_tmp = $finger_tmp->card->fingerprint;
          //カード情報もチェック
          $customer = $this->User->find('first',array(
                                          'conditions' => array(
                                                'email' => $email,
                                                'fingerprint' => $finger_tmp
                                                )
                                          )
          );

          if(empty($customer))
          {
            // メールアドレスが既に登録済のとき⇒カード情報が異なるため、新規顧客で登録
            $params = array(
                            'conditions' => array(
                            'email' => $this->request->data['email'],
                            )
                        );
            $emailcount = $this->User->find('count', $params);

            // 過去に同じEMAILで登録がある場合、名前に数字を付加してから登録
            if($emailcount>0){
                $name = $name . ($emailcount + 1);
            }


            //顧客生成
            $customers = $webpay->customer->create(array("card"=>$token,"email"=>$email));
            $customer_id = $customers->id;

            //users_id生成
            $this->User->save(['email'=>$email,'customer_id'=>$customer_id,'name'=>$name]);
            //users_id取得
            $user_id = $this->User->id;

            //card_hash保存
            $fingerprint = $customers->activeCard->fingerprint;
            $this->CardHash->save(['user_id'=>$user_id,'fingerprint'=>$fingerprint]);
          }else{
            //customer_idと課金のひも付け
            $customer_id = $customer['User']['customer_id'];
            $user_id = $customer['User']['id'];
          };


          //recの取得
          if(substr($cha_rec_id,0,3) !="rec"){
                // 課金処理
                $charge_id = $webpay->charge->create(array(
                "amount"=>$amount,
                "currency"=>"jpy",
                "customer"=>$customer_id,
                "description"=>$description
                  ));
                //課金idの保存
                $charge_id = $charge_id->id;
                $this->Charge->save(['user_id'=>$user_id,'charge_id'=>$charge_id,'summary'=>$description,'amount'=>$amount]);
          }else{
                //定額処理
                $return_re = $webpay->recursion->create(array(
                    "amount"=>$this->request->data['amount'],
                    "currency"=>"jpy",
                    "customer"=>$customer_id,
                    "period"=>"month",
                    "description" => $description
                ));
                // DB登録
                // Recursionsテーブル
                $recursion_savedata = array(
                    'user_id' => $user_id,
                    'recursion_id' => $return_re->id,
                    'summary' => $this->request->data['description'],
                    'amount' => $this->request->data['amount']
                );
                $this->Recursion->save($recursion_savedata);
                //(月額)表示用
                $period = "dummy";
          }

      } catch (\WebPay\ErrorResponse\ErrorResponseException $e) {
          $error = $e->data->error;
          switch ($error->causedBy) {
              case 'buyer':
                  // カードエラーなど、購入者に原因がある
                  // エラーメッセージをそのまま表示するのがわかりやすい
                  $this->Session->write('sendData', array('error'=>$error->message,'nowallname'=>$nowall_name));
                  break;
              case 'insufficient':
                  // 実装ミスに起因する
                  $this->Session->write('sendData', array('error'=>$error->message,'nowallname'=>$nowall_name));
                  break;
              case 'missing':
                  // リクエスト対象のオブジェクトが存在しない
                  $this->Session->write('sendData', array('error'=>$error->message,'nowallname'=>$nowall_name));
                  break;
              case 'service':
                  // WebPayに起因するエラー
                  $this->Session->write('sendData', array('error'=>$error->message,'nowallname'=>$nowall_name));
                  break;
              default:
                  // 未知のエラー
                  $this->Session->write('sendData', array('error'=>$error->message,'nowallname'=>$nowall_name));
                  break;
          }
          //申込失敗画面へ
          $this->redirect(array('controller'=>'error','action'=>'index'));
      } catch (\WebPay\ApiException $e) {
          // APIからのレスポンスが受け取れない場合。接続エラーなど
        exit;
          $this->Session->write('sendData', array('error'=>$error->message,'nowallname'=>$nowall_name));
          $this->redirect(array('controller'=>'error','action'=>'index'));
      } catch (\Exception $e) {
          // WebPayとは関係ない例外の場合
        debug($e);
          $this->Session->write('sendData', array('error'=>$error->message,'nowallname'=>$nowall_name));
          $this->redirect(array('controller'=>'error','action'=>'index'));
      }
        $Data = array('email'=> $email,
                                  'name'=>$name,
                                  'amount'=>$amount,
                                  'summary'=>$description
                                   );
        if(isset($period)) $Data['period'] = "dummy_check";
        //成功画面へ
        $this->Session->write('sendData',$Data);
        $this->redirect(array('controller'=>'purchased','action'=>'index'));
      }
      else{
        // $this->render('id/'$this->request->data['cha_rec_id']);
        $this->set('validationErrors', $this->User->validationErrors);
        // $this->Session->setFlash($this->User->validationErrors);
        $this->redirect($this->referer());
      }
    }
  }

}