<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//echo "<pre>"; print_r($arParams); print_r($arResult); echo "</pre>";
?>
<div class="content-form register-form">
<div class="fields">
<?
if (count($arResult["ERRORS"]) > 0)
{
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));
}
elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y")
{
	?><div class="field"><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></div><?
}?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>

<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
  <?
   if($FIELD == "PERSONAL_PROFESSION")
   {
    ?><input type="hidden" name="REGISTER[PERSONAL_PROFESSION]" value="1" /><?
    continue;
   }
   
   if(strpos($FIELD, "WORK_") !== false)
    continue;
  ?>
		<div class="field">
   <label class="field-title"><?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="starrequired">*</span><?endif?></label>
			<div class="form-input"><?
	switch ($FIELD)
	{
		case "PASSWORD":
		case "CONFIRM_PASSWORD":
			?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" /><?
		break;

		case "PERSONAL_GENDER":
			?><select name="REGISTER[<?=$FIELD?>]">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select><?
		break;

		case "PERSONAL_COUNTRY":
		case "WORK_COUNTRY":
			?><select name="REGISTER[<?=$FIELD?>]"><?
			foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
			{
				?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
			<?
			}
			?></select><?
		break;

		case "PERSONAL_PHOTO":
		case "WORK_LOGO":
			?><input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" /><?
		break;

		case "PERSONAL_NOTES":
		case "WORK_NOTES":
			?><textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
		break;
		default:
			if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?=$arResult["DATE_FORMAT"]?></small><br /><?endif;
			?><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" /><?
				if ($FIELD == "PERSONAL_BIRTHDAY")
					$APPLICATION->IncludeComponent(
						'bitrix:main.calendar',
						'',
						array(
							'SHOW_INPUT' => 'N',
							'FORM_NAME' => 'regform',
							'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
							'SHOW_TIME' => 'N'
						),
						null,
						array("HIDE_ICONS"=>"Y")
					);
				?><?
	}?></div>
		</div>
<?endforeach?>

<h2>Организация</h2>
<div class="field">
 <label class="field-title">Название организации:<span class="starrequired">*</span></label>
 <div class="form-input"><input size="30" type="text" name="REGISTER[WORK_COMPANY]" value="<?=$arResult["VALUES"]["WORK_COMPANY"]?>" /></div>
</div>
<?if(!$arResult["VALUES"]["WORK_COUNTRY"]) $arResult["VALUES"]["WORK_COUNTRY"] = 1;?>
<div class="field">
 <label class="field-title">Страна:<span class="starrequired">*</span></label>
 <div class="form-input">
  <select name="REGISTER[WORK_COUNTRY]"><?
			foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
			{
				?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"]["WORK_COUNTRY"]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
			<?
			}
			?></select>
 </div>
</div>
<div class="field">
 <label class="field-title">Город:<span class="starrequired">*</span></label>
 <div class="form-input"><input size="30" type="text" name="REGISTER[WORK_CITY]" value="<?=$arResult["VALUES"]["WORK_CITY"]?>" /></div>
</div>
<div class="field">
 <label class="field-title">Юридический адрес:<span class="starrequired">*</span></label>
 <div class="form-input"><input size="30" type="text" name="REGISTER[WORK_STREET]" value="<?=$arResult["VALUES"]["WORK_STREET"]?>" /></div>
</div>
<div class="field">
 <label class="field-title">Физический адрес:<span class="starrequired">*</span></label>
 <div class="form-input"><input size="30" type="text" name="REGISTER[WORK_NOTES]" value="<?=$arResult["VALUES"]["WORK_NOTES"]?>" /></div>
</div>
<div class="field">
 <label class="field-title">Телефон:<span class="starrequired">*</span></label>
 <div class="form-input"><input size="30" type="text" name="REGISTER[WORK_PHONE]" value="<?=$arResult["VALUES"]["WORK_PHONE"]?>" /></div>
</div>

<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
 <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
  <div class="field">
   <label class="field-title"><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="required">*</span><?endif;?></label>
			<div class="form-input"><?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?>
   </div>
  </div> 
	<?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************?>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
  <div class="field">
			<label class="field-title"><?=GetMessage("CAPTCHA_REGF_PROMT")?><span class="starrequired">*</label>
			<div class="form-input"><input type="text" name="captcha_word" maxlength="50" value="" /></div>
			<p style="clear: left;"><input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></p>
		</div>
	<?
}
/* CAPTCHA */
?>
 <div class="field field-button"><input type="submit" class="input-submit" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" /></div>
 
 
<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

</form>
</div>
</div>