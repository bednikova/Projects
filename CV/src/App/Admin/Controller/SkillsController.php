<?php

namespace App\Admin\Controller;


/**
 * Description of SkillsController
 *
 * @author bednikova
 */
class SkillsController extends AuthenticatedController {
    
    	    
	public function index() {
		
		$paginator = new \Pragmatic\DBAL\Paginator(10);
		
		$skills = \App\Model\Skills::listItems('', $paginator);
		
		$data = array(
			'skills' => $skills,
			'paginator' => $paginator
		);
		
		$this->render($data, 'list.php');
		
	}
	
	public function update() {
		
		$skillsId = $this->request->get('id', $this->request->post('id', null));
		
		if ( $skillsId === null ) {
			return false;
		}
		
		$skills = \App\Model\Skills::loadById($skillsId);
		
		if ( empty($skillsId) ) {
			return false;
		}
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$skills->hydrateFromPOSTData($this->request->post());
				$skills->update();
				\Pragmatic\FlashMessage::write("Skills with id {$skills->getId()} updated successfully ");
				$this->response->redirect('skills', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$this->render($this->request->post(), 'form.php');
				return;
			}
		
		}
		
		$this->render(\Pragmatic\ModelHelper::modelToArray($skills, false), 'form.php');
		
	}
	
	public function create() {
		
		$skills = new \App\Model\Skills();
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$skills = \App\Model\Skills::createFromPOSTData($this->request->post());
				$skills->insert();
				\Pragmatic\FlashMessage::write("Skills with id {$skills->getId()} created successfully ");
				$this->response->redirect('skills', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$this->render($this->request->post(), 'form.php');
				return;
			}
			
		}
		
		$this->render(\Pragmatic\ModelHelper::modelToArray($skills, false), 'form.php');
		
	}
	
	public function delete() {
		
		$skills = \App\Model\Skills::loadById($this->request->get('id'));
		$skills->delete();
		\Pragmatic\FlashMessage::write("Skills with id {$skills->getId()} has been deleted successfully");
		$this->response->redirect('skills', 'index');
		
	}
}
