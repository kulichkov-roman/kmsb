<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) < 1)
	return;?>

<div class="row news">	
	<?foreach($arResult["ITEMS"] as $arItem):?><!--
		--><div class="col-md-4">
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news-item">
				<div class="item-pic-wrapper">
					<div class="item-pic">
						<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
							<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
						<?endif;?>
					</div>
				</div>
				<div class="item-caption">
					<span class="item-date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
					<div class="item-title"><?=$arItem["NAME"]?></div>
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