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
		"ORDER" => "rank",
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
		"CATEGORY_0_iblock_dynamic" => array(
			0 => "48",
			1 => "all",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CONVERT_CURRENCY" => "N",
		"COMPONENT_TEMPLATE" => "visual"
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
                    <?if($curDir === "/"){?>
						<div class="promo">
							<?$APPLICATION->IncludeComponent(
                            	"bitrix:catalog.top",
                            	"slider_main",
                            	array(
                            		"IBLOCK_TYPE" => "dynamic",
                            		"IBLOCK_ID" => "46",
                            		"ELEMENT_SORT_FIELD" => "sort",
                            		"ELEMENT_SORT_ORDER" => "asc",
                            		"ELEMENT_SORT_FIELD2" => "id",
                            		"ELEMENT_SORT_ORDER2" => "desc",
                            		"FILTER_NAME" => "",
                            		"HIDE_NOT_AVAILABLE" => "N",
                            		"ELEMENT_COUNT" => "9",
                            		"LINE_ELEMENT_COUNT" => "3",
                            		"PROPERTY_CODE" => array(
                            			0 => "LINK",
                            			1 => "ITEM",
                            			2 => "PRICE",
                            			3 => "",
                            		),
                            		"OFFERS_LIMIT" => "5",
                            		"VIEW_MODE" => "SECTION",
                            		"SHOW_DISCOUNT_PERCENT" => "N",
                            		"SHOW_OLD_PRICE" => "N",
                            		"MESS_BTN_BUY" => "Купить",
                            		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
                            		"MESS_BTN_DETAIL" => "Подробнее",
                            		"MESS_NOT_AVAILABLE" => "Нет в наличии",
                            		"SECTION_URL" => "",
                            		"DETAIL_URL" => "",
                            		"SECTION_ID_VARIABLE" => "SECTION_ID",
                            		"CACHE_TYPE" => "A",
                            		"CACHE_TIME" => "36000000",
                            		"CACHE_GROUPS" => "Y",
                            		"DISPLAY_COMPARE" => "N",
                            		"CACHE_FILTER" => "N",
                            		"PRICE_CODE" => array(
                            		),
                            		"USE_PRICE_COUNT" => "N",
                            		"SHOW_PRICE_COUNT" => "1",
                            		"PRICE_VAT_INCLUDE" => "Y",
                            		"CONVERT_CURRENCY" => "N",
                            		"BASKET_URL" => "/personal/basket.php",
                            		"ACTION_VARIABLE" => "action",
                            		"PRODUCT_ID_VARIABLE" => "id",
                            		"USE_PRODUCT_QUANTITY" => "N",
                            		"ADD_PROPERTIES_TO_BASKET" => "Y",
                            		"PRODUCT_PROPS_VARIABLE" => "prop",
                            		"PARTIAL_PRODUCT_PROPERTIES" => "N",
                            		"PRODUCT_PROPERTIES" => array(
                            		),
                            		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
                            		"TEMPLATE_THEME" => "blue",
                            		"ADD_PICT_PROP" => "-",
                            		"LABEL_PROP" => "-"
                            	),
                            	false
                            );?>
						</div>
                    <?}?>
                    <div class="main-content">
                        <?if($curDir === "/"){?>
                            <div class="index-grid">
								<div class="index-section index-section_available">
									<?$APPLICATION->IncludeComponent(
                                       	"bitrix:catalog.top",
                                        "product_in_stock",
                                        array(
                                            "IBLOCK_TYPE" => "dynamic",
                                            "IBLOCK_ID" => "49",
                                            "ELEMENT_SORT_FIELD" => "sort",
                                            "ELEMENT_SORT_ORDER" => "asc",
                                            "ELEMENT_SORT_FIELD2" => "id",
                                            "ELEMENT_SORT_ORDER2" => "desc",
                                            "FILTER_NAME" => "",
                                            "HIDE_NOT_AVAILABLE" => "N",
                                            "ELEMENT_COUNT" => "20",
                                            "LINE_ELEMENT_COUNT" => "3",
                                            "PROPERTY_CODE" => array(
                                                0 => "LINK_ELEM",
                                                1 => "",
                                            ),
                                            "OFFERS_LIMIT" => "5",
                                            "VIEW_MODE" => "SECTION",
                                            "SHOW_DISCOUNT_PERCENT" => "N",
                                            "SHOW_OLD_PRICE" => "N",
                                            "MESS_BTN_BUY" => "Купить",
                                            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                                            "MESS_BTN_DETAIL" => "Подробнее",
                                            "MESS_NOT_AVAILABLE" => "Нет в наличии",
                                            "SECTION_URL" => "",
                                            "DETAIL_URL" => "",
                                            "SECTION_ID_VARIABLE" => "SECTION_ID",
                                            "CACHE_TYPE" => "A",
                                            "CACHE_TIME" => "36000000",
                                            "CACHE_GROUPS" => "Y",
                                            "DISPLAY_COMPARE" => "N",
                                            "CACHE_FILTER" => "N",
                                            "PRICE_CODE" => array(
                                                0 => "Розничные",
                                            ),
                                            "USE_PRICE_COUNT" => "N",
                                            "SHOW_PRICE_COUNT" => "1",
                                            "PRICE_VAT_INCLUDE" => "Y",
                                            "CONVERT_CURRENCY" => "N",
                                            "BASKET_URL" => "/personal/basket.php",
                                            "ACTION_VARIABLE" => "action",
                                            "PRODUCT_ID_VARIABLE" => "id",
                                            "USE_PRODUCT_QUANTITY" => "N",
                                            "ADD_PROPERTIES_TO_BASKET" => "Y",
                                            "PRODUCT_PROPS_VARIABLE" => "prop",
                                            "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                            "PRODUCT_PROPERTIES" => array(),
                                            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                            "TEMPLATE_THEME" => "blue",
                                            "ADD_PICT_PROP" => "-",
                                            "LABEL_PROP" => "-"
                                        ),
                                        false
                                    );?>
								</div>
                                <div class="index-section index-section_banner">
                                    <?
									global $arOnMainFilter;
									
									$arOnMainFilter = array(
										"PROPERTY_SHOW_ON_MAIN_VALUE" => "Y"
									);
									$APPLICATION->IncludeComponent(
										"bitrix:news.list", 
										"banners_main", 
										array(
											"DISPLAY_DATE" => "Y",
											"DISPLAY_NAME" => "Y",
											"DISPLAY_PICTURE" => "Y",
											"DISPLAY_PREVIEW_TEXT" => "Y",
											"AJAX_MODE" => "N",
											"IBLOCK_TYPE" => "dynamic",
											"IBLOCK_ID" => "50",
											"NEWS_COUNT" => "1",
											"SORT_BY1" => "SORT",
											"SORT_ORDER1" => "ASC",
											"SORT_BY2" => "ACTIVE_FROM",
											"SORT_ORDER2" => "ACTIVE_FROM",
											"FILTER_NAME" => "arOnMainFilter",
											"FIELD_CODE" => array(
												0 => "",
												1 => "",
											),
											"PROPERTY_CODE" => array(
												0 => "SHOW_ON_MAIN",
												1 => "LINK",
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
											"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
											"ADD_SECTIONS_CHAIN" => "Y",
											"HIDE_LINK_WHEN_NO_DETAIL" => "N",
											"PARENT_SECTION" => "",
											"PARENT_SECTION_CODE" => "",
											"INCLUDE_SUBSECTIONS" => "Y",
											"CACHE_TYPE" => "A",
											"CACHE_TIME" => "36000000",
											"CACHE_NOTES" => "",
											"CACHE_FILTER" => "N",
											"CACHE_GROUPS" => "Y",
											"PAGER_TEMPLATE" => ".default",
											"DISPLAY_TOP_PAGER" => "N",
											"DISPLAY_BOTTOM_PAGER" => "N",
											"PAGER_TITLE" => "Новости",
											"PAGER_SHOW_ALWAYS" => "N",
											"PAGER_DESC_NUMBERING" => "N",
											"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
											"PAGER_SHOW_ALL" => "Y",
											"AJAX_OPTION_JUMP" => "N",
											"AJAX_OPTION_STYLE" => "Y",
											"AJAX_OPTION_HISTORY" => "N",
											"AJAX_OPTION_ADDITIONAL" => ""
										),
										false
									);?>
                                </div>
                                <div class="index-section index-section_news">
									<div class="index-section-wrap">
                                        <?
										$APPLICATION->IncludeComponent(
											"bitrix:news.list", 
											"news_list_main", 
											array(
												"DISPLAY_DATE" => "Y",
												"DISPLAY_NAME" => "Y",
												"DISPLAY_PICTURE" => "Y",
												"DISPLAY_PREVIEW_TEXT" => "Y",
												"AJAX_MODE" => "N",
												"IBLOCK_TYPE" => "dynamic",
												"IBLOCK_ID" => "1",
												"NEWS_COUNT" => "3",
												"SORT_BY1" => "TIMESTAMP_X",
												"SORT_ORDER1" => "ASC",
												"SORT_BY2" => "",
												"SORT_ORDER2" => "",
												"FILTER_NAME" => "arOnMainFilter",
												"FIELD_CODE" => array(
													0 => "",
													1 => "",
												),
												"PROPERTY_CODE" => array(
													0 => "SHOW_ON_MAIN",
													1 => "LINK",
													2 => "",
												),
												"CHECK_DATES" => "Y",
												"DETAIL_URL" => "",
												"PREVIEW_TRUNCATE_LEN" => "255",
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
												"INCLUDE_SUBSECTIONS" => "N",
												"CACHE_TYPE" => "A",
												"CACHE_TIME" => "36000000",
												"CACHE_NOTES" => "",
												"CACHE_FILTER" => "N",
												"CACHE_GROUPS" => "Y",
												"PAGER_TEMPLATE" => ".default",
												"DISPLAY_TOP_PAGER" => "N",
												"DISPLAY_BOTTOM_PAGER" => "N",
												"PAGER_TITLE" => "Новости",
												"PAGER_SHOW_ALWAYS" => "N",
												"PAGER_DESC_NUMBERING" => "N",
												"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
												"PAGER_SHOW_ALL" => "N",
												"AJAX_OPTION_JUMP" => "N",
												"AJAX_OPTION_STYLE" => "Y",
												"AJAX_OPTION_HISTORY" => "N",
												"AJAX_OPTION_ADDITIONAL" => ""
											),
											false
										);?>
                                    </div>
                                </div>
                            </div>
                        <?} else {?>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:breadcrumb",
                                "breadcrumb",
                                Array(
                                )
                            );?>
                            <?if(inDevelopment()){?>
                                <h1><?$APPLICATION->ShowTitle();?></h1>
                            <?}?>
                        <?}?>