<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
$order = array('sort' => 'asc');
$tmp = 'sort'; // параметр проигнорируется методом, но обязан быть
$userId = 22;
$rsUsers = CUser::GetList($order, $tmp, array("ID" => $userId), array("SELECT" => array("UF_*")));
$arUser = $rsUsers -> GetNext();
$arFiles = array();
foreach($arUser["UF_FILES"] as $fileId){
	$arFiles[] = CFile::GetPath($fileId);
}
?>