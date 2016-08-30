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

<div class="b-manufacturers">
	<?if(sizeof($arResult["ITEMS"])){?>
    	<?if($arParams["HEADING"]){?>
    	    <h2><?=$arParams["HEADING"]?></h2>
    	<?}?>
	<?}?>
    <div class="manufacturer__list">
        <?foreach($arResult["ITEMS"] as $arItem){?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="manufacturer__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="manufacturer__item-wrap">
                    <div class="manufacturer-img">
                        <div class="manufacturer-img-wrap">
                            <?
                            $link = $arItem["PROPERTIES"]["LINK_SITE"]["VALUE"];
                            if(!$link){
                                $link = "javascript:void(0);";
                            }
                            ?>
                            <a href="<?=$link?>" target="_blank">
                                <?
                                $pictId = $arItem["PREVIEW_PICTURE"]["ID"];
                                if(!$pictId) {
                                    $pictId = $arItem["DETAIL_PICTURE"]["ID"];
                                }
                                if(!$pictId){
                                    $pictId = NO_PHOTO_ID;
                                }
                                $pictExt = GetFileExtension(CFile::GetPath($pictId));
                                $photo = itc\Resizer::get($pictId, 'width', 150, null, $pictExt);
                                ?>
                                <img alt="<?=$arItem["NAME"]?>" src="<?=$photo?>">
                            </a>
                        </div>
                    </div>
                    <div class="manufacturer-text">
                        <div class="manufacturer-header">
                            <a class="manufacturer-title" href="<?=CATALOG_MANUFACTURERS_URL_KS.$arItem["CODE"].'/'?>" target="_blank"><?=$arItem["NAME"]?></a>
                        </div>
						<?/*
                        <div class="manufacturer-info">
                            <?if($arItem["PREVIEW_TEXT"] <> ""){?>
                                <p>
                                    <?=$arItem["PREVIEW_TEXT"]?>
                                </p>
                            <?}?>
                        </div>
						*/?>
                        <?/*<a class="manufacturer-prod-link" href="<?=$arItem["DETAIL_PAGE_URL"] . "?arPseudoFilter[PROPERTY_". $arParams["CATALOG_FILTER_PROP"] . "_VALUE]=Y"?>" target="_blank">Номенклатура</a>*/?>
                        <a class="manufacturer-prod-link" href="<?=CATALOG_MANUFACTURERS_URL_KS.$arItem["CODE"].'/'?>" target="_blank">Номенклатура</a>
                        <?
						if($USER->IsAuthorized())
						{
							if($arResult["SHOW_PRICE_DEALER"])
							{
								$priceSrc = $arItem["DISPLAY_PROPERTIES"]["PRICE"]["FILE_VALUE"]["SRC"];
								$priceClass = "";
							}
							else
							{
								$priceSrc = "javascript:void(0);";
								$priceClass = "js__openDealerAccessError";
							}
						}
						else
						{
							$priceSrc = "#authForm";
							$priceClass = "js__openFormInPopup";
						}
                        if($priceSrc)
                        {
                            ?>
                            <a class="manufacturer-price-link <?=$priceClass?>" href="<?=$priceSrc?>">Прайс-лист</a>
                            <?
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?}?>
    </div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
	<br /><?=$arResult["NAV_STRING"]?>
<?}?>