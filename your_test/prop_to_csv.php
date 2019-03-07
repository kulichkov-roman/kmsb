<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
//die('disabled');
CModule::IncludeModule("iblock");
$arFilter = array(
    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    "ACTIVE"    => "Y"
);
$rsProps = CIBlockProperty::GetList(array(), $arFilter);

$obUpdateProp = new CIBlockProperty;
while( $arProp = $rsProps->GetNext() ) {
    
	$arPropTmp = array($arProp["NAME"], $arProp["CODE"]);
	$arPropsList[] = $arPropTmp;
}

$fp = fopen($_SERVER["DOCUMENT_ROOT"]."/eventsend_log.txt", 'w');

foreach ($arPropsList as $fields) {
	fputcsv($fp, $fields, ';');
}

fclose($fp);

