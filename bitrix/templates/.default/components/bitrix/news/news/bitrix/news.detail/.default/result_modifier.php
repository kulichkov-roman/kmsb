<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

// получение единичную фотографию
$id = "";
if(is_array($arResult["DETAIL_PICTURE"]))
{
    $id = $arResult["DETAIL_PICTURE"]["ID"];
}
if($id <> "")
{
    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        "MODULE_ID" => "iblock",
        "@ID" => $id
    );

    $arDetailPicture = array();

    $rsFile = $fl->GetList($arOrder, $arFilter);

    if($arItem = $rsFile->GetNext())
    {
        $arDetailPicture[$arItem["ID"]] = $arItem;

        $extension = GetFileExtension("/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);
        $urlDetailPicture = itc\Resizer::get($arItem["ID"], 'auto', 300, 274, $extension);

        $arResult["DETAIL_PICTURE"]["SRC"] = $urlDetailPicture;
    }
}
?>