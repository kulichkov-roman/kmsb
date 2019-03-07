<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$this->setFrameMode(true);

if($arResult["SECTIONS_COUNT"] < 1)
	return;?>

<div class="row sections">
	<?foreach($arResult["SECTIONS"] as $arSection):?><!--
		--><div class="col-sm-6 col-md-3">
			<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="section-item">										
				<?if(!empty($arSection["PICTURE"])):?>
					<div class="item-pic-wrapper">
						<div class="item-pic" style="background-image:url('<?=$arSection["PICTURE"]["SRC"]?>');"></div>
					</div>
				<?elseif(!empty($arSection["UF_ICON"])):?>
					<div class="item-icon-wrapper">
						<div class="item-icon">
							<i class="fa <?=$arSection['UF_ICON']?>"></i>
						</div>
					</div>
				<?else:?>
					<div class="item-pic-wrapper">
						<div class="item-pic"></div>
					</div>
				<?endif;?>							
				<div class="item-caption">
					<div class="item-title"><?=$arSection["NAME"]?></div>							
					<?=(!empty($arSection["UF_SHORT_DESC"]) ? "<div class='item-text'>".$arSection["UF_SHORT_DESC"]."</div>" : "");?>
				</div>
			</a>
		</div><!--
	--><?endforeach;?>
</div>