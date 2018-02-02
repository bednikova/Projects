<?php
namespace Pragmatic;

class Request {
	
	protected $get;
	protected $post;
	protected $request;
	protected $cookie;
	protected $url;
	protected $files;
	protected $method;
	protected $controller;
	protected $action;
	
	const METHOD_POST = 'POST';
	const METHOD_GET = 'GET';
	
	public function __construct() {
		$this->get = $_GET;
		$this->post = $_POST;
		$this->request = $_REQUEST;
		$this->cookie = $_COOKIE;
		$this->files = $_FILES;
		$this->url = $_SERVER['SCRIPT_NAME'];
		$this->method = $_SERVER['REQUEST_METHOD'];
	}
	
	public function getUrl() {
		return $this->url;
	}
	
	public function get($name = '', $defaultValue = null) {
		return $this->fetchValue($name, $this->get, $defaultValue);
	}
	
	public function post($name = '', $defaultValue = null) {
		return $this->fetchValue($name, $this->post, $defaultValue);
	}
	
	public function request($name = '', $defaultValue = null) {
		return $this->fetchValue($name, $this->request, $defaultValue);
	}
	
	public function cookie($name = '', $defaultValue = null) {
		return $this->fetchValue($name, $this->cookie, $defaultValue);
	}
	
	public function files() {
		return $this->files;
	}
	
	public function method() {
		return $this->method;
	}
	
	protected function fetchValue( $name, $superGlobal, $default = null ) {
		
		if ( empty($name) ) {
			return $superGlobal;
		}
		
		if ( !array_key_exists($name, $superGlobal) ) {
			return $default;
		}
		
		return $superGlobal[$name];
		
	}
	
	public function createUrl($controller = null, $action = null, $params = array(), $keepQueryString = false) {
		
		if ( $controller === null ) {
			$controller = $this->controller;
		}
		
		if ( $action === null ) {
			$action = $this->action;
		}
		
		$url = "{$_SERVER['SCRIPT_NAME']}?controller=$controller&action=$action";
		
		if ( $keepQueryString ) {
			$url.='&'.$_SERVER['QUERY_STRING'];
		}
		
		if ( !empty($params) ) {
			$url.='&'.http_build_query($params);
		}
		
		return $url;
		
	}
	
	public function setCurrentController($controllerName) {
		$this->controller = $controllerName;
	}
	
	public function setCurrentAction($action) {
		$this->action = $action;
	}
	
	public function getCurrentController() {
		return $this->controller;
	}
	
	public function getCurrentAction() {
		return $this->action;
	}
	
	/**
	 * Creates a relative url, based on the current page position
	 * @param type $url
	 * @return string Description
	 */
	public function createAbsoluteUrl($url, $keepQueryString = false) {
		$baseUrl = $_SERVER['SCRIPT_NAME'];
		$baseUrl = preg_replace('~/?index.php~', '', $baseUrl).'/';

		if ( $keepQueryString ) {
			if ( strpos($url, '?') === false ) {
				$url.='?'.$_SERVER['QUERY_STRING'];
			} else {
				$url.='&'.$_SERVER['QUERY_STRING'];
			}

		}

		return $baseUrl.$url;
	}

	/**
	 * 
	 * Checks if the current url matches the given page
	 * 
	 * @param string $page
	 * @return boolean
	 */
	public function isActive($page) {
		return (strpos($this->controller,$page) !== false);
	}
	
}

