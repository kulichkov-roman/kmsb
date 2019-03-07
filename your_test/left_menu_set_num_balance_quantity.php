<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//die('disable');

if (CModule::IncludeModule("iblock"))
{
    $bs = new CIBlockSection;
    $be = new CIBlockElement;

    // обнулить значения UF_COUNT_ELEM и UF_COUNT_ELEM_BALANCE
    $arSort = array();
    $arFilter = array(
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    );
    $arSelect = array("ID", "NAME");

    $rsSection = $bs->GetList(
        $arSort,
        $arFilter,
        false,
        $arSelect,
        false
    );

    $arSection = array();
    while ($arItem = $rsSection->GetNext())
    {
        $arSectionIDs[] = $arItem["ID"];
    }
    unset($arItem, $arElement);

    $arFields = Array(
        "UF_COUNT_BALANCE" => "0",
    );

    foreach($arSectionIDs as $id)
    {
        if($id > 0)
        {
            $rsCurBs = $bs->Update($id, $arFields);
        }
    }
    unset($arId);

    // получить список разделов, в которых есть элементы.
    $arSort = array();
    $arSelect = array();
    $arFilter = array(
        "ACTIVE" => "Y",
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
        "PROPERTY_AKSESSUAR_V_GRUPPE" => "true",
        ">CATALOG_QUANTITY" => 0,
    );
    $arGroupBy = array('IBLOCK_SECTION_ID');

    $rsElements = $be->GetList(
        $arSort,
        $arFilter,
        $arGroupBy,
        false,
        $arSelect
    );

    // сохранить в список ID разделов
    $arIds = array();
    while ($arItem = $rsElements->Fetch())
    {
        $arIds[] = $arItem;

        // сохранить количество элементов в текущий раздел с элементами
        $countElemCurSection = IntVal($arItem["CNT"]);

        $arFields = Array(
            "UF_COUNT_BALANCE" => $countElemCurSection,
        );

        $rsSectionUpdate = $bs->Update($arItem["IBLOCK_SECTION_ID"], $arFields);
    }

    //echo sizeof($arIds);
    //echo "<pre>"; var_dump($arIds); echo "</pre>";die();

    // получить список всех родительских ID разделов в по списку с ID разделами
    foreach($arIds as &$arId)
    {
        $arPath = array();
        $rsPath= GetIBlockSectionPath(CATALOG_IBLOCK_ID_KS, $arId["IBLOCK_SECTION_ID"]);
        while($arItem = $rsPath->GetNext())
        {
            if($arItem["ID"] != $arId["IBLOCK_SECTION_ID"])
            {
                $arPath[] = $arItem["ID"];
            }
        }
        $arId["PATH_ID"] = $arPath;
        unset($arPath);
    }
    unset($arId);

    //echo sizeof($arIds);
    //echo "<pre>"; var_dump($arIds); echo "</pre>";die();

    // получить и добавить число элементов
    foreach($arIds as &$arId)
    {
        if(sizeof($arId)>0)
        {
            $arPath = array_reverse($arId["PATH_ID"]);

            //echo sizeof($arIds);
            //echo "<pre>"; var_dump($arId["PATH_ID"]); echo "</pre>";
            //echo "<pre>"; var_dump($arPath); echo "</pre>";

            foreach($arPath as &$id)
            {
                // получить свойство UF_COUNT_ELEM по списку
                $arSort = array();
                $arFilter = array(
                    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
                    "ID" => $id
                );
                $arSelect = array(
                    "ID",
                    "NAME",
                    "UF_COUNT_BALANCE"
                );

                $rsSection = $bs->GetList(
                    $arSort,
                    $arFilter,
                    false,
                    $arSelect,
                    false
                );

                $countElemParentSection = 0;
                $countElemCurSection = IntVal($arId["CNT"]);;

                if($arItem = $rsSection->GetNext())
                {
                    $countElemParentSection = IntVal($arItem["UF_COUNT_BALANCE"]);
                }

                // к полученному свойству прибавить количество у текущей секции
                $sumCount = $countElemParentSection + $countElemCurSection;

                //echo "<pre>"; var_dump($sumCount); echo "</pre>"; die();

                $arFields = Array(
                    "UF_COUNT_BALANCE" => $sumCount,
                );

                $rsSectionUpdate = $bs->Update($id, $arFields);
            }
            unset($id);
        }
    }
    unset($arId);

    die("done");
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>