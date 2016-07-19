<?php

    App::uses('AppModel', 'Model');

    class CardHash extends AppModel{
          public $hasOne = array('User');
    }