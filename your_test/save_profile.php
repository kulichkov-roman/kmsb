<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
die('1');
CModule::IncludeModule('sale');
$ID = 48;

$profileId =  17;
CSaleOrderUserProps::Delete($profileId);
$profileId =  19;
CSaleOrderUserProps::Delete($profileId);



echo 'completed';
?>