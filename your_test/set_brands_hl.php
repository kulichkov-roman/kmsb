<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
//die('disabled');
CModule::IncludeModule("iblock");

// получим актуальные XML_ID брендов из свойства-справочника
$arFilter = array(
    "IBLOCK_ID"     => CATALOG_IBLOCK_ID_KS,
    "ACTIVE"        => "Y",
    "!PROPERTY_CML2_MANUFACTURER" => false,
);

$arBrands = array();
$rsElements = CIBlockElement::GetList(array(), $arFilter, array("PROPERTY_CML2_MANUFACTURER"));
while($arElement = $rsElements->GetNext())
{
    $arBrandsValue[] = $arElement['PROPERTY_CML2_MANUFACTURER_VALUE'];
}

//echo "<pre>"; var_dump($arBrandsValue); echo "</pre>";die();

foreach ($arBrandsValue as $value)
{
    $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('NAME' => CATALOG_TABLE_MANUFACTURER)));

    if($arData = $rsData->fetch())
    {
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);
        $mainQuery = new \Bitrix\Main\Entity\Query($entity);
        $mainQuery->setOrder(array());
        $mainQuery->setFilter(array('UF_XML_ID' => $value));
        $mainQuery->setSelect(array('*'));

        $rsResult = $mainQuery->exec();
    }

    $rsResult = new CDBResult($rsResult);
    while ($arRow = $rsResult->Fetch())
    {
        $arBrands[] = $arRow["UF_NAME"];
    }
}

//echo "<pre>"; var_dump($arBrands); echo "</pre>";die();

/*получим имена и id существующих брендов*/
$arBrandToId = array();
$arFilter = array(
    "IBLOCK_ID" => BRANDS_IBLOCK_ID,
    "ACTIVE"    => "Y"
);
$rsElements = CIBlockElement::GetList(array(), $arFilter);
while( $arElement = $rsElements->GetNext() ) {
    $arBrandToId[ $arElement["NAME"] ] = $arElement["ID"];
}
$arBrandExistingNames = array_keys($arBrandToId);

/*с такими брендами нет товаров - удалим их*/
$arBrandOldNames = array_diff($arBrandExistingNames, $arBrands);
/*это новые бренды - добавим их*/
$arBrandNewNames = array_diff($arBrands, $arBrandExistingNames);

/*добавляем новые бренды*/
$arBrandFields = array(
    "IBLOCK_ID"     => BRANDS_IBLOCK_ID,
    "ACTIVE"        => "Y",
);

$obBrand = new CIBlockElement;

$arTranslitParams = Array(
    "max_len" => "50", // обрезает символьный код до 50 символов
    "change_case" => "L", // буквы преобразуются к нижнему регистру
    "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
    "replace_other" => "", // меняем левые символы на нижнее подчеркивание
    "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
);

foreach($arBrandNewNames as $Brand){
    $arBrandFields["NAME"] = $Brand;
    $arBrandFields["CODE"] = substr(CUtil::translit($Brand, "ru", $arTranslitParams), 0, 50);
    $NEW_Brand_ID = $obBrand -> Add(
        $arBrandFields
    );

    if($NEW_Brand_ID) {
        $arBrandToId[ $Brand ] = $NEW_Brand_ID;
    }
}

/*удалим старые бренды*/
$arBrandOldIds = array();
foreach($arBrandOldNames as $Brand){
    $arBrandOldIds[] = $arBrandToId[ $Brand ];
}

foreach($arBrandOldIds as $BrandId) {
    CIBlockElement::Delete($BrandId);
}

/*проставить привязку*/
$arFilter = array(
    "IBLOCK_ID"     => CATALOG_IBLOCK_ID_KS,
    "ACTIVE"        => "Y",
    "!PROPERTY_CML2_MANUFACTURER" => false
);

$BrandS_ID_PROP_NAME = "BRAND";
$rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "PROPERTY_CML2_MANUFACTURER"));
while( $arFields = $rsElements->GetNext() ) {

    $brandProp = $arFields["PROPERTY_CML2_MANUFACTURER_VALUE"];
    // $arBrandIds = array();

    $brandId = $arBrandToId[ $brandProp ];

    $ELEMENT_ID = $arFields["ID"];

    if($ELEMENT_ID && $brandId){
        CIBlockElement::SetPropertyValuesEx(
            $ELEMENT_ID,
            CATALOG_IBLOCK_ID_KS,
            array(
                $BrandS_ID_PROP_NAME => $brandId
            )
        );
    }
}

die('done');
?>