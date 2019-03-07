<?
/**
 * @param $arResult
 * @param $fileName
 */
function putToLog($var, $logFileName = "log.log")
{
	file_put_contents($_SERVER["DOCUMENT_ROOT"]. '/' .$logFileName, date("d.m.Y H:i:s") . " " . var_export($var, true) . "\r\n", FILE_APPEND);
}

function getTotalCountElem($iblock)
{
	$arSort = array();
	$arSelect = array("ID", "NAME");
	$arFilter = array(
		"ACTIVE"=>"Y",
		"IBLOCK_ID" => $iblock,
	);

	$rsElements = CIBlockElement::GetList(
		$arSort,
		$arFilter,
		false,
		false,
		$arSelect
	);

	return $rsElements->SelectedRowsCount();
}

// мультибайтоывя заменя, взята из ядра bitrix
function mb_str_replace($needle, $replace_text, $haystack)
{
	return implode($replace_text, mb_split($needle, $haystack));
}

// подсветка результата поиска в заголовке (не зависит от регистра)
function getFormatSearchTitle($wordCur, $textCur)
{
	// в нижний регистр
	$textLower = ToLower($textCur);
	$wordLower = ToLower($wordCur);

	// запомнить позицию вхождения в строках в нижнем регистре
	$posBegin = Bxstrrpos($textLower, $wordLower);

	if($posBegin !== false)
	{
		// получить длину строки
		$textLength = mb_strlen($wordLower);
		// получить подстроку по оригиналу от и до символов
		$textSubStr = mb_substr($textCur, $posBegin, $textLength);

		// на что меняем
		$strReplace = '<b style="color:#34a2f8; background:#fed330;">'.$textSubStr.'</b>';

		// меняем подстроку на $strReplace
		//$textResult = mb_substr_replace($textCur, $strReplace, $posBegin, $textLength);

		$textResult = mb_str_replace($textSubStr, $strReplace  ,$textCur);
		return $textResult;
	}
	return $textCur;
}

