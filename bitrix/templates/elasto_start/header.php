<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />				
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?$APPLICATION->ShowTitle()?></title>
		<?$APPLICATION->SetAdditionalCSS("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
		$APPLICATION->SetAdditionalCSS("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&subset=latin,cyrillic-ext");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/bootstrap.min.css");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/colors.css");		
		CJSCore::Init(array("jquery2"));		
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/bootstrap.min.js");
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/formValidation.min.js");
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/formValidation.bootstrap.min.js");		
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.inputmask.bundle.min.js");		
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/moreMenu.js");
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/main.js");		
		$APPLICATION->ShowHead();?>
	</head>
	<body>
		<?=$APPLICATION->ShowPanel();
		global $arSettings, $arSiteClosed;?>
		<?$arSettings = $APPLICATION->IncludeComponent("altop:settings.elastostart", "", array(), false, array("HIDE_ICONS" => "Y"));?>
		<?if(COption::GetOptionString("main", "site_stopped", "N") == "Y" && !$USER->CanDoOperation("edit_other_settings")):
			$arSiteClosed = "Y";
		else:
			$arSiteClosed = "N";
		endif;?>
		<div class="page-wrapper">
			<div class="hidden-xs hidden-sm header-wrapper">
				<div class="container">
					<div class="row">
						<div class="header">
							<div class="col-md-4">
								<a class="logo" href="<?=SITE_DIR?>">							
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
							<div class="col-md-2">
								<p class="tagline">
									<!--TAGLINE-->
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
										array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR."include/header_tagline.php"
										),
										false
									);?>
								</p>						
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="head-blocks">
										<div class="col-md-6">
											<div class="location">
												<!--ADDRESS-->
												<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
													array(
														"AREA_FILE_SHOW" => "file",
														"PATH" => SITE_DIR."include/address.php"
													),
													false
												);?>
												<div class="map">
													<a class="btn btn-default" href="<?=SITE_DIR?>contacts/#map" role="button"><i class="fa fa-map-marker"></i><span><?=GetMessage("ELASTO_LOCATION");?></span></a>
												</div>
												<div class="clr"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="contacts">
												<!--CONTACTS-->
												<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
													array(
														"AREA_FILE_SHOW" => "file",
														"PATH" => SITE_DIR."include/contacts.php"
													),
													false
												);?>
												<?/*?>
												<div class="callback">
													<a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#elasto_callback_<?=SITE_ID?>" role="button"><i class="fa fa-phone"></i><span><?=GetMessage("ELASTO_CALLBACK");?></span></a>
												</div>
												<?*/?>
												<div class="clr"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="<?=($arSiteClosed == 'Y' ? 'visible-xs visible-sm ' : '');?>top-menu-wrapper">
				<div class="top-menu<?=($arSettings['TOP_MENU']['VALUE'] != 'LIGHT' ? ' '.strtolower($arSettings['TOP_MENU']['VALUE']) : '');?>">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<!--TOP_MENU-->
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
									array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/header_top_menu.php"
									),
									false,
									array("HIDE_ICONS" => "Y")
								);?>						
							</div>					
						</div>
					</div>
				</div>
			</div>
			<div class="visible-xs visible-sm container loc-cont-buttons-wrapper">
				<div class="row loc-cont-buttons">
					<div class="col-xs-6 col-sm-6">
						<a class="btn btn-default" href="<?=SITE_DIR?>contacts/#map" role="button"><i class="fa fa-map-marker"></i><span><?=GetMessage("ELASTO_LOCATION");?></span></a>
					</div>
					<div class="col-xs-6 col-sm-6">
						<a class="btn btn-default" href="javascript:void(0)" data-toggle="collapse" data-target="#bs-contacts-collapse-2" role="button"><?=GetMessage("ELASTO_CONTACTS");?><span class="caret"></span></a>
					</div>
				</div>
				<div class="collapse contacts-collapse" id="bs-contacts-collapse-2">
					<ul class="nav contacts-nav">
						<li>
							<!--CONTACTS-->
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/contacts.php"
								),
								false
							);?>
							<?/*?>
							<div class="callback">
								<a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#elasto_callback_<?=SITE_ID?>" role="button"><i class="fa fa-phone"></i><span><?=GetMessage("ELASTO_CALLBACK");?></span></a>
							</div>
							<?*/?>
						</li>
					</ul>
				</div>
			</div>
			<?if($arSiteClosed == "N"):
				if(!CSite::inDir(SITE_DIR."index.php")):?>
					<div class="content-wrapper internal">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", 
										array(
											"START_FROM" => "0",
											"PATH" => "",
											"SITE_ID" => "-"
										),
										false,
										array("HIDE_ICONS" => "Y")
									);?>
									<h1><?=$APPLICATION->ShowTitle(false);?></h1>
				<?endif;
			endif;?>
