<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\page;
use \Hcode\PageAdmin;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new page();

	$page->set("index");

	

	
	//echo "Ecommerce Leonardo Nunes";



});

$app->get('admin', function() {

	$page = new PageAdmin();

	$page->set("index");

	

	
	//echo "Ecommerce Leonardo Nunes";



});

$app->run();

 ?>