<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta name="cmsmagazine" content="38d2170328e981e4d60ee986faaa509f">

        <?$APPLICATION->ShowHead()?>
        
        <?
        //-->
        // Вся логика header.php
        $curDir = $APPLICATION->GetCurDir();

        $arParseUrl = array_unique(explode("/", $curDir));
        $arParseUrl = array_diff($arParseUrl, array(''));
        //<--
        ?>
        
        <title>
            <?if ($curDir == "/") {?>
				Сибирь-комплект — <?$APPLICATION->ShowTitle();?>
            <?} else {?>
                <?$APPLICATION->ShowTitle();?> — Сибирь-комплект
            <?}?>
        </title>
        
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

        <?$APPLICATION->SetAdditionalCSS("/css/jquery/fancybox/2.1.3/jquery.fancybox.css");?>
        <?$APPLICATION->SetAdditionalCSS("/css/main.css");?>
        
        <?$APPLICATION->AddHeadScript("/js/jquery/1.8.2/jquery.min.js");?>

        <?$APPLICATION->AddHeadScript("/js/jquery.ui/jquery-ui.min.js");?>
        <?$APPLICATION->SetAdditionalCSS("/js/jquery.ui/jquery-ui.min.css");?>
        <?$APPLICATION->SetAdditionalCSS("/js/jquery.ui/jquery-ui.theme.min4.css");?>
        
        <?$APPLICATION->AddHeadScript("/js/jquery/fancybox/2.1.4/jquery.fancybox.min.js");?>
	    	<?$APPLICATION->AddHeadScript("/js/jquery/cookie/1.0/jquery.cookie.min.js");?>
        <?$APPLICATION->AddHeadScript("/js/jquery/mousewheel/3.0.6/jquery.mousewheel.min.js");?>
        <?$APPLICATION->AddHeadScript("/js/base.js");?>
        <?$APPLICATION->AddHeadScript("/js/script.js");?>
        
        <?$APPLICATION->SetAdditionalCSS("/js/swiper/idangerous.swiper.css");?>
        <?$APPLICATION->AddHeadScript("/js/swiper/idangerous.swiper.min.js");?>
        
        <?$APPLICATION->SetAdditionalCSS("/files/kom-sib/Design/jquery.kwicks.min.css");?>
        <?$APPLICATION->AddHeadScript("/files/kom-sib/Design/jquery.kwicks.min.js");?>
        
        <?$APPLICATION->AddHeadScript("/js/jquery.validation/jquery.validate.min.js");?>
        <?$APPLICATION->AddHeadScript("/js/jquery.maskedinput.min.js");?>
		
        <?$APPLICATION->SetAdditionalCSS("/css/developers.css");?>
        <?$APPLICATION->AddHeadScript("/js/developers.js");?>
        
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    </head>
	<body id="<?=getBodyIDsString();?>" class="<?=getBodyClassesString();?>">
        <div id="panel">
            <?$APPLICATION->ShowPanel();?>
        </div>
        <div class="wrapper">
            <div class="wrapper-wrap">
                <div class="header">
                    <div class="header-top">
                        <div class="b-account-status">
                            <!--noindex-->
                            <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include", "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => "/include/site_templates/top_auth.php"
                            ));?> 
							<div class="cart-status">
								<?$APPLICATION->IncludeComponent(
									"bitrix:sale.basket.basket.line", 
									"basket_line",
									array(
										"PATH_TO_BASKET" => "/personal/cart/",
										"PATH_TO_PERSONAL" => "/personal/",
										"SHOW_PERSONAL_LINK" => "Y",
										"SHOW_NUM_PRODUCTS" => "Y",
										"SHOW_TOTAL_PRICE" => "Y",
										"SHOW_EMPTY_VALUES" => "Y",
										"SHOW_PRODUCTS" => "N",
										"POSITION_FIXED" => "N"
									),
									false
								);?>
							</div>
							<!--/noindex-->
						</div>
						<div class="b-description">
                            <?
                            $APPLICATION->IncludeComponent("bitrix:main.include", "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => "/include/site_templates/b-description.php",
                                    "EDIT_TEMPLATE" => ""
                                ),
                                false
                            );
                            ?>
                        </div>
                    </div>
                    <div class="header-main">
                        <div class="header-main-wrap">
                            <div class="logo">
                                <?
                                $APPLICATION->IncludeComponent("bitrix:main.include", "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => "/include/site_templates/logo.php",
                                        "EDIT_TEMPLATE" => ""
                                    ),
                                    false
                                );
                                ?>
                            </div>
                            <div class="h-contacts">
                                <?
                                $APPLICATION->IncludeComponent("bitrix:main.include", "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => "/include/site_templates/h-contacts.php",
                                        "EDIT_TEMPLATE" => ""
                                    ),
                                    false
                                );
                                ?>
                                <div class="site-search">
                                    <?$APPLICATION->IncludeComponent(
                                    	"bitrix:search.title",
                                    	"visual",
                                    	array(
                                    		"NUM_CATEGORIES" => "1",
                                    		"TOP_COUNT" => "10",
                                    		"ORDER" => "date",
                                    		"USE_LANGUAGE_GUESS" => "Y",
                                    		"CHECK_DATES" => "N",
                                    		"SHOW_OTHERS" => "N",
                                    		"CATEGORY_1_socialnetwork_user" => "",
                                    		"PAGE" => "/search/index.php",
                                    		"CATEGORY_OTHERS_TITLE" => "",
                                    		"CATEGORY_0_TITLE" => "",
                                    		"CATEGORY_0" => array(
                                    			0 => "iblock_dynamic",
                                    		),
                                    		"CATEGORY_0_iblock_services" => array(
                                    			0 => "57",
                                    		),
                                    		"CATEGORY_1_TITLE" => "",
                                    		"CATEGORY_1" => array(
                                    			0 => "iblock_dynamic",
                                    		),
                                    		"CATEGORY_1_main" => "",
                                    		"CATEGORY_1_forum" => array(
                                    			0 => "all",
                                    		),
                                    		"CATEGORY_1_iblock_news" => array(
                                    			0 => "all",
                                    		),
                                    		"CATEGORY_1_iblock_services" => array(
                                    			0 => "57",
                                    		),
                                    		"CATEGORY_1_iblock_hobbi" => array(
                                    			0 => "all",
                                    		),
                                    		"CATEGORY_1_iblock_Static" => array(
                                    			0 => "all",
                                    		),
                                    		"CATEGORY_1_blog" => array(
                                    			0 => "all",
                                    		),
                                    		"CATEGORY_1_socialnetwork" => array(
                                    			0 => "all",
                                    		),
                                    		"SHOW_INPUT" => "Y",
                                    		"INPUT_ID" => "title-search-input",
                                    		"CONTAINER_ID" => "title-search",
                                    		"PRICE_CODE" => array(
                                    		),
                                    		"PRICE_VAT_INCLUDE" => "N",
                                    		"PREVIEW_TRUNCATE_LEN" => "125",
                                    		"SHOW_PREVIEW" => "N",
                                    		"PREVIEW_WIDTH" => "75",
                                    		"PREVIEW_HEIGHT" => "75",
                                    		"CATEGORY_1_iblock_dynamic" => array(
                                    			0 => "48",
                                    		),
                                    		"CONVERT_CURRENCY" => "N",
                                    		"CATEGORY_0_iblock_dynamic" => array(
                                    			0 => "48",
                                    		)
                                    	),
                                    	false
                                    );?>
                                </div>
                            </div>
                            <div class="main-menu">
                                <?$APPLICATION->IncludeComponent("bitrix:menu", "main_menu", array(
                                    "ROOT_MENU_TYPE" => "main",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => array(
                                    ),
                                    "MAX_LEVEL" => "2",
                                    "CHILD_MENU_TYPE" => "main_depth2",
                                    "USE_EXT" => "Y",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N"
                                    ),
                                    false
                                );?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-block">
                    <div class="sec-content">
                        <div class="aside-section">
                            <?
							if(inContacts()) {
                                $APPLICATION->IncludeComponent("bitrix:news.list", "b_staff", array(
                                	"IBLOCK_TYPE" => "dynamic",
                                		"IBLOCK_ID" => "15",
                                		"NEWS_COUNT" => "20",
                                		"SORT_BY1" => "ACTIVE_FROM",
                                		"SORT_ORDER1" => "DESC",
                                		"SORT_BY2" => "SORT",
                                		"SORT_ORDER2" => "ASC",
                                		"FILTER_NAME" => "",
                                		"FIELD_CODE" => array(
                                			0 => "",
                                			1 => "",
                                		),
                                		"PROPERTY_CODE" => array(
                                			0 => "icq",
                                			1 => "skype",
                                		),
                                		"CHECK_DATES" => "Y",
                                		"DETAIL_URL" => "",
                                		"AJAX_MODE" => "N",
                                		"AJAX_OPTION_JUMP" => "N",
                                		"AJAX_OPTION_STYLE" => "Y",
                                		"AJAX_OPTION_HISTORY" => "N",
                                		"CACHE_TYPE" => "A",
                                		"CACHE_TIME" => "36000000",
                                		"CACHE_FILTER" => "N",
                                		"CACHE_GROUPS" => "Y",
                                		"PREVIEW_TRUNCATE_LEN" => "",
                                		"ACTIVE_DATE_FORMAT" => "j F Y",
                                		"SET_TITLE" => "N",
                                		"SET_BROWSER_TITLE" => "N",
                                		"SET_META_KEYWORDS" => "N",
                                		"SET_META_DESCRIPTION" => "N",
                                		"SET_STATUS_404" => "N",
                                		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                		"ADD_SECTIONS_CHAIN" => "N",
                                		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                		"PARENT_SECTION" => "",
                                		"PARENT_SECTION_CODE" => "",
                                		"INCLUDE_SUBSECTIONS" => "Y",
                                		"PAGER_TEMPLATE" => ".default",
                                		"DISPLAY_TOP_PAGER" => "N",
                                		"DISPLAY_BOTTOM_PAGER" => "N",
                                		"PAGER_TITLE" => "Новости",
                                		"PAGER_SHOW_ALWAYS" => "N",
                                		"PAGER_DESC_NUMBERING" => "N",
                                		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                		"PAGER_SHOW_ALL" => "N",
                                		"DISPLAY_DATE" => "Y",
                                		"DISPLAY_NAME" => "Y",
                                		"DISPLAY_PICTURE" => "Y",
                                		"DISPLAY_PREVIEW_TEXT" => "Y",
                                		"AJAX_OPTION_ADDITIONAL" => ""
                                	),
                                	false,
                                	array(
                                	    "ACTIVE_COMPONENT" => "Y"
                                	)
                                );
                            } elseif(inBrands()) {
                                $APPLICATION->IncludeComponent("bitrix:main.include", "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => "/include/site_templates/catalog_brands_menu.php",
                                        "EDIT_TEMPLATE" => ""
                                    ),
                                    false
                                );
							} elseif(inService()) {
                                $APPLICATION->IncludeComponent(
                                    "bitrix:news.list", 
                                    "service_center_docs", 
                                    array(
                                        "DISPLAY_DATE" => "Y",
                                        "DISPLAY_NAME" => "Y",
                                        "DISPLAY_PICTURE" => "Y",
                                        "DISPLAY_PREVIEW_TEXT" => "Y",
                                        "AJAX_MODE" => "Y",
                                        "IBLOCK_TYPE" => "dynamic",
                                        "IBLOCK_ID" => "51",
                                        "NEWS_COUNT" => "999",
                                        "SORT_BY1" => "SORT",
                                        "SORT_ORDER1" => "ASC",
                                        "SORT_BY2" => "ID",
                                        "SORT_ORDER2" => "ASC",
                                        "FILTER_NAME" => "",
                                        "FIELD_CODE" => array(
                                            0 => "ID",
                                            1 => "",
                                        ),
                                        "PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "FILE",
                                            2 => "",
                                        ),
                                        "CHECK_DATES" => "Y",
                                        "DETAIL_URL" => "",
                                        "PREVIEW_TRUNCATE_LEN" => "",
                                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "SET_TITLE" => "N",
                                        "SET_BROWSER_TITLE" => "N",
                                        "SET_META_KEYWORDS" => "N",
                                        "SET_META_DESCRIPTION" => "N",
                                        "SET_STATUS_404" => "N",
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                        "PARENT_SECTION" => "",
                                        "PARENT_SECTION_CODE" => "",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => "3600",
                                        "CACHE_FILTER" => "Y",
                                        "CACHE_GROUPS" => "Y",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "N",
                                        "PAGER_TITLE" => "Новости",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => "",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => ""
                                    ),
                                    false
                                );
                            } elseif(inRegistration()) {
                                ?>
                                <div class="text-content">
                                    <?$APPLICATION->IncludeComponent(
                                            "bitrix:main.include", "",
                                            Array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => "/include/site_templates/registration_benefits.php"
                                    ));?>
                                </div>
                            <?} elseif(inDevelopment()) {
                                ?>
                                <div class="text-content">
                                    <?$APPLICATION->IncludeComponent(
                                            "bitrix:main.include", "",
                                            Array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => "/include/site_templates/development_text.php"
                                    ));?>
                                </div>
                            <?} elseif(!inContacts() && !inBrands()) {
                                if(!inBalances()){
                                    $templates = "catalog_left_menu";
                                } else {
                                    $templates = "catalog_left_menu_balances";
                                }
								//global $USER;
	                            //if(!$USER->isAdmin()) {
		                        //    $APPLICATION->IncludeComponent(
			                    //        "bitrix:catalog.section.list",
			                    //        "catalog_left_section",
			                    //        array(
				                //            "IBLOCK_TYPE" => "dynamic",
				                //            "IBLOCK_ID" => "48",
				                //            "SECTION_ID" => $_REQUEST["SECTION_ID"],
				                //            "SECTION_CODE" => "",
				                //            "COUNT_ELEMENTS" => "Y",
				                //            "TOP_DEPTH" => "6",
				                //            "SECTION_FIELDS" => array(
					            //                0 => "",
					            //                1 => "",
				                //            ),
				                //            "SECTION_USER_FIELDS" => array(
					            //                0 => "UF_SHOW_LEFT_MENU",
					            //                1 => "UF_POSITIVE_BALANCES",
					            //                2 => "UF_COUNT_ELEM",
					            //                3 => "UF_COUNT_BALANCE",
					            //                4 => "",
				                //            ),
				                //            "SECTION_URL" => "",
				                //            "CACHE_TYPE" => "A",
				                //            "CACHE_TIME" => "3600",
				                //            "CACHE_GROUPS" => "Y",
				                //            "ADD_SECTIONS_CHAIN" => "Y",
				                //            "VIEW_MODE" => "LINE",
				                //            "SHOW_PARENT_NAME" => "Y",
				                //            "COMPONENT_TEMPLATE" => "catalog_left_section"
			                    //        ),
			                    //        false
		                        //    );
	                            //}
								$APPLICATION->IncludeComponent(
									"bitrix:menu",
									$templates,
									array(
										"ROOT_MENU_TYPE" => "left_cat",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"MAX_LEVEL" => "4",
										"CHILD_MENU_TYPE" => "left_cat",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "catalog_left_menu"
									),
									false
								);
							} else {
								//$APPLICATION->IncludeComponent("bitrix:menu", "catalog_left_menu", array(
                                //    "ROOT_MENU_TYPE" => "left_cat",
                                //    "MENU_CACHE_TYPE" => "A",
                                //    "MENU_CACHE_TIME" => "3600",
                                //    "MENU_CACHE_USE_GROUPS" => "Y",
                                //    "MENU_CACHE_GET_VARS" => array(
                                //    ),
                                //    "MAX_LEVEL" => "4",
                                //    "CHILD_MENU_TYPE" => "left_cat",
                                //    "USE_EXT" => "Y",
                                //    "DELAY" => "N",
                                //    "ALLOW_MULTI_SELECT" => "N"
                                //    ),
                                //    false
                                //);
                            }
							?>
                        </div>
                    </div>
                    <div class="main-content">
						<?if(!inCatalog()){ ?>
								<?$APPLICATION->IncludeComponent(
								"bitrix:breadcrumb",
								"breadcrumb",
								Array()
							);
						}?>
                        <?if(inDevelopment() || inService() || inDealers() || inContacts()){?>
                            <h1><?$APPLICATION->ShowTitle();?></h1>
                        <?}?>
