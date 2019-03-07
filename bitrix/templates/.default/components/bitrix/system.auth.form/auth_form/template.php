<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="popup__header">
    Авторизация
</div>
<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" novalidate="novalidate" class="auth-form">
    <?if($arResult["BACKURL"] <> ''):?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?endif?>
    <?foreach ($arResult["POST"] as $key => $value):?>
        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
    <?endforeach?>
    <input type="hidden" name="AUTH_FORM" value="Y" />
    <input type="hidden" name="TYPE" value="AUTH" />
    <?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
        ShowMessage($arResult['ERROR_MESSAGE']);
    ?>
    <ul class="field__list">
        <li class="field__item">
            <span class="field__title">E-mail<span class="req">*</span></span>
            <div class="field__value">
                <input class="field email required text-field" type="text" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>" />
            </div>
        </li>
        <li class="field__item">
            <span class="field__title">Пароль<span class="req">*</span></span>
            <div class="field__value">
                <input class="field required text-field" name="USER_PASSWORD" type="password" />
            </div>
        </li>
    </ul>
    <a class="toggle-pass-link js__changeAuthForm" href="javascript:;">Забыли пароль?</a>
    <div class="form-actions">
        <input class="submit" name="Login" type="submit" value="Войти" />
    </div>
</form>
<?if($arResult["ERROR_MESSAGE"]){?>
    <script>
    $(document).ready(function() {
        $('a[href="#authForm"]').click();
    });
    </script>	
<?}?>
