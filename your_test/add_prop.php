<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('sale');

$orderId = 45;
$arFile = CFile::MakeFileArray('/sample.doc');
pre($arFile);
pre(CSaleOrderPropsValue::Add(array(
	'NAME' 				=> "Файл",
	'CODE'				=> "FILE",
	'ORDER_PROPS_ID' 	=> 28,
	'ORDER_ID' 			=> $orderId,
	'VALUE' 			=> CFile::SaveFile($arFile)
)));
pre($GLOBALS["APPLICATION"] -> GetException());
echo '1';