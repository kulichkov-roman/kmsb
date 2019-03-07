<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
//echo "<pre>"; print_r($arResult); echo "</pre>";
//exit();
//echo "<pre>"; print_r($_SESSION); echo "</pre>";

?>
<?=ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	echo ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

<div class="content-form profile-form">
	<div class="fields">
		<div class="field field-firstname">
			<label class="field-title">Логин</label>
			<div class="form-input"><input type="text" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" /></div>
		</div>
  <div class="field field-firstname">
			<label class="field-title">E-mail</label>
			<div class="form-input"><input type="text" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" /></div>
		</div>
  <div class="field field-firstname">
			<label class="field-title"><?=GetMessage('NAME')?></label>
			<div class="form-input"><input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /></div>
		</div>
		<div class="field field-lastname">	
			<label class="field-title"><?=GetMessage('LAST_NAME')?></label>
			<div class="form-input"><input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></div>
			
		</div>
		<div class="field field-secondname">	
			<label class="field-title"><?=GetMessage('SECOND_NAME')?></label>
			<div class="form-input"><input type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" /></div>
		</div>
	</div>
</div>
<div class="content-form profile-form">
	<div class="legend"><?=GetMessage("MAIN_PSWD")?></div>
	<div class="fields">
		<div class="field field-password_new">	
			<label class="field-title"><?=GetMessage('NEW_PASSWORD_REQ')?></label>

			<div class="form-input"><input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" /></div>
			
		</div>
		<div class="field field-password_confirm">	
			<label class="field-title"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
			<div class="form-input"><input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></div>
			
		</div>
	</div>
</div>
<div class="content-form profile-form">
	<div class="legend">Организация</div>
	<div class="fields">
		<div class="field field-firstname">
			<label class="field-title">Название организации</label>
			<div class="form-input"><input type="text" name="WORK_COMPANY" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" /></div>
		</div>
  <div class="field field-firstname">
			<label class="field-title">Страна</label>
			<div class="form-input"><?=$arResult["COUNTRY_SELECT_WORK"]?></div>
		</div>
  <div class="field field-firstname">
			<label class="field-title">Город</label>
			<div class="form-input"><input type="text" name="WORK_CITY" value="<?=$arResult["arUser"]["WORK_CITY"]?>" /></div>
		</div>
  <div class="field field-firstname">
			<label class="field-title">Юридический адрес</label>
			<div class="form-input"><input type="text" name="WORK_STREET" value="<?=$arResult["arUser"]["WORK_STREET"]?>" /></div>
		</div>
  <div class="field field-firstname">
			<label class="field-title">Физический адрес</label>
			<div class="form-input"><input type="text" name="WORK_NOTES" value="<?=$arResult["arUser"]["WORK_NOTES"]?>" /></div>
		</div>
  <div class="field field-firstname">
			<label class="field-title">Телефон</label>
			<div class="form-input"><input type="text" name="WORK_PHONE" value="<?=$arResult["arUser"]["WORK_PHONE"]?>" /></div>
		</div>
	</div>
</div>

<div class="content-form profile-form">
	<div class="button"><input name="save" value="<?=GetMessage("MAIN_SAVE")?>"class="input-submit" type="submit"></div>
</div>
</form>