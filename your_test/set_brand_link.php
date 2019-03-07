<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
die('disabled');
CModule::IncludeModule('iblock');

$startTime = time();
$arFilter = array(
    "IBLOCK_ID" => BRANDS_IBLOCK_ID,
    "ACTIVE"    => "Y"
);
$arBrandNameToId = array();
$rsElements = CIBlockElement::GetList(array(),$arFilter);
while( $arElement = $rsElements->GetNext() ) {
    $arBrandNameToId[ $arElement["NAME"] ] = $arElement["ID"];
}


$arFilter = array(
    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    "ACTIVE"    => "Y",
    "!PROPERTY_CML2_MANUFACTURER" => false
);
$arSelect = array(
    "ID",
    "PROPERTY_CML2_MANUFACTURER"
);

$linkPropertyCode = "BRAND";
$rsElements = CIBlockElement::GetList(array(),$arFilter, false, false, $arSelect);

while( $arElement = $rsElements->GetNext() ) {
    $brandName = $arElement["PROPERTY_CML2_MANUFACTURER_VALUE"];
    $brandId = $arBrandNameToId[ $brandName ];
    $elementId = $arElement["ID"];
    
    if($brandId){
        CIBlockElement::SetPropertyValuesEx($elementId, false, array($linkPropertyCode => $brandId));    
    }
}

pre(time() - $startTime);
echo 'compelted';
