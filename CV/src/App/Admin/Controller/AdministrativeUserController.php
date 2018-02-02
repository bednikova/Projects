<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Admin\Controller;

/**
 * Description of AdministrativeUserController
 *
 * @author muteX
 */
class AdministrativeUserController extends AuthenticatedController {
	
	public function login() {
		
		$this->session->set(AuthenticatedController::LOGGED_USER_KEY, null);
		
		if ($this->request->method() == \Pragmatic\Request::METHOD_POST) {
			
			$username = $this->request->post('username',null);
			$password = $this->request->post('password',null);

			$validUser = \App\Model\User\Administrator::checkCredentials($username, $password);
			
			if ($validUser !== null) {
				$this->session->set(AuthenticatedController::LOGGED_USER_KEY, $validUser);
				$this->response->redirect('home', 'index');
			} else {
				\Pragmatic\FlashMessage::write("Invalid username or password");
			}
		
		}
		
		$this->renderHeadless([], 'login.php');
	}
	
}
