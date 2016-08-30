<?
//CModule::IncludeModule("iblock");

//if($arParams["CATALOG_FILTER_PROP"]){
//    $groupPropName = "PROPERTY_BRAND";
//    $filterPropName = "PROPERTY_" . $arParams["CATALOG_FILTER_PROP"] . "_VALUE";
//
//    $arFilter = array("IBLOCK_ID" => CATALOG_IBLOCK_ID_KS, "ACTIVE" => "Y", $filterPropName => "Y");
//    $rsElements = CIBlockElement::GetList(
//        array(),
//        $arFilter,
//        array(
//            $groupPropName
//        )
//    );
//
//    $arFilteredBrandIds = array();
//    while( $arElement = $rsElements->GetNext() ) {
//        $arFilteredBrandIds[] = $arElement[ $groupPropName . '_VALUE' ];
//    }
//
//    foreach($arResult["ITEMS"] as $key => $arItem){
//        if(!in_array($arItem["ID"], $arFilteredBrandIds)){
//            unset($arResult["ITEMS"][ $key ]);
//        }
//    }
//}

global $USER;

$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();

if($arUser["UF_SHOW_PRICE_DEALER"] == "1")
{
    $arResult["SHOW_PRICE_DEALER"] = true;
}
else
{
    $arResult["SHOW_PRICE_DEALER"] = false;
}
//?>