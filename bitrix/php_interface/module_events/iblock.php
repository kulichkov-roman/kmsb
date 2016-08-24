<?
//при работе с инфоблоками "специальных предложений" автоматом проставляем привязанному элементу каталога галочку "товар в наличии"
//AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", array("specialOffers", "saveParams"));
//AddEventHandler("iblock", "OnAfterIBlockElementUpdate", array("specialOffers", "setAvailable"));

//AddEventHandler("iblock", "OnAfterIBlockElementAdd", array("specialOffers", "setAvailable"));

//AddEventHandler("iblock", "OnBeforeIBlockElementDelete", array("specialOffers", "saveParamsOnDelete"));
//AddEventHandler("iblock", "OnAfterIBlockElementDelete", array("specialOffers", "setAvailableOnDelete"));

// транслитирация символьного кода элемента ИБ каталог
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "UpdateElementCode");
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "UpdateElementCode");
// транслитирация символьного кода раздела ИБ каталог
AddEventHandler("iblock", "OnBeforeIBlockSectionAdd", "UpdateSectionCode");
AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "UpdateSectionCode");

/**
 * Обновить символьный код элемента
 * @param $arFields
 */
function UpdateElementCode(&$arFields)
{
    if($arFields["IBLOCK_ID"] == CATALOG_IBLOCK_ID_KS)
    {
        //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_UpdateElementCode.txt", var_export($arFields, true), FILE_APPEND | LOCK_EX);

	    /**
	     * Если това добавляется, то у него нет еще PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE
	     */
        /*$arSort = array();
        $arSelect = array(
            "ID",
            "NAME",
            "PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE"
        );
        $arFilter = array(
            "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
            "ID" => $arFields["ID"]
        );
        $rsElements = CIBlockElement::GetList(
            $arSort,
            $arFilter,
            false,
            false,
            $arSelect
        );

        $arElement = $rsElements->GetNext();

        if($arElement["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"] <> "")
        {
            $strName = $arElement["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"];
        }
        else
        {
            $strName = $arElement["NAME"];
        }*/

	    /**
	     * Внезависмости от добавления элемента или обновления перегенирировать POLNOE_NAIMENOVANIE_PROP по обрабатываемым данным в событие
	     */
	    $strName = $arFields["PROPERTY_VALUES"][POLNOE_NAIMENOVANIE_PROP]['n0']["VALUE"] <> "" ? $arFields["PROPERTY_VALUES"][POLNOE_NAIMENOVANIE_PROP]['n0']["VALUE"] : $arFields["NAME"] ;

	    $util = new Cutil;

	    $arParams = array(
		    "change_case" => "L",
		    "replace_space" => "_",
		    "replace_other" => "_",
		    "delete_repeat_replace" => true,
	    );

	    $arFields["CODE"] = $util->translit($strName, "ru", $arParams);

	    //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_UpdateElementCode.txt", var_export($arFields, true), FILE_APPEND | LOCK_EX);
    }
}

/**
 * Обновить символьный код раздела
 * @param $arFields
 */
function UpdateSectionCode(&$arFields)
{
    if($arFields["IBLOCK_ID"] == CATALOG_IBLOCK_ID_KS)
    {
	    /**
	     * @todo на сколько нужно делать данную выборку?
	     */
	    $arSort = array();
        $arFilter = array(
            "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
            "ID" => $arFields["ID"],
        );
        $arSelect = array(
            "ID",
            "NAME"
        );
        $rsSection = CIBlockSection::GetList(
            $arSort,
            $arFilter,
            false,
            $arSelect,
            false
        );
        $arSection = $rsSection->GetNext();

        $strName = $arSection["NAME"];

        $util = new Cutil;

        $arParams = array(
            "change_case" => "L",
            "replace_space" => "_",
            "replace_other" => "_",
            "delete_repeat_replace" => true,
        );

        $arFields["CODE"] = $util->translit($strName, "ru", $arParams).'_'.$arFields["ID"];
    }
}

