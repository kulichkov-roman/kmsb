<?
function ITCAdd2BasketByProductID($PRODUCT_ID, $QUANTITY = 1, $arProductParams = array())
{
	$PRODUCT_ID = IntVal($PRODUCT_ID);
	if ($PRODUCT_ID <= 0)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Empty product field", "EMPTY_PRODUCT_ID");
		return false;
	}

	$QUANTITY = DoubleVal($QUANTITY);
	if ($QUANTITY <= 0)
		$QUANTITY = 1;

	if (!CModule::IncludeModule("sale"))
	{
		$GLOBALS["APPLICATION"]->ThrowException("Sale module is not installed", "NO_SALE_MODULE");
		return false;
	}

	if (CModule::IncludeModule("statistic") && IntVal($_SESSION["SESS_SEARCHER_ID"])>0)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Searcher can not buy anything", "SESS_SEARCHER");
		return false;
	}

	$arProduct = CCatalogProduct::GetByID($PRODUCT_ID);
	if ($arProduct === false)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Product is not found", "NO_PRODUCT");
		return false;
	}

	if ($arProduct["QUANTITY_TRACE"]=="Y" && DoubleVal($arProduct["QUANTITY"])<=0)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Product is run out", "PRODUCT_RUN_OUT");
		return false;
	}

	$CALLBACK_FUNC = "ITCCatalogBasketCallback";
	$arCallbackPrice = CSaleBasket::ReReadPrice($CALLBACK_FUNC, "catalog", $PRODUCT_ID, $QUANTITY);
	if (!is_array($arCallbackPrice) || count($arCallbackPrice) <= 0)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Product price is not found", "NO_PRODUCT_PRICE");
		return false;
	}

//	$arIBlockElement = GetIBlockElement($PRODUCT_ID);
	$dbIBlockElement = CIBlockElement::GetList(array(), array(
					"ID" => $PRODUCT_ID,
					"ACTIVE_DATE" => "Y",
					"ACTIVE" => "Y",
					"CHECK_PERMISSIONS" => "Y",
				), false, false, array(
					"ID",
					"IBLOCK_ID",
					"XML_ID",
					"NAME",
					"DETAIL_PAGE_URL",
	));
	$arIBlockElement = $dbIBlockElement->GetNext();
 
 //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 //Специфика проекта
 $arFilter = Array('IBLOCK_ID'=>$arIBlockElement["IBLOCK_ID"], 'ID'=>$arIBlockElement["IBLOCK_SECTION_ID"], 'GLOBAL_ACTIVE'=>'Y', '=UF_HIDDEN'=>'');
 $rsSec = CIBlockSection::GetList(Array(), $arFilter, false);
 if(!$rsSec->SelectedRowsCount())
  $arIBlockElement["DETAIL_PAGE_URL"] = "";
 //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 
	if ($arIBlockElement == false)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Infoblock element is not found", "NO_IBLOCK_ELEMENT");
		return false;
	}

	$arProps = array();

	$dbIBlock = CIBlock::GetList(
			array(),
			array("ID" => $arIBlockElement["IBLOCK_ID"])
		);
	if ($arIBlock = $dbIBlock->Fetch())
	{
		$arProps[] = array(
				"NAME" => "Catalog XML_ID",
				"CODE" => "CATALOG.XML_ID",
				"VALUE" => $arIBlock["XML_ID"]
			);
	}

	$arProps[] = array(
			"NAME" => "Product XML_ID",
			"CODE" => "PRODUCT.XML_ID",
			"VALUE" => $arIBlockElement["XML_ID"]
		);

	$arPrice = CPrice::GetByID($arCallbackPrice["PRODUCT_PRICE_ID"]);

	$arFields = array(
			"PRODUCT_ID" => $PRODUCT_ID,
			"PRODUCT_PRICE_ID" => $arCallbackPrice["PRODUCT_PRICE_ID"],
			"PRICE" => $arCallbackPrice["PRICE"],
			"CURRENCY" => $arCallbackPrice["CURRENCY"],
			"WEIGHT" => $arProduct["WEIGHT"],
			"QUANTITY" => $QUANTITY,
			"LID" => SITE_ID,
			"DELAY" => "N",
			"CAN_BUY" => "Y",
			"NAME" => $arIBlockElement["~NAME"],
			"CALLBACK_FUNC" => $CALLBACK_FUNC,
			"MODULE" => "catalog",
			//"NOTES" => $arProduct["CATALOG_GROUP_NAME"],
			"NOTES" => $arPrice["CATALOG_GROUP_NAME"],
			"ORDER_CALLBACK_FUNC" => "ITCCatalogBasketOrderCallback",
			"CANCEL_CALLBACK_FUNC" => "ITCCatalogBasketCancelCallback",
			"PAY_CALLBACK_FUNC" => "ITCCatalogPayOrderCallback",
			"DETAIL_PAGE_URL" => $arIBlockElement["DETAIL_PAGE_URL"],
			"CATALOG_XML_ID" => $arIBlock["XML_ID"],
			"PRODUCT_XML_ID" => $arIBlockElement["XML_ID"],			
			"VAT_RATE" => $arCallbackPrice['VAT_RATE'],
		);

	if ($arProduct["QUANTITY_TRACE"]=="Y")
	{
		if (IntVal($arProduct["QUANTITY"])-$QUANTITY < 0)
			$arFields["QUANTITY"] = DoubleVal($arProduct["QUANTITY"]);
	}

	if (is_array($arProductParams) && count($arProductParams) > 0)
	{
		for ($i = 0; $i < count($arProductParams); $i++)
		{
			$arProps[] = array(
					"NAME" => $arProductParams[$i]["NAME"],
					"CODE" => $arProductParams[$i]["CODE"],
					"VALUE" => $arProductParams[$i]["VALUE"],
					"SORT" => $arProductParams[$i]["SORT"]
				);
		}
	}
	$arFields["PROPS"] = $arProps;

 $addres = CSaleBasket::Add($arFields);
	if ($addres)
	{
		if (CModule::IncludeModule("statistic"))
			CStatistic::Set_Event("sale2basket", "catalog", $arFields["DETAIL_PAGE_URL"]);
	}

	return $addres;
}