// прикрепленный файл
function SendAttache($event, $lid, $arFields, $filePath)
{
    global $DB;

    $event = $DB->ForSQL($event);
    $lid = $DB->ForSQL($lid);

    $rsMessTpl = $DB->Query("SELECT * FROM b_event_message WHERE EVENT_NAME='$event' AND LID='$lid';");
    while ($arMessTpl = $rsMessTpl->Fetch())
    {
        // get charset
        $strSql = "SELECT CHARSET FROM b_lang WHERE LID='$lid' ORDER BY DEF DESC, SORT";
        $dbCharset = $DB->Query($strSql, false, "FILE: ".__FILE__."<br>LINE: ".__LINE__);
        $arCharset = $dbCharset->Fetch();
        $charset = $arCharset["CHARSET"];

        if($arFields['Person']){    	
			$res = CIBlockElement::GetList(
				array(),
				array(
					'ID' => $arFields['Person']
				),
				FALSE,
				FALSE,
				array(
					'ID',
					'NAME',
					'PROPERTY_email'
				)
			);
			$ar_res = $res->GetNext();

			if (!empty($ar_res['PROPERTY_EMAIL_VALUE'])){
				$arMessTpl["EMAIL_TO"] = $ar_res['PROPERTY_EMAIL_VALUE'];
			}
        }

        // additional params
        if (!isset($arFields["DEFAULT_EMAIL_FROM"]))
            $arFields["DEFAULT_EMAIL_FROM"] = COption::GetOptionString("main", "email_from", "admin@".$GLOBALS["SERVER_NAME"]);
        if (!isset($arFields["SITE_NAME"]))
            $arFields["SITE_NAME"] = COption::GetOptionString("main", "site_name", $GLOBALS["SERVER_NAME"]);
        if (!isset($arFields["SERVER_NAME"]))
            $arFields["SERVER_NAME"] = COption::GetOptionString("main", "server_name", $GLOBALS["SERVER_NAME"]);

        // replace
        $from = CAllEvent::ReplaceTemplate($arMessTpl["EMAIL_FROM"], $arFields);
        $to = CAllEvent::ReplaceTemplate($arMessTpl["EMAIL_TO"], $arFields);
        $message = CAllEvent::ReplaceTemplate($arMessTpl["MESSAGE"], $arFields);
        $subj = CAllEvent::ReplaceTemplate($arMessTpl["SUBJECT"], $arFields);
        $bcc = CAllEvent::ReplaceTemplate($arMessTpl["BCC"], $arFields);


        $from = trim($from, "\r\n");
        $to = trim($to, "\r\n");
        $subj = trim($subj, "\r\n");
        $bcc = trim($bcc, "\r\n");

        if(COption::GetOptionString("main", "convert_mail_header", "Y")=="Y")
        {
            $from = CAllEvent::EncodeMimeString($from, $charset);
            $to = CAllEvent::EncodeMimeString($to, $charset);
            $subj = CAllEvent::EncodeMimeString($subj, $charset);
        }

        $all_bcc = COption::GetOptionString("main", "all_bcc", "");
        if ($all_bcc != "")
        {
            $bcc .= (strlen($bcc)>0 ? "," : "") . $all_bcc;
            $duplicate = "Y";
        }
        else
        {
            $duplicate = "N";
        }

        $strCFields = "";
        $cSearch = count($arSearch);
        foreach ($arSearch as $id => $key)
        {
            $strCFields .= substr($key, 1, strlen($key)-2)."=".$arReplace[$id];
            if ($id < $cSearch-1)
                $strCFields .= "&";
        }

        if (COption::GetOptionString("main", "CONVERT_UNIX_NEWLINE_2_WINDOWS", "N") == "Y")
            $message = str_replace("\n", "\r\n", $message);

        // read file(s)
        $arFiles = array();
        if (!is_array($filePath))
            $filePath = array($filePath);
        foreach ($filePath as $fPath)
        {
            $arFiles[] = array(
                                "F_PATH" => $_SERVER['DOCUMENT_ROOT'].$fPath,
                                "F_LINK" => $f = fopen($_SERVER['DOCUMENT_ROOT'].$fPath, "rb")
                                );
        }

        $un = strtoupper(uniqid(time()));
        $eol = CAllEvent::GetMailEOL();
        $head = $body = "";

        // header
        $head .= "Mime-Version: 1.0".$eol;
        $head .= "From: $from".$eol;
        if(COption::GetOptionString("main", "fill_to_mail", "N")=="Y")
            $header = "To: $to".$eol;
        $head .= "Reply-To: $from".$eol;
        $head .= "X-Priority: 3 (Normal)".$eol;
        $head .= "X-MID: $messID.".$arMessTpl["ID"]."(".date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL"))).")".$eol;
        $head .= "X-EVENT_NAME: ISALE_KEY_F_SEND".$eol;
        if (strpos($bcc, "@") !== false)
            $head .= "BCC: $bcc".$eol;
        $head .= "Content-Type: multipart/mixed; ";
        $head .= "boundary=\"----".$un."\"".$eol.$eol;

        // body
        $body = "------".$un.$eol;
        if ($arMessTpl["BODY_TYPE"] == "text")
            $body .= "Content-Type:text/plain; charset=".$charset.$eol;
        else
            $body .= "Content-Type:text/html; charset=".$charset.$eol;
        $body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
        $body .= $message.$eol.$eol;

        foreach ($arFiles as $arF)
        {
            $body .= "------".$un.$eol;
            $body .= "Content-Type: application/octet-stream; name=\"".basename($arF["F_PATH"])."\"".$eol;
            $body .= "Content-Disposition:attachment; filename=\"".basename($arF["F_PATH"])."\"".$eol;
            $body .= "Content-Transfer-Encoding: base64".$eol.$eol;
            $body .= chunk_split(base64_encode(fread($arF["F_LINK"], filesize($arF["F_PATH"])))).$eol.$eol;
        }
        $body .= "------".$un."--";

        // send
        if (!defined("ONLY_EMAIL") || $to==ONLY_EMAIL)
            bxmail($to, $subj, $body, $head, COption::GetOptionString("main", "mail_additional_parameters", ""));
    }
}

