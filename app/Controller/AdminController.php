<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

require VENDORS . 'autoload.php';
use WebPay\WebPay;

class AdminController extends AppController {

    public $components = array('Session');

    public function beforeFilter() {
        parent::beforeFilter();

        switch (true) {
            case !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']):
            case $_SERVER['PHP_AUTH_USER'] !== 'admin':
            case $_SERVER['PHP_AUTH_PW']   !== 'password':
                header('WWW-Authenticate: Basic realm="Please enter your ID and password"');
                header('HTTP/1.0 401 Unauthorized');
                die("Invalid id / password combination.  Please try again");
        }
    }

    public function generate() {
        $this->layout = 'adminLayout';

        if ($this->request->is('post'))
        {
            $this->Admin->set($this->request->data['Admin']);

            if($this->Admin->validates())
            {
                $key = uniqid();

                $nowallname = $this->base64_urlsafe_encode($this->request->data['Admin']['nowall-name']);
                $name = $this->base64_urlsafe_encode($this->request->data['Admin']['name']);
                $email = $this->base64_urlsafe_encode($this->request->data['Admin']['email']);
                $summary = $this->base64_urlsafe_encode($this->request->data['Admin']['summary']);
                $amount = $this->base64_urlsafe_encode($this->request->data['Admin']['amount']);
                $period = $this->base64_urlsafe_encode($this->request->data['Admin']['period']);

                $period = str_replace('.', '', $period);

                // URL作成
                $url = "https://elite.sc/payments/key/". $key. "?".
                            "nowall-name=". $nowallname.
                            "&name=". $name.
                            "&email=". $email.
                            "&summary=". $summary.
                            "&amount=". $amount.
                            "&period=". $period;

                $this->request->data['Admin'] += array('url' => $url);


                // ここからルーティング追加
                $file = APP . "Config/routes.php";
                // ファイルをオープンして既存のコンテンツを取得
                $current = file_get_contents($file);
                // 新しいルートをファイルに追加
                $addroute = preg_replace("/\/\/fromkey/","//fromkey\n    Router::connect('/key/".$key. "', array('controller' => 'key', 'action' => 'index')); //time:".time(),$current);
                // 結果をファイルに書き出し
                file_put_contents($file, $addroute);


                // ここからメール送信
                $email = new CakeEmail('default');

                $res = $email->config(array('log' => 'emails'))
                             ->from(array('info@hoge.co.jp' => 'ELITES事務局'))
                             ->to($this->request->data['Admin']['email'])
                             ->subject('[ELITES] 決済URL通知メール')
                             ->send($this->emailcontent_url($this->request->data['Admin']['name'],$url));

                $res = $email->config(array('log' => 'emails'))
                             ->from(array('info@hoge.co.jp' => 'ELITES事務局'))
                             ->to($this->request->data['Admin']['email'])
                             ->subject('[ELITES] ID/PW通知メール')
                             ->send($this->emailcontent_idpw($this->request->data['Admin']['name']));

                // POSTの内容をSESSIONに保存
                $this->Session->write('sendData', $this->request->data);

                $this->redirect(array('action' => 'generated'));
            }

        }
    }

    public function generated() {
        $this->layout = 'adminLayout';$this->Session->write = array();

        if(!SessionComponent::check('sendData'))
        {
            $this->redirect(array('action' => 'generate'));
        }
        else
        {
            $this->Session->read('sendData');

            $this->set('sendData', $_SESSION['sendData']);

            // セッションの内容を消す
            $this->Session->delete('sendData');
        }
    }

    private function emailcontent_url($name, $url) {

        $emailcontent = $name. "様\n\nお世話になっております。\nELITES事務局です。\n\nこちらから課金情報の登録をお願いします。\n\n". $url."\n\nこのURLはメール送信後24時間有効です。\n\nまた本メールは自動送信のため、返信しないようお願いします。";

        return $emailcontent;
    }

    private function emailcontent_idpw($name) {

        $emailcontent = $name. "様\n\nお世話になっております。\nELITES事務局です。\n\n課金情報登録ページ用のID/PWを送信致します。\n課金情報登録用URLを閲覧する際には、このID/PWを使用してください。\n\nID: id\nPW: password\n\nまた本メールは自動送信のため、返信しないようお願いします。";

        return $emailcontent;
    }

    private function base64_urlsafe_encode($val) {
        $val = base64_encode($val);
        return str_replace(array('+', '/', '='), array('_', '-', '.'), $val);
    }
}
