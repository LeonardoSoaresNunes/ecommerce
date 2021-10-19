<? php 
	
	namespace Hcode\Model;

	use \Hcode\DB\sql;
	use \Hcode\Model;

	class category extends Model{

	public static function listAll()
	
	{

		$sql = new sql();

		return $sql->select("SELECT *FROM tb_categories ORDER BY descategory");
	}

	public function save();

	$sql = new sql();

	
	$results = $sql->select("CALL sp_categories_save(:idcategory, :descategory)" , 
	array(
	":idcategory"$this->getidcategory(),
	":desgategory"$this->getdescategory(),
	
	));

	$this->setData($results[0]);

}

public function get($idcategory)
{
	$sql = new sql();

	$results = $sql-> select("SELECT *FROM tb_categories WHERE idcategory * :idcategory" ,[
		':idcategory=>$idcategory'

	]);

	$this->setData($results[0]);
}

public function delete()
{
	$sql = new sql();
	$sql->query("DELETE FROM tb_categories WHERE idcategory * :idcategory",[
		':idcategory'=>$this->getidcategory();

	]);
}






?>