function getPrintPrice($price, $currency = ' руб.')
{
   return number_format($price, 0, '.', ' ') . $currency; 
}

function fullNameSortAsc($a, $b)
{
	return strnatcmp($a["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"], $b["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"]);
}

function fullNameSortDesc($b, $a)
{
	return strnatcmp($a["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"], $b["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"]);
}

function getDataBalances()
{
    if(!CModule::IncludeModule('iblock'))
    {
        return false;
    }
    else
    {
        $arSort = array("timestamp_x" => "desc");
        $arSelect = array(
            "ID",
            "NAME",
            "TIMESTAMP_X"
        );
        $arFilter = array(
            "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
            "ACTIVE" => "Y",
            ">CATALOG_QUANTITY" => 0,
        );
        $arNavStartParams = array(
            "nTopCount" => 1
        );
        $rsElements = CIBlockElement::GetList(
            $arSort,
            $arFilter,
            false,
            $arNavStartParams,
            $arSelect
        );
        while ($arItem = $rsElements->GetNext())
        {
            $arElement = $arItem;
        }

        return ConvertDateTime($arElement["TIMESTAMP_X"], "DD.MM.YYYY", "ru");
    }
    //echo "<pre>"; var_dump($arElement); echo "</pre>";
}

function addPropertyToIndex($iblockID, $itemID, $propertyName, &$body )
{
    CModule::IncludeModule('iblock');

    $resProps = CIBlockElement::GetProperty(
        $iblockID,
        $itemID,
        array("sort" => "asc"),
        Array("CODE"=> $propertyName)
    );
    if($arProp = $resProps->GetNext())
    {
        $body .= ' '.$arProp['VALUE'];
    }
}

function recursiveArraySearch($needle,$haystack)
{
    foreach($haystack as $key=>$value)
    {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false))
        {
            return $current_key;
        }
    }
    return false;
}

function getFileSrc($arItem)
{
    return '/upload/'.$arItem["SUBDIR"].'/'.$arItem["FILE_NAME"];
}

function getDetilTextWithOutTable($detailText)
{
    $arDetailText = explode("<p>#TABLE_PROP#</p>", $detailText);
    
    return implode('', $arDetailText);
}

//function compareSmartFilterValue($v1, $v2)
//{
//    if ($v1[1] == $v2[1]) return 0;
//    return ($v1[1] < $v2[1])? -1: 1;
//}

function getUrlCompareSec($arUrl)
{
    return '/'.$arUrl[1].'/'.$arUrl[2].'/';
}

function getExtensionImage($src)
{
    return end(explode('.', $src));
}

function outputPrice($strPrice)
{
	if($strPrice <> "")
	{
		$result = IntVal($strPrice).' руб.';
	}
	else 
	{
		$result = '';
	}
	return $result;
}

