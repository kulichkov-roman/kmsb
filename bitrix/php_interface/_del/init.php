<?

/*
function translate_str($title)
    {
        $tbl= array(
            '�'=>'a', '�'=>'b', '�'=>'v', '�'=>'g', '�'=>'d', '�'=>'e', '�'=>'zh', '�'=>'z',
            '�'=>'i', '�'=>'y', '�'=>'k', '�'=>'l', '�'=>'m', '�'=>'n', '�'=>'o', '�'=>'p',
            '�'=>'r', '�'=>'s', '�'=>'t', '�'=>'u', '�'=>'f', '�'=>'y', '�'=>'e', '�'=>'A',
            '�'=>'B', '�'=>'V', '�'=>'G', '�'=>'D', '�'=>'E', '�'=>'ZH', '�'=>'Z', '�'=>'I',
            '�'=>'Y', '�'=>'K', '�'=>'L', '�'=>'M', '�'=>'N', '�'=>'O', '�'=>'P', '�'=>'R',
            '�'=>'S', '�'=>'T', '�'=>'U', '�'=>'F', '�'=>'Y', '�'=>'E', '�'=>"yo", '�'=>"h",
            '�'=>"ts", '�'=>"ch", '�'=>"sh", '�'=>"shch", '�'=>"", '�'=>"", '�'=>"yu", '�'=>"ya",
            '�'=>"YO", '�'=>"H", '�'=>"TS", '�'=>"CH", '�'=>"SH", '�'=>"SHCH", '�'=>"", '�'=>"",
            '�'=>"YU", '�'=>"YA", ' '=>"-", '('=>'', ')'=>'', ','=>'', '.'=>'-', '_'=>'-'
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
    { //������������� � ��������
      switch (substr($str, $i, 1))
      {
        case "_":  $s.="-"; break;
        case "-":  $s.="-"; break;
        case " ":  $s.="-"; break;
        case ".":  $s.="."; break;
        case "�":  $s.="a"; break;
        case "�":  $s.="b"; break;
        case "�":  $s.="v"; break;
        case "�":  $s.="g"; break;
        case "�":  $s.="d"; break;
        case "�":  $s.="e"; break;
        case "�":  $s.="e"; break;
        case "�":  $s.="zh"; break;
        case "�":  $s.="z"; break;
        case "�":  $s.="i"; break;
        case "�":  $s.="iy"; break;
        case "�":  $s.="k"; break;
        case "�":  $s.="l"; break;
        case "�":  $s.="m"; break;
        case "�":  $s.="n"; break;
        case "�":  $s.="o"; break;
        case "�":  $s.="p"; break;
        case "�":  $s.="r"; break;
        case "�":  $s.="s"; break;
        case "�":  $s.="t"; break;
        case "�":  $s.="u"; break;
        case "�":  $s.="f"; break;
        case "�":  $s.="h"; break;
        case "�":  $s.="c"; break;
        case "�":  $s.="ch"; break;
        case "�":  $s.="sh"; break;
        case "�":  $s.="sch"; break;
        case "�":  $s.=""; break;
        case "�":  $s.=""; break;
        case "�":  $s.="i"; break;
        case "�":  $s.="e"; break;
        case "�":  $s.="yu"; break;
        case "�":  $s.="ya"; break;
        case "�":  $s.="a"; break;
        case "�":  $s.="b"; break;
        case "�":  $s.="v"; break;
        case "�":  $s.="g"; break;
        case "�":  $s.="d"; break;
        case "�":  $s.="e"; break;
        case "�":  $s.="e"; break;
        case "�":  $s.="zh"; break;
        case "�":  $s.="z"; break;
        case "�":  $s.="i"; break;
        case "�":  $s.="iy"; break;
        case "�":  $s.="k"; break;
        case "�":  $s.="l"; break;
        case "�":  $s.="m"; break;
        case "�":  $s.="n"; break;
        case "�":  $s.="o"; break;
        case "�":  $s.="p"; break;
        case "�":  $s.="r"; break;
        case "�":  $s.="s"; break;
        case "�":  $s.="t"; break;
        case "�":  $s.="u"; break;
        case "�":  $s.="f"; break;
        case "�":  $s.="h"; break;
        case "�":  $s.="c"; break;
        case "�":  $s.="ch"; break;
        case "�":  $s.="sh"; break;
        case "�":  $s.="sch"; break;
        case "�":  $s.=""; break;
        case "�":  $s.=""; break;
        case "�":  $s.="i"; break;
        case "�":  $s.="e"; break;
        case "�":  $s.="yu"; break;
        case "�":  $s.="ya"; break;
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
       $msg = '<br>������ ����� ������ � ����������(���):<br>';
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
       $msg = '<br>������ ����� ������ � ����������(���):<br>';
       foreach($sel_task as $val)
         $msg .= '['.$val["ID"].'] '.$val["NAME"].'<br>';
       global $APPLICATION;
       $APPLICATION->throwException($msg);
       return false;
     }
     }
   }
   
    //-->
	// 13.05.2014. ���������� ��� �������� ��� ������ �� � ���������.
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
			"DESCRIPTION"		=>"��������",
			//optional handlers
			"GetPublicViewHTML"	=>array("ITCClass","GetPublicViewHTML"),
			"GetAdminListViewHTML"	=>array("ITCClass","GetAdminListViewHTML"),
			"GetPropertyFieldHtml"	=>array("ITCClass","GetPropertyFieldHtml"),
			"ConvertToDB"		=>array("ITCClass","ConvertToDB"),
			"ConvertFromDB"		=>array("ITCClass","ConvertFromDB"),
		);
	}
 
 // ����� � ��������� ����� (DISPLAY_VALUE)
	function GetPublicViewHTML($arProperty, $value, $strHTMLControlName){
		if($value["VALUE"]["ELEMENT"]){
			$res = CIBlockElement::GetByID($value["VALUE"]["ELEMENT"]);
			if($ar_res = $res->GetNext())
				return $ar_res['NAME'].' - '.$value["VALUE"]["COUNT"];
		}
		return '';
	}

	// ����� ������ � �������
	function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName){
		$res = CIBlockElement::GetByID($value["VALUE"]["ELEMENT"]);
		if($ar_res = $res->GetNext())
 			return '<a href="/bitrix/admin/iblock_element_edit.php?ID='.$value["VALUE"]["ELEMENT"].'&type='. $ar_res['IBLOCK_TYPE_ID'].'&lang=ru&IBLOCK_ID='.$ar_res['IBLOCK_ID'].'">'.$ar_res["NAME"].'</a> - '. $value["VALUE"]["COUNT"];
	}

	// �������������� � �������
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
		���-�� <input type="text" name="<?=$strHTMLControlName["VALUE"];?>[COUNT]" value="<?if($value["VALUE"]["COUNT"]):?><?=$value["VALUE"]["COUNT"]?><?else:?>1<?endif?>" style="width: 40px;"/> ��.
		<?$return = ob_get_contents();
		ob_end_clean();
		return  $return;
	}

	// �������������� ����� �����������
	function ConvertToDB($arProperty, $value){
		if(is_array($value["VALUE"])){
			// ��������� ��� ��� ������, ��������� �������....
			$value["VALUE"]["ELEMENT"] = IntVal($value["VALUE"]["ELEMENT"]);
			$value["VALUE"]["COUNT"] = IntVal($value["VALUE"]["COUNT"]);
			// ���� ���� �� ����� 0 - ������� (������ null ��� - ��� ������)
			if(!$value["VALUE"]["ELEMENT"] || !$value["VALUE"]["COUNT"])return;
			$value["VALUE"] = serialize($value["VALUE"]);
		}
		return $value;
	}

	// �������������� ����� ������
	function ConvertFromDB($arProperty, $value){
		if(strlen($value["VALUE"]) > 0)$value["VALUE"] = unserialize($value["VALUE"]);
		return $value;
	}
 
 function GetUserTypeDescription3(){
		return array(
			"PROPERTY_TYPE"		=>"E",
			"USER_TYPE"		=>"dop_tovars",
			"DESCRIPTION"		=>"�������������� ������",
			//optional handlers
			"GetPublicViewHTML"	=>array("ITCClass","GetPublicViewHTML3"),
			"GetAdminListViewHTML"	=>array("ITCClass","GetAdminListViewHTML3"),
			"GetPropertyFieldHtml"	=>array("ITCClass","GetPropertyFieldHtml3"),
			"ConvertToDB"		=>array("ITCClass","ConvertToDB3"),
			"ConvertFromDB"		=>array("ITCClass","ConvertFromDB3"),
		);
	}
 
 // ����� � ��������� ����� (DISPLAY_VALUE)
	function GetPublicViewHTML3($arProperty, $value, $strHTMLControlName){
		if($value["VALUE"]["NAME"]){
			return $value["VALUE"]['NAME'].' - '.$value["VALUE"]["COUNT"];
		}
		return '';
	}

	// ����� ������ � �������
	function GetAdminListViewHTML3($arProperty, $value, $strHTMLControlName){
		return $value["VALUE"]["NAME"].' - '. $value["VALUE"]["COUNT"];
	}

	// �������������� � �������
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
		���-�� <input type="text" name="<?=$strHTMLControlName["VALUE"];?>[COUNT]" value="<?if($value["VALUE"]["COUNT"]):?><?=$value["VALUE"]["COUNT"]?><?else:?>1<?endif?>" style="width: 40px;"/> ��.
		<?$return = ob_get_contents();
		ob_end_clean();
		return  $return;
	}

	// �������������� ����� �����������
	function ConvertToDB3($arProperty, $value){
		if(is_array($value["VALUE"])){
			// ��������� ��� ��� ������, ��������� �������....
			$value["VALUE"]["COUNT"] = IntVal($value["VALUE"]["COUNT"]);
			// ���� ���� �� ����� 0 - ������� (������ null ��� - ��� ������)
			if(!$value["VALUE"]["NAME"] || !$value["VALUE"]["COUNT"])return;
			$value["VALUE"] = serialize($value["VALUE"]);
		}
		return $value;
	}

	// �������������� ����� ������
	function ConvertFromDB3($arProperty, $value){
		if(strlen($value["VALUE"]) > 0)$value["VALUE"] = unserialize($value["VALUE"]);
		return $value;
	}
 
 function GetUserTypeDescription2(){
		return array(
			"PROPERTY_TYPE"		=>"E",
			"USER_TYPE"		=>"order",
			"DESCRIPTION"		=>"������ ������",
			//optional handlers
			"GetPublicViewHTML"	=>array("ITCClass","GetPublicViewHTML2"),
			"GetAdminListViewHTML"	=>array("ITCClass","GetAdminListViewHTML2"),
			"GetPropertyFieldHtml"	=>array("ITCClass","GetPropertyFieldHtml2"),
			"ConvertToDB"		=>array("ITCClass","ConvertToDB2"),
			"ConvertFromDB"		=>array("ITCClass","ConvertFromDB2"),
		);
	}
 
 // ����� � ��������� ����� (DISPLAY_VALUE)
	function GetPublicViewHTML2($arProperty, $value, $strHTMLControlName){
		return $value['VALUE']['NAME'].' - '.$value["VALUE"]["COUNT"];
		return '';
	}

	// ����� ������ � �������
	function GetAdminListViewHTML2($arProperty, $value, $strHTMLControlName){
		$res = CIBlockElement::GetByID($value["VALUE"]["ELEMENT"]);
		if($ar_res = $res->GetNext())
 			return '<a href="/bitrix/admin/iblock_element_edit.php?ID='.$value["VALUE"]["ELEMENT"].'&type='. $ar_res['IBLOCK_TYPE_ID'].'&lang=ru&IBLOCK_ID='.$ar_res['IBLOCK_ID'].'">'.$value['VALUE']["NAME"].'</a> - '. $value["VALUE"]["COUNT"];
	}

	// �������������� � �������
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
   [<?=$value["VALUE"]["ELEMENT"];?>] <?=$value["VALUE"]["NAME"];?> - <?=$value["VALUE"]["COUNT"];?> ��.
  <?endif?>
		<?$return = ob_get_contents();
		ob_end_clean();
		return  $return;
	}

	// �������������� ����� �����������
	function ConvertToDB2($arProperty, $value){
		if(is_array($value["VALUE"])){
			// ��������� ��� ��� ������, ��������� �������....
			$value["VALUE"]["ELEMENT"] = IntVal($value["VALUE"]["ELEMENT"]);
			$value["VALUE"]["NAME"] = $value["VALUE"]["NAME"];
   $value["VALUE"]["COUNT"] = IntVal($value["VALUE"]["COUNT"]);
			// ���� ���� �� ����� 0 - ������� (������ null ��� - ��� ������)
			if(!$value["VALUE"]["ELEMENT"] || !$value["VALUE"]["COUNT"])return;
			$value["VALUE"] = serialize($value["VALUE"]);
		}
		return $value;
	}

	// �������������� ����� ������
	function ConvertFromDB2($arProperty, $value){
		if(strlen($value["VALUE"]) > 0)$value["VALUE"] = unserialize($value["VALUE"]);
		return $value;
	}
}
*/
?>