function ITCCatalogBasketCallback($productID, $quantity = 0, $renewal = "N")
{
	global $USER;

	$productID = IntVal($productID);
	$quantity = DoubleVal($quantity);
	$renewal = (($renewal == "Y") ? "Y" : "N");

	$arResult = array();

	$dbIBlockElement = CIBlockElement::GetList(
			array(),
			array(
					"ID" => $productID,
     "ACTIVE_DATE" => "Y",
					"ACTIVE" => "Y",
					"CHECK_PERMISSIONS" => "Y"
				)
		);
	$arProduct = $dbIBlockElement->GetNext();
	$arCatalog = CCatalog::GetByID($arProduct["IBLOCK_ID"]);
	if ($arCatalog["SUBSCRIPTION"] == "Y")
	{
		$quantity = 1;
	}
	
	if ($arCatalogProduct = CCatalogProduct::GetByID($productID))
	{
		if ($arCatalogProduct["QUANTITY_TRACE"]=="Y" && DoubleVal($arCatalogProduct["QUANTITY"])<=0)
		{
			$GLOBALS["APPLICATION"]->ThrowException(GetMessage("CATALOG_NO_QUANTITY_PRODUCT", Array("#NAME#" => $arProduct["NAME"])), "CATALOG_NO_QUANTITY_PRODUCT");
			return $arResult;
		}
	}
	
	$arCoupons = CCatalogDiscount::GetCoupons();
	if (is_array($arCoupons) && is_array($GLOBALS['CATALOG_ONETIME_COUPONS_BASKET']))
	{
		foreach ($arCoupons as $key => $coupon)
		{
			if (array_key_exists($coupon, $GLOBALS['CATALOG_ONETIME_COUPONS_BASKET']))
			{
				if ($GLOBALS['CATALOG_ONETIME_COUPONS_BASKET'][$coupon] == $productID)
				{
					$arCoupons = array($productID);
					break;
				}
				else
					unset($arCoupons[$key]);
			}
		}
	}
	
	//echo '<pre>Element: '; print_r($arProduct); echo '</pre>';
	//echo '<pre>Product: '; print_r($arCatalogProduct); echo '</pre>';
	//echo '<pre>Coupons: '; print_r($arCoupons); echo '</pre>';
	$arPrice = CCatalogProduct::GetOptimalPrice($productID, $quantity, $USER->GetUserGroupArray(), $renewal, array(), false, $arCoupons);
	//echo '<pre>Price: '; print_r($arPrice); echo '</pre>';
	
	if (!$arPrice || count($arPrice) <= 0)
	{
		if ($nearestQuantity = CCatalogProduct::GetNearestQuantityPrice($productID, $quantity, $USER->GetUserGroupArray()))
		{
			$quantity = $nearestQuantity;
			$arPrice = CCatalogProduct::GetOptimalPrice($productID, $quantity, $USER->GetUserGroupArray(), $renewal, array(), false, $arCoupons);
		}
	}
	
	if (!$arPrice || count($arPrice) <= 0)
	{
		return $arResult;
	}

	$currentPrice = $arPrice["PRICE"]["PRICE"];
	$currentDiscount = 0.0;

	if ($arPrice['PRICE']['VAT_INCLUDED'] == 'N')
	{
		if(DoubleVal($arPrice['PRICE']['VAT_RATE']) > 0)
		{
			$currentPrice *= (1 + $arPrice['PRICE']['VAT_RATE']);
			$arPrice['PRICE']['VAT_INCLUDED'] = 'y';
		}
	}

	if (isset($arPrice["DISCOUNT"]) && count($arPrice["DISCOUNT"]) > 0)
	{
		if ($arPrice["DISCOUNT"]["VALUE_TYPE"]=="F")
		{
			if ($arPrice["DISCOUNT"]["CURRENCY"] == $arPrice["PRICE"]["CURRENCY"])
				$currentDiscount = $arPrice["DISCOUNT"]["VALUE"];
			else
				$currentDiscount = CCurrencyRates::ConvertCurrency($arPrice["DISCOUNT"]["VALUE"], $arPrice["DISCOUNT"]["CURRENCY"], $arPrice["PRICE"]["CURRENCY"]);
		}
		else
			$currentDiscount = $currentPrice * $arPrice["DISCOUNT"]["VALUE"] / 100.0;

		$currentDiscount = roundEx($currentDiscount, SALE_VALUE_PRECISION);

		if (DoubleVal($arPrice["DISCOUNT"]["MAX_DISCOUNT"]) > 0)
		{
			if ($arPrice["DISCOUNT"]["CURRENCY"] == $baseCurrency)
				$maxDiscount = $arPrice["DISCOUNT"]["MAX_DISCOUNT"];
			else
				$maxDiscount = CCurrencyRates::ConvertCurrency($arPrice["DISCOUNT"]["MAX_DISCOUNT"], $arPrice["DISCOUNT"]["CURRENCY"], $arPrice["PRICE"]["CURRENCY"]);
			$maxDiscount = roundEx($maxDiscount, CATALOG_VALUE_PRECISION);

			if ($currentDiscount > $maxDiscount)
				$currentDiscount = $maxDiscount;
		}
		
		//$currentPrice = $currentPrice - $currentDiscount;         !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		
		if ($arPrice['DISCOUNT']['COUPON'])
		{
			//echo $arPrice['DISCOUNT']['COUPON'].'<br />';
			$dbRes = CCatalogDiscountCoupon::GetList(array(), array('COUPON' => $arPrice['DISCOUNT']['COUPON'], 'ONE_TIME' => 'Y'), false, false, array('ID'));
		
			if ($arRes = $dbRes->Fetch())
			{
				$GLOBALS['CATALOG_ONETIME_COUPONS_BASKET'][$arPrice['DISCOUNT']['COUPON']] = $productID;
			}
		}
	}
 
 //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 if($USER->IsAuthorized())
 {
  $discount = false;
  $discount_name = "";
  $discount_time = "";
  $userID = $USER->GetID();
  $arSelect = Array("ID", "NAME", "TIMESTAMP_X", "PROPERTY_DISCOUNT");
  $arFilter = Array("IBLOCK_ID"=>DISCOUNT_IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_USER"=>$userID, "PROPERTY_SECTION"=>$arProduct["IBLOCK_SECTION_ID"]);
  $rsDiscounts = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
  while($arDiscount = $rsDiscounts->Fetch())
  {
   if(intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]) > 0 && ($discount === false || intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]) > $discount))
   {
    $discount = intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]);
    $discount_name = $arDiscount["NAME"];
    $discount_time = $arDiscount["TIMESTAMP_X"];
   }
  }
  
  if($discount !== false)
  {
   $discount_abs = $currentPrice * $discount / 100.0;
   if($discount_abs > $currentDiscount)
   {
    $currentDiscount = $discount_abs;
    
    $arPrice["DISCOUNT_PRICE"] = $currentPrice - $currentDiscount;
    $arPrice["DISCOUNT"]["ID"] = "";
    $arPrice["DISCOUNT"]["ACTIVE_FROM"] = "";
    $arPrice["DISCOUNT"]["ACTIVE_TO"] = "";
    $arPrice["DISCOUNT"]["RENEWAL"] = "";
    $arPrice["DISCOUNT"]["NAME"] = $discount_name;
    $arPrice["DISCOUNT"]["MAX_USES"] = 0;
    $arPrice["DISCOUNT"]["COUNT_USES"] = 0;
    $arPrice["DISCOUNT"]["SORT"] = 100;
    $arPrice["DISCOUNT"]["MAX_DISCOUNT"] = 0;
    $arPrice["DISCOUNT"]["VALUE_TYPE"] = "P";
    $arPrice["DISCOUNT"]["VALUE"] = $discount;
    $arPrice["DISCOUNT"]["MIN_ORDER_SUM"] = 0;
    $arPrice["DISCOUNT"]["TIMESTAMP_X"] = $discount_time;
    $arPrice["DISCOUNT"]["NOTES"] = "";
    $arPrice["DISCOUNT"]["COUPON"] = "";
    $arPrice["DISCOUNT"]["COUPON_ONE_TIME"] = "";
   }
  }
 }
 
 $currentPrice = $currentPrice - $currentDiscount;
 //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
	$arResult = array(
			"PRODUCT_PRICE_ID" => $arPrice["PRICE"]["ID"],
			"PRICE" => $currentPrice,
			"VAT_RATE" => $arPrice['PRICE']['VAT_RATE'],
			"CURRENCY" => $arPrice["PRICE"]["CURRENCY"],
			"QUANTITY" => $quantity,
			"DISCOUNT_PRICE" => $currentDiscount,
			"WEIGHT" => 0,
			"NAME" => $arProduct["~NAME"],
			"CAN_BUY" => "Y",
			"NOTES" => $arPrice["PRICE"]["CATALOG_GROUP_NAME"]
		);

	if ($arCatalogProduct)
	{
		$arResult["WEIGHT"] = IntVal($arCatalogProduct["WEIGHT"]);
		if ($arCatalogProduct["QUANTITY_TRACE"]=="Y")
		{
			if ((DoubleVal($arCatalogProduct["QUANTITY"]) - $quantity) < 0)
			{
				$arResult["QUANTITY"] = DoubleVal($arCatalogProduct["QUANTITY"]);
				$GLOBALS["APPLICATION"]->ThrowException(GetMessage("CATALOG_QUANTITY_NOT_ENOGH", Array("#NAME#" => $arProduct["NAME"], "#CATALOG_QUANTITY#" => $arCatalogProduct["QUANTITY"], "#QUANTITY#" => $quantity)), "CATALOG_QUANTITY_NOT_ENOGH");
			}
		}
	}
 
	return $arResult;
}

