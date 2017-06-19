<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//die('disable');

if (CModule::IncludeModule("iblock"))
{
    $arSort = array();
    $arSelect = array(
        "ID",
        "NAME"
    );
    $arFilter = array(
        "IBLOCK_ID" => BALANCES_PRODUCT_ID
    );
    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        false,
        $arSelect
    );
    while ($arItem = $rsElements->GetNext())
    {
        $arElements[] = $arItem;
    }
    $bl = new CIBlock;
    if($bl->GetPermission(BALANCES_PRODUCT_ID)>='W')
    {
        $el = new CIBlockElement;
        if(is_array($arElements))
        {
            global $DB;
            foreach ($arElements as &$arItem)
            {
                $DB->StartTransaction();
                if (!$el->Delete($arItem['ID']))
                {
                    $DB->Rollback();
                    return false;
                }
                else
                {
                    $DB->Commit();
                }
            }
            unset($arItem, $arElement);
        }
    }

    /*----*/

    $arSort = array(
        "timestamp_x" => "desc",
    );
    $arSelect = array(
        "ID",
        "NAME",
        "DETAIL_PICTURE",
        "PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE",
        "XML_ID"
    );
    $arFilter = array(
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    );
    $arNavStartParams = array(
        "nTopCount" => 100,
    );
    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        $arNavStartParams,
        $arSelect
    );
    $arIds = array();
    while ($arItem = $rsElements->GetNext())
    {
        $arElements[$arItem["ID"]] = $arItem;
        $arIds[] = $arItem["ID"];
    }

    $arKeyIds = array_rand($arIds, 20);
    foreach($arKeyIds as $key)
    {
        $arIdsTrunc[] = $arIds[$key];
    }

    $arElementsTrunc = array();
    foreach($arIdsTrunc as $id)
    {
        $arElementsTrunc[$id] = $arElements[$id];
    }

    $arDetailPictures = array();
    foreach($arElementsTrunc as &$arItem)
    {
        $arDetailPictures[$arItem["ID"]] = $arItem["DETAIL_PICTURE"];
    }
    unset($arItem, $arElements, $arIdsTrunc);

    $strDetailPictures = implode(",", $arDetailPictures);

    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        "MODULE_ID" => "iblock",
        "@ID" => $strDetailPictures
    );

    $rsFile = $fl->GetList(
        $arOrder,
        $arFilter
    );
    $arFile = array();
    while($arItem = $rsFile->GetNext())
    {
        $arFile[$arItem["ID"]] = $arItem;
        $arFile[$arItem["ID"]]["SRC"] = "/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"];
    }
    foreach($arElementsTrunc as &$arItem)
    {
        $arItem["DETAIL_PICTURE"] = $arFile[$arItem["DETAIL_PICTURE"]];
    }
    unset($arItem);

    $arProp = array();
    $el = new CIBlockElement;
    global $USER;

    foreach($arElementsTrunc as &$arItem)
    {
        $arProp[1115] = $arItem["ID"];

        $arLoadProductArray = Array(
            "MODIFIED_BY"    => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"      => BALANCES_PRODUCT_ID,
            "PROPERTY_VALUES"=> $arProp,
            "NAME"           => $arItem["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"],
            "ACTIVE"         => "Y",
            "DETAIL_PICTURE" => $fl->MakeFileArray($arItem["DETAIL_PICTURE"]["SRC"]),
            "XML_ID"         => $arItem['XML_ID']
        );

        if($productId = $el->Add($arLoadProductArray))
        {
            echo "New ID: " . $productId;
        }
        else
        {
            echo "Error: ".$el->LAST_ERROR;
        }
    }
    unset($arItem);
}
?>
