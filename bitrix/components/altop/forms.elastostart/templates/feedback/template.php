<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();

$sComponentFolder = $this->__component->__path;

$this->setFrameMode(true);?>

<div class="feedback-wrapper">
	<div class="container">
		<div class="row feedback">
			<div class="col-md-12">
				<div class="h1"><?=$arResult["IBLOCK_NAME"]?></div>
			</div>
			<form id="<?=$arResult['IBLOCK_CODE']?>_form" action="javascript:void(0)">				
				<div class="col-md-12">
					<div id="<?=$arResult['IBLOCK_CODE']?>_alert" class="alert" style="display:none;"></div>
				</div>
				<input type="hidden" name="IBLOCK_CODE" value="<?=$arResult['IBLOCK_CODE']?>" />
				<input type="hidden" name="IBLOCK_NAME" value="<?=$arResult['IBLOCK_NAME']?>" />
				<input type="hidden" name="IBLOCK_ID" value="<?=$arParams['IBLOCK_ID']?>" />					
				<input type="hidden" name="USE_CAPTCHA" value="<?=$arParams['USE_CAPTCHA']?>" />
				<?if(is_array($arResult["FIELDS"])):?>
					<input type="hidden" name="FIELDS_STRING" value="<?=$arResult['FIELDS_STRING']?>" />
					<div class="col-md-3">
						<?foreach($arResult["FIELDS"] as $key => $arField):							
							if($arField["USER_TYPE"] != "HTML"):?>
								<div class="form-group<?=(!empty($arField['HINT']) ? ' has-feedback' : '');?>">
									<input type="text" name="<?=$arField['CODE']?>" class="form-control" placeholder="<?=$arField['NAME']?>" />
									<?if(!empty($arField["HINT"])):?>
										<i class="form-control-feedback fv-icon-no-has fa <?=$arField['HINT']?>"></i>
									<?endif;?>
								</div>
							<?endif;
						endforeach;?>
					</div>				
					<div class="col-md-6">
						<?foreach($arResult["FIELDS"] as $key => $arField):
							if($arField["USER_TYPE"] == "HTML"):?>
								<div class="form-group<?=(!empty($arField['HINT']) ? ' has-feedback' : '');?>">
									<textarea name="<?=$arField['CODE']?>" class="form-control" rows="3" placeholder="<?=$arField['NAME']?>" style="height:<?=$arField['USER_TYPE_SETTINGS']['height']?>px; min-height:<?=$arField['USER_TYPE_SETTINGS']['height']?>px; max-height:<?=$arField['USER_TYPE_SETTINGS']['height']?>px;"></textarea>
									<?if(!empty($arField["HINT"])):?>
										<i class="form-control-feedback fv-icon-no-has fa <?=$arField['HINT']?>"></i>
									<?endif;?>
								</div>
							<?endif;
						endforeach;?>
					</div>
				<?endif;?>
				<div class="col-md-3">
					<?if($arParams["USE_CAPTCHA"] == "Y"):
						$frame = $this->createFrame()->begin("");?>
							<div class="form-group captcha has-feedback">
								<div class="pic">
									<img class="captcha_img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA_CODE']?>" width="100" height="36" alt="CAPTCHA" />
								</div>								
								<input type="text" name="captcha_word" class="form-control" placeholder="<?=GetMessage('FORMS_FEEDBACK_CAPTCHA_WORD')?>" />
								<input type="hidden" name="captcha_sid" value="<?=$arResult['CAPTCHA_CODE']?>" />
								<i class="form-control-feedback fa fa-times" style="display:none;"></i>
								<small class="help-block" style="display:none;"><?=GetMessage("FORMS_FEEDBACK_CAPTCHA_WRONG")?></small>
							</div>
						<?$frame->end();
					endif;?>
					<div class="form-group<?=($arParams["USE_CAPTCHA"] == "N" ? ' no-captcha' : '');?>">
						<button type="submit" class="btn btn-primary"><?=GetMessage("FORMS_FEEDBACK_SUBMIT")?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	//<![CDATA[
	$(function() {
		/***Mask***/		
		<?if(is_array($arResult["FIELDS"])):					
			foreach($arResult["FIELDS"] as $key => $arField):
				if($arField["CODE"] == "PHONE" && !empty($arResult["SETTINGS"]["PHONE_MASK"]["VALUE"])):?>
					$("#<?=$arResult['IBLOCK_CODE']?>_form").find("[name='PHONE']").inputmask("<?=$arResult['SETTINGS']['PHONE_MASK']['VALUE']?>");
				<?endif;
			endforeach;
		endif;?>
		
		/***Validation***/
		$("#<?=$arResult['IBLOCK_CODE']?>_form").formValidation({
			framework: "bootstrap",
			icon: {
				valid: "fa fa-check",
				invalid: "fa fa-times",
				validating: "fa fa-refresh"
			},			
			fields: {
				<?if(is_array($arResult["FIELDS"])):					
					foreach($arResult["FIELDS"] as $key => $arField):?>
						<?=$arField["CODE"]?>: {
							row: ".form-group",
							validators: {								
								<?if($arField["IS_REQUIRED"] == "Y"):?>
									notEmpty: {
										message: "<?=GetMessage('FORMS_FEEDBACK_NOT_EMPTY_INVALID')?>"
									},
								<?endif;
								if($arField["CODE"] == "PHONE" && !empty($arResult["SETTINGS"]["VALIDATE_PHONE_MASK"]["VALUE"])):?>
									regexp: {
										message: "<?=GetMessage('FORMS_FEEDBACK_REGEXP_INVALID')?>",										
										regexp: /<?=$arResult["SETTINGS"]["VALIDATE_PHONE_MASK"]["VALUE"]?>/
									},
								<?endif;?>
							}
						},						
					<?endforeach;
				endif;?>				
			}
		}).on("success.form.fv", function(e) {
			/***Prevent default form submission***/
			e.preventDefault();
				
			var $form = $(e.target);			
				
			/***Send all form data to back-end***/
			$.ajax({
				url: "<?=$sComponentFolder?>/script.php",
				type: "POST",
				data: $form.serialize(),
				dataType: "json",
				success: function(response) {						
					/***Show the message***/
					if(!!response.result) {
						/***Clear the form***/
						$form.formValidation("resetForm", true);
						
						if(response.result == "Y") {							
							$("#<?=$arResult['IBLOCK_CODE']?>_alert").removeClass("alert-warning").addClass("alert-success").html("<?=GetMessage('FORMS_FEEDBACK_ALERT_SUCCESS')?>").show();
						} else {
							$("#<?=$arResult['IBLOCK_CODE']?>_alert").removeClass("alert-success").addClass("alert-warning").html("<?=GetMessage('FORMS_FEEDBACK_ALERT_WARNING')?>").show();
						}
					}

					/***Captcha***/
					<?if($arParams["USE_CAPTCHA"] == "Y"):?>
						if(!!response.captcha_error) {
							/***Clear the field***/
							$form.formValidation("resetField", "captcha_word", true);							
							
							if(response.captcha_error == "Y") {
								/***Enable submit button***/
								$form.formValidation("disableSubmitButtons", false);

								$("#<?=$arResult['IBLOCK_CODE']?>_form").find("[name='captcha_word']").parent().addClass("has-error").find(".form-control-feedback").show().parent().find(".help-block").show();
							} else {
								$("#<?=$arResult['IBLOCK_CODE']?>_form").find("[name='captcha_word']").parent().removeClass("has-error").find(".form-control-feedback").hide().parent().find(".help-block").hide();
							}
							if(!!response.captcha_code) {
								$("#<?=$arResult['IBLOCK_CODE']?>_form").find(".captcha_img").attr("src", "/bitrix/tools/captcha.php?captcha_sid=" + response.captcha_code);
								$("#<?=$arResult['IBLOCK_CODE']?>_form").find("[name='captcha_sid']").val(response.captcha_code);
							}
						}
					<?endif;?>
				}
			});
		});				
	});	
	//]]>
</script>