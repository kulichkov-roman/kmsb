<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);
?>
<?if (!empty($arResult['ITEMS'])){?>
	<div class="b-lineup">
        <div class="b-lineup__header">
            Другие товары в разделе &laquo;<?=$arResult["NAME"]?>&raquo;
        </div>
		<div class="lineup-gallery">
            <div class="lineup-gallery-wrap">
                <ul class="lineup__list">
                    <?foreach ($arResult['ITEMS'] as $key => $arItem) {
                        $strMainID = $this->GetEditAreaId($arItem['ID'] . $key);
                
                        $arItemIDs = array(
                            'ID' => $strMainID,
                            'PICT' => $strMainID . '_pict',
                            'SECOND_PICT' => $strMainID . '_secondpict',
                            'MAIN_PROPS' => $strMainID . '_main_props',
                
                            'QUANTITY' => $strMainID . '_quantity',
                            'QUANTITY_DOWN' => $strMainID . '_quant_down',
                            'QUANTITY_UP' => $strMainID . '_quant_up',
                            'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                            'BUY_LINK' => $strMainID . '_buy_link',
                            'SUBSCRIBE_LINK' => $strMainID . '_subscribe',
                
                            'PRICE' => $strMainID . '_price',
                            'DSC_PERC' => $strMainID . '_dsc_perc',
                            'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',
                
                            'PROP_DIV' => $strMainID . '_sku_tree',
                            'PROP' => $strMainID . '_prop_',
                            'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                            'BASKET_PROP_DIV' => $strMainID . '_basket_prop'
                        );
                
                        $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
                
                        $strTitle = (
                        isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
                            ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
                            : $arItem['NAME']
                        );
                        $showImgClass = $arParams['SHOW_IMAGE'] != "Y" ? "no-imgs" : "";
                        ?>
                        <li class="lineup__item <?=$arItem["SELECTED"] ? 'lineup__item_state_active' : ''?>" id="<?=$strMainID;?>">
                            <?if($arItem["SELECTED"]){?>
                                <div class="lineup__img">
                                    <img alt="<?=$arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] <> "" ? $arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] : $arItem["NAME"]?>" src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" />
                                </div>
                                <div class="lineup__title">
                                    <?=$arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] <> "" ? $arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] : $arItem["NAME"]?>
                                </div>
                            <?} else {?>
                                <div class="lineup__img">
                                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                        <img alt="<?=$arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] <> "" ? $arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] : $arItem["NAME"]?>" src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" />
                                    </a>
                                </div>
                                <div class="lineup__title">
                                    <a class="lineup__link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                        <?=$arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] <> "" ? $arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] : $arItem["NAME"]?>
                                    </a>
                                </div>
                            <?}?>
                        </li>
                        <?
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
<?}?>
