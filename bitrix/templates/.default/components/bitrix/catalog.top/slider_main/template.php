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
	//echo "<pre>"; var_dump($arResult["ITEMS"]); echo "</pre>";
}
?>
<?if(!empty($arResult['ITEMS'])){?>

    <ul class="promo__list">
        <?foreach($arResult['ITEMS'] as $key => $arItem){?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
            $classNoPrice = "";
            if($arItem['PROPERTIES']['ITEM']['ELEMENT']['CATALOG_PRICE_2'] == ""){
                $classNoPrice = " offer__item_noprice";
            }
            $bgSrc = "";
            if(!empty($arItem['PROPERTIES']['IMAGE']['FILEPATH'])){
                $bgSrc = $arItem['PROPERTIES']['IMAGE']['FILEPATH'];
            }
            ?>
            <li id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="promo__item<?=$classNoPrice?>">
                <div class="promo__header">Специальные предложения</div>
                <div class="promo__container" style="background: url(<?=$bgSrc?>) left top no-repeat;">
                    <div class="promo__content">
                        <div class="promo__content__wrap">
                          <?if(!empty($arItem['PROPERTIES']['ITEM']['ELEMENT'])){?>
                              <a class="promo__link" href="<?=$arItem['PROPERTIES']['ITEM']['ELEMENT']['DETAIL_PAGE_URL'];?>">
                                  <?=$arItem['PROPERTIES']['ITEM']['ELEMENT']['PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE'];?>
                              </a>
                          <?} else {?>
							  	<?if($arItem['PROPERTIES']['LINK']['VALUE'] <> ""){?>
									<a class="promo__link" href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>">
							  			<?=$arItem['NAME'];?>
									</a>
								<?} else {?>
									<?=$arItem['NAME'];?>
								<?}?>
						  <?}?>
                          <?if($arItem["PREVIEW_TEXT"] <> ""){?>
                              <div class="promo__text">
                                  <?=$arItem["PREVIEW_TEXT"]?>
                              </div>
                          <?}?>
                          <?if($arItem['PROPERTIES']['PRICE']["VALUE"] <> ""){?>
                              <div class="promo__price">
                                  <span class="promo__price__value">Цена <?=$arItem['PROPERTIES']['PRICE']["VALUE"]?></span>
                              </div>
                          <?}?>
                        </div>
                    </div>
                    <!--<div class="promo__img">
                        <?if(!empty($arItem['PROPERTIES']['IMAGE']['FILEPATH'])){?>
                            <img alt="" src="<?=$arItem['PROPERTIES']['IMAGE']['FILEPATH'];?>">
                        <?}?>
                    </div>-->
                </div>
                <div class="promo__index"><?=$key+1;?></div>
            </li>
        <?}?>
    </ul>
<?}?>
