<?php

namespace App\Admin\Controller;


class HomeController extends AuthenticatedController{
    
    public function index() {
		
		$paginator = new \Pragmatic\DBAL\Paginator(10);
		
		$home = \App\Model\Home::listItems('', $paginator);
		
		$data = array(
			'home' => $home,
			'paginator' => $paginator
		);
		
		$this->render($data, 'list.php');
		
	}
	
	public function update() {
		
		$homeId = $this->request->get('id', $this->request->post('id', null));
		
		if ( $homeId === null ) {
			return false;
		}
		
		$home = \App\Model\Home::loadById($homeId);
		
		if ( empty($homeId) ) {
			return false;
		}
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$home->hydrateFromPOSTData($this->request->post());
				$home->update();
				\Pragmatic\FlashMessage::write("Home with id {$home->getId()} updated successfully ");
				$this->response->redirect('home', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$this->render($this->request->post(), 'form.php');
				return;
			}
		
		}
		
		$this->render(\Pragmatic\ModelHelper::modelToArray($home, false), 'form.php');
		
	}
	
	public function create() {
		
		$home = new \App\Model\Home();
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$home = \App\Model\Home::createFromPOSTData($this->request->post());
				$home->insert();
				\Pragmatic\FlashMessage::write("Home with id {$home->getId()} created successfully ");
				$this->response->redirect('home', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$this->render($this->request->post(), 'form.php');
				return;
			}
			
		}
		
		$this->render(\Pragmatic\ModelHelper::modelToArray($home, false), 'form.php');
		
	}
	
	public function delete() {
		
		$skills = \App\Model\Skills::loadById($this->request->get('id'));
		$skills->delete();
		\Pragmatic\FlashMessage::write("Home with id {$skills->getId()} has been deleted successfully");
		$this->response->redirect('home', 'index');
		
	}
    
}
