<?php
/**
 * Error Handling Controller
 *
 * Controller used by ErrorHandler to render error views.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Controller
 * @since         CakePHP(tm) v 2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Error Handling Controller
 *
 * Controller used by ErrorHandler to render error views.
 *
 * @package       Cake.Controller
 */
class ErrorController extends AppController {

/**
 * Uses Property
 *
 * @var array
 */
  public $uses = array();
  public $components = array('Session','Paginator','Cookie');

/**
 * Constructor
 *
 * @param CakeRequest $request Request instance.
 * @param CakeResponse $response Response instance.
 */
  public function index(){
    // $this->autoLayout = false;  // レイアウトをOFFにする
    // $this->layout = 'errorLayout';
    $this->layout = 'itemLayout';
    $this->set('title_for_layout','申込失敗画面 | ELITES') ;

    $tmp = $this->Session->read('sendData');

    if(empty($tmp))
    {
        $this->redirect('http://elite.sc/');
    }

    $this->set(array('error'=>$tmp["error"],'nowall_name'=>$tmp["nowallname"]));
    $this->Session->delete('sendData');

  }

  public function __construct($request = null, $response = null) {
    parent::__construct($request, $response);
    $this->constructClasses();
    if (count(Router::extensions()) &&
      !$this->Components->attached('RequestHandler')
    ) {
      $this->RequestHandler = $this->Components->load('RequestHandler');
    }
    if ($this->Components->enabled('Auth')) {
      $this->Components->disable('Auth');
    }
    if ($this->Components->enabled('Security')) {
      $this->Components->disable('Security');
    }
    $this->_set(array('cacheAction' => false, 'viewPath' => 'Errors'));
  }



}
