<? 
//-->
// Событие создающее пользователя, у которого login = email
//AddEventHandler("main", "OnBeforeUserRegister", array("MPSMainClass", "OnBeforeUserUpdateHandler"));
//AddEventHandler("main", "OnBeforeUserUpdate", array("MPSMainClass", "OnBeforeUserUpdateHandler"));

//AddEventHandler("sale", "OnSalePayOrder", array("MPSMainClass", "OnSalePayOrderHandler"));

/*class MPSMainClass 
{
    function OnSalePayOrderHandler($OrderID, $Payed="N")
    {
        
        $Doc = new CAcritDocument;
        
        $Doc->OnSalePayOrder($OrderID, $Payed="N");
        
        /*$arOrder = CSaleOrder::GetByID($OrderID);
        if ($arOrder["PAYED"]=="Y") {
            
            //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_log.txt", print_r("Payed=Y", true), FILE_APPEND | LOCK_EX);

            $DeliveryStr = COption::GetOptionString("sale","delivery","");
            
            //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_log.txt", print_r($arOrder, true), FILE_APPEND | LOCK_EX);
            file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_log.txt", print_r($DeliveryStr, true), FILE_APPEND | LOCK_EX);

            $arDeliveryStr = explode(",",$DeliveryStr);
            if (!is_array($arDeliveryStr)) $arDeliveryStr = array();
            if (in_array($arOrder["DELIVERY_ID"], $arDeliveryStr)) {
                $EMailCode = COption::GetOptionString("acrit.document","emailcode","EMAIL");
                $EMail = "";
                $db_props = CSaleOrderProps::GetList(
                    array("SORT" => "ASC"),
                    array(
                        "PERSON_TYPE_ID" => $arOrder["PERSON_TYPE_ID"],
                        "CODE" => $EMailCode
                    )
                );
                if ($arProps = $db_props->Fetch()) {
                    $db_vals = CSaleOrderPropsValue::GetList(
                        array("SORT" => "ASC"),
                        array(
                            "ORDER_ID" => $OrderID,
                            "ORDER_PROPS_ID" => $arProps["ID"]
                        )
                    );
                    if ($arVals = $db_vals->Fetch()) {
                        $EMail = $arVals["VALUE"];
                    }
                }
                $dbBasket = CSaleBasket::GetList(
                    array("NAME" => "ASC"),
                    array("ORDER_ID" => $OrderID),
                    false,
                    false,
                    array("ID", "NAME", "PRICE", "CURRENCY", "PRODUCT_ID")
                );
                $arFiles = array();
                while ($arBasketItem = $dbBasket->Fetch()) {
                    $dbBasketProps = CSaleBasket::GetPropsList(
                        array("SORT" => "ASC", "ID" => "DESC"),
                        array(
                            "BASKET_ID" => $arBasketItem["ID"],
                            "!CODE" => array("CATALOG.XML_ID", "PRODUCT.XML_ID")
                        ),
                        false,
                        false,
                        array("ID", "BASKET_ID", "NAME", "VALUE", "CODE", "SORT")
                    );
                    $AttachIndex=1;
                    while($arBasketProp = $dbBasketProps->GetNext()) {
                        if (in_array($arBasketProp["CODE"], array("HTML","DOC","PDF"))) {
                            if (is_numeric($arBasketProp["VALUE"])) {
                                $Key = $arBasketItem["NAME"].".".strtolower($arBasketProp["CODE"]);
                                $FileName = CFile::GetPath($arBasketProp["VALUE"]);
                                $arFiles[$Key] = $FileName;
                            }
                        }
                    }
                }
                if (check_email($EMail) && count($arFiles)>0) {
                    $arEMailFields = array(
                        "EMAIL_TO" => $EMail,
                        "USER_ID" => CUser::GetID(),
                        "ORDER_ID" => $OrderID,
                        "PRICE" => $arOrder["PRICE"],
                        "CURRENCY" => $arOrder["CURRENCY"],
                        "PRICE_DELIVERY" => $arOrder["PRICE_DELIVERY"],
                        "FILES"=>$arFiles
                    );
                    $Result = CEvent::Send("ACRIT_DOCUMENT_FORM_PAID", "s1", $arEMailFields);
                }
            }
        }
        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_log.txt", print_r($OrderID."\n", true), FILE_APPEND | LOCK_EX);
    }
}*/
//<--
?>