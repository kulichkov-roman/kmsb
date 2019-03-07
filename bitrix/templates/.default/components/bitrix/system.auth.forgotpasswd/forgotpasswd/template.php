<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

// ShowMessage($arParams["~AUTH_RESULT"]);
?>
<div class="popup__header">
    Восстановление пароля
</div>
<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="remind-form" novalidate="novalidate">
    <?
    if (strlen($arResult["BACKURL"]) > 0)
    {
    ?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?
    }
    ?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">
    <ul class="field__list">
        <li class="field__item">
            <span class="field__title">E-mail<span class="req">*</span></span>
            <div class="field__value">
                <input name="USER_EMAIL" class="field email required text-field" type="text" />
            </div>
        </li>
    </ul>
    <div class="form-note">
        Пожалуйста, введите адрес электронной почты, указанный при&nbsp;регистрации.<br />
        На этот адрес придет письмо с&nbsp;дальнейшими инструкциями.
    </div>
    <a class="toggle-pass-link js__changeAuthForm" href="javascript:;">Я вспомнил его!</a>
    <div class="form-actions">
        <input class="submit" name="send_account_info" type="submit" value="Отправить" />
    </div>
</form>