function truncateStr($strText, $intLen, $endStr = "", $type = "text", $option = "")
{
    switch($type)
    {
        case "html":
            switch($option)
            {
                case 'fp':
                    $obParser = new CTextParser;
                    
                    $symbols = strip_tags($strText);
                    $symbols_len = strlen($symbols);
                    
                    if($symbols_len < strlen($strText))
                    {
                        $strip_text = $obParser->strip_words($strText, $intLen);
                    
                        if($symbols_len > $intLen)
                            $strip_text = $strip_text.$endStr;

                        $final_text = $obParser->closetags($strip_text);

                        preg_match('|<p>(.*)</p>|Uis', $final_text, $arFinalText);
                        
                        $final_text = current($arFinalText);
                    }
                    elseif($symbols_len > $strText)
                    {
                        $final_text = substr($strText, 0, $intLen).$endStr;
                        preg_match('|<p>(.*)</p>|Uis', $final_text, $arFinalText);

                        $final_text = current($arFinalText);
                    }
                    else
                    {
                        $final_text = $strText;
                    }
                break;
                default:
                    $obParser = new CTextParser;

                    $symbols = strip_tags($strText);
                    $symbols_len = strlen($symbols);
                    
                    if($symbols_len < strlen($strText))
                    {
                        $strip_text = $obParser->strip_words($strText, $intLen);
                    
                        if($symbols_len > $intLen)
                            $strip_text = $strip_text.$endStr;
                    
                        $final_text = $obParser->closetags($strip_text);
                    }
                    elseif($symbols_len > $strText)
                        $final_text = substr($strText, 0, $intLen).$endStr;
                    else
                        $final_text = $strText;
                break;
            }
            return $final_text; 
        break;
        case "text":
            if(strlen($strText) > $intLen)
                return rtrim(substr($strText, 0, $intLen), ".").$endStr;
            else
                return $strText;
        break;
    }    
}

function plural($number, $word1, $word4, $word5) 
{
    if ($number % 100 == 11 || $number % 100 == 12 || $number % 100 == 13 || $number % 100 == 14) 
        return $word5;
    if ($number % 10 == 1)
        return $word1;
    if ($number % 10 == 2 || $number % 10 == 3 || $number % 10 == 4)
        return $word4;
    return $word5;
}

//htmlentities для кириллицы
function htmlSafe($string)
{
    return htmlentities($string, ENT_COMPAT | ENT_HTML401, "UTF-8");
}

function inCatalog()
{
	if(strpos($_SERVER["REQUEST_URI"], '/catalog/') === 0) {
		return true;
	}

	return false;
}

function inCatalogDetail()
{
    global $APPLICATION;
    $curDir = $APPLICATION -> GetCurPage();
    
    // /catalog/dresses/42_52/19/
    $catalogDetailPattern = '#^/catalog/[^/]+/[0-9_-]+/[^/]+$#Us';
    
    return preg_match($catalogDetailPattern, $curDir);
}

function inBrands()
{
    if(strpos($_SERVER["REQUEST_URI"], '/catalog/manufacturers/') === 0) {
        return true;
    }
    
    return false;
}

function inBalances()
{
    if(strpos($_SERVER["REQUEST_URI"], '/catalog/balances/') === 0) {
        return true;
    }

    return false;
}

function inRegistration(){
    if(strpos($_SERVER["REQUEST_URI"], '/registration/') === 0) {
        return true;
    }
    
    return false;
}

function inDevelopment(){
    if(strpos($_SERVER["REQUEST_URI"], '/development/') === 0) {
        return true;
    }
    
    return false;
}

function inService(){
    if(strpos($_SERVER["REQUEST_URI"], '/service/') === 0) {
        return true;
    }
    
    return false;
}

function inDealers(){
    if(strpos($_SERVER["REQUEST_URI"], '/dealers/') === 0) {
        return true;
    }
    
    return false;
}

function inContacts(){
    if(strpos($_SERVER["REQUEST_URI"], '/contacts/') === 0) {
        return true;
    }
    
    return false;
}

//получить классы для body
function getBodyClassesString()
{
    global $APPLICATION;
    $curDir = $APPLICATION -> GetCurDir();
       
    // /catalog/
    if(strpos($curDir, '/catalog/') === 0)
    {
        return ' catalog';
    }
    
    // /
    if(strpos($curDir, '/') === 0)
    {
        return '';
    }
    
    return 'catalog';
}

function getBodyIDsString()
{

    global $APPLICATION;
    $curDir = $APPLICATION -> GetCurDir();
    
    // /catalog/
    if(strpos($curDir, '/catalog/') === 0) 
    {
        return 'inner';
    }
    // / 
    if(strpos($curDir, '/') === 0) 
    {
        return 'index';
    }
    
    return 'inner';
}

function cmp($a, $b)
{
    if ($a == $b)
        return 0;
    
    return ($a < $b) ? -1 : 1;
}
?>
