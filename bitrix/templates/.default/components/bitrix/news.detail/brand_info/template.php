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

//echo "<pre>"; var_dump($arResult); echo "</pre>";
?>
<?if(strlen($arResult["DETAIL_TEXT"])>0 || is_array($arResult["DETAIL_PICTURE"])){?>
    <div class="manufacturer-info">
        <div class="manufacturer-logo">
            <a rel="nofollow" href="<?=$arResult["PROPERTIES"]["LINK_SITE"]["VALUE"] <> "" ? $arResult["PROPERTIES"]["LINK_SITE"]["VALUE"] : 'javascript:void(0);'?>">
                <?
                if (!is_array($arResult["DETAIL_PICTURE"])) {
                    $photo = itc\Resizer::get(NO_PHOTO_ID, 'width', 300, null, NO_PHOTO_EXTENSION);
                } else {
                    $extension = end(explode('.', $arResult["DETAIL_PICTURE"]["SRC"]));
                    $photo = itc\Resizer::get($arResult["DETAIL_PICTURE"]["ID"], 'width', 300, null, $extension);
                }
                ?>
                <img src="<?=$photo?>" border="0" alt="">
            </a>
        </div>
        <div class="manufacturer-text">
            <div class="manufacturer-descr">
                <?
                if(strlen($arResult["DETAIL_TEXT"])>0){
                    echo $arResult["DETAIL_TEXT"];
                } else {
                    echo $arResult["PREVIEW_TEXT"];
                }
                ?>
            </div>
            <?if($arResult["PROPERTIES"]["LINK_SITE"]["VALUE"] <> ""){?>
                <div class="manufacturer-site">
                    Сайт: <a rel="nofollow" href="<?=$arResult["PROPERTIES"]["LINK_SITE"]["VALUE"]?>" target="_blank"><?=$arResult["PROPERTIES"]["LINK_SITE"]["VALUE"]?></a>
                </div>
            <?}?>
        </div>
    </div>
<?}?>