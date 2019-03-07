<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) < 1)
	return;?>

<div class="row services">	
	<?foreach($arResult["ITEMS"] as $arItem):?><!--
		--><div class="col-sm-6 col-md-3">
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="services-item">										
				<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
					<div class="item-pic-wrapper">
						<div class="item-pic" style="background-image:url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>');"></div>
					</div>
				<?elseif(!empty($arItem["DISPLAY_PROPERTIES"]["ICON"])):?>
					<div class="item-icon-wrapper">
						<div class="item-icon">
							<i class="fa <?=$arItem['DISPLAY_PROPERTIES']['ICON']['VALUE']?>"></i>
						</div>
					</div>
				<?else:?>
					<div class="item-pic-wrapper">
						<div class="item-pic"></div>
					</div>
				<?endif;?>
				<div class="item-caption">
					<div class="item-title"><?=$arItem["NAME"]?></div>							
					<?=(!empty($arItem["DISPLAY_PROPERTIES"]["SHORT_DESC"]) ? "<div class='item-text'>".$arItem["DISPLAY_PROPERTIES"]["SHORT_DESC"]["~VALUE"]["TEXT"]."</div>" : "");?>
				</div>
			</a>
		</div><!--
	--><?endforeach;
	if($arParams["DISPLAY_BOTTOM_PAGER"]):
		if(!empty($arResult["NAV_STRING"])):?>
			<div class="col-md-12">
				<?=$arResult["NAV_STRING"];?>
			</div>
		<?endif;
	endif;?>
</div>