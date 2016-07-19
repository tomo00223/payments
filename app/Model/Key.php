<?php

    App::uses('AppModel', 'Model');

    class Key extends AppModel{

          public $useTable = false;

          public $validate = array(
            'nowall-name' => array(
                'rule1' => array(
                    'rule' => 'notBlank',
                    'message' => 'NOWALL担当者を入力してください'
                ),
            ),
            'name' => array(
                'rule1' => array(
                    'rule' => 'notBlank',
                    'message' => 'お客様名を入力してください'
                ),
            ),
            'email' => array(
                'rule1' => array(
                    'rule' => 'notBlank',
                    'message' => 'メールアドレスを入力してください'
                ),
                'rule2' => array(
                    'rule' => 'email',
                    'message' => 'メールアドレスを正しく入力してください'
                ),
            ),
            'summary' => array(
                'rule1' => array(
                    'rule' => 'notBlank',
                    'message' => '決済内容を入力してください'
                ),
            ),
            'amount' => array(
                'rule1' => array(
                    'rule' => 'notBlank',
                    'message' => '決済金額を入力してください'
                ),
                'rule2' => array(
                    'rule' => 'naturalNumber',
                    'message' => '決済金額を正しく入力してください'
                ),
            ),
            'day' => array(
                'rule1' => array(
                    'rule' => array('range', 0, 32),
                    'message' => '定期課金日を正しく入力してください',
                    'allowEmpty' => true
                ),
            ),
            'webpay-token' => array(
                'rule1' => array(
                    'rule' => 'notBlank',
                    'message' => 'カード情報を入力してください'
                ),
            ),
            'agree' => array(
                'rule1' => array(
                    'required' => true,
                    'message' => '同意する場合は、チェックボックスをオンにしてください'
                ),
            ),
          );

    }