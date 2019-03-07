<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) < 1)
	return;?>

<div class="services-wrapper">
	<div class="container">				
		<div class="row services">
			<div class="col-md-12">
				<div class="h1"><?=GetMessage("SERVICES");?></div>
			</div>
			<?foreach($arResult["ITEMS"] as $arItem):?><!--
				--><div class="col-sm-6 col-md-3">
					<a href="<?=(!empty($arItem['DISPLAY_PROPERTIES']['URL']) ? $arItem['DISPLAY_PROPERTIES']['URL']['VALUE'] : 'javascript:void(0)');?>" class="services-item">														
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
							<?=(!empty($arItem["PREVIEW_TEXT"]) ? "<div class='item-text'>".$arItem["PREVIEW_TEXT"]."</div>" : "");?>
						</div>
					</a>
				</div><!--
			--><?endforeach;?>
		</div>
	</div>
</div>