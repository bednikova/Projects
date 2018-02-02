<?php
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.'/../../src/');

require_once __DIR__.'/../../lib/Pragmatic/Boostrap.php';

$bootstrap = new Pragmatic\Bootstrap();
$bootstrap->setDbCredentials('localhost', 'root', '', 'cv');
$bootstrap->setDefaultController('home');
$bootstrap->setTplPath(__DIR__.'/../../templates/admin');
$bootstrap->setMainTpl('main.php');
$bootstrap->setAppUrlPrefix('admin');
$bootstrap->setDefaultAppNS('\\App\\Admin\\');
$bootstrap->run();

