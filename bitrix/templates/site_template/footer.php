<?
//-->
// Вся логика footer.php
$curDir = $APPLICATION->GetCurDir();
//<--
?>
                    </div><!--main-content-->
                </div><!--content-block-->
            </div><!--wrapper-wrap-->
        </div><!--wrapper-->
        <div class="footer">
            <div class="footer-wrap">
                <div class="copyright">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:main.include", "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => "/include/site_templates/copyright.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );
                    ?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include", "",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/include/site_templates/counters.php"
						)
					);?>
                </div>
                <div class="f-contacts">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:main.include", "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => "/include/site_templates/f-contacts.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );
                    ?>
                </div>
                <div class="developer">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:main.include", "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => "/include/site_templates/developer.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );
                    ?>
                </div>
                <div class="counter">
                    <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include", "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "/include/site_templates/google_analytics.php"
                    ));?>
					<?$APPLICATION->IncludeComponent(
                            "bitrix:main.include", "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "/include/site_templates/consultant.php"
                    ));?>
                </div>
            </div>
        </div>
        <div class="popup-wrap">
            <div id="feedbackForm" class="b-popup b-popup-form b-popup-form_feedback">
                <div class="popup__header">Обратная связь</div>
                <form name="ControlList307" action="" class="form validate request-form" method="post" enctype="multipart/form-data">
                    <ul class="field__list">
                        <li class="field__item">
                            <span class="field__title">Ф.И.О. <span class="req">*</span></span>
                            <div class="field__value">
                                <input type="text" name="Param4" class="field required text-field" title="Контактное лицо, организация" value="" />
                            </div>
                        </li>
                        <li class="field__item">
                            <span class="field__title">E-mail <span class="req">*</span></span>
                            <div class="field__value">
                                <input type="text" name="Param5" class="field required email text-field" title="Электронная почта" value="" />
                            </div>
                        </li>
                        <li class="field__item">
                            <span class="field__title">Компания <span class="req">*</span></span>
                            <div class="field__value">
                                <input type="text" name="Param7" class="field text-field" value="" />
                            </div>
                        </li>
                        <li class="field__item">
                            <span class="field__title">ИНН</span>
                            <div class="field__value">
                                <input type="text" class="field text-field" name="INN" value="" />
                            </div>
                        </li>
                        <li class="field__item">
                            <span class="field__title">Контактный телефон:</span>
                            <div class="field__value">
                                <input type="text" name="Param6" class="field phone-field" value="" />
                            </div>
                        </li>
                        <li class="field__item field__item_comment">
                            <span class="field__title">Дополнительная информация</span>
                            <div class="field__value">
                                <textarea name="Content" class="field comment-field" id="textarea_Control314"></textarea>
                            </div>
                        </li>
                        <li class="field__item field__item_comment">
                            <span class="field__title">Прикрепить файл</span>
                            <div class="field__value">
                                <span class="auto-comment">Загрузить&nbsp;файл&nbsp;(*.*):&nbsp;</span><input type="file" name="Param3" />
                            </div>
                        </li>
                    </ul>
                    <div class="form-note">
                        <span class="req">*</span> Обязательно для заполнения
                    </div>
                    <input type="text" id="Field-243" name="AchField" title="Введите ваш номер телефона" value="" /><input type="submit" name="request" value="Отправить" class="submit" />
                </form>
            </div>
            <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "/include/site_templates/footer_popup_auth.php"
                )
            );?>
        </div>
    </body>
</html>