function ITCCatalogBasketOrderCallback($productID, $quantity, $renewal = "N")
{
 global $USER;
 
	$productID = IntVal($productID);
	$quantity = DoubleVal($quantity);
	$renewal = (($renewal == "Y") ? "Y" : "N");
	$arResult = array();

	if ($arCatalogProduct = CCatalogProduct::GetByID($productID))
	{
		if ($arCatalogProduct["QUANTITY_TRACE"]=="Y" && DoubleVal($arCatalogProduct["QUANTITY"])<doubleVal($quantity))
			return $arResult;
	}

	$arPrice = CCatalogProduct::GetOptimalPrice($productID, $quantity, $GLOBALS["USER"]->GetUserGroupArray(), $renewal);
	if (!$arPrice || count($arPrice) <= 0)
	{
		if ($nearestQuantity = CCatalogProduct::GetNearestQuantityPrice($productID, $quantity, $GLOBALS["USER"]->GetUserGroupArray()))
		{
			$quantity = $nearestQuantity;
			$arPrice = CCatalogProduct::GetOptimalPrice($productID, $quantity, $GLOBALS["USER"]->GetUserGroupArray(), $renewal);
		}
	}
	if (!$arPrice || count($arPrice) <= 0)
	{
		return $arResult;
	}

	$dbIBlockElement = CIBlockElement::GetList(
			array(),
			array(
					"ID" => $productID,
					"ACTIVE_DATE" => "Y",
					"ACTIVE" => "Y",
					"CHECK_PERMISSIONS" => "Y"
				)
		);
	$arProduct = $dbIBlockElement->GetNext();

	$currentPrice = $arPrice["PRICE"]["PRICE"];
	$currentDiscount = 0.0;
	
	if ($arPrice['PRICE']['VAT_INCLUDED'] == 'N')
	{
		if(DoubleVal($arPrice['PRICE']['VAT_RATE']) > 0)
		{
			$currentPrice *= (1 + $arPrice['PRICE']['VAT_RATE']);
			$arPrice['PRICE']['VAT_INCLUDED'] = 'Y';
		}
	}

	if (isset($arPrice["DISCOUNT"]) && count($arPrice["DISCOUNT"]) > 0)
	{
		if ($arPrice["DISCOUNT"]["VALUE_TYPE"]=="F")
		{
			if ($arPrice["DISCOUNT"]["CURRENCY"] == $arPrice["PRICE"]["CURRENCY"])
				$currentDiscount = $arPrice["DISCOUNT"]["VALUE"];
			else
				$currentDiscount = CCurrencyRates::ConvertCurrency($arPrice["DISCOUNT"]["VALUE"], $arPrice["DISCOUNT"]["CURRENCY"], $arPrice["PRICE"]["CURRENCY"]);
		}
		else
			$currentDiscount = $currentPrice * $arPrice["DISCOUNT"]["VALUE"] / 100.0;

		$currentDiscount = roundEx($currentDiscount, SALE_VALUE_PRECISION);

		if (DoubleVal($arPrice["DISCOUNT"]["MAX_DISCOUNT"]) > 0)
		{
			if ($arPrice["DISCOUNT"]["CURRENCY"] == $baseCurrency)
				$maxDiscount = $arPrice["DISCOUNT"]["MAX_DISCOUNT"];
			else
				$maxDiscount = CCurrencyRates::ConvertCurrency($arPrice["DISCOUNT"]["MAX_DISCOUNT"], $arPrice["DISCOUNT"]["CURRENCY"], $arPrice["PRICE"]["CURRENCY"]);
			$maxDiscount = roundEx($maxDiscount, CATALOG_VALUE_PRECISION);

			if ($currentDiscount > $maxDiscount)
				$currentDiscount = $maxDiscount;
		}
  
  //$currentPrice = $currentPrice - $currentDiscount;       !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	}
 
 //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 if($USER->IsAuthorized())
 {
  $discount = false;
  $discount_name = "";
  $discount_time = "";
  $userID = $USER->GetID();
  $arSelect = Array("ID", "NAME", "TIMESTAMP_X", "PROPERTY_DISCOUNT");
  $arFilter = Array("IBLOCK_ID"=>DISCOUNT_IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_USER"=>$userID, "PROPERTY_SECTION"=>$arProduct["IBLOCK_SECTION_ID"]);
  $rsDiscounts = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
  while($arDiscount = $rsDiscounts->Fetch())
  {
   if(intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]) > 0 && ($discount === false || intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]) > $discount))
   {
    $discount = intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]);
    $discount_name = $arDiscount["NAME"];
    $discount_time = $arDiscount["TIMESTAMP_X"];
   }
  }
  
  if($discount !== false)
  {
   $discount_abs = $currentPrice * $discount / 100.0;
   if($discount_abs > $currentDiscount)
   {
    $currentDiscount = $discount_abs;
    
    $arPrice["DISCOUNT_PRICE"] = $currentPrice - $currentDiscount;
    $arPrice["DISCOUNT"]["ID"] = "";
    $arPrice["DISCOUNT"]["ACTIVE_FROM"] = "";
    $arPrice["DISCOUNT"]["ACTIVE_TO"] = "";
    $arPrice["DISCOUNT"]["RENEWAL"] = "";
    $arPrice["DISCOUNT"]["NAME"] = $discount_name;
    $arPrice["DISCOUNT"]["MAX_USES"] = 0;
    $arPrice["DISCOUNT"]["COUNT_USES"] = 0;
    $arPrice["DISCOUNT"]["SORT"] = 100;
    $arPrice["DISCOUNT"]["MAX_DISCOUNT"] = 0;
    $arPrice["DISCOUNT"]["VALUE_TYPE"] = "P";
    $arPrice["DISCOUNT"]["VALUE"] = $discount;
    $arPrice["DISCOUNT"]["MIN_ORDER_SUM"] = 0;
    $arPrice["DISCOUNT"]["TIMESTAMP_X"] = $discount_time;
    $arPrice["DISCOUNT"]["NOTES"] = "";
    $arPrice["DISCOUNT"]["COUPON"] = "";
    $arPrice["DISCOUNT"]["COUPON_ONE_TIME"] = "";
   }
  }
 }
 
 $currentPrice = $currentPrice - $currentDiscount;
 //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
	$arResult = array(
			"PRODUCT_PRICE_ID" => $arPrice["PRICE"]["ID"],
			"PRICE" => $currentPrice,
			"VAT_RATE" => $arPrice['PRICE']['VAT_RATE'],
			"CURRENCY" => $arPrice["PRICE"]["CURRENCY"],
			"QUANTITY" => $quantity,
			"WEIGHT" => 0,
			"NAME" => $arProduct["~NAME"],
			"CAN_BUY" => "Y",
			"NOTES" => $arPrice["PRICE"]["CATALOG_GROUP_NAME"],
			"DISCOUNT_PRICE" => $currentDiscount,
		);
	if(!empty($arPrice["DISCOUNT"]))
	{
		if(strlen($arPrice["DISCOUNT"]["COUPON"])>0)
			$arResult["DISCOUNT_COUPON"] = $arPrice["DISCOUNT"]["COUPON"];
			if($arPrice["DISCOUNT"]["VALUE_TYPE"]=="P")
				$arResult["DISCOUNT_VALUE"] = $arPrice["DISCOUNT"]["VALUE"]."%";
			else
				$arResult["DISCOUNT_VALUE"] = SaleFormatCurrency($arPrice["DISCOUNT"]["VALUE"], $arPrice["DISCOUNT"]["CURRENCY"]);
			$arResult["DISCOUNT_NAME"] = "[".$arPrice["DISCOUNT"]["ID"]."] ".$arPrice["DISCOUNT"]["NAME"];
			
		$dbCoupon = CCatalogDiscountCoupon::GetList(
			array(),
			array("COUPON" => $arPrice["DISCOUNT"]["COUPON"], 'ACTIVE' => 'Y'),
			false,
			false,
			array("ID", "ONE_TIME")
		);
		
		if ($arCoupon = $dbCoupon->Fetch())
		{
			$arFieldsCoupon = Array("DATE_APPLY" => Date($GLOBALS["DB"]->DateFormatToPHP(CSite::GetDateFormat("FULL", SITE_ID))));

			if ($arCoupon["ONE_TIME"] == "Y")
			{
				$arFieldsCoupon["ACTIVE"] = "N";

				foreach($_SESSION["CATALOG_USER_COUPONS"] as $k => $v)
				{
					if(trim($v) == trim($arPrice["DISCOUNT"]["COUPON"]))
					{
						unset($_SESSION["CATALOG_USER_COUPONS"][$k]);
						$_SESSION["CATALOG_USER_COUPONS"][$k] == "";
					}
				}
			}

			CCatalogDiscountCoupon::Update($arCoupon["ID"], $arFieldsCoupon);
		}
	}

	if ($arCatalogProduct)
	{
		$arResult["WEIGHT"] = IntVal($arCatalogProduct["WEIGHT"]);
	}
	CCatalogProduct::QuantityTracer($productID, $quantity);
	return $arResult;
}

