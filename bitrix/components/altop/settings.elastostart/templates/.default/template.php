<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(false);?>

<div class="settings-panel<?=($_COOKIE['settingsPanel'] == 'open' ? ' active' : '');?>">
	<div class="panel-title">
		<?=GetMessage("SETTINGS_PANEL_TITLE")?><span class="switch"><i class="fa fa-cog"></i></span>		
	</div>
	<form method="post" name="settings-panel">
		<?foreach($arResult as $optionCode => $arOption):
			if($arOption["IN_SETTINGS_PANEL"] == "Y"):
				if($optionCode != "COLOR_SCHEME_CUSTOM"):?>
					<div class="panel-block" id="panel-block-<?=$optionCode?>">					
						<div class="block-title"><span><?=$arOption["TITLE"]?></span><i class="fa fa-plus"></i></div>
						<div class="block-options<?=($arOption['TYPE'] == 'selectbox' ? ' selectbox' : ($arOption['TYPE'] == 'multiselectbox' ? ' multiselectbox' : '')).($optionCode == 'COLOR_SCHEME' ? ' colors' : '');?>">							
							<?if($optionCode != "COLOR_SCHEME"):
								if($arOption["TYPE"] == "selectbox"):
									foreach($arOption["LIST"] as $variantCode => $arVariant):?>
										<div class="block-option">
											<input type="radio" id="<?=$optionCode.'_'.$variantCode?>" name="<?=$optionCode?>" <?=$arVariant["CURRENT"] == "Y" ? "checked=\"checked\"" : ""?> value="<?=$variantCode?>" />
											<label for="<?=$optionCode.'_'.$variantCode?>"><?=$arVariant["TITLE"]?></label>
										</div>
									<?endforeach;
								elseif($arOption["TYPE"] == "multiselectbox"):
									foreach($arOption["LIST"] as $variantCode => $arVariant):?>
										<div class="block-option">
											<input type="checkbox" id="<?=$optionCode.'_'.$variantCode?>" name="<?=$optionCode?>[]" <?=$arVariant["CURRENT"] == "Y" ? "checked=\"checked\"" : ""?> value="<?=$variantCode?>" />
											<label for="<?=$optionCode.'_'.$variantCode?>"><span class="check-cont"><span class="check"><i class="fa fa-check"></i></span></span><span class="check-title"><?=$arVariant["TITLE"]?></span></label>
										</div>
									<?endforeach;
								endif;
							else:
								foreach($arOption["LIST"] as $variantCode => $arVariant):
									if($variantCode !== "CUSTOM"):?>
										<div class="block-option" data-color="<?=$arVariant['COLOR']?>">
											<input type="radio" id="<?=$optionCode.'_'.$variantCode?>" name="<?=$optionCode?>" <?=$arVariant["CURRENT"] == "Y" ? "checked=\"checked\"" : ""?> value="<?=$variantCode?>" />
											<label for="<?=$optionCode.'_'.$variantCode?>" title="<?=$arVariant['TITLE']?>" style="background-color:<?=$arVariant['COLOR']?>;"><i class="fa fa-check"></i></label>
										</div>
									<?else:?>										
										<div class="color-scheme-custom">
											<div class="block-option" data-color="<?=(strlen($arResult['COLOR_SCHEME_CUSTOM']['VALUE']) > 0 ? $arResult['COLOR_SCHEME_CUSTOM']['VALUE'] : $arResult['COLOR_SCHEME_CUSTOM']['DEFAULT']);?>">
												<input type="radio" id="<?=$optionCode.'_'.$variantCode?>" name="<?=$optionCode?>" <?=$arVariant["CURRENT"] == "Y" ? "checked=\"checked\"" : ""?> value="<?=$variantCode?>" />
												<label for="<?=$optionCode.'_'.$variantCode?>" title="<?=$arVariant['TITLE']?>" style="background-color:<?=(strlen($arResult['COLOR_SCHEME_CUSTOM']['VALUE']) > 0 ? $arResult['COLOR_SCHEME_CUSTOM']['VALUE'] : $arResult['COLOR_SCHEME_CUSTOM']['DEFAULT']);?>;"><i class="fa fa-check"></i></label>
											</div>											
											<input type="text" id="option-color-scheme-custom" name="COLOR_SCHEME_CUSTOM" maxlength="7" value="<?=(strlen($arResult['COLOR_SCHEME_CUSTOM']['VALUE']) > 0 ? $arResult['COLOR_SCHEME_CUSTOM']['VALUE'] : $arResult['COLOR_SCHEME_CUSTOM']['DEFAULT']);?>" />
											<button type="button" name="palette_button" class="btn btn-primary"><i class="fa fa-eyedropper"></i><span><?=GetMessage("SETTINGS_PANEL_PALETTE")?></span></button>
										</div>
									<?endif;
								endforeach;
							endif;?>								
						</div>
					</div>
				<?endif;
			else:?>
				<input type="hidden" name="<?=$optionCode?>" value="<?=$arOption["VALUE"]?>" />
			<?endif;
		endforeach;?>
		<div class="panel-block reset">
			<button type="button" name="reset_button" class="btn btn-reset"><i class="fa fa-repeat"></i><span><?=GetMessage("SETTINGS_PANEL_RESET")?></span></button>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(function() {
		/***SHOW_HIDE_SETTINGS_PANEL***/
		if($.cookie("settingsPanel") == "open") {
			$(".settings-panel").addClass("active");
		}
		$(".settings-panel .switch").on({			
			mouseenter: function() {
				$(".fa-cog").addClass("fa-spin");
			},
			mouseleave: function() {
				$(".fa-cog").removeClass("fa-spin");
			}
		});		
		$(".settings-panel .switch").on("click", function() {			
			var panel = $(this).closest(".settings-panel"),
				isPanelActive = panel.hasClass("active");
			if(!!isPanelActive) {			
				panel.animate({right: "-" + panel.outerWidth() + "px"}, 300).removeClass("active");
				$.removeCookie("settingsPanel", {path: "/"});
			} else {
				panel.animate({right: "0"}, 300).addClass("active");				
				$.cookie("settingsPanel", "open", {path: "/"});
			}
		});
		
		/***SHOW_HIDE_BLOCK_OPTIONS***/
		<?foreach($arResult as $optionCode => $arOption):
			if($arOption["IN_SETTINGS_PANEL"] == "Y"):?>
				if($.cookie("panel-block-<?=$optionCode?>") == "open") {					
					$("#panel-block-<?=$optionCode?>").children(".block-title").addClass("active").children(".fa").removeClass("fa-plus").addClass("fa-minus").closest(".block-title").siblings(".block-options").show();
				}					
				$("#panel-block-<?=$optionCode?> .block-title").on("click", function() {
					var clickitem = $(this),
						isClickitemActive = clickitem.hasClass("active");					
					if(!!isClickitemActive) {
						clickitem.removeClass("active").children(".fa").removeClass("fa-minus").addClass("fa-plus");
						$.removeCookie("panel-block-<?=$optionCode?>", {path: "/"});
					} else {
						clickitem.addClass("active").children(".fa").removeClass("fa-plus").addClass("fa-minus");
						$.cookie("panel-block-<?=$optionCode?>", "open", {path: "/"});
					}
					clickitem.siblings(".block-options").slideToggle();					
				});
			<?endif;
		endforeach;?>

		/***VARIABLES***/
		var inputs = $(".settings-panel .block-option input"),
			colorSchemeCustom = $(".settings-panel .color-scheme-custom"),
			colorSchemeCustomDiv = colorSchemeCustom.find(".block-option"),
			colorSchemeCustomLabel = colorSchemeCustomDiv.find("label"),
			colorSchemeCustomInput = colorSchemeCustom.find("input[name=COLOR_SCHEME_CUSTOM]"),
			paletteButton = colorSchemeCustom.find("button"),
			formPanel = $("form[name=settings-panel]"),
			formPanelActionInput = "<input type='hidden' name='action' value='change_theme' />";

		/***SPECTRUM***/		
		paletteButton.spectrum({				
			clickoutFiresChange: false,
			cancelText: "<?=GetMessage('SETTINGS_PANEL_PALETTE_CHANCEL')?>",
			chooseText: "<?=GetMessage('SETTINGS_PANEL_PALETTE_CHOOSE_COLOR')?>",
			containerClassName:"palette_cont",				
			move: function(color) {
				var hex = color.toHexString();				
				colorSchemeCustomDiv.attr("data-color", hex);
				colorSchemeCustomLabel.css({"background-color": hex});
				colorSchemeCustomInput.val(hex);
			},
			hide: function(color) {
				var hex = color.toHexString();
				colorSchemeCustomDiv.attr("data-color", hex);
				colorSchemeCustomLabel.css({"background-color": hex});
				colorSchemeCustomInput.val(hex);
			},
			change: function(color) {										
				colorSchemeCustomDiv.find("input").prop("checked", true);
				formPanel.append(formPanelActionInput);
				formPanel.submit();
			}
		});
		
		/***CHANGE_INPUT***/
		inputs.each(function() {			
			if($(this).is(":checked")) {				
				var parentColor = $(this).parent(".block-option").data("color");
				if(!!parentColor) {					
					colorSchemeCustomDiv.attr("data-color", parentColor);
					colorSchemeCustomLabel.css({"background-color": parentColor});
					colorSchemeCustomInput.val(parentColor);
					paletteButton.spectrum("set", parentColor);
				}		
			}
		});
		inputs.on("change", function() {			
			if($(this).is(":checked")) {
				var parentColor = $(this).parent(".block-option").data("color");
				if(!!parentColor) {
					colorSchemeCustomDiv.attr("data-color", parentColor);
					colorSchemeCustomLabel.css({"background-color": parentColor});
					colorSchemeCustomInput.val(parentColor);
					paletteButton.spectrum("set", parentColor);
				}
			}
			formPanel.append(formPanelActionInput);
			formPanel.submit();
		});

		/***CHANGE_COLOR_SCHEME_CUSTOM_INPUT***/		
		function CheckColor(color) {
			color = color.replace(/#/g, "");
			if(color.length < 6) {
				if(color.length != 3) {
					for($i = 0, $l = 6 - color.length; $i < $l; ++$i) {
						color = color + "0";
					}					
				}
			} else if(color.length > 6) {
				color = color.slice(0, -(color.length - 6));	
			}
			color = "#" + color;
			return color;
		}
		colorSchemeCustomInput.on("change", function() {			
			var hex = $(this).val();
			if(hex.length > 0) {
				hex = CheckColor(hex);				
				$(this).val(hex);
				colorSchemeCustomDiv.attr("data-color", hex);
				colorSchemeCustomLabel.css({"background-color": hex});
				paletteButton.spectrum("set", hex);
			} else {
				var activeColor = $(this).closest(".colors").find("input:checked").parent(".block-option").data("color");				
				if(!!activeColor) {
					$(this).val(activeColor);
					colorSchemeCustomDiv.attr("data-color", activeColor);
					colorSchemeCustomLabel.css({"background-color": activeColor});
					paletteButton.spectrum("set", activeColor);
				}
			}
		});
		colorSchemeCustomInput.on("keypress", function(e) {
			if(e.keyCode == 13) {
				e.preventDefault();
				var hex = $(this).val();
				if(hex.length > 0) {
					hex = CheckColor(hex);				
					$(this).val(hex);
					colorSchemeCustomDiv.attr("data-color", hex);
					colorSchemeCustomLabel.css({"background-color": hex});					
				} else {
					var activeColor = $(this).closest(".colors").find("input:checked").parent(".block-option").data("color");				
					if(!!activeColor) {
						$(this).val(activeColor);						
					}
				}
				colorSchemeCustomDiv.find("input").prop("checked", true);
				formPanel.append(formPanelActionInput);
				formPanel.submit();
			}
		});

		/***RESET_BUTTON***/
		$(".settings-panel button[name=reset_button]").on("click", function() {
			formPanel.append("<input type='hidden' name='THEME' value='default' />");
			formPanel.append(formPanelActionInput);
			formPanel.submit();
		});
	});
</script>