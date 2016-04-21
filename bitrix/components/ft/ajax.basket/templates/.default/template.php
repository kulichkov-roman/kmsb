<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<h1><?$APPLICATION->ShowTitle();?></h1>
<div class="b-cart">
<?if(!empty($arResult['ERRORS'])):?>
	<div class="errors"><?=ShowError(implode('<br>', $arResult['ERRORS']));?></div>
<?elseif(!empty($arResult['MESSAGE'])):?>
	<div class="message"><?=ShowMessage(array('TYPE' => 'OK', 'MESSAGE' => $arResult['MESSAGE']))?></div>
<?endif?>
<?if(empty($arResult['MESSAGE'])):?>
    <?if($arResult["OPTIONS_VIEW_ALL"]):?>
	    <a href="javascript:;" class="toggle-all-options-button js__toggle-all-options" title=" ">
	    	<span class="button-text button-text_type_open">Раскрыть все опции</span>
	    	<span class="button-text button-text_type_close">Свернуть все опции</span>
	    </a>
    <?endif;?>
	<table border="0" cellpadding="0" cellspacing="0" class="cart-grid">
		<tbody>
			<tr class="cart-grid__row_title">
				<td class="cart-grid__cell_title">Товар</td>
                <?if(SHOW_PRICE === "Y"):?>
				    <td class="cart-grid__cell_price">Цена с НДС</td>
                <?endif;?>
				<td class="cart-grid__cell_num">Количество</td>
                <?if(SHOW_PRICE === "Y"):?>
				    <td class="cart-grid__cell_sum">Сумма</td>
                <?endif;?>
				<td class="cart-grid__cell_delete">
					<a class="cart-delete" href="javascript:;" title="Очистить корзину">×</a><div class="cart-loading"><img src="/files/kom-sib/Design/cart-loader.gif"></div>
				</td>
			</tr>
			<?foreach($arResult['ITEMS'] as $id => $arItem):?>				
				<tr class="cart-grid__row_item cart-grid__row_odd" data-product-id="<?=$arItem['PRODUCT_ID']?>">
					<td class="cart-grid__cell_title">
					<?if(!empty($arItem['OPTIONS'])):?>
						<a class="toggle-options-button js__toggle-options" href="javascript:;"><span class="button-text button-text_type_open" title="Смотреть опции">+</span><span class="button-text button-text_type_close" title="Скрыть опции">−</span></a>
					<?endif;?>
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="cart-item__link" target="_blank">
                            <span class="cart-item__title"><?=$arItem['NAIMENOVANIE_DLYA_SAYTA_POLNOE']?></span>
                            <span class="cart-item__img"><img src="<?=$arItem['DETAIL_PICTURE']?>" alt="<?=$arItem['NAIMENOVANIE_DLYA_SAYTA_POLNOE']?>" /></span>
                        </a>
					</td>
                    <?if(SHOW_PRICE === "Y"):?>
					    <td>
					    	<div class="cart-price">
					    		<span class="cart-price__value"><?=number_format($arItem['PRICE'], 0, '.', ' ')?></span> руб.
					    	</div>
					    </td>
                    <?endif;?>
					<td>
						<div class="cart-count">
							<a class="cart-count__control cart-count__control_type_remove" href="javascript:;">−</a><input class="cart-count__input" type="text" value="<?=intval($arItem['QUANTITY'])?>"><a class="cart-count__control cart-count__control_type_add" href="javascript:;">+</a><div class="cart-loading"><img src="/files/kom-sib/Design/cart-loader.gif"></div>
						</div>
					</td>
                    <?if(SHOW_PRICE === "Y"):?>
					    <td>
					    	<div class="cart-sum" data-currency="1">
					    		<span class="cart-sum__value"><?=number_format($arItem['SUM'], 0, '.', ' ')?></span> руб.
					    	</div>
					    </td>
                    <?endif;?>
					<td class="cart-grid__cell_delete">
						<a class="cart-delete" href="javascript:;" title="Убрать из корзины">×</a><div class="cart-loading"><img src="/files/kom-sib/Design/cart-loader.gif"></div>
					</td>
				</tr>
				<?if(!empty($arItem['OPTIONS'])):?>
					<tr class="cart-grid__row_option cart-grid__row_odd">
						<td class="cart-grid__cell_title">
							<div class="cart-option-header">Опции</div>
						</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
                        <?if(SHOW_PRICE === "Y"):?>
						    <td>&nbsp;</td>
						    <td>&nbsp;</td>
                        <?endif;?>
					</tr>
					<?
					$mainProductId = $arItem["PRODUCT_ID"];
					foreach($arItem['OPTIONS'] as $key => $option):?>
						<?
						// if( $_COOKIE['ITC'] == 'Y') {
						// 	pre($option["ID"]);
						// }
						$optionQuantity = $arResult["OPTION_QUANTITY"][ $option["PRODUCT_ID"] . '_' . $mainProductId];
						$option["QUANTITY"] = intval($optionQuantity);

						if(!is_array($option)) {
							continue;
						}
						?>
						<tr class="cart-grid__row_option cart-grid__row_odd" data-product-id="<?=$option['PRODUCT_ID']?>" data-main-product-id="<?=$mainProductId?>">
							<td class="cart-grid__cell_title">
                                <a href="<?=$option['DETAIL_PAGE_URL']?>" class="cart-item__link" target="_blank">
                                    <span class="cart-item__title"><?=$option['NAIMENOVANIE_DLYA_SAYTA_POLNOE']?></span>
                                    <?if($option['DETAIL_PICTURE'] <> ""){?>
                                        <span class="cart-item__img"><img src="<?=$option['DETAIL_PICTURE']?>" alt="<?=$option['NAIMENOVANIE_DLYA_SAYTA_POLNOE']?>" /></span>
                                    <?}?>
                                </a>
							</td>
                            <?if(SHOW_PRICE === "Y"):?>
							    <td>
							    	<div class="cart-price">
							    		<span class="cart-price__value"><?=number_format($option['PRICE'], 0, '.', ' ')?></span> руб.
							    	</div>
							    </td>
                            <?endif;?>
							<td>
								<div class="cart-count">
									<a class="cart-count__control cart-count__control_type_remove" href="javascript:;">−</a><input class="cart-count__input" type="text" value="<?=intval($option['QUANTITY'])?>"><a class="cart-count__control cart-count__control_type_add" href="javascript:;">+</a><div class="cart-loading"><img src="/files/kom-sib/Design/cart-loader.gif"></div>
								</div>
							</td>
                            <?if(SHOW_PRICE === "Y"):?>
						    	<td>
						    		<div class="cart-sum" data-currency="1">
						    			<span class="cart-sum__value"><?=number_format($option['SUM'], 0, '.', ' ')?></span> руб.
						    		</div>
						    	</td>
                            <?endif;?>
							<td class="cart-grid__cell_delete">
								<a class="cart-delete" href="javascript:;" title="Убрать из корзины">×</a><div class="cart-loading"><img src="/files/kom-sib/Design/cart-loader.gif"></div>
							</td>
						</tr>
					<?endforeach;?>
				<?endif;?>
			<?endforeach;?>
		</tbody>
	</table>
    <?if(SHOW_PRICE === "Y"):?>
	    <div class="bin-summary">
	    	Итого к оплате: <span class="bin-summary__value"><?=getPrintPrice($arResult['ORDER_INFO']['SUM'])?></span>
	    </div>
    <?endif;?>
	<?if(!empty($arResult['ITEMS'])):?>
	<div class="bin-contacts">
		<?if(!$USER->IsAuthorized()){?>
            <div class="bin-contacts-section">
		    	<a href="#authForm" class="bin-contacts__header js__openFormInPopup" title="У меня уже есть учетная запись, зайду из-под нее">У меня уже есть учетная запись, зайду из-под нее</a>
		    </div>
        <?}?>
		<div class="bin-contacts-section bin-contacts__section_state_opened">
			<div class="bin-contacts__header">
				Совершаю покупку впервые, учетной записи у меня нет
			</div>
			<div class="bin-contacts-section__content">
				<div class="bin-contacts-form bin-contacts-form_reg">
					<form id="basker-form" class="validate" novalidate="novalidate" action="" method="post" enctype="multipart/form-data">
						<div class="bin-contacts__intro">
							<div class="bin-contacts-subheader">
								Отправьте мне
							</div>
							<ul class="offer-type__list">
							<?foreach($arResult['PROPS'][$arParams['SEND_ME_PROP_ID']]['VALUES'] as $key => $variant):?>
								<li class="offer-type__item">
									<input<?=($variant['ID'] == $arResult['PROPS'][$arParams['SEND_ME_PROP_ID']]['VALUE'] ? ' checked="checked"' : '')?> id="offer<?=$variant['ID']?>" name="PROPS[<?=$arParams['SEND_ME_PROP_ID']?>]" type="radio" value="<?=$variant['ID']?>"> 
									<label for="offer<?=$variant['ID']?>"><?=$variant['NAME']?></label>
								</li>
							<?endforeach;?>
							</ul>
						</div>
						<div class="form-section">
							<ul class="field__list">
								<li class="field__item">
									<span class="field__title">Организация<span class="req">*</span></span>
									<div class="field__value">
										<input class="field required text-field" name="PROPS[20]" type="text" value="<?=$arResult['PROPS'][20]['VALUE']?>">
									</div>
									<div class="field__example">
										ООО «Компания», ИП Иванов Иван Иванович
									</div>
								</li>
							<li class="field__item">
								<span class="field__title">Адрес<span class="req">*</span></span>
									<div class="field__value">
										<input class="field required text-field" name="PROPS[21]" type="text" value="<?=$arResult['PROPS'][21]['VALUE']?>">
									</div>
								<div class="field__example">
									630124, Новосибирск, ул. Куприна, 8/1, оф. 3
								</div>
							</li>
							<li class="field__item">
								<span class="field__title">ИНН<span class="req">*</span></span>
								<div class="field__value">
									<input class="field required  text-field" name="PROPS[22]" type="text" value="<?=$arResult['PROPS'][22]['VALUE']?>">
								</div>
							</li>
							<li class="field__item">
								<span class="field__title">КПП<span class="req">*</span></span>
								<div class="field__value">
									<input class="field required  text-field" name="PROPS[23]" type="text" value="<?=$arResult['PROPS'][23]['VALUE']?>">
								</div>
							</li>
							<li class="field__item">
								<span class="field__title">Телефон<span class="req">*</span></span>
								<div class="field__value">
									<input class="field required  text-field phone-field" name="PROPS[24]" type="text" value="<?=$arResult['PROPS'][24]['VALUE']?>">
								</div>
								<div class="field__example">
									(383) 111-11-11
								</div>
							</li>
							<li class="field__item">
								<span class="field__title">Телефон дополнительный</span>
								<div class="field__value">
									<input class="field text-field phone-field" name="PROPS[25]" type="text" value="<?=$arResult['PROPS'][25]['VALUE']?>">
								</div>
								<div class="field__example">
									(383) 222-22-22
								</div>
							</li>
							<li class="field__item">
								<span class="field__title">Факс</span>
								<div class="field__value">
									<input class="field text-field phone-field" name="PROPS[26]" type="text" value="<?=$arResult['PROPS'][26]['VALUE']?>">
								</div>
								<div class="field__example">
									(383) 333-33-33
								</div>
							</li>
							</ul>
						</div>
						
						<div class="form-section">
							<ul class="field__list">
								<li class="field__item">
									<span class="field__title">Ф.И.О.<span class="req">*</span></span>
									<div class="field__value">
										<input class="field required text-field" name="PROPS[27]" type="text" value="<?=$arResult['PROPS'][27]['VALUE']?>">
									</div>
									<div class="field__example">
										Иванов Иван Иванович
									</div>
								</li>
								<li class="field__item register-field"<?=($arResult['POST']['FIELDS']['REGISTER'] != 'Y' ? ' style="display: none;"' : '')?>>
									<span class="field__title">E-mail<span class="req">*</span></span>
									<div class="field__value">
										<input class="field email<?=($arResult['POST']['FIELDS']['REGISTER'] == 'Y' ? ' required' : '')?> text-field" name="FIELDS[EMAIL]" type="email" value="<?=$arResult['POST']['FIELDS']['EMAIL']?>">
									</div>
								</li>
								<li class="field__item register-field"<?=($arResult['POST']['FIELDS']['REGISTER'] != 'Y' ? ' style="display: none;"' : '')?>>
									<span class="field__title">Пароль<span class="req">*</span></span>
									<div class="field__value">
										<input class="field<?=($arResult['POST']['FIELDS']['REGISTER'] == 'Y' ? ' required' : '')?> text-field" name="FIELDS[PASSWORD]" type="password" value="">
									</div>
								</li>
								<li class="field__item register-field"<?=($arResult['POST']['FIELDS']['REGISTER'] != 'Y' ? ' style="display: none;"' : '')?>>
									<span class="field__title">Пароль еще раз<span class="req">*</span></span>
									<div class="field__value">
										<input class="field<?=($arResult['POST']['FIELDS']['REGISTER'] == 'Y' ? ' required' : '')?> text-field" name="FIELDS[CONFIRM_PASSWORD]" type="password" value="">
									</div>
								</li>
								<li class="field__item">
									<span class="field__title">Дополнительная информация</span>
									<div class="field__value">
										<textarea class="field comment-field" name="PROPS[30]"><?=$arResult['PROPS']['30']['VALUE']?></textarea>
									</div>
									<div class="field__example">
										Примечания, способ доставки, оформить договор…
									</div>
								</li>
								<li class="field__item">
									<span class="field__title">Прикрепить файл</span>
									<div class="field__value">
										<input type="file" name="PROPS[28]">
									</div>
								</li>
							</ul>
						</div>
						
						<div class="form-actions">
							<?if(empty($arParams['USER_ID'])):?>
							<div class="form-remember">
								<input<?=($arResult['POST']['FIELDS']['REGISTER'] == 'Y' ? ' checked="checked"' : '')?> id="remember" name="FIELDS[REGISTER]" type="checkbox" value="Y">
								<label for="remember">Запомнить меня</label>
							</div>
							<?endif;?>
							<input class="submit" type="submit" name="confirmOrder" value="Отправить заказ">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?endif;?>
<?endif;?>
</div>