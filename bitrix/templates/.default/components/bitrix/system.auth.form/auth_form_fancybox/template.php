<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?if($arResult["FORM_TYPE"] == "login"){?>
	<?if(isset($_REQUEST["USER_LOGIN"])) {
        $userLogin = htmlspecialchars($_REQUEST["USER_LOGIN"]);
    }?>
	<?$this->SetViewTarget('showModelAuth');?>
        <?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) {?>
            <script>
                $(function() {
                    $('._js-mc-fancybox_login').trigger('click');
                })
            </script>
        <?}?>
    <?$this->EndViewTarget();?>
	<form title="Авторизация" id="autorization-form-auth" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>"  class="auth-form">
		<?//echo "<pre>"; var_dump($arResult); echo "</pre>";?>
		<?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) {?>
			<div class="form_message2">
				<div class="message_item">
					<?if (is_array($arResult['ERROR_MESSAGE'])) {?>
						<?=$arResult['ERROR_MESSAGE']['MESSAGE']?>
					<?} elseif($arResult['ERROR_MESSAGE'] <> "") {?>
						<?=$arResult['ERROR_MESSAGE']?>
					<?}?>
				</div>
			</div>
		<?}?>
		<?if ($arResult["BACKURL"] <> '') {?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?}?>
		<?foreach ($arResult["POST"] as $key => $value) {?>
			<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?}?>
		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<ul>
			<li>
				<label for="USER_LOGIN"> <?=GetMessage('AUTH_EMAIL')?></label>
				<input type="email" name="USER_LOGIN" id="USER_LOGIN" value="<?echo $arResult["USER_LOGIN"] <> "" ? $arResult["USER_LOGIN"] : $userLogin;?>" required>
			</li>
			<li>
				<label for="USER_PASSWORD"> <?=GetMessage('AUTH_PASSWORD')?></label>
				<input type="password" name="USER_PASSWORD" id="USER_PASSWORD" required>
			</li>
			<li>
				<input type="submit" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
			</li>
		</ul>
	</form>
<?} else {?>
	<?$this->SetViewTarget('showLogoutForm');?>
		<form id="logoutForm" action="<?=$arResult["AUTH_URL"]?>">
			<?foreach ($arResult["GET"] as $key => $value) {?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?}?>
			<input type="hidden" name="logout" value="yes" />
			<ul class="login">
				<li>
					<a class="popUp" href="<?=PERSONAL_PROFILE_URL?>">
						<?if ($arResult["USER_NAME"] <> "") {?>
							<?=$arResult["USER_NAME"];?>
						<?} elseif ($arResult["USER_LOGIN"] <> "") {?>
							<?=$arResult["USER_LOGIN"];?>
						<?}?>
					</a>
				</li>
				<li>
					<a class="popUp" style="cursor: pointer" title="<?=GetMessage("AUTH_LOGOUT_BUTTON");?>" onclick="$('#logoutForm').submit()">
						<?=GetMessage("AUTH_LOGOUT_BUTTON");?>
					</a>
				</li>
			</ul>
		</form>
	<?$this->EndViewTarget();?>
<?}?>