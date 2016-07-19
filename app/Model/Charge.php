<?php

    App::uses('AppModel', 'Model');

    class Charge extends AppModel{

          public $hasMany = array('Item');

          public $belongsTo = array('User');

    }