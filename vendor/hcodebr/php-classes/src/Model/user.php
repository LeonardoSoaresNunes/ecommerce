<? php 
	
	namespace Hcode\Model;

	use \Hcode\DB\sql;
	use \Hcode\Model;

	class User extends Model{

		const SESSEION = "User";

		public static function login ($login , $passord)

		{
			sql = sql();

			$results = sql->select ("SELECT *FROM tb_users WHERE deslogin =:LOGIN" , array(
				":LOGIN"=>$login
			));

			if (count($results)=== 0){
				throw new \Exception("Usuario Inexistente ou Senha Invalida", 1);
			}

			$data = $results[0];

			if(password_verify($password, $data["despassord"])===true){

				$user = new User();

			}else{

				throw new \Exception("Usuario Insexistente ou Senha Invalida.");
			}

			$data = $results[0];
			if (password_verify($password ,$data["despassord"]) ===true)
			{
				$user = new user();
				$user->setData($data);

				$__SESSION[User::SESSEION]=$user->getValues();
				return $user;

			}else{

			}


		}

		public function verifyLogin($inadmin = true)
		{
			if (isset($_SESSION[User::SESSEION])


				|| 
				$_SESSION[User::SESSEION]
				||
				!(int)$_SESSION[User::SESSEION]["iduser"] >0
				(bool)$SESSEION[User::SESSEION]["inadmin"] !== $inadmin

		){
				header("Location::/admin/login");
			exit;

			}
	}

	public static function logout()
	{
		$_SESSION[User::SESSEION] = NULL;
	}
}




?>