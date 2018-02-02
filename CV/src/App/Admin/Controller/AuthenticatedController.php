<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Admin\Controller;

/**
 * Description of AuthenticatedController
 *
 * @author muteX
 */
abstract class AuthenticatedController extends \Pragmatic\Controller {
	
	const LOGGED_USER_KEY = 'loggedUser';
	
	/**
	 *
	 * @var \App\Model\User\Administrator
	 */
	protected $loggedUser;


	public function __construct($request, $session, $response) {
		parent::__construct($request, $session, $response);
		
		$this->loggedUser = $this->session->get(self::LOGGED_USER_KEY);
		
		if ($this->loggedUser == null) {
			
			if ($this->request->getCurrentController() != 'administrativeuser' || $this->request->getCurrentAction() != 'login') {
				$this->response->redirect('administrativeuser', 'login');
			}
			
		}
	}
	
}
