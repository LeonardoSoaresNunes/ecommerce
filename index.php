<?php 

session_start();

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\page;
use \Hcode\PageAdmin;
use\Hcode\Model\user;

$app = new Slim();

$app->config('debug', true);

require_once("site.php");

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

$app->get('/admin/logout', function(){
	User::logout();
	header("Location:/admin/login");
	exit;
});

$app->get('/admin/users' , function(){

	User::verifyLogin();

	$users = User::listAll();

	$page = newAdmin();
	$page ->setTpl("users", array(
		"users" =>$users

	);

});

$app->get('/admin/users/create' , function(){

	User::verifyLogin();
	$page = newAdmin();
	$page ->setTpl("users/create");

});

$app->get("/admin/users/:iduser/dedelete", function($iduser){
	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);
	$user->delete();
	header("Location:/admin/users");
	exit;
});

$app->get('/admin/users/:iduser' , function($iduser){

	User::verifyLogin();

	$user = new User();
	$user->get((int)$iduser);

	$page = newAdmin();
	$page ->setTpl("users-update", array(
		"user"->$user->getValue()

	));

});


$app->post("admin/user/create" , function(){
	User::verifyLogin();
	var_dump($_POST);

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;
	$user->setData($_POST);
	$user->save();
	var_dump($user);
})

$app->post("admin/user/:iduser" , function($iduser){
	User::verifyLogin();
	$user = new User();
	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;



	$user->get((int)$iduser);
	$user->setData($_POST);
	$user->update();

	header("Location: /admin/users");
	exit;

});

$app->get("admin/forgot" , function(){
	$page = new PageAdmin([
		"header"->false,
		"footer"->false;

	])

	$page->setTpl("forgot");

}) ;

$app->post("/adminforgot" , function(){
	
	$user = User::getForgot($_POST["email"]);
	header("Location:/admin/forgot/sent");
	exit;

});

$app.get("admin/forgot/sent" , function(){

	$page = new PageAdmin9([
		"header"=>false,
		"footer"=>false



	]);
	$page->setTpl("forgot-sent");


});

$app->get("/admin/forgot/Reset" , function(){

	$user = User::validForgotDecrypt($_GET["code"]);

	$page= new PageAdmin([
		"header"=>false,
		"footer"=>false

	]);

	$page->setTpl("forgot-reset", array(

		"name"=>user["desperson"],
		"code"=>$GET["code"]

	));

});

$app->post("/admin/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);

	User::setForgotUsed($forgot["idcovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$password = password_hash("$_POST["password"]", PASSWORD_DEFAULT,[

		"cost"=>12

	]);

	$user->setPassword($password);




});


	$page= new PageAdmin([
		"header"=>false,
		"footer"=>false

	]);

	$page->setTpl("forgot-reset", array(

		"name"=>user["desperson"],
		"code"=>$GET["code"]

	));

	$app->get("/admin/categories" , function(){
		User::verifyLogin();

		$catogories = category::listAll();

		$page = new PageAdmin();
		$page->setTpl("categories", [
			'categories'=>catogories

		]);
	}
	

	$app->get("/admin/categories/create" , function(){
		User::verifyLogin();		

		$page = new PageAdmin();
		$page->setTpl("categories-create");



	});

	$app->post("/admin/categories/create" , function(){
		User::verifyLogin();		

		$category = new Category();
		$category->setData($_POST);
		$category->save();

		header('Location:/admin/categories');
		exit;



	});

	$app->("admin/categories/:idcategory/delete", function($idcategory){
		User::verifyLogin();
		
		$category = new category();
		$category->get((int)$idcategory);

		$category->delete();


		header('Location:/admin/categories');
		exit;


	});

	$app->get("admin/categories/:idcategory/update", function($idcategory){
		User::verifyLogin();

		$category = new Category();
		$category->get((int)$idcategory);
		
		$page = new PageAdmin();
		$page->setTpl("categories-update");

		'category'=>$category->getValues();


	});


	$app->post("admin/categories/:idcategory/update", function($idcategory){
		User::verifyLogin();

		$category = new Category();
		$category->get((int)$idcategory);

		$category->setData($_POST);
		$category->save();

		header('Location:/admin/categories');
		exit;



	});

	$app->get('categories/:idcategory', function ($idgategory){
		$category = new Category();

		$category->get((int)$idcategory);


		$page = new Page();

		$page->setTpl("category", [
			'category'=>$category->getValues();
			'products=>[]'

		]);

		$app->get("admin/products", function(){

			User::verifyLogin();
			$products = product::listAll();
			$page = new PageAdmin();

			$page->setTpl("products", [

				"products"=>$products


			]);
		});

		$app->get("admin/products/create", function(){

			User::verifyLogin();
			$products = product::listAll();
			$page = new PageAdmin();

			$page->setTpl("products-create");

	});
		$app->post("admin/products/create", function(){

			User::verifyLogin();
			$product = new product();

			$product->setData($_POST);
			$product->save();


			header("Location:/admin/products");
			exit;
	});


		$app->get("admin/products/idproduct", function(idproduct){

			User::verifyLogin();
			$product = new product();

			$product->get((int)$idprodut);
			
			$page = new PageAdmin();

			$page->setTpl("products-update",[
				'product'=>$product->getValues();

			]);

	});

		$app->get("admin/products/idproduct/delete", function(idproduct){

			User::verifyLogin();
			$product = new product();

			$product->get((int)$idprodut);
			
			$product->delete();

			
			header("Location:/admin/products");
			exit;

			

			]);
		}










$app->run();

 ?>