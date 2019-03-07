<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

global $arSiteClosed;?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<?if($arSiteClosed == "N"):?>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			<?endif;?>
			<a class="visible-xs visible-sm navbar-brand" href="<?=SITE_DIR?>">
				<!--LOGO-->
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
					array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."include/header_logo.php"
					),
					false
				);?>
			</a>
		</div>
		<?if($arSiteClosed == "N"):?>
			<div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li<?=($APPLICATION->GetCurPage(true) == SITE_DIR."index.php" ? " class='active'" : "");?>><a href="<?=SITE_DIR?>"><i class="hidden-xs hidden-sm fa fa-home"></i><span class="visible-xs visible-sm"><?=GetMessage("MENU_HOME")?></span></a></li>
					<?if(!empty($arResult)):
						$previousLevel = 0;					
						foreach($arResult as $arItem):
							if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
								echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
							endif;
							if($arItem["IS_PARENT"]):?>
								<li class="dropdown<?=($arItem['SELECTED'] ? ' active' : '');?>">
									<a href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
							<?else:?>
								<li<?=$arItem["SELECTED"] ? " class='active'" : ""?>>
									<a href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a>
								</li>
							<?endif;
							$previousLevel = $arItem["DEPTH_LEVEL"];						
						endforeach;
						if($previousLevel > 1):
							echo str_repeat("</ul></li>", ($previousLevel - 1));
						endif;
					endif;?>
				</ul>
			</div>
		<?endif;?>
	 </div>
</nav>