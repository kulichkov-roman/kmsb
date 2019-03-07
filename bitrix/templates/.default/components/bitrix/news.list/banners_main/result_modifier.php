<?
$arParams;
$arResult;

$Sections = array();
$SectionsRes = CIBlockSection::GetList(
  array("SORT"=>"ASC"),
  array(
    'IBLOCK_ID' => $arParams['IBLOCK_ID']
  ),
  FALSE,
  array(),
  FALSE
);

$arResult['DATA']['ITEMS'] = array();
while($array = $SectionsRes->Fetch()){
  $arResult['DATA']['ITEMS'][$array['ID']] = array(
    'NAME' => $array['NAME'],
    'ITEMS' => array()
  );
}

foreach ($arResult['ITEMS'] as $Item){
  if (!empty($Item['IBLOCK_SECTION_ID']) && isset($arResult['DATA']['ITEMS'][$Item['IBLOCK_SECTION_ID']])){
    if (!empty($Item['PREVIEW_PICTURE'])){
		$Item['SCALED_PREVIEW_PICTURE']['SRC'] = itc\Resizer::get($Item['PREVIEW_PICTURE']['ID'], 'crop', 120, 120);
    }
    $arResult['DATA']['ITEMS'][$Item['IBLOCK_SECTION_ID']]['ITEMS'][$Item['ID']] = $Item;
  }
}




