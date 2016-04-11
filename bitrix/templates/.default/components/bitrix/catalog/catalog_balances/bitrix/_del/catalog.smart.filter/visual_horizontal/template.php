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

CJSCore::Init(array("fx"));

if (file_exists($_SERVER["DOCUMENT_ROOT"].$this->GetFolder().'/themes/'.$arParams["TEMPLATE_THEME"].'/colors.css'))
	$APPLICATION->SetAdditionalCSS($this->GetFolder().'/themes/'.$arParams["TEMPLATE_THEME"].'/colors.css');
?>
<?if($arResult["SHOW_SMART_FILTER"] == "Y"){?>
	<div class="b-catalog-search">
		<form name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
			<span class="b-catalog-search__header">Поиск по критериям:</span>
            <?
			foreach($arResult["HIDDEN"] as $arItem)
			{
				?>
				<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
				<?
			}
			foreach($arResult["ITEMS"] as $key=>$arItem)
			{
				if($arItem["PROPERTY_TYPE"] == "L" || $arItem["PROPERTY_TYPE"] == "S")
				{
					if(sizeof($arItem["VALUES"]) > 0)
					{			
						?>
						<div class="search-section">
							<div class="search-section__title">
								<?=$arItem["NAME"]?>
							</div>
							<div class="search-section__content">
								<a class="search-section__value" href="javascript:;"><span class="search-section__value-wrap">все</span></a>
								<div class="search-section__select">
									<ul class="select__list">
										<?foreach($arItem["VALUES"] as $val => $ar){?>
											<li class="select__item">
												<input 
													class="select__control"
													type="checkbox" 
													name="<?=$ar["CONTROL_NAME"]?>"
													id="<?=$ar["CONTROL_ID"]?>" 
													value="<?=$ar["HTML_VALUE"]?>"
													<?=$ar["CHECKED"] ? 'checked="checked"' : ''?>
													<?=$ar["DISABLED"] ? 'disabled': ''?>
												/>
												<label class="select__label" for="<?=$ar["CONTROL_ID"]?>"><?=$ar["VALUE"];?></label>
											</li>
										<?}?>
									</ul>
								</div>
							</div>
						</div>
						<?
					}
				}
			}
			?>
			<input class="b-catalog-search__submit" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
		</form>
	</div>
<?}?>