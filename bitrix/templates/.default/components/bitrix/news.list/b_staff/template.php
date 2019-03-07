<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//echo "<pre>"; var_dump($arResult['DATA']['ITEMS']); echo "</pre>";
?>

<?if(!empty($arResult['DATA']['ITEMS'])){?>
	<div class="b-staff">
		<?foreach($arResult['DATA']['ITEMS'] as $Section) {?>
			<?
            // Временнное решение
			if($Section["NAME"] === "Отдел продаж"){
				$class = " staff-section_state_opened";
			} else {
				$class = "";
			}
			?>
			<div class="staff-section<?=$class?>">
				<a href="javascript:;" id="staff-<?=$Section["ID"]?>" class="staff__header">
					<span class="button-text">
						<?=$Section['NAME'];?>
					</span>
				</a>
				<div class="staff__content">
					<?if(!empty($Section['ITEMS'])){
						foreach($Section['ITEMS'] as $Item){?>
							<div class="staff__item">
								<?if(!empty($Item["PREVIEW_PICTURE"])){?>
									<div class="staff-img">
										<img
											src="<?=$Item["SCALED_PREVIEW_PICTURE"]["SRC"]?>"
										/>
									</div>
								<?}?>
								<div class="staff-text">
									<div class="staff-name">
										<?=$Item['NAME'];?>
									</div>
									<div class="staff-info">
										<?=$Item['PREVIEW_TEXT'];?>
									</div>
									<?if(!empty($Item["PROPERTIES"])){?>
										<div class="staff-contacts">
											<?if(!empty($Item["PROPERTIES"]['ICQ']['VALUE'])){?>
												<div class="staff-contacts__item">
													<span class="staff-contacts__title staff-contacts__title_icq">&nbsp;</span>
													<span class="staff-contacts__value">
														<?=$Item["PROPERTIES"]['ICQ']['VALUE'];?>
													</span>
												</div>
											<?}?>
											<?if(!empty($Item["PROPERTIES"]['SKYPE']['VALUE'])){?>
												<div class="staff-contacts__item">
													<span class="staff-contacts__title staff-contacts__title_skype">&nbsp;</span>
													<span class="staff-contacts__value">
														<a href="skype:<?=$Item["PROPERTIES"]['SKYPE']['VALUE'];?>?chat&amp;topic=С сайта">
															<?=$Item["PROPERTIES"]['SKYPE']['VALUE'];?>
														</a>
													</span>
												</div>
											<?}?>
											<div class="staff-contacts__item">
												<span class="staff-contacts__value">
													<a	class="js__openFormInPopupFeedback mail-link"
														href="#feedbackForm"
														data-id="<?=$Item['ID'];?>"
														data-name="<?=$Item['NAME'];?>"
													>
														<span class="link-text">Написать сообщение</span>
													</a>
												</span>
											</div>
										</div>
									<?}?>
								</div>
							</div>
						<?}?>
					<?}?>
				</div>
			</div>
		<?}?>
	</div>
<?}?>
<script>
	$(document).ready(function(){
		var staffWindowHash = window.location.hash;
		var staffRegexp = /staff-\d+/;

		if(staffRegexp.test(staffWindowHash)){
			$('.staff-section').each(function(){
				$(this).removeClass('staff-section_state_opened');
			})
			$(staffWindowHash).click();
		}
	});
</script>
