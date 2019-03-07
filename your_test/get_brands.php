<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
die('disabled');
CModule::IncludeModule("iblock");

$groupPropName = "PROPERTY_981";
$groupPropName = "PROPERTY_CML2_MANUFACTURER";

$arFilter = array("IBLOCK_ID" => CATALOG_IBLOCK_ID_KS, "ACTIVE" => "Y");
$rsElements = CIBlockElement::GetList(
    array(),
    $arFilter,
    array(
        $groupPropName
    ) 
);

$counter = 0;
$obBrand = new CIBlockElement;
$arAddFields = array(
    "IBLOCK_ID" => BRANDS_IBLOCK_ID,
    "ACTIVE"    => "Y"
);
while( $arElement = $rsElements->GetNext() ) {
    $brandName = $arElement[ $groupPropName . '_VALUE' ];
    if($brandName){
        $arAddFields["NAME"] = $brandName;
        
        $obBrand -> Add($arAddFields);
    }
}
echo 'completed';
