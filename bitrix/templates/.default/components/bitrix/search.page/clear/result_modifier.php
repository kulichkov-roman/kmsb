<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult["TAGS_CHAIN"] = array();
if($arResult["REQUEST"]["~TAGS"])
{
	$res = array_unique(explode(",", $arResult["REQUEST"]["~TAGS"]));
	$url = array();
	foreach ($res as $key => $tags)
	{
		$tags = trim($tags);
		if(!empty($tags))
		{
			$url_without = $res;
			unset($url_without[$key]);
			$url[$tags] = $tags;
			$result = array(
				"TAG_NAME" => htmlspecialcharsex($tags),
				"TAG_PATH" => $APPLICATION->GetCurPageParam("tags=".urlencode(implode(",", $url)), array("tags")),
				"TAG_WITHOUT" => $APPLICATION->GetCurPageParam((count($url_without) > 0 ? "tags=".urlencode(implode(",", $url_without)) : ""), array("tags")),
			);
			$arResult["TAGS_CHAIN"][] = $result;
		}
	}
}

//if($USER->isAdmin())
//{
//	echo "<pre>"; var_dump($arResult["SEARCH"]); echo "</pre>";
//}

$arIDs = array();
foreach($arResult["SEARCH"] as &$arItem)
{
    $arIDs[] = $arItem["ITEM_ID"];
}
unset($arItem);

$arSort = array();
$arSelect = array(
    "ID",
    "NAME",
    "PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE",
    "PROPERTY_NAIMENOVANIE_DLYA_SAYTA_KRATKOE",
	"PROPERTY_CML2_ARTICLE",
    "DETAIL_TEXT",
	"DETAIL_PICTURE"
);
$arFilter = array("IBLOCK_ID" => CATALOG_IBLOCK_ID_KS, "ID" => $arIDs);

$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    false,
    $arSelect
);

while ($arItem = $rsElements->GetNext())
{
    $arElement[$arItem["ID"]] = $arItem;
}

$arDetailPictures = array();
foreach($arResult["SEARCH"] as &$arItem)
{
    $arItem["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_KRATKOE_VALUE"] = $arElement[$arItem["ITEM_ID"]]["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_KRATKOE_VALUE"];
    $arItem["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"]  = $arElement[$arItem["ITEM_ID"]]["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"];
    $arItem["PROPERTY_CML2_ARTICLE_VALUE"]  = $arElement[$arItem["ITEM_ID"]]["PROPERTY_CML2_ARTICLE_VALUE"];
    $arItem["DETAIL_TEXT"]  = $arElement[$arItem["ITEM_ID"]]["DETAIL_TEXT"];

	if($arElement[$arItem["ITEM_ID"]]["DETAIL_PICTURE"] <> "")
	{
		$arItem["DETAIL_PICTURE"] = $arElement[$arItem["ITEM_ID"]]["DETAIL_PICTURE"];
		$arDetailPicturesIDs[] = $arElement[$arItem["ITEM_ID"]]["DETAIL_PICTURE"];
	}
	else
	{
		$arItem["DETAIL_PICTURE"] = itc\Resizer::get(NO_PHOTO_PL_94_94_ID, 'auto', 94, 94, NO_PHOTO_DEFAULT_EXTENSION);
	}

}
unset($arItem);

if(sizeof($arDetailPicturesIDs) > 0)
{
	$strIds = implode(",", $arDetailPicturesIDs);

	$fl = new CFile;

	$arOrder = array();
	$arFilter = array(
		"MODULE_ID" => "iblock",
		"@ID" => $strIds
	);

	$arDetailPictures = array();

	$rsFile = $fl->GetList($arOrder, $arFilter);
	while($arItem = $rsFile->GetNext())
	{
		$arDetailPictures[$arItem["ID"]] = $arItem;

		$extension = GetFileExtension("/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);
		$urlDetailPictures = itc\Resizer::get($arItem["ID"], 'auto', 94, 94, $extension);

		$arDetailPictures[$arItem["ID"]]["SRC"] = $urlDetailPictures;
	}

	foreach($arResult["SEARCH"] as &$arItem)
	{
		// заполняется часть $arItem["DETAIL_PICTURE"]
		// заглушки проставляются в строке 78
		if($arDetailPictures[$arItem["DETAIL_PICTURE"]]["SRC"] <> "")
		{
			$arItem["DETAIL_PICTURE"] = $arDetailPictures[$arItem["DETAIL_PICTURE"]]["SRC"];
		}
	}
	unset($arItem);
}

// fullNameSort в functions.php
if(isset($_GET["how"]) && $_GET["how"] == "na")
{
	// сортировка от а до я
	usort($arResult["SEARCH"], "fullNameSortAsc");
}
elseif(isset($_GET["how"]) && $_GET["how"] == "nd")
{
	// сортировка от я до а
	usort($arResult["SEARCH"], "fullNameSortDesc");
}
else
{
	// сортировка от а до я
	usort($arResult["SEARCH"], "fullNameSortAsc");
}

//if($USER->isAdmin())
//{
//	//echo "<pre>"; var_dump($arResult["SEARCH"]); echo "</pre>";
//	$array = array(
//		array('id' => 1, 'category_name' => 'ааа'),
//		array('id' => 2, 'category_name' => 'яяя'),
//		array('id' => 3, 'category_name' => 'ббб')
//	);
//
//	usort($array, function($l, $r) {
//		return strcmp($r["category_name"],$l["category_name"]);
//	});
//
//	pre($array);
//
//}
?>