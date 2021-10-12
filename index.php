<?php 

session_start();

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\page;
use \Hcode\PageAdmin;
use\Hcode\Model\user;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new page();

	$page->setTpl("index");

	

	
	//echo "Ecommerce Leonardo Nunes";



});

$app->get('/admin', function() {
	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get('/admin/login', function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false,

	])

	$page = new PageAdmin();

	$page->setTpl("login");

});

$app->post('admin/login' , function(){
	user::login($_POST["login"], $_POST["password"]);
	header("Location:/admin");
	exit;



});

$app->('admin/logout', function(){
	User::logout();
	header("Location:/admin/login");
	exit;
})


$app->run();

 ?>