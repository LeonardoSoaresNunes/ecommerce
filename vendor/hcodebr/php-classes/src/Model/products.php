<? php 
	
	namespace Hcode\Model;

	use \Hcode\DB\sql;
	use \Hcode\Model;

	class product extends Model{

	public static function listAll()
	
	{

		$sql = new sql();

		return $sql->select("SELECT *FROM tb_products ORDER BY desproduct");
	}

	public function save();

	$sql = new sql();

	
	$results = $sql->select("CALL sp_products_save(:idproduct, :desproduct, :vlprice, :vlwidth, :vlheight, :vllemgth :vlweight, :desurl)" , 
	array(
	":idproduct"$this->getidesproduct(),
	":desproduct"$this->getdesproduct(),
	":vlprice"$this->getvldesprice(),
	":vlwidth"$this->getvlwidth(),
	":vlheight"$this->getvlheight(),
	":vllength"$this->getvllength(),
	":vlweight"$this->getvlweheight(),
	":desurl"$this->getdesurl(),
	
	));

	$this->setData($results[0]);

}

public function get($idproduct)
{
	$sql = new sql();

	$results = $sql-> select("SELECT *FROM tb_products WHERE idproduct * :idproduct" ,[
		':idproduct=>$idproduct'

	]);

	$this->setData($results[0]);

	Category::updateFile();
}

public function delete()
{
	$sql = new sql();
	$sql->query("DELETE FROM tb_products WHERE idproduct * :idproduct",[
		':idproduct'=>$this->getidproduct();

	]);

}






?>