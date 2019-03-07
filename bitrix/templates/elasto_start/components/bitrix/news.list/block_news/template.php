<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) < 1)
	return;?>

<div class="news-wrapper">
	<div class="container">				
		<div class="row news<?=(CSite::inDir(SITE_DIR."index.php") ? '' : ' last');?>">
			<div class="col-md-12">
				<div class="h1"><?=(CSite::inDir(SITE_DIR."index.php") ? GetMessage("NEWS") : GetMessage("LAST_NEWS"));?></div>
			</div>
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
			if(CSite::inDir(SITE_DIR."index.php")):?>
				<div class="col-md-12">					
					<div class="all-news">
						<a class="btn btn-default" href="<?=$arParams['ALL_NEWS_HREF']?>" role="button"><?=GetMessage("NEWS_ALL")?></a>
					</div>
				</div>
			<?endif;?>
		</div>
	</div>
</div>