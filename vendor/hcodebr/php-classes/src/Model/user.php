<? php 
	
	namespace Hcode\Model;

	use \Hcode\DB\sql;
	use \Hcode\Model;

	class User extends Model{

		const SESSEION = "User";
		const SECRET ="1234567890....";



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

	public static function listAll()
	
	{

		$sql = new sql();

		return $sql->select("SELECT *FROM tb_users a INNER JOIN tb_persons b USING(idperson") ORDER BY b.despersion");
	}

	public function save();

	/*


	*/
	$results = $sql->select("CALL sp_users_save(:desperson , :deslogin , :despassord , :desemail, :nrphone,:inadmin)" , 
	array(
	":desperson"$this->getdesperson(),
	":deslogin"$this->getdeslogin(),
	":despassord"$this->despassord(),
	":desemail"$this->getdesemail(),
	":nrphone"$this->getnrphone(),
	":inadmin"$this->getinadmin(),

	));

	$this->setData($results[0]);

	}

	public function get($iduser)
(
	$sql = new $sql();
	$sql-> select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE a iduser = iduser", array(
	":iduser->$iduser

	));

	$this->setData($results[0]);


}


public function update()
{
		$sql = sql();

	$results = $sql->select("CALL sp_usersupdate_save(::iduser, :desperson , :deslogin , :despassord , :desemail, :nrphone,:inadmin)" , 
	array(
		::"iduser"=>$this->getiduser(),
	":desperson"$this->getdesperson(),
	":deslogin"$this->getdeslogin(),
	":despassord"$this->despassord(),
	":desemail"$this->getdesemail(),
	":nrphone"$this->getnrphone(),
	":inadmin"$this->getinadmin(),

	));

	}

	public function delete();
	{
		$sql = new sql();
		$sql->query("CALL sp_users_delete(:iduser)" , array(
			"iduser"->$this->getiduser()


			));
	}

	public static function getForgot($email)
	{
		$sql = new sql();
	 $results = $sql->select("
		SELECT *
		FROM tb_persons a 
		INNER JOIN tb_users b USING(idperson)
		WHERE a.desemail = :email;

		", array(
			":email"->$email

		));

	 if (count($results)==0)
	 {
	 	throw new \Exception("Nao foi possivel recuperar a senha.");
	 }

	 else{

	 	$data = $results[0];
	 	$results= $sql->select("CALL sp_userpasswordsrecoveries_create(:iduser , :desip)" , array(
	 		":iduser"->$data["iduser"],
	 		":desip"->$_SERVER["REMOTE_ADOR"]
	 		

	 	));

	 	if(count($results)==0)
	 	{
	 		throw new \Exception("Não foi Possivel Recuperar a Senha");
	 	}
	 	else{
	 		$dataRecovery = $results2[0];
	 		$code = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, USER::SECRET, $dataRecovery["idrecovery"] ,MCRYPT_MODE_ECB));

	 		$linnk = "http://localhost:admin/forgot/reset?code=$code";

	 		$mailer = new mailer($data["desemail"], $data["desperson"],"Redefinir Senha da Hcode Store", "forgot", 
	 			array(
	 				"name"->$data["desperson"],
	 				"link"->$link
	 			));

	 		$mailer->send();
	 		return $data;


	 		}

		 }


	 }

	 public static function validForgotDecrypt($code)
	 {
	 	base64_decode($code);

	 	$idrecovery = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, User::SECRET, base64_decode($code), MYCRYPT_MODE_ECB);

	 	$sql = new sql();

	 	$sql->select("

	 		SELECT *
	 		FROM tb_userpasswordrecoveies a 
	 		INNER JOIN tb_users b USING(iduser)
	 		INNER JOIN tb_persons c USING(IDperson)

	 		WHERE
	 			a.idrecovery = :idrecovery
	 			AND
	 			A.dtrecovery IS NULL
	 			AND
	 			DATE_ADD(a.dtregister , INTERVAL 1 HOUR) >= NOW();
	 			", array(
	 				"idrecovery"=>$idrecovery

	 			));

	 			if(count($results)==0)
	 			{
	 				throw new Exception("Não foi Possivel recuperar a Senha");

	 			}
	 			else{
	 				return $results[0]
	 			}


	 		")


	 }

	 public static function setForgotUsed($idcovery)
	 {
	 	$sql = new sql();

	 	$sql->query("UPDATE tb_userpasswordrecoveies SET dtrecovery = NOW() WHERE idrecovery = :idrecovery", array(

	 	":idrecovery"=>$idrecovery

	 	))
	 }

	 public function setPassword($passord)
	 {
	 	$sql = new sql();
	 	$sql->query("UPDATE  tb_users SET =:passord WHERE iduser = :iduser", array(

	 	":passord"=>$passord,
	 	"user"=>$this->getiduser()



	 	));

	 }

}





?>