class specialOffers{
	const AVAILABLE_PROP_CODE = "AVAILABLE_ICO";
	const AVAILABLE_YES = '135';

	const ITEM_PROP_CODE = "ITEM";

	static $_arSpecialOfferIblockIds = array(
		SLIDER_ON_MAIN_IBLOCK_ID,
		SPECIAL_OFFERS_IBLOCK_ID
	);

	private static $catalogItemId = false;
	private static $oldActiveStatus = false;

	//установить свойство элемента каталога "Товар в наличии"
	public static function setAvailableProperty($elementId, $value = ""){
		CModule::IncludeModule("iblock");

        //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_log.txt", var_export($value, true), FILE_APPEND | LOCK_EX);

		CIBlockElement::SetPropertyValuesEx(
	        $elementId,
	        CATALOG_IBLOCK_ID_KS,
	        array(
	            self::AVAILABLE_PROP_CODE => $value
	        )
	    );
	}

	//получить значение свойства-привязки "Товар" для слайдера
	public static function getCatalogItemProperty($elementId, $iblock){
		CModule::IncludeModule("iblock");

		$rsProp = CIBlockElement::GetProperty($iblock, $elementId, array(), array("CODE" => self::ITEM_PROP_CODE));
		$arProp = $rsProp -> GetNext();

		return $arProp["VALUE"];
	}

	//проверить, имеет ли инфоблок отношение к "спец.предложениям"
	public static function isSpecialOffer($iblockId){
		return in_array($iblockId, self::$_arSpecialOfferIblockIds);
	}

	//сохранить текущее значение свойства-привязки "товар"
	public static function saveParams($arFields){
		if(!self::isSpecialOffer($arFields["IBLOCK_ID"])){
			return;
		}
		
		if(!$arFields["ID"]){
			return;
		}

		self::$catalogItemId = self::getCatalogItemProperty($arFields["ID"], $arFields["IBLOCK_ID"]);
	}

	//перед удалением
	public static function saveParamsOnDelete($elementId){
		CModule::IncludeModule("iblock");

		$rsElement = CIBlockElement::GetById($elementId);
		$arFields = $rsElement -> GetNext();

		self::saveParams($arFields);

		return;
	}

	//после удаления
	public static function setAvailableOnDelete($arFields){

		if(!self::isSpecialOffer($arFields["IBLOCK_ID"])){
			return;
		}
		
		$elementId = $arFields["ID"];
		if(!$elementId){
			return;
		}
		
		$oldCatalogItemId = self::$catalogItemId;
		if($oldCatalogItemId){
			self::setAvailableProperty($oldCatalogItemId);
		}
	}		

	//при апдейте элемента слайдера установить для товара свойство "товар в наличии"
	public static function setAvailable($arFields){

		if(!self::isSpecialOffer($arFields["IBLOCK_ID"])){
			return;
		}

		$elementId = $arFields["ID"];
		if(!$elementId){
			return;
		}

        $newCatalogItemId = self::getCatalogItemProperty($elementId, $arFields["IBLOCK_ID"]);
		$oldCatalogItemId = self::$catalogItemId;

        //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/eventsend_log.txt", var_export($oldCatalogItemId, true), FILE_APPEND | LOCK_EX);

		//если деактивировали элемент - убрать свойство "товар в наличии"
		if($arFields["ACTIVE"] != "Y"){
			self::setAvailableProperty($oldCatalogItemId);
			return;
		}

		// if(($newCatalogItemId == $oldCatalogItemId )&& (self::$oldActiveStatus == "Y")){
		// 	return;
		// }		

		//у раннее прикрепленного элемента каталога убираем галочку "товар в наличии"
		if($oldCatalogItemId){
			self::setAvailableProperty($oldCatalogItemId);
		}

		//у прикрепленного элемента ставим галочку "товар в наличии"
		if($newCatalogItemId){
			self::setAvailableProperty($newCatalogItemId, self::AVAILABLE_YES);	
		}
	}
}
?>