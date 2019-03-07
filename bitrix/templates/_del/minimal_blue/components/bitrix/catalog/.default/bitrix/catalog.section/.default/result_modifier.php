<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$delimiter = strpos($arParams['COMPARE_URL'], '?') ? '&' : '?';
// cache hack to use items list in component_epilog.php
$this->__component->arResult['IDS'] = array();
foreach ($arResult['ITEMS'] as $key => $arItem) 
{
	$this->__component->arResult['IDS'][] = $arItem['ID'];
	$arResult['ITEMS'][$key]['COMPARE_URL'] = str_replace("#ACTION_CODE#", "ADD_TO_COMPARE_LIST",$arParams['COMPARE_URL']).$delimiter."id=".$arItem['ID'];
}
$this->__component->SetResultCacheKeys(array('IDS'));

foreach ($arResult['ITEMS'] as $key => $arElement)
{
	if(is_array($arElement["DETAIL_PICTURE"]))
	{
		$arFileTmp = CFile::ResizeImageGet(
			$arElement['DETAIL_PICTURE'],
			array("width" => 75, 'height' => 225),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);

		$arResult['ITEMS'][$key]['PREVIEW_IMG'] = array(
			'SRC' => $arFileTmp["src"],
			'WIDTH' => IntVal($arSize[0]),
			'HEIGHT' => IntVal($arSize[1]),
		);
	}
}
?>