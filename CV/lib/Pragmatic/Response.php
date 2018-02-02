<?php
namespace Pragmatic;

class Response {
	
	protected $content = '';
	
	protected $status = 200;
	
	public function setStatus($status) {
		$this->status = $status;
	}
	
	public function addContent($content) {
		$this->content.=$content;
	}
	
	public function redirect($controller, $action, $params = array(), $keepQueryString = false) {
		$url = "{$_SERVER['SCRIPT_NAME']}?controller=$controller&action=$action";
		
		if ( $keepQueryString ) {
			$url.='&'.$_SERVER['QUERY_STRING'];
		}
		
		if ( !empty($params) ) {
			$url.='&'.http_build_query($params);
		}
		
		header("Location: $url");
		exit();
	}
	
	public function respond() {
		header("HTTP/1.0 $this->status");
		echo $this->content;
		exit();
	}
	
}
