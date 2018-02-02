<?php
namespace App\Admin\Controller;

use \App\Model\User\Customer as UserModel;

class UserController extends AuthenticatedController {
	
	public function index() {
		
		$paginator = new \Pragmatic\DBAL\Paginator(10);

		$users = UserModel::listItems('', $paginator);
		
		$data = array(
			'users' => $users,
			'paginator' => $paginator
		);
		
		$this->render($data, 'list.php');
		
	}
	
	public function update() {
		
		$userId = $this->request->get('id', $this->request->post('id', null));
		
		$user = UserModel::loadById($userId);
		
		if ( empty($user) ) {
			return false;
		}
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$user->hydrateFromPOSTData($this->request->post());
				$user->update();
				\Pragmatic\FlashMessage::write("User with id {$user->getId()} updated successfully ");
				$this->response->redirect('user', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$this->render($this->request->post(), 'form.php');
				return;
			}
		
		}
		
		$this->render(\Pragmatic\ModelHelper::modelToArray($user, false), 'form.php');
		
	}
	
	public function create() {
		
		$user = new UserModel();
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$user = UserModel::createFromPOSTData($this->request->post());
				$user->insert();
				\Pragmatic\FlashMessage::write("User with id {$user->getId()} created successfully ");
				$this->response->redirect('user', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$this->render($this->request->post(), 'form.php');
				return;
			}
			
		}
		
		$this->render(\Pragmatic\ModelHelper::modelToArray($user, false), 'form.php');
		
	}
	
	public function delete() {
		
		$user = UserModel::loadById($this->request->get('id'));
		$user->delete();
		\Pragmatic\FlashMessage::write("User with id {$user->getId()} has been deleted successfully");
		$this->response->redirect('information', 'index');
		
	}
	
}

