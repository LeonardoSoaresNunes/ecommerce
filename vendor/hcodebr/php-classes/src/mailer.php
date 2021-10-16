<?php






namespace Hcode;

use Rain\Tpl;

class Mailer{

	const USERNAME = "leonardo@leonardo.com";
	const PASSWORD = "<?PASSWORD?>";
	CONST NAME_FROM = "Hcode Store";

	public function __construct( $toAddress , $toname, $subject, $tplName, $data = array())
	{

		$email = new \PHPMailer;

		$email->isSmtp();



		$mail->SMTPDebug = 0;


		$mail->Debugoutput="html";

		$email->host = 'leonardo@leonardo.com';
		

	}
}













?>