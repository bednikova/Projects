<?php
namespace Pragmatic;

class Dispatcher {
	
	protected $defaultController;
	protected $defaultAction;
	protected $appNS;
	
	public function __construct($defaultController, $defaultAction, $appNS) {
		$this->defaultAction = $defaultAction;
		$this->defaultController = $defaultController;
		$this->appNS = $appNS;
	}
	
	public function dispatch(Request $request, Session $session) {
		
		$controllerName = $request->get('controller',$this->defaultController);
		$controllerClass = $this->appNS.'Controller\\'.ucfirst($controllerName).'Controller';
		$action = $request->get('action', $this->defaultAction);
		
		$response = new Response();
		
		if ( !class_exists($controllerClass) ) {
			$response->setStatus(404);
			return $response;
		}
		
		$request->setCurrentController($controllerName);
		$request->setCurrentAction($action);
		
		$controller = new $controllerClass($request, $session, $response);

		if ( !method_exists($controller, $action) ) {
			$response->setStatus(404);
			return $response;
		}
		
		$controller->$action();
		
		return $response;
		
	}
	
}
