<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
die('disabled');
CModule::IncludeModule("iblock");
$arFilter = array(
    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    "ACTIVE"    => "Y"
);
$rsProps = CIBlockProperty::GetList(array(), $arFilter);

$obUpdateProp = new CIBlockProperty;
while( $arProp = $rsProps->GetNext() ) {
    if(strpos($arProp["CODE"], "CML2") === false){
        $propId = $arProp["ID"];
        $propCode = "PROP_" . $propId;
        $arUpdateFields = array(
            "CODE" => $propCode
        );
        
        $obUpdateProp -> Update(
            $propId,
            $arUpdateFields
        );    
    }
}

