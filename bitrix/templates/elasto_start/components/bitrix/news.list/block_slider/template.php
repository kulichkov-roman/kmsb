<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) < 1)
	return;?>

<div class="slider-wrapper">
	<div class="slider">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<a href="<?=(!empty($arItem['DISPLAY_PROPERTIES']['URL']) ? $arItem['DISPLAY_PROPERTIES']['URL']['VALUE'] : 'javascript:void(0)');?>" class="slider-item"<?=(!empty($arItem["PREVIEW_PICTURE"]) ? " style='background-image:url(".$arItem["PREVIEW_PICTURE"]["SRC"].");'" : "");?>>
				<span class="item-caption">
					<span class="item-title"><?=$arItem["NAME"]?></span>
					<?=(!empty($arItem["PREVIEW_TEXT"]) ? "<span class='item-text'>".$arItem["PREVIEW_TEXT"]."</span>" : "");?>
				</span>
			</a>
		<?endforeach;?>
	</div>
</div>