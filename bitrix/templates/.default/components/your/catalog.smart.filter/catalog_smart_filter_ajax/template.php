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

if($arResult['SHOW_FILTER'] == 'Y'){?>
	<form name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?=$arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
		<?foreach($arResult["HIDDEN"] as $arItem){?>
			<input
				type="hidden"
				name="<?=$arItem["CONTROL_NAME"]?>"
				id="<?=$arItem["CONTROL_ID"]?>"
				value="<?=$arItem["HTML_VALUE"]?>"
			/>
		<?}?>
	    <div class="b-catalog-search">
	        <span class="b-catalog-search__header">Поиск по критериям:</span>
			<?foreach($arResult["ITEMS"] as $arItem){?>
	            <?if($arItem["PROPERTY_TYPE"] == "N" || isset($arItem["PRICE"])){?>
	            <?
	            // диапазон цен
	            ?>
	            <?} elseif(!empty($arItem["VALUES"])) {?>
	                <div class="search-section">
						<?if($arItem["COUNT_CHECKED"] > 0) {
							$countChecked = ' (выбрано параметров: '.$arItem["COUNT_CHECKED"].')';
						} else {
							$countChecked = "";
						}?>
	                    <a class="search-section__title" href="javascript::"><?=$arItem["NAME"]?><span class="search-section__value"><?=$countChecked?></span></a>
	                    <div class="search-section__dropdown">
	                        <a href="javascript:;" class="search-section__button search-section__button_all js__filterCatalogList">Показать все</a>
	                        <div class="search-section__select">
	                            <ul class="select__list" id="ul_<?=$arItem["ID"]?>">
	                                <?foreach($arItem["VALUES"] as $val => $ar){?>
	                                    <li class="select__item lvl2<?=$ar["DISABLED"]? ' lvl2_disabled': ''?>">
	                                        <input
	                                            type="checkbox"
	                                            value="<?=$ar["HTML_VALUE"]?>"
	                                            name="<?=$ar["CONTROL_NAME"]?>"
	                                            id="<?=$ar["CONTROL_ID"]?>"
	                                            <?=$ar["CHECKED"]? 'checked="checked"': ''?>
												<?=$ar["DISABLED"]? 'disabled="disabled"': ''?>
	                                            class="select__control <?=$ar["CHECKED"]? 'state_attached': ''?>"
	                                            onclick="smartFilter.click(this)"
	                                            /><label for="<?=$ar["CONTROL_ID"]?>" class="select__label"><?=htmlspecialcharsBack($ar["VALUE"]);?></label>
	                                    </li>
	                                <?}?>
	                            </ul>
	                        </div>
	                        <a href="<?echo $arResult["FILTER_URL"]?>" class="showchild search-section__button search-section__button_selected  js__filterCatalogList">Выбрать отмеченные</a>
	                    </div>
	                </div>
	            <?}?>
			<?}?>
			<div class="modef" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>>
				<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
				<a href="<?echo $arResult["FILTER_URL"]?>" class="showchild"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
				<!--<span class="ecke"></span>-->
			</div>
			<?echo $arResult["RES_COUNT_CHECKED"] ? '<div style="padding-top: 10px">' : '';?>
			<input type="submit" <?echo !$arResult["RES_COUNT_CHECKED"] ? 'id="del_filter"' : '';?> name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"/>
			<?echo $arResult["RES_COUNT_CHECKED"] ? '</div>' : '';?>
		</div>
	</form>

	<script>
		var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>');
	</script>
<?}?>