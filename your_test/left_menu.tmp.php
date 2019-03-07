<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//die('disable');

if (CModule::IncludeModule("iblock"))
{
    $output = date('d.m.Y H:i:s') . ' setUserFieldsQuantityLeftMenu' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);

    // получить все товары основные и баланс положительный
    $arSort = array();
    $arSelect = array("ID", "NAME", "IBLOCK_SECTION_ID");
    $arFilter = array(
        "ACTIVE" => "Y",
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
        "PROPERTY_AKSESSUAR_V_GRUPPE" => "true",
        ">CATALOG_QUANTITY" => 0,
    );
    $arGroupBy = array('IBLOCK_SECTION_ID');

    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        $arGroupBy,
        false,
        $arSelect
    );

    while ($arItem = $rsElements->GetNext())
    {
        $arElement[] = $arItem;
    }

    // создать список идентификаторв разделов
    $arIds = array();
    foreach($arElement as &$arItem)
    {
        $arIds[] = $arItem["IBLOCK_SECTION_ID"];
    }
    unset($arItem, $arElement);

    foreach($arIds as $key=>$id)
    {
        // получить массив всех родительских идентификатов до корневого раздела
        $rsPath= GetIBlockSectionPath(CATALOG_IBLOCK_ID_KS, $id);
        while($arItem = $rsPath->GetNext())
        {
            $arPath[] = $arItem["ID"];
        }
        $arIds[$key] = array(
            "ID" => $id,
            "PATH_ID" => $arPath,
        );
        unset($arPath);
    }

    $bs = new CIBlockSection;

    // "включить" свойство
    $arFields = Array(
        "UF_POSITIVE_BALANCES" => true,
    );

    // установить свойство, обновив разделы
    foreach($arIds as $arId)
    {
        if($arId["ID"] > 0)
        {
            $rsCurBs = $bs->Update($arId["ID"], $arFields);

            foreach($arId["PATH_ID"] as $id)
            {
                $rsPathBs = $bs->Update($id, $arFields);
            }
        }
    }
    unset($arId);

    $output .= date('d.m.Y H:i:s') . ' setUserFieldsQuantityLeftMenu end' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);
	
	
	
	echo 'done';
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>