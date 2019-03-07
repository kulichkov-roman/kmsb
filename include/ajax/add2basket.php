<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    global $USER;
    	
    CModule::IncludeModule('sale');
    CModule::IncludeModule('catalog');
    
    $result = array();    

    $result['status'] = 0;
    $result['error'] = '';
    
    $arBasketItems = array();
	
	//file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_log.txt", var_export($_REQUEST['product_props'], true), FILE_APPEND | LOCK_EX);
    
    $productId = intVal($_REQUEST['productId']);
    $quantity =  intVal($_REQUEST['quantity']);
	$arProps = $_REQUEST['product_props'];
    $action =  $_REQUEST['action'];
	
	if($productId > 0)
	{        
        $arBasketItems = GetBasketList();
		
		$arInBasket = array();
		
		if(sizeof($arBasketItems) > 0)
		{
			foreach($arBasketItems as $arBasketItem)
			{
				$arInBasket[$arBasketItem['PRODUCT_ID']] = array(
					'basket_item_id' => $arBasketItem['ID'],
					'quantity' => $arBasketItem['QUANTITY']
				);
			}
		}

        switch($action){
            case 'add' :
                // Если указанное количество больше 0, то будем добавлять/обновлять товар в корзине
                if($quantity > 0)
				{
                    //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_log.txt", var_export($productId, true), FILE_APPEND | LOCK_EX);
                    //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_log.txt", var_export($arInBasket, true), FILE_APPEND | LOCK_EX);
					
					if(array_key_exists($productId, $arInBasket))
					{
                        if(CSaleBasket::Update($arInBasket[$productId]['basket_item_id'], array('QUANTITY' => $quantity)))
						{
                            $result['status'] = 1;
                        }
						else
						{
                            $result['status'] = 0;
                            $result['error'] = 'update basket';
                        }
                    }
					else
					{
                        if (CModule::IncludeModule("sale"))
                        {
                            $arSort = array();
                            $arSelect = array(
                                "ID",
                                "NAME",
                                "PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE"
                            );
                            $arFilter = array(
                                "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
                                "ID" => $productId
                            );

                            $rsElements = CIBlockElement::GetList(
                                $arSort,
                                $arFilter,
                                false,
                                false,
                                $arSelect
                            );

                            $arElement = $rsElements->GetNext();

                            $arFields = array(
                                'PRODUCT_ID' => $productId,
                                'PRODUCT_PRICE_ID' => 0,
                                'PRICE' => 0.00,
                                'CURRENCY' => 'RUB',
                                'WEIGHT' => 0,
                                'QUANTITY' => !empty($quantity) ? $quantity : 1,
                                'LID' => SITE_ID,
                                'DELAY' => 'N',
                                'CAN_BUY' => 'Y',
                                'NAME' => $arElement["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"],
                                'MODULE' => 'catalog',
                            );

                            $arProps = array();

                            $arProps[] = array(
                                "NAME" => 'Арктикул',
                                "CODE" => 'CML2_ARTICLE',
                                "VALUE" => htmlspecialcharsEx($_REQUEST['product_props']['articul']),
                                "SORT" => 100
                            );

                            $arFields["PROPS"] = $arProps;

                            $sb = new CSaleBasket;

                            if($sb->Add($arFields))
                            {
                                $result['status'] = 1;
                            }
                            else
                            {
                                $result['status'] = 0;
                                if($ex = $APPLICATION->GetException())
                                    $result['error'] = $ex->GetString();
                            }
                        }
                        else
                        {
                            $result['error'] = "Не подключен модуль catalog";
                        }
                    }            
                }
				else
				{
					// Если указанное количество равно 0, то будем удалять товар из корзины
                    // Сначала проверяем есть ли товар в корзине, а потом уже пытаемся его удалить
                    if(array_key_exists($productId, $arInBasket))
					{                        
                        if(CSaleBasket::Delete($arInBasket[$productId]['basket_item_id']))
						{
							/*$arProductToDelete = CIBlockElement::GetList(array('ID' => 'ASC'), array('IBLOCK_ID' => CATALOG_IBLOCK_ID_KS, 'ID' => $productId), false, false, array('ID', 'PROPERTY_KOMPLEKTUYUSHCHIE'))->Fetch();

							if(!empty($arProductToDelete['PROPERTY_KOMPLEKTUYUSHCHIE_VALUE'])) {
								$rsAccessories = CIBlockElement::GetList(array('ID' => 'ASC'), array('IBLOCK_ID' => CATALOG_IBLOCK_ID_KS, 'XML_ID' => $arProductToDelete['PROPERTY_KOMPLEKTUYUSHCHIE_VALUE']), false, false, array('ID'));
								
								while($arAccessory = $rsAccessories->Fetch()) {
									$optionId = $arAccessory['ID'];
									if(array_key_exists($optionId, $arInBasket)){
										CSaleBasket::Delete($arInBasket[$optionId]['basket_item_id']);
									}
								}
							}*/
                            $result['status'] = 1;
                        }
						else
						{
                            $result['status'] = 0;
                        }
                    }
                }
            break;
            case 'shelve' :
                
                if(CSaleBasket::Update($arInBasket[$productId]['basket_item_id'], array('DELAY' => 'Y')))
				{
                    $result['status'] = 1;
                }
				else
				{
                    $result['status'] = 0;
                    $result['error'] = 'shelve basket';                    
                }
            break;
            case 'unshelve' :
                if(CSaleBasket::Update($arInBasket[$productId]['basket_item_id'], array('DELAY' => 'N')))
				{
                    $result['status'] = 1;
                }
				else
				{
                    $result['status'] = 0;
                    $result['error'] = 'unshelve basket';                    
                }            
            break;
        }        
    }
    
    if($result['status'] == 1)
	{
        $arBasketItems = GetBasketList();

        $result['productsCount'] = 0;
        $result['productsPrice'] = 0;
        $result['productsTitle'] = '';
        foreach($arBasketItems as $arBasketItem)
		{
            $result['productsCount'] += $arBasketItem['QUANTITY'];
            if($arBasketItem['DELAY'] == 'Y')
                $result['delayed_products'] += $arBasketItem['QUANTITY'];
            else    
                $result['available_products'] += $arBasketItem['QUANTITY'];
                
            $result['productsPrice'] += $arBasketItem['QUANTITY'] * roundEx($arBasketItem['PRICE'] - $arBasketItem['DISCOUNT_PRICE']);                
        }
        
        $result['productsPrice'] = number_format(roundEx($result['productsPrice']), 0, '.', ' ');
        $result['productsTitle'] = plural($result['productsCount'], 'товар', 'товара', 'товаров');
    }    

    print json_encode($result);
?>