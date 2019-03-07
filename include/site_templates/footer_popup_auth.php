<div id="authForm" class="b-popup b-popup-form b-popup-form_auth">
    <div class="popup-form popup-form_state_active">
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.form", 
            "auth_form", 
            array(
                "REGISTER_URL" => "/registration/",
                "FORGOT_PASSWORD_URL" => "/auth/",
                "PROFILE_URL" => "",
                "SHOW_ERRORS" => "Y"
            ),
            false
        );?>
    </div>
    <div class="popup-form">
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.forgotpasswd", 
            "forgotpasswd"
        );?>
    </div>
</div>