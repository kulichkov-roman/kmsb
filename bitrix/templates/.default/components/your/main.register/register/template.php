<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>

<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<?
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif?>

    <div class="reg-form">
      <form class="validate" novalidate="novalidate" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
        <div class="form-section">
          <ul class="field__list">
            <li class="field__item">
              <span class="field__title">Организация<span class="req">*</span></span>
              <div class="field__value">
                <input class="field required text-field" name="REGISTER[WORK_COMPANY]" value="<?=htmlSafe($_REQUEST["REGISTER"]["WORK_COMPANY"])?>" type="text" /></div>
              <div class="field__example">
                ООО &laquo;Компания&raquo;, ИП Иванов Иван Иванович</div>
            </li>
            <li class="field__item">
              <span class="field__title">Адрес<span class="req">*</span></span>
              <div class="field__value">
                <input class="field required text-field" name="REGISTER[WORK_STREET]" value="<?=htmlSafe($_REQUEST["REGISTER"]["WORK_STREET"])?>" type="text" /></div>
              <div class="field__example">
                630124, Новосибирск, ул. Куприна, 8/1, оф. 3</div>
            </li>
            <li class="field__item">
              <span class="field__title">ИНН<span class="req">*</span></span>
              <div class="field__value">
                <input class="field required  text-field" name="UF_INN" value="<?=htmlSafe($_REQUEST["UF_INN"])?>" type="text" /></div>
            </li>
            <li class="field__item">
              <span class="field__title">КПП<span class="req">*</span></span>
              <div class="field__value">
                <input class="field required  text-field" name="UF_KPP" type="text" value="<?=htmlSafe($_REQUEST["UF_KPP"])?>" /></div>
            </li>
            <li class="field__item">
              <span class="field__title">Телефон<span class="req">*</span></span>
              <div class="field__value">
                <input class="field required  text-field phone-field" name="REGISTER[WORK_PHONE]" value="<?=htmlSafe($_REQUEST["REGISTER"]["WORK_PHONE"])?>" type="text" /></div>
              <div class="field__example">
                (383) 111-11-11</div>
            </li>
            <li class="field__item">
              <span class="field__title">Телефон дополнительный</span>
              <div class="field__value">
                <input class="field text-field phone-field" name="REGISTER[PERSONAL_PHONE]" value="<?=htmlSafe($_REQUEST["REGISTER"]["PERSONAL_PHONE"])?>" type="text" /></div>
              <div class="field__example">
                (383) 222-22-22</div>
            </li>
            <li class="field__item">
              <span class="field__title">Факс</span>
              <div class="field__value">
                <input class="field text-field phone-field" name="REGISTER[WORK_FAX]" value="<?=htmlSafe($_REQUEST["REGISTER"]["WORK_FAX"])?>" type="text" /></div>
              <div class="field__example">
                (383) 333-33-33</div>
            </li>
          </ul>
        </div>
        <div class="form-section">
          <ul class="field__list">
            <li class="field__item">
              <span class="field__title">Ф.И.О.<span class="req">*</span></span>
              <div class="field__value">
                <input class="field required text-field" name="REGISTER[NAME]" type="text" value="<?=htmlSafe($_REQUEST["REGISTER"]["NAME"])?>" /></div>
              <div class="field__example">
                Иванов Иван Иванович</div>
            </li>
            <li class="field__item">
              <span class="field__title">E-mail<span class="req">*</span></span>
              <div class="field__value">
                <input class="field email required text-field" name="REGISTER[EMAIL]" type="email" value="<?=htmlSafe($_REQUEST["REGISTER"]["EMAIL"])?>" /></div>
            </li>
            <li class="field__item">
              <span class="field__title">Пароль<span class="req">*</span></span>
              <div class="field__value">
                <input class="field required text-field" name="REGISTER[PASSWORD]" type="password" /></div>
            </li>
            <li class="field__item">
              <span class="field__title">Пароль еще раз<span class="req">*</span></span>
              <div class="field__value">
                <input class="field required text-field" name="REGISTER[CONFIRM_PASSWORD]" type="password" /></div>
            </li>
            <li class="field__item">
              <span class="field__title">Дополнительная информация</span>
              <div class="field__value">
                <textarea class="field comment-field" name="REGISTER[WORK_NOTES]"><?=htmlSafe($_REQUEST["REGISTER"]["WORK_NOTES"])?></textarea></div>
            </li>
            <li class="field__item">
              <span class="field__title">Прикрепить файл</span>
              <div class="field__value">
                <input name="UF_FILES[]" type="file" /></div>
            </li>
          </ul>
        </div>
        <div class="form-actions">
          <div class="form-remember">
            <input checked="checked" id="remember" type="checkbox" /><label for="remember">Запомнить меня</label></div>
          <input class="submit" type="submit" name="register_submit_button" value="Зарегистрироваться" /></div>
      </form>
    </div>
<?endif?>
