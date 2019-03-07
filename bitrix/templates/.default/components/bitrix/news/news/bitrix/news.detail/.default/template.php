<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if($USER->isAdmin())
{
	//echo "<pre>"; var_dump($arResult); echo "</pre>";
}
?>

<div class="news-detail">
    <?if($arResult["DETAIL_PICTURE"]){?>
        <img class="detail_picture" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" title="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>"/>
    <?}?>
    <div class="detail_content">
        <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]){?>
            <span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
        <?}?>
        <?if(strlen($arResult["DETAIL_TEXT"])>0){?>
            <?=$arResult["DETAIL_TEXT"];?>
        <?} else {?>
            <?=$arResult["PREVIEW_TEXT"];?>
        <?}?>
    </div>
</div>