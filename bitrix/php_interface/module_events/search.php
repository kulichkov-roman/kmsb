<?
//-->

AddEventHandler("search", "BeforeIndex", "leaveAddPropToInIndex");

function leaveAddPropToInIndex($arFields)
{
    if($arFields['MODULE_ID'] == 'iblock' && !empty($arFields['ITEM_ID']) && $arFields['PARAM2'] == CATALOG_IBLOCK_ID_KS)
    {
        $arFields['BODY'] = '';
        $arFields['TITLE'] = '';

        addPropertyToIndex(CATALOG_IBLOCK_ID_KS, $arFields['ITEM_ID'], "CML2_ARTICLE", $arFields['BODY']);
        addPropertyToIndex(CATALOG_IBLOCK_ID_KS, $arFields['ITEM_ID'], "CML2_ARTICLE", $arFields['TITLE']);
        addPropertyToIndex(CATALOG_IBLOCK_ID_KS, $arFields['ITEM_ID'], "NAIMENOVANIE_DLYA_SAYTA_POLNOE", $arFields['BODY']);
        addPropertyToIndex(CATALOG_IBLOCK_ID_KS, $arFields['ITEM_ID'], "NAIMENOVANIE_DLYA_SAYTA_POLNOE", $arFields['TITLE']);
    }
    return $arFields;
}
//<--
?>