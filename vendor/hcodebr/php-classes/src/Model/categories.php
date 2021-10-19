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

	Category::updateFile();
}

public function delete()
{
	$sql = new sql();
	$sql->query("DELETE FROM tb_categories WHERE idcategory * :idcategory",[
		':idcategory'=>$this->getidcategory();

	]);

}

public static function updateFile();

{
	$categories = category::listAll();

	$html = [];

	foreach ($categories as $row) {

		array_push($html ,'<li><a href="/categories/'.$row['idcategory'].'">'.$row['descategory'].'</a><li>');
		
	}

	file_put_contents($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR ."views". DIRECTORY_SEPARATOR ."categories-menu.html", implode('', $html));
}






?>