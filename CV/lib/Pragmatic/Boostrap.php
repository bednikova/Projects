<?php
namespace Pragmatic;

class Bootstrap {
	
	protected $defaultController;
	protected $defaultAction = 'index';
	protected $tplPath;
	protected $mainTpl;
	protected $defaultAppNS;
	protected $appUrlPrefix;
	
	protected $dbSetup;
	
	public function run() {
		
		set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.'/../');
		spl_autoload_register('spl_autoload', false);
		
		$dispatcher = new Dispatcher($this->defaultController, $this->defaultAction, $this->defaultAppNS);
		
		View::setMainTpl($this->mainTpl);
		View::setTplLocation($this->tplPath);
		
		$database = new DBAL\Database(
				$this->dbSetup['host'],
				$this->dbSetup['user'],
				$this->dbSetup['pass'],
				$this->dbSetup['db']
				);
		Model::setDB($database);
		
		$request = new Request();
		$session = new Session();
		
		FlashMessage::setSession($session);
		
		$response = $dispatcher->dispatch($request, $session);
		
		$response->respond();
		
	}
	
	public function setDbCredentials($host, $user, $pass, $db) {
		$this->dbSetup = array(
			'host'	=> $host,
			'user'	=> $user,
			'pass'	=> $pass,
			'db'	=> $db
		);
	}
	
	public function setTplPath($tpPath) {
		$this->tplPath = $tpPath;
	}
	
	public function setMainTpl($mainTpl) {
		$this->mainTpl = $mainTpl;
	}
	
	public function setDefaultController($defaultController) {
		$this->defaultController = $defaultController;
	}
	
	public function setDefaultAction($defaultAction) {
		$this->defaultAction = $defaultAction;
	}
	
	public function setDefaultAppNS($defaultAppNS) {
		$this->defaultAppNS = $defaultAppNS;
	}

	public function setAppUrlPrefix($appUrlPrefix) {
		$this->appUrlPrefix = $appUrlPrefix;
	}
	
}