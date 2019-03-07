<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>

<?
// получить детальную фотограяю
$arIds = array();
if(is_array($arResult["DETAIL_PICTURE"]))
{
	$arIds[] = $arResult["DETAIL_PICTURE"]["ID"];
}
// получить доплнительные фотографии
if(is_array($arResult["PROPERTIES"]["PHOTO"]["VALUE"]) || is_array($arResult["DETAIL_PICTURE"]))
{
	foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as &$arItem)
	{
		$arIds[] = $arItem;
	}
	unset($arItem);
}

if(sizeof($arIds) > 0)
{
	$strIds = implode(",", $arIds);

	$fl = new CFile;

	$arOrder = array();
	$arFilter = array(
		"MODULE_ID" => "iblock",
		"@ID" => $strIds
	);

	$arPicture = array();
	$arSliderPicture = array();
	$arPreviewSliderPicture = array();

	$rsFile = $fl->GetList($arOrder, $arFilter);
	while($arItem = $rsFile->GetNext())
	{
		//$arPicture[$arItem["ID"]] = $arItem;

		// фотография для показа на страницу
		$extension = GetFileExtension("/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);
		//$urlPicture = itc\Resizer::get($arItem["ID"], 'width', 700, null, $extension);
		//$arPicture[$arItem["ID"]]["SRC"] = $urlPicture;

		// фотография для зума
		$urlSliderPicture = itc\Resizer::get($arItem["ID"], 'width', 1024, null, $extension);
		$arSliderPicture[$arItem["ID"]]["SRC"] = $urlSliderPicture;

		// фотографии для списка слайдов
		$urlPreviewSliderPicture = itc\Resizer::get($arItem["ID"], 'crop', 90, 90, $extension);
		$arPreviewSliderPicture[$arItem["ID"]]["SRC"] = $urlPreviewSliderPicture;
	}

	// если есть детальная добавить её в слайдер
	if (is_array($arResult["DETAIL_PICTURE"]))
	{
		$urlSliderPicture = itc\Resizer::get($arResult["DETAIL_PICTURE"]["ID"], 'width', 1024, null, "png");
		$arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE_DETAIL"][] = $urlSliderPicture;

		$urlSliderPicture = itc\Resizer::get($arResult["DETAIL_PICTURE"]["ID"], 'crop', 90, 90, "png");
		$arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE_PREVIEW"][] = $urlSliderPicture;
	}

	// фотографии для зума и списка слайдов
	foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as &$value)
	{
		$arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE_DETAIL"][] = $arSliderPicture[$value]["SRC"];
		$arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE_PREVIEW"][] = $arPreviewSliderPicture[$value]["SRC"];
	}
	unset($value, $arSliderPicture, $arPreviewSliderPicture);
}
else
{
	$arResult["PROPERTIES"]["NO_PHOTO"] = array(
		"SRC" => itc\Resizer::get(NO_PHOTO_ID, 'auto', 700, 457, NO_PHOTO_EXTENSION)
	);
}
?>