<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);				
			if($arSiteClosed == "N"):
				if(!CSite::inDir(SITE_DIR."index.php")):?>
									<div class="share">
										<!--SHARE-->
										<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
											array(
												"AREA_FILE_SHOW" => "file",
												"PATH" => SITE_DIR."include/footer_share.php"
											),
											false
										);?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?endif;?>			
				<!--GALLERY_FILES_DOCS-->
				<?$APPLICATION->ShowViewContent("gallery_files_docs");?>
				<!--LAST_NEWS-->
				<?$APPLICATION->ShowViewContent("last_news");?>			
				<!--BLOCK_LOCATION-->
				<?if(CSite::inDir("/contacts/")):?>
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/block_location.php"
						),
						false,
						array("HIDE_ICONS" => "Y")
					);?>
				<?endif;
			endif;?>
			<!--FEEDBACK-->
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR."include/footer_feedback.php"
				),
				false,
				array("HIDE_ICONS" => "Y")
			);?>
			<div class="footer-wrapper">
				<div class="container">
					<div class="row">
						<div class="footer">						
							<div class="col-md-4">
								<div class="copyright">									
									<!--COPYRIGHT-->
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer_copyright.php"), false);?>
								</div>
							</div>							
							<div class="col-sm-6 col-md-4">
								<!--SOCIAL-->
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
									array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/footer_social.php"
									),
									false,
									array("HIDE_ICONS" => "Y")
								);?>								
							</div>
							<div class="col-sm-6 col-md-4">
								<!--DEVELOPER-->
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer_developer.php"), false);?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--MODAL_CALLBACK-->
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR."include/modal_callback.php"
				),
				false,
				array("HIDE_ICONS" => "Y")
			);?>			
		</div>	
	</body>
</html>