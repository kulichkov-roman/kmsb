<?global $USER;?>
<?if (!$USER->IsAuthorized()){?>
    <div class="account-action">
        <a href="#authForm" class="account-action__button account-action__button_auth js__openFormInPopup" title="">
            <span class="link-text">Вход</span>
        </a>
        <a href="/registration/" class="account-action__link" title="Регистрация">
            Регистрация
        </a>
    </div>
<?} else {?>
    <div class="account-action">
        <a href="/personal/profile/" class="account-action__button account-action__button_auth js__openFormInPopup" title="">
            <?
            $userName = $USER -> GetFullName();
            if($userName){
                echo $userName;
            } else {
                echo $USER -> GetLogin();
            }
            ?>
        </a>
        <a href="?logout=yes" class="account-action__link" title="Регистрация">
            Выход
        </a>
    </div>
<?}?>