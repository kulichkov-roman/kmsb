<?
//-->
// Вся логика footer.php
$curDir = $APPLICATION->GetCurDir();
//<--
?>
                    </div><!--main-content-->
                </div><!--content-block-->
            </div><!--wrapper-wrap-->
        </div><!--wrapper-->
        <div class="footer">
            <div class="footer-wrap">
                <div class="copyright">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:main.include", "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => "/include/site_templates/copyright.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );
                    ?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include", "",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/include/site_templates/counters.php"
						)
					);?>
                </div>
                <div class="f-contacts">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:main.include", "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => "/include/site_templates/f-contacts.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );
                    ?>
                </div>
                <div class="developer">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:main.include", "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => "/include/site_templates/developer.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );
                    ?>
                </div>
                <div class="counter">
                    <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include", "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "/include/site_templates/google_analytics.php"
                    ));?>
					<?$APPLICATION->IncludeComponent(
                            "bitrix:main.include", "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "/include/site_templates/consultant.php"
                    ));?>
                </div>
            </div>
        </div>
        <div class="popup-wrap">
            <?if(inContacts()){
				$APPLICATION->IncludeComponent(
	"your:iblock.element.add.form", 
	"contacts_application", 
	array(
		"IBLOCK_TYPE" => "dynamic",
		"IBLOCK_ID" => "45",
		"STATUS_NEW" => "N",
		"LIST_URL" => "",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_EDIT" => "Спасибо! Сообщение отправлено.",
		"USER_MESSAGE_ADD" => "Спасибо! Сообщение отправлено.",
		"DEFAULT_INPUT_SIZE" => "30",
		"RESIZE_IMAGES" => "N",
		"PROPERTY_CODES" => array(
			0 => "NAME",
			1 => "995",
			2 => "996",
			3 => "997",
			4 => "999",
			5 => "1001",
			6 => "1000",
            7 => "1002"),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "NAME",
			1 => "995",
			2 => "996",
			3 => "997",
			4 => "999",
			5 => "1001",
            6 => "1002"
		),
		"GROUPS" => array(
			0 => "2",
		),
		"STATUS" => "ANY",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"MAX_USER_ENTRIES" => "100000",
		"MAX_LEVELS" => "100000",
		"LEVEL_LAST" => "Y",
		"MAX_FILE_SIZE" => "0",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"SEF_MODE" => "N",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"SEF_FOLDER" => "/contacts/"
	),
	false,
    array(
        "HIDE_ICONS" => "Y"
    )
);
			}
			?>
            <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "/include/site_templates/footer_popup_auth.php"
            ));?> 
        </div>
		
    </body>
</html>
