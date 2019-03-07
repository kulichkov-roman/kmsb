<?

/*
function translate_str($title)
    {
        $tbl= array(
            'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ж'=>'zh', 'з'=>'z',
            'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p',
            'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'ы'=>'y', 'э'=>'e', 'А'=>'A',
            'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ж'=>'ZH', 'З'=>'Z', 'И'=>'I',
            'Й'=>'Y', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O', 'П'=>'P', 'Р'=>'R',
            'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Ы'=>'Y', 'Э'=>'E', 'ё'=>"yo", 'х'=>"h",
            'ц'=>"ts", 'ч'=>"ch", 'ш'=>"sh", 'щ'=>"shch", 'ъ'=>"", 'ь'=>"", 'ю'=>"yu", 'я'=>"ya",
            'Ё'=>"YO", 'Х'=>"H", 'Ц'=>"TS", 'Ч'=>"CH", 'Ш'=>"SH", 'Щ'=>"SHCH", 'Ъ'=>"", 'Ь'=>"",
            'Ю'=>"YU", 'Я'=>"YA", ' '=>"-", '('=>'', ')'=>'', ','=>'', '.'=>'-', '_'=>'-'
            );

        $translate = mb_strtolower(strtr($title, $tbl));
        return $translate;
    }

function translate_str_old($str)
{
  $str=strtolower($str);
  $s="";
  $o0=ord('0');
  $o9=ord('9');
  $oa=ord('a');
  $oz=ord('z');
  for ($i=0;$i<strlen($str);$i++)
  {
    $os=ord(substr($str, $i, 1));
    if ((($o0<=$os)&&($os<=$o9)) || (($oa<=$os) &&($os<=$oz)))
      $s.=substr($str, $i, 1);
    else
    { //преобразовать в транслит
      switch (substr($str, $i, 1))
      {
        case "_":  $s.="-"; break;
        case "-":  $s.="-"; break;
        case " ":  $s.="-"; break;
        case ".":  $s.="."; break;
        case "а":  $s.="a"; break;
        case "б":  $s.="b"; break;
        case "в":  $s.="v"; break;
        case "г":  $s.="g"; break;
        case "д":  $s.="d"; break;
        case "е":  $s.="e"; break;
        case "ё":  $s.="e"; break;
        case "ж":  $s.="zh"; break;
        case "з":  $s.="z"; break;
        case "и":  $s.="i"; break;
        case "й":  $s.="iy"; break;
        case "к":  $s.="k"; break;
        case "л":  $s.="l"; break;
        case "м":  $s.="m"; break;
        case "н":  $s.="n"; break;
        case "о":  $s.="o"; break;
        case "п":  $s.="p"; break;
        case "р":  $s.="r"; break;
        case "с":  $s.="s"; break;
        case "т":  $s.="t"; break;
        case "у":  $s.="u"; break;
        case "ф":  $s.="f"; break;
        case "х":  $s.="h"; break;
        case "ц":  $s.="c"; break;
        case "ч":  $s.="ch"; break;
        case "ш":  $s.="sh"; break;
        case "щ":  $s.="sch"; break;
        case "ь":  $s.=""; break;
        case "ъ":  $s.=""; break;
        case "ы":  $s.="i"; break;
        case "э":  $s.="e"; break;
        case "ю":  $s.="yu"; break;
        case "я":  $s.="ya"; break;
        case "А":  $s.="a"; break;
        case "Б":  $s.="b"; break;
        case "В":  $s.="v"; break;
        case "Г":  $s.="g"; break;
        case "Д":  $s.="d"; break;
        case "Е":  $s.="e"; break;
        case "Ё":  $s.="e"; break;
        case "Ж":  $s.="zh"; break;
        case "З":  $s.="z"; break;
        case "И":  $s.="i"; break;
        case "Й":  $s.="iy"; break;
        case "К":  $s.="k"; break;
        case "Л":  $s.="l"; break;
        case "М":  $s.="m"; break;
        case "Н":  $s.="n"; break;
        case "О":  $s.="o"; break;
        case "П":  $s.="p"; break;
        case "Р":  $s.="r"; break;
        case "С":  $s.="s"; break;
        case "Т":  $s.="t"; break;
        case "У":  $s.="u"; break;
        case "Ф":  $s.="f"; break;
        case "Х":  $s.="h"; break;
        case "Ц":  $s.="c"; break;
        case "Ч":  $s.="ch"; break;
        case "Ш":  $s.="sh"; break;
        case "Щ":  $s.="sch"; break;
        case "Ь":  $s.=""; break;
        case "Ъ":  $s.=""; break;
        case "Ы":  $s.="i"; break;
        case "Э":  $s.="e"; break;
        case "Ю":  $s.="yu"; break;
        case "Я":  $s.="ya"; break;
      }
    }
  }
  
  return $s;
}

AddEventHandler("iblock", "OnIBlockPropertyBuildList", Array("ITCClass", "GetUserTypeDescription"));
AddEventHandler("iblock", "OnIBlockPropertyBuildList", Array("ITCClass", "GetUserTypeDescription2"));
AddEventHandler("iblock", "OnIBlockPropertyBuildList", Array("ITCClass", "GetUserTypeDescription3"));

AddEventHandler("iblock", "OnAfterIBlockSectionAdd", Array("ITCClass", "OnAfterIBlockSectionAddHandler"));
AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", Array("ITCClass", "OnBeforeIBlockSectionUpdateHandler"));
   
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("ITCClass", "OnAfterIBlockElementAddHandler"));
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("ITCClass", "OnBeforeIBlockElementUpdateHandler"));

//AddEventHandler("iblock", "OnBeforeIBlockElementDelete", Array("ITCClass", "OnBeforeIBlockElementDeleteHandler"));
class ITCClass
{
 /*function OnBeforeIBlockElementDeleteHandler($ID)
 {
   $res = CIBlockElement::GetByID($ID);
   $elem = $res->Fetch();
   if($elem["IBLOCK_ID"] == 6)
   {
     $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_complect");
     $arFilter = Array("IBLOCK_ID"=>8);
     $res = CIBlockElement::GetList(Array("sort"=>"ask"), $arFilter, false, Array("nTopCount"=>100), $arSelect);
     $sel_task = '';
     while($task = $res->Fetch())
     {
       if($task["PROPERTY_COMPLECT_VALUE"]["ELEMENT"] == $ID)
       {
         $sel_task[] = array("NAME"=>$task["NAME"], "ID"=>$task["ID"]);
       }
     }
     
     if(is_array($sel_task) && count($sel_task))
     {
       $msg = '<br>Данный товар связан с комплектом(ами):<br>';
       foreach($sel_task as $val)
         $msg .= '['.$val["ID"].'] '.$val["NAME"].'<br>';
       global $APPLICATION;
       $APPLICATION->throwException($msg);
       return false;
     }
   }
 }
 
 function OnBeforeIBlockSectionUpdateHandler(&$arFields)
 {
   $arFields["CODE"] = translate_str($arFields["NAME"]."-".$arFields["ID"]);
 }
 
 function OnAfterIBlockSectionAddHandler(&$arFields)
 {
   $bs = new CIBlockSection;
   $fields = Array("NAME" => $arFields["NAME"]);
   $bs->Update($arFields["ID"], $fields);
 }
 
 function OnBeforeIBlockElementUpdateHandler(&$arFields)
 {
   if($arFields["IBLOCK_ID"] == 6)
   {
     $arFields["CODE"] = translate_str($arFields["NAME"]."-".$arFields["ID"]);
     
     if($arFields["ACTIVE"] == "N")
     {
     $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_complect");
     $arFilter = Array("IBLOCK_ID"=>8);
     $res = CIBlockElement::GetList(Array("sort"=>"ask"), $arFilter, false, Array("nTopCount"=>100), $arSelect);
     $sel_task = '';
     while($task = $res->Fetch())
     {
       if($task["PROPERTY_COMPLECT_VALUE"]["ELEMENT"] == $arFields["ID"])
       {
         $sel_task[] = array("NAME"=>$task["NAME"], "ID"=>$task["ID"]);
       }
     }
     
     if(is_array($sel_task) && count($sel_task))
     {
       $msg = '<br>Данный товар связан с комплектом(ами):<br>';
       foreach($sel_task as $val)
         $msg .= '['.$val["ID"].'] '.$val["NAME"].'<br>';
       global $APPLICATION;
       $APPLICATION->throwException($msg);
       return false;
     }
     }
   }
   
    //-->
	// 13.05.2014. Символьный код элемента для нового ИБ с каталогом.
	//if ($arFields["IBLOCK_ID"] == CATALOG_IBLOCK_ID_KS)
	//{
	//	$arFields["CODE"] = translate_str($arFields["NAME"]."-".$arFields["ID"]);
	//}
	//<--
 }
 
 function OnAfterIBlockElementAddHandler(&$arFields)
 {
   if($arFields["IBLOCK_ID"] == 6)
   {
     $el = new CIBlockElement;
     $fields = Array("NAME" => $arFields["NAME"]);
     $el->Update($arFields["ID"], $fields);
   }
 }
    
 function GetUserTypeDescription(){
		return array(
			"PROPERTY_TYPE"		=>"E",
			"USER_TYPE"		=>"complect",
			"DESCRIPTION"		=>"Комплект",
			//optional handlers
			"GetPublicViewHTML"	=>array("ITCClass","GetPublicViewHTML"),
			"GetAdminListViewHTML"	=>array("ITCClass","GetAdminListViewHTML"),
			"GetPropertyFieldHtml"	=>array("ITCClass","GetPropertyFieldHtml"),
			"ConvertToDB"		=>array("ITCClass","ConvertToDB"),
			"ConvertFromDB"		=>array("ITCClass","ConvertFromDB"),
		);
	}
 
 // Показ в публичной части (DISPLAY_VALUE)
	function GetPublicViewHTML($arProperty, $value, $strHTMLControlName){
		if($value["VALUE"]["ELEMENT"]){
			$res = CIBlockElement::GetByID($value["VALUE"]["ELEMENT"]);
			if($ar_res = $res->GetNext())
				return $ar_res['NAME'].' - '.$value["VALUE"]["COUNT"];
		}
		return '';
	}

	// Показ списка в админке
	function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName){
		$res = CIBlockElement::GetByID($value["VALUE"]["ELEMENT"]);
		if($ar_res = $res->GetNext())
 			return '<a href="/bitrix/admin/iblock_element_edit.php?ID='.$value["VALUE"]["ELEMENT"].'&type='. $ar_res['IBLOCK_TYPE_ID'].'&lang=ru&IBLOCK_ID='.$ar_res['IBLOCK_ID'].'">'.$ar_res["NAME"].'</a> - '. $value["VALUE"]["COUNT"];
	}

	// Редактирование в админке
	function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName){
		$strHTMLControlName["VALUE"] = htmlspecialcharsEx($strHTMLControlName["VALUE"]);
		static $cache = array();
		$IBLOCK_ID = $arProperty["LINK_IBLOCK_ID"];
		if(!array_key_exists($IBLOCK_ID, $cache)){
			$rsItems = CIBlockElement::GetList(
				array("NAME" => "ASC", "ID" => "ASC",),
     				array("IBLOCK_ID"=> $IBLOCK_ID, "CHECK_PERMISSIONS" => "Y",),
				false, false,
    				array("ID", "NAME",)
			);
			$cache[$IBLOCK_ID] = array();
			while($arItem = $rsItems->GetNext())$cache[$IBLOCK_ID][] = $arItem;
		}
		ob_start();?>
  <input type="text" size="4" name="<?=$strHTMLControlName["VALUE"];?>[ELEMENT]" id="<?=$strHTMLControlName["VALUE"];?>[ELEMENT]" value="<?=$value["VALUE"]["ELEMENT"]?>">
		<input type="button" onclick="jsUtils.OpenWindow('/bitrix/admin/iblock_element_search.php?lang=ru&amp;IBLOCK_ID=<?=$arProperty["LINK_IBLOCK_ID"];?>&amp;n=<?=$strHTMLControlName["VALUE"];?>[ELEMENT]', 600, 500);" value="..." />
		Кол-во <input type="text" name="<?=$strHTMLControlName["VALUE"];?>[COUNT]" value="<?if($value["VALUE"]["COUNT"]):?><?=$value["VALUE"]["COUNT"]?><?else:?>1<?endif?>" style="width: 40px;"/> шт.
		<?$return = ob_get_contents();
		ob_end_clean();
		return  $return;
	}

	// Преобразование перед сохранением
	function ConvertToDB($arProperty, $value){
		if(is_array($value["VALUE"])){
			// Сохраняем все что пришло, проверять надоело....
			$value["VALUE"]["ELEMENT"] = IntVal($value["VALUE"]["ELEMENT"]);
			$value["VALUE"]["COUNT"] = IntVal($value["VALUE"]["COUNT"]);
			// Если одно из полей 0 - удаляем (вернем null БУС - сам удалит)
			if(!$value["VALUE"]["ELEMENT"] || !$value["VALUE"]["COUNT"])return;
			$value["VALUE"] = serialize($value["VALUE"]);
		}
		return $value;
	}

	// Преобразование после чтения
	function ConvertFromDB($arProperty, $value){
		if(strlen($value["VALUE"]) > 0)$value["VALUE"] = unserialize($value["VALUE"]);
		return $value;
	}
 
 function GetUserTypeDescription3(){
		return array(
			"PROPERTY_TYPE"		=>"E",
			"USER_TYPE"		=>"dop_tovars",
			"DESCRIPTION"		=>"Дополнительные товары",
			//optional handlers
			"GetPublicViewHTML"	=>array("ITCClass","GetPublicViewHTML3"),
			"GetAdminListViewHTML"	=>array("ITCClass","GetAdminListViewHTML3"),
			"GetPropertyFieldHtml"	=>array("ITCClass","GetPropertyFieldHtml3"),
			"ConvertToDB"		=>array("ITCClass","ConvertToDB3"),
			"ConvertFromDB"		=>array("ITCClass","ConvertFromDB3"),
		);
	}
 
 // Показ в публичной части (DISPLAY_VALUE)
	function GetPublicViewHTML3($arProperty, $value, $strHTMLControlName){
		if($value["VALUE"]["NAME"]){
			return $value["VALUE"]['NAME'].' - '.$value["VALUE"]["COUNT"];
		}
		return '';
	}

	// Показ списка в админке
	function GetAdminListViewHTML3($arProperty, $value, $strHTMLControlName){
		return $value["VALUE"]["NAME"].' - '. $value["VALUE"]["COUNT"];
	}

	// Редактирование в админке
	function GetPropertyFieldHtml3($arProperty, $value, $strHTMLControlName){
		$strHTMLControlName["VALUE"] = htmlspecialcharsEx($strHTMLControlName["VALUE"]);
		static $cache = array();
		$IBLOCK_ID = $arProperty["LINK_IBLOCK_ID"];
		if(!array_key_exists($IBLOCK_ID, $cache)){
			$rsItems = CIBlockElement::GetList(
				array("NAME" => "ASC", "ID" => "ASC",),
     				array("IBLOCK_ID"=> $IBLOCK_ID, "CHECK_PERMISSIONS" => "Y",),
				false, false,
    				array("ID", "NAME",)
			);
			$cache[$IBLOCK_ID] = array();
			while($arItem = $rsItems->GetNext())$cache[$IBLOCK_ID][] = $arItem;
		}
		ob_start();?>
  <input type="text" size="30" name="<?=$strHTMLControlName["VALUE"];?>[NAME]" id="<?=$strHTMLControlName["VALUE"];?>[NAME]" value="<?=$value["VALUE"]["NAME"]?>">
		Кол-во <input type="text" name="<?=$strHTMLControlName["VALUE"];?>[COUNT]" value="<?if($value["VALUE"]["COUNT"]):?><?=$value["VALUE"]["COUNT"]?><?else:?>1<?endif?>" style="width: 40px;"/> шт.
		<?$return = ob_get_contents();
		ob_end_clean();
		return  $return;
	}

	// Преобразование перед сохранением
	function ConvertToDB3($arProperty, $value){
		if(is_array($value["VALUE"])){
			// Сохраняем все что пришло, проверять надоело....
			$value["VALUE"]["COUNT"] = IntVal($value["VALUE"]["COUNT"]);
			// Если одно из полей 0 - удаляем (вернем null БУС - сам удалит)
			if(!$value["VALUE"]["NAME"] || !$value["VALUE"]["COUNT"])return;
			$value["VALUE"] = serialize($value["VALUE"]);
		}
		return $value;
	}

	// Преобразование после чтения
	function ConvertFromDB3($arProperty, $value){
		if(strlen($value["VALUE"]) > 0)$value["VALUE"] = unserialize($value["VALUE"]);
		return $value;
	}
 
 function GetUserTypeDescription2(){
		return array(
			"PROPERTY_TYPE"		=>"E",
			"USER_TYPE"		=>"order",
			"DESCRIPTION"		=>"Состав заказа",
			//optional handlers
			"GetPublicViewHTML"	=>array("ITCClass","GetPublicViewHTML2"),
			"GetAdminListViewHTML"	=>array("ITCClass","GetAdminListViewHTML2"),
			"GetPropertyFieldHtml"	=>array("ITCClass","GetPropertyFieldHtml2"),
			"ConvertToDB"		=>array("ITCClass","ConvertToDB2"),
			"ConvertFromDB"		=>array("ITCClass","ConvertFromDB2"),
		);
	}
 
 // Показ в публичной части (DISPLAY_VALUE)
	function GetPublicViewHTML2($arProperty, $value, $strHTMLControlName){
		return $value['VALUE']['NAME'].' - '.$value["VALUE"]["COUNT"];
		return '';
	}

	// Показ списка в админке
	function GetAdminListViewHTML2($arProperty, $value, $strHTMLControlName){
		$res = CIBlockElement::GetByID($value["VALUE"]["ELEMENT"]);
		if($ar_res = $res->GetNext())
 			return '<a href="/bitrix/admin/iblock_element_edit.php?ID='.$value["VALUE"]["ELEMENT"].'&type='. $ar_res['IBLOCK_TYPE_ID'].'&lang=ru&IBLOCK_ID='.$ar_res['IBLOCK_ID'].'">'.$value['VALUE']["NAME"].'</a> - '. $value["VALUE"]["COUNT"];
	}

	// Редактирование в админке
	function GetPropertyFieldHtml2($arProperty, $value, $strHTMLControlName){
		$strHTMLControlName["VALUE"] = htmlspecialcharsEx($strHTMLControlName["VALUE"]);
		static $cache = array();
		$IBLOCK_ID = $arProperty["LINK_IBLOCK_ID"];
		if(!array_key_exists($IBLOCK_ID, $cache)){
			$rsItems = CIBlockElement::GetList(
				array("NAME" => "ASC", "ID" => "ASC",),
     				array("IBLOCK_ID"=> $IBLOCK_ID, "CHECK_PERMISSIONS" => "Y",),
				false, false,
    				array("ID", "NAME",)
			);
			$cache[$IBLOCK_ID] = array();
			while($arItem = $rsItems->GetNext())$cache[$IBLOCK_ID][] = $arItem;
		}
		ob_start();?>
  <?if($value["VALUE"]["ELEMENT"]):?>
   <input type="hidden" name="<?=$strHTMLControlName["VALUE"];?>[ELEMENT]" value="<?=$value["VALUE"]["ELEMENT"]?>">
   <input type="hidden" name="<?=$strHTMLControlName["VALUE"];?>[NAME]" value="<?=$value["VALUE"]["NAME"]?>">
   <input type="hidden" name="<?=$strHTMLControlName["VALUE"];?>[COUNT]" value="<?=$value["VALUE"]["COUNT"]?>">
   [<?=$value["VALUE"]["ELEMENT"];?>] <?=$value["VALUE"]["NAME"];?> - <?=$value["VALUE"]["COUNT"];?> шт.
  <?endif?>
		<?$return = ob_get_contents();
		ob_end_clean();
		return  $return;
	}

	// Преобразование перед сохранением
	function ConvertToDB2($arProperty, $value){
		if(is_array($value["VALUE"])){
			// Сохраняем все что пришло, проверять надоело....
			$value["VALUE"]["ELEMENT"] = IntVal($value["VALUE"]["ELEMENT"]);
			$value["VALUE"]["NAME"] = $value["VALUE"]["NAME"];
   $value["VALUE"]["COUNT"] = IntVal($value["VALUE"]["COUNT"]);
			// Если одно из полей 0 - удаляем (вернем null БУС - сам удалит)
			if(!$value["VALUE"]["ELEMENT"] || !$value["VALUE"]["COUNT"])return;
			$value["VALUE"] = serialize($value["VALUE"]);
		}
		return $value;
	}

	// Преобразование после чтения
	function ConvertFromDB2($arProperty, $value){
		if(strlen($value["VALUE"]) > 0)$value["VALUE"] = unserialize($value["VALUE"]);
		return $value;
	}
}
*/
?>