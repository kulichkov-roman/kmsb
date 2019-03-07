<?require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/header.php");
global $arSettings;
if(!empty($arSettings["SITE_CLOSED_TITLE"]["VALUE"]))
	$APPLICATION->SetTitle($arSettings["SITE_CLOSED_TITLE"]["VALUE"]);?>

<!--BLOCK_SITE_CLOSED-->
<?$showCountdown = CElastoStart::LoadCountdown();?>
<div class="site-closed-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="site-closed-outer">
					<div class="site-closed-inner">
						<?if(!empty($arSettings["SITE_CLOSED_TITLE"]["VALUE"])):?>
							<div class="h1"><?=$arSettings["SITE_CLOSED_TITLE"]["VALUE"]?></div>
						<?endif;
						if(!empty($arSettings["SITE_CLOSED_DESCRIPTION"]["VALUE"])):?>
							<p><?=$arSettings["SITE_CLOSED_DESCRIPTION"]["VALUE"]?></p>
						<?endif;
						if($showCountdown):?>
							<div class="site-opening">
								<?if(!empty($arSettings["SITE_OPENING_TITLE"]["VALUE"])):?>
									<div class="h2"><?=$arSettings["SITE_OPENING_TITLE"]["VALUE"]?></div>
								<?endif;?>
								<div class="site-opening-timer"></div>
							</div>
						<?endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--BLOCK_LOCATION-->
<?if(in_array("LOCATION", $arSettings["HOME_PAGE"]["VALUE"])):?>
	<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
		array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_DIR."include/block_location.php"
		),
		false,
		array("HIDE_ICONS" => "Y")
	);?>
<?endif;?>

<?require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/footer.php");?>