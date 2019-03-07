<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div id="search" class="form-box">
	<form action="<?=$arResult["FORM_ACTION"]?>">
		<div class="form-textbox">
			<div class="form-textbox-border"><?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 15,
					"DROPDOWN_SIZE" => 10,
				),
				$component, array("HIDE_ICONS" => "Y")
	);?></div>
		</div>
		<div class="form-button">
			<input type="submit" name="s" onfocus="this.blur();" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" id="search-submit-button">
		</div>
	</form>
</div>