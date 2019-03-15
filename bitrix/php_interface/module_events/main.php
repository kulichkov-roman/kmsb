<? 
//-->
AddEventHandler('main', 'OnBeforeUserAdd', function (&$arFields) {

    global $APPLICATION;

    $checkFields = array('NAME' => 'Ф.И.О.');
    foreach ($checkFields as $fieldCode => $name) {
        if (preg_match('#[a-zA-Z]#', $arFields[$fieldCode])) {
            $APPLICATION->ThrowException("Поле '$name' не должно содержать английских символов.");
            return false;
        }
    }

    return true;
}, 1);

AddEventHandler("main", "OnBeforeUserUpdate", Array("KMSMainClass", "OnBeforeUserUpdateHandler"));
AddEventHandler("main", "OnBeforeUserAdd", Array("KMSMainClass", "OnBeforeUserAddHandler"));
AddEventHandler("main", "OnBeforeEventSend", Array("KMSMainClass", "OnBeforeEventSendHandler"));

AddEventHandler("main", "OnBeforeUserRegister", array("KMSMainClass", "emailToLogin"));
AddEventHandler("main", "OnBeforeUserUpdate", array("KMSMainClass", "emailToLogin"));

AddEventHandler("main", "OnBeforeEventAdd", array("KMSMainClass", "addFileAttachment"));

AddEventHandler('main', 'OnEpilog', '_Check404Error',1);

function _Check404Error()
{
    if (defined("ERROR_404") && ERROR_404=="Y")
    {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        include $_SERVER['DOCUMENT_ROOT']."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php";
        require ($_SERVER["DOCUMENT_ROOT"]."/404.php");
        include $_SERVER['DOCUMENT_ROOT']."/bitrix/templates/".SITE_TEMPLATE_ID."/footer.php";
    }
}


class KMSMainClass 
{
    function addFileAttachment($event, $lid, $arFields)
    {
      if ($event == "ITC_ELEMENT_ADD_IBLOCK45")
      {
          if($arFields["File"] && file_exists($_SERVER["DOCUMENT_ROOT"] . $arFields["File"])){
            SendAttache($event, $lid, $arFields, $arFields["File"]);
            return false;
          }
      }
    }

    function OnBeforeUserUpdateHandler(&$arFields)
    {
        // Запретить редактировать логин пользователям
        global $USER;

        if (!$USER->isAdmin()) {
            unset ($arFields["LOGIN"]);
        }

        return $arFields;
    }

    function OnBeforeUserAddHandler(&$arFields)
    {
        // Если пользователь зарегистрировался через социальные сети
        if ( strlen($arFields['EXTERNAL_AUTH_ID']) > 0)
        {
            if ($arFields['EMAIL'] == '' && $arFields["LOGIN"] != '')
                $arFields['EMAIL'] = $arFields['LOGIN'] . '.not@real.email';
        }

        return $arFields;
    }
    public function OnBeforeEventSendHandler(&$arFields, &$arTemplate){
        CModule::IncludeModule("iblock");
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
        $FileLocalPath = parse_url($arFields['File'], PHP_URL_PATH);
        if (!in_array($FileLocalPath, array('', '/'))){
          $arFields['FileHTML'] = '<a href="'.$arFields['File'].'">'.$arFields['File'].'</a>';
        }else{
          $arFields['FileHTML'] = 'нет файла';
        }
        $arTemplate['EMAIL_TO'] = $ar_res['PROPERTY_EMAIL_VALUE'];
      }
    }
    
    function emailToLogin(&$arFields)
    {
        //не админ
        if(!in_array(1, CUser::GetUserGroup($arFields["ID"]))){
            $arFields["LOGIN"] = $arFields["EMAIL"];
        }    
        return $arFields;
    }
}
//<--
?>
