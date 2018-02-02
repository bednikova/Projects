<?php
namespace Pragmatic;

abstract class Controller {
	
	/**
	 *
	 * @var Request
	 */
	protected $request;
	
	/**
	 *
	 * @var Session
	 */
	protected $session;
	
	/**
	 *
	 * @var Response
	 */
	protected $response;
	
	/**
	 *
	 * @var View
	 */
	protected $view;
	
	public function __construct($request, $session, $response) {
		$this->request = $request;
		$this->session = $session;
		$this->response = $response;
		$this->view = new View($request);
		$this->view->setSuffix($this->getSuffix());
	}
	
	protected function getSuffix() {
		$currentClass = get_called_class();
		$currentClassParts = explode('\\',$currentClass);
		$className = array_pop($currentClassParts);
		$className = str_ireplace('controller', '', $className);
		$className = strtolower($className);
		return $className;
	}
	
	
	protected function render($data, $tpl) {
		$content = $this->view->render($tpl, $data);
		$this->response->addContent($content);
		return $this->response;
	}
	
	protected function renderHeadless($data, $tpl) {
		$content = $this->view->render($tpl, $data, true);
		$this->response->addContent($content);
		return $this->response;
	}
	
}

