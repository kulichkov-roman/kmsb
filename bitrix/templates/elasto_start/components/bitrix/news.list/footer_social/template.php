<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) < 1)
	return;?>

<ul class="join-us">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<li>
			<a rel="nofollow" title="<?=$arItem['NAME']?>" href="<?=(!empty($arItem['DISPLAY_PROPERTIES']['URL']) ? $arItem['DISPLAY_PROPERTIES']['URL']['VALUE'] : 'javascript:void(0)');?>" target="_blank"<?=(!empty($arItem["DISPLAY_PROPERTIES"]["BACKGR_HOV"]) ? " style='background:#".$arItem["DISPLAY_PROPERTIES"]["BACKGR_HOV"]["VALUE"].";'" : "");?>><i class="fa<?=(!empty($arItem['DISPLAY_PROPERTIES']['ICON']) ? ' '.$arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'] : '');?>"></i></a>
		</li>
	<?endforeach;?>
</ul>