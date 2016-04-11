<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="b-compare">
    <form action="<?=$APPLICATION->GetCurPage()?>" method="get">
        <table border="0" cellpadding="0" cellspacing="0" class="compare-grid">
            <thead>
                <tr>
                    <td class="compare-grid__cell_name">
                        <div class="compare-view">
                            <noindex>
                                <?
                                if($arResult["DIFFERENT"])
                                {
                                    ?>
                                    <a class="compare-view__button" href="<?=htmlspecialcharsbx($APPLICATION->GetCurPageParam("DIFFERENT=N",array("DIFFERENT")))?>" rel="nofollow">
                                        <?=GetMessage("CATALOG_ALL_CHARACTERISTICS")?>
                                    </a>
                                    <?
                                } 
                                else
                                {
                                    ?>
                                    <span class="compare-view__button compare-view__button_state_active">
                                        <?=GetMessage("CATALOG_ALL_CHARACTERISTICS")?>
                                    </span>
                                    <?
                                }
                                
                                if(!$arResult["DIFFERENT"])
                                {
                                    ?>
                                    <a class="compare-view__button" href="<?=htmlspecialcharsbx($APPLICATION->GetCurPageParam("DIFFERENT=Y",array("DIFFERENT")))?>" rel="nofollow">
                                        <?=GetMessage("CATALOG_ONLY_DIFFERENT")?>
                                    </a>
                                    <?
                                } 
                                else 
                                {
                                    ?>
                                    <span class="compare-view__button compare-view__button_state_active">
                                        <?=GetMessage("CATALOG_ONLY_DIFFERENT")?>
                                    </span>
                                    <?
                                }
                                ?>
                            </noindex>
                        </div>
                    </td>
                    <?
                    
                    //echo "<pre>"; var_dump($arResult["ITEMS"][0]["FIELDS"]); echo "</pre>"; die();
                    
                    foreach($arResult["ITEMS"] as $arElement)
                    {
                        $arUrl = explode("/", $arElement["DETAIL_PAGE_URL"]);
                        ?>
                        <td>
                            <div class="compare__item">
                                <?
                                if (!is_array($arElement["DETAIL_PICTURE"])) 
                                {
                                    $photo = itc\Resizer::get(NO_PHOTO_ID, 'height', null, 150, NO_PHOTO_EXTENSION);
                                }
                                else
                                {
                                    $extension = getExtensionImage($arElement["DETAIL_PICTURE"]["SRC"]); 
                                    $photo = itc\Resizer::get($arElement["DETAIL_PICTURE"]["ID"], 'height', null, 150, $extension);
                                }
                                ?>
                                <div class="compare__item__img">
                                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
                                        <img src="<?=$photo?>" />
                                    </a>
                                </div>
                                <a class="compare__item__title" href="<?=$arElement["DETAIL_PAGE_URL"]?>">
                                    <?=$arElement["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] <> "" ? $arElement["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] : $arElement["NAME"]?>
                                </a>
                                <a class="compare__item__delete" data-element-id="<?=$arElement["ID"]?>" data-compare-url="<?=getUrlCompareSec($arUrl)?>" href="javascript:;" title="Удалить">×</a>
                            </div>
                        </td>
                        <?
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?
                foreach($arResult["ITEMS"][0]["PRICES"] as $code=>$arPrice)
                {
                    if($arPrice["CAN_ACCESS"])
                    {
                        ?>
                        <tr class="compare-grid__row_param">
                            <td class="compare-grid__cell_name">
                                <?=$arResult["PRICES"][$code]["TITLE"]?>
                            </td>
                            <?
                            foreach($arResult["ITEMS"] as $arElement)
                            {
                                ?>
                                    <td class="compare__price">
                                        <?
                                        if($arElement["PRICES"][$code]["CAN_ACCESS"])
                                        {
                                            echo $arElement["PRICES"][$code]["PRINT_DISCOUNT_VALUE"];
                                        }
                                        ?>
                                    </td>
                                <?
                            }
                            ?>
                        </tr>
                        <?
                    }
                }
                foreach($arResult["SHOW_PROPERTIES"] as $code=>$arProperty)
                {
                    $arCompare = Array();
                    foreach($arResult["ITEMS"] as $arElement)
                    {
                        $arPropertyValue = $arElement["DISPLAY_PROPERTIES"][$code]["VALUE"];
                        if(is_array($arPropertyValue))
                        {
                            sort($arPropertyValue);
                            $arPropertyValue = implode(" / ", $arPropertyValue);
                        }
                        $arCompare[] = $arPropertyValue;
                    }
                    $diff = (count(array_unique($arCompare)) > 1 ? true : false);
                    if($diff || !$arResult["DIFFERENT"])
                    {
                        ?>
                        <tr class="compare-grid__row_param">
                            <td class="compare-grid__cell_name"><?=$arProperty["NAME"]?></td>
                            <?
                            foreach($arResult["ITEMS"] as $arElement)
                            {
                                if($diff) 
                                {
                                    ?>
                                    <td>
                                        <?
                                        if(is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]))
                                        {
                                            echo implode("/ ", $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]);
                                        } 
                                        else
                                        {
                                            if($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"] <> "")
                                            {
                                                echo $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"];
                                            }
                                            else
                                            {
                                                echo "—";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <?
                                }
                                else
                                {
                                    ?>
                                    <td>
                                        <?
                                        if(is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]))
                                        {
                                            echo implode("/ ", $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]);
                                        } 
                                        else
                                        {
                                            if($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"] <> "")
                                            {
                                                echo $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"];
                                            }
                                            else
                                            {
                                                echo "—";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <?
                                }
                           }
                           ?>
                        </tr>
                        <?
                    }
                }
                ?>
                <tr class="compare-grid__row_descr">
                    <td>
                        &nbsp;
                    </td>
                    <?
                    foreach($arResult["ITEMS"] as $arElement){
                    ?>
                        <td>
                            <?
                            if($arElement["DETAIL_TEXT"] <> "" && $arElement["DETAIL_TEXT"] !== "#TABLE_PROP#")
                            {
                                ?>
                                <a class="compare-details__button js__openCompareDetails" href="javascript:;" data-href="<?=$arElement["ID"]?>" title='<?=$arElement["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_POLNOE"]["VALUE"]?>'>
                                    <span class="button-text">Описание</span>
                                </a>
                                <div class="compare-details__content" id="details-<?=$arElement["ID"]?>">

                                        <div class="popup__header">
                                            <?=$arElement["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_POLNOE"]["VALUE"]?>
                                        </div>
                                        <div class="popup__content">
                                            <?=getDetilTextWithOutTable($arElement["DETAIL_TEXT"]);?>
                                        </div>

                                </div>
                                <?
                            }
                            ?>
                        </td>
                    <?
                    }
                    ?>
                </tr>
                <tr class="compare-grid__row_cart">
                    <td>
                        &nbsp;
                    </td>
                    <?
                    foreach($arResult["ITEMS"] as $arElement)
                    {
                        ?>
                        <td>
                            <?
                            if($arElement["CAN_BUY"])
                            {
                                ?>
                                <noindex>
                                    <a class="cart-bin__button add_to_basket_input_compare" data-product-id="<?=$arElement["ID"]?>" href="<?=BASKET_URL_KS?>">
                                        <span class="button-text button-text_type_put" title="Положить в корзину">В корзину</span>
                                        <span class="button-text button-text_type_order" title="Оформить заказ">Оформить заказ</span>
                                    </a>
                                </noindex>                           
                                <?
                            }
                            elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"]))
                            {
                                ?><br /><?=GetMessage("CATALOG_NOT_AVAILABLE")?><?
                            }
                            ?>
                        </td>
                        <?
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </form>
</div>