function ITCCatalogBasketCancelCallback($PRODUCT_ID, $QUANTITY, $bCancel)
{
	$PRODUCT_ID = IntVal($PRODUCT_ID);
	$QUANTITY = DoubleVal($QUANTITY);
	$bCancel = ($bCancel ? True : False);

	if ($bCancel)
		CCatalogProduct::QuantityTracer($PRODUCT_ID, -$QUANTITY);
	else
		CCatalogProduct::QuantityTracer($PRODUCT_ID, $QUANTITY);
}

function ITCCatalogPayOrderCallback($productID, $userID, $bPaid, $orderID)
{
	global $DB;

	$productID = IntVal($productID);
	$userID = IntVal($userID);
	$bPaid = ($bPaid ? True : False);
	$orderID = IntVal($orderID);

	if ($userID <= 0)
		return False;

	$dbIBlockElement = CIBlockElement::GetList(
			array(),
			array(
					"ID" => $productID,
					"ACTIVE_DATE" => "Y",
					"ACTIVE" => "Y",
					"CHECK_PERMISSIONS" => "Y"
			)
		);
	if ($arIBlockElement = $dbIBlockElement->GetNext())
	{
		//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  //Специфика проекта
  $arFilter = Array('IBLOCK_ID'=>$arIBlockElement["IBLOCK_ID"], 'ID'=>$arIBlockElement["IBLOCK_SECTION_ID"], 'GLOBAL_ACTIVE'=>'Y', '=UF_HIDDEN'=>'');
  $rsSec = CIBlockSection::GetList(Array(), $arFilter, false);
  if(!$rsSec->SelectedRowsCount())
   $arIBlockElement["DETAIL_PAGE_URL"] = "";
  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  
  $arCatalog = CCatalog::GetByID($arIBlockElement["IBLOCK_ID"]);
		if ($arCatalog["SUBSCRIPTION"] == "Y")
		{
			$arProduct = CCatalogProduct::GetByID($productID);

			if ($bPaid)
			{
				$arUserGroups = array();
				$arTmp = array();
				$ind = -1;
				$dbProductGroups = CCatalogProductGroups::GetList(
						array(),
						array("PRODUCT_ID" => $productID),
						false,
						false,
						array("GROUP_ID", "ACCESS_LENGTH", "ACCESS_LENGTH_TYPE")
					);
				while ($arProductGroups = $dbProductGroups->Fetch())
				{
					$ind++;
					$curTime = time();

					$accessType = $arProductGroups["ACCESS_LENGTH_TYPE"];
					$accessLength = IntVal($arProductGroups["ACCESS_LENGTH"]);

					$accessVal = 0;
					if ($accessType == "H")
						$accessVal = mktime(date("H") + $accessLength, date("i"), date("s"), date("m"), date("d"), date("Y"));
					elseif ($accessType == "D")
						$accessVal = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + $accessLength, date("Y"));
					elseif ($accessType == "W")
						$accessVal = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 7 * $accessLength, date("Y"));
					elseif ($accessType == "M")
						$accessVal = mktime(date("H"), date("i"), date("s"), date("m") + $accessLength, date("d"), date("Y"));
					elseif ($accessType == "Q")
						$accessVal = mktime(date("H"), date("i"), date("s"), date("m") + 3 * $accessLength, date("d"), date("Y"));
					elseif ($accessType == "S")
						$accessVal = mktime(date("H"), date("i"), date("s"), date("m") + 6 * $accessLength, date("d"), date("Y"));
					elseif ($accessType == "Y")
						$accessVal = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y") + $accessLength);
					elseif ($accessType == "T")
						$accessVal = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y") + 2 * $accessLength);

					$arUserGroups[$ind] = array(
							"GROUP_ID" => $arProductGroups["GROUP_ID"],
							"DATE_ACTIVE_FROM" => Date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL", SITE_ID)), $curTime),
							"DATE_ACTIVE_TO" => Date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL", SITE_ID)), $accessVal)
						);

					$arTmp[IntVal($arProductGroups["GROUP_ID"])] = $ind;
				}

				if (count($arUserGroups) > 0)
				{
					$dbOldGroups = CUser::GetUserGroupEx($userID);
					while ($arOldGroups = $dbOldGroups->Fetch())
					{
						if (array_key_exists(IntVal($arOldGroups["GROUP_ID"]), $arTmp))
						{
							if (strlen($arOldGroups["DATE_ACTIVE_FROM"]) <= 0)
							{
								$arUserGroups[$arTmp[IntVal($arOldGroups["GROUP_ID"])]]["DATE_ACTIVE_FROM"] = false;
							}
							else
							{
								$oldDate = CDatabase::FormatDate($arOldGroups["DATE_ACTIVE_FROM"], CSite::GetDateFormat("SHORT", SITE_ID), "YYYYMMDDHHMISS");
								$newDate = CDatabase::FormatDate($arUserGroups[$arTmp[IntVal($arOldGroups["GROUP_ID"])]]["DATE_ACTIVE_FROM"], CSite::GetDateFormat("SHORT", SITE_ID), "YYYYMMDDHHMISS");
								if ($oldDate > $newDate)
									$arUserGroups[$arTmp[IntVal($arOldGroups["GROUP_ID"])]]["DATE_ACTIVE_FROM"] = $arOldGroups["DATE_ACTIVE_FROM"];
							}

							if (strlen($arOldGroups["DATE_ACTIVE_TO"]) <= 0)
							{
								$arUserGroups[$arTmp[IntVal($arOldGroups["GROUP_ID"])]]["DATE_ACTIVE_TO"] = false;
							}
							else
							{
								$oldDate = CDatabase::FormatDate($arOldGroups["DATE_ACTIVE_TO"], CSite::GetDateFormat("SHORT", SITE_ID), "YYYYMMDDHHMISS");
								$newDate = CDatabase::FormatDate($arUserGroups[$arTmp[IntVal($arOldGroups["GROUP_ID"])]]["DATE_ACTIVE_TO"], CSite::GetDateFormat("SHORT", SITE_ID), "YYYYMMDDHHMISS");
								if ($oldDate > $newDate)
									$arUserGroups[$arTmp[IntVal($arOldGroups["GROUP_ID"])]]["DATE_ACTIVE_TO"] = $arOldGroups["DATE_ACTIVE_TO"];
							}
						}
						else
						{
							$ind++;

							$arUserGroups[$ind] = array(
									"GROUP_ID" => $arOldGroups["GROUP_ID"],
									"DATE_ACTIVE_FROM" => $arOldGroups["DATE_ACTIVE_FROM"],
									"DATE_ACTIVE_TO" => $arOldGroups["DATE_ACTIVE_TO"]
								);
						}
					}

					CUser::SetUserGroup($userID, $arUserGroups);
					if (isset($GLOBALS["USER"]) && is_object($GLOBALS["USER"]) && IntVal($GLOBALS["USER"]->GetID()) == $userID)
					{
						$arUserGroupsTmp = array();
						for ($i = 0; $i < count($arUserGroups); $i++)
							$arUserGroupsTmp[] = IntVal($arUserGroups[$i]["GROUP_ID"]);

						$GLOBALS["USER"]->SetUserGroupArray($arUserGroupsTmp);
					}
				}
			}
			else
			{
				$arUserGroups = array();
				$ind = -1;
				$arTmp = array();

				$dbOldGroups = CUser::GetUserGroupEx($userID);
				while ($arOldGroups = $dbOldGroups->Fetch())
				{
					$ind++;
					$arUserGroups[$ind] = array(
							"GROUP_ID" => $arOldGroups["GROUP_ID"],
							"DATE_ACTIVE_FROM" => $arOldGroups["DATE_ACTIVE_FROM"],
							"DATE_ACTIVE_TO" => $arOldGroups["DATE_ACTIVE_FROM"]
						);

					$arTmp[IntVal($arOldGroups["GROUP_ID"])] = $ind;
				}

				$bNeedUpdate = False;
				$dbProductGroups = CCatalogProductGroups::GetList(
						array(),
						array("PRODUCT_ID" => $productID),
						false,
						false,
						array("GROUP_ID")
					);
				while ($arProductGroups = $dbProductGroups->Fetch())
				{
					if (array_key_exists(IntVal($arProductGroups["GROUP_ID"]), $arTmp))
					{
						unset($arUserGroups[IntVal($arProductGroups["GROUP_ID"])]);
						$bNeedUpdate = True;
					}
				}

				if ($bNeedUpdate)
				{
					CUser::SetUserGroup($userID, $arUserGroups);

					if (isset($GLOBALS["USER"]) && is_object($GLOBALS["USER"]) && IntVal($GLOBALS["USER"]->GetID()) == $userID)
					{
						$arUserGroupsTmp = array();
						for ($i = 0; $i < count($arUserGroups); $i++)
							$arUserGroupsTmp[] = IntVal($arUserGroups[$i]["GROUP_ID"]);

						$GLOBALS["USER"]->SetUserGroupArray($arUserGroupsTmp);
					}
				}
			}

			if ($arProduct["PRICE_TYPE"] != "S")
			{
				if ($bPaid)
				{
					$recurType = $arProduct["RECUR_SCHEME_TYPE"];
					$recurLength = IntVal($arProduct["RECUR_SCHEME_LENGTH"]);

					$recurSchemeVal = 0;
					if ($recurType == "H")
						$recurSchemeVal = mktime(date("H") + $recurLength, date("i"), date("s"), date("m"), date("d"), date("Y"));
					elseif ($recurType == "D")
						$recurSchemeVal = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + $recurLength, date("Y"));
					elseif ($recurType == "W")
						$recurSchemeVal = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 7 * $recurLength, date("Y"));
					elseif ($recurType == "M")
						$recurSchemeVal = mktime(date("H"), date("i"), date("s"), date("m") + $recurLength, date("d"), date("Y"));
					elseif ($recurType == "Q")
						$recurSchemeVal = mktime(date("H"), date("i"), date("s"), date("m") + 3 * $recurLength, date("d"), date("Y"));
					elseif ($recurType == "S")
						$recurSchemeVal = mktime(date("H"), date("i"), date("s"), date("m") + 6 * $recurLength, date("d"), date("Y"));
					elseif ($recurType == "Y")
						$recurSchemeVal = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y") + $recurLength);
					elseif ($recurType == "T")
						$recurSchemeVal = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y") + 2 * $recurLength);

					$arFields = array(
							"USER_ID" => $userID,
							"MODULE" => "catalog",
							"PRODUCT_ID" => $productID,
							"PRODUCT_NAME" => $arIBlockElement["~NAME"],
							"PRODUCT_URL" => $arIBlockElement["DETAIL_PAGE_URL"],
							"PRODUCT_PRICE_ID" => false,
							"PRICE_TYPE" => $arProduct["PRICE_TYPE"],
							"RECUR_SCHEME_TYPE" => $recurType,
							"RECUR_SCHEME_LENGTH" => $recurLength,
							"WITHOUT_ORDER" => $arProduct["WITHOUT_ORDER"],
							"PRICE" => false,
							"CURRENCY" => false,
							"CANCELED" => "N",
							"CANCELED_REASON" => false,
							"CALLBACK_FUNC" => "CatalogRecurringCallback",
							"DESCRIPTION" => false,
							"PRIOR_DATE" => false,
							"NEXT_DATE" => Date(
									$GLOBALS["DB"]->DateFormatToPHP(CLang::GetDateFormat("FULL", SITE_ID)),
									$recurSchemeVal
								)
						);

					return $arFields;
				}
			}
		}

		return True;
	}

	return false;
}
?>