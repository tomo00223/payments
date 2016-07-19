<?php

    App::uses('AppModel', 'Model');

    class Recursion extends AppModel{

          public $hasMany = array('Item');

          public $belongsTo = array('User');

    }