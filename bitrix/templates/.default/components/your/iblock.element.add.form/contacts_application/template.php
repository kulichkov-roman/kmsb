<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);

$ElementIdFields = array();

$FieldClasses = array(
  'FIO' => 'js__field-fio',
  'Email' => 'email'
);

if (!empty($arResult["PROPERTY_LIST"])) foreach ($arResult["PROPERTY_LIST"] as $propertyID){
  if (
    is_numeric($propertyID)
    && !empty($arResult["PROPERTY_LIST_FULL"][$propertyID]['CODE'])
    && isset($Fields[$arResult["PROPERTY_LIST_FULL"][$propertyID]['CODE']])
  ){
    $Fields[$arResult["PROPERTY_LIST_FULL"][$propertyID]['CODE']]['Preperty'] = $arResult["PROPERTY_LIST_FULL"][$propertyID];
  }else{
    foreach ($Fields as &$Field){
      if (!empty($Field['Id']) && $Field['Id'] == $propertyID){
        $Field['Preperty'] = $arResult["PROPERTY_LIST_FULL"][$propertyID];
        $Field['Preperty']['ID'] = $propertyID;
        break;
      }
    }
    unset($Field);
  }
}
?>

<div id="feedbackForm" class="b-popup b-popup-form b-popup-form_feedback">
    <div class="popup__header">Обратная связь</div>
    <div class="errors">
    <?
      $showForm = false;
      $showSuccessForm = false;
      if (!empty($arResult["ERRORS"])):?>
        <?ShowError(implode("<br />", $arResult["ERRORS"]));
        $showForm = true;?>
      <?endif;?>
      <?if (!empty($arResult["MESSAGE"])):?>
        <?
        $arResult["MESSAGE"] = 'Спасибо! Сообщение отправлено.';
        // ShowNote($arResult["MESSAGE"]);
        $showSuccessForm = true;?>
      <?endif;?>
    </div>  
    <form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" class="form validate request-form feedback__form" method="post" enctype="multipart/form-data">
    <input type="hidden" class="js__name-field" value="" />
    <input type="hidden" name="PROPERTY[NAME][0]" class="js__title-field" value="" />
    <input type="hidden" name="PROPERTY[XML_ID][0]" class="js__title-field" value="<?=rand('1000000', '10000000')?>"/>
    <?=bitrix_sessid_post()?>
	  <div style="display: none;">
          <input type="text" value="" size="25" name="NAME_USER_FALSE">
      </div>
      <?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
      <?if (!empty($arResult["PROPERTY_LIST"])):?>
        <ul class="field__list">
          <?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
            <?if ($propertyID != 'NAME' && !empty($arResult["PROPERTY_LIST_FULL"][$propertyID])):?>
              <?$Property = $arResult["PROPERTY_LIST_FULL"][$propertyID];?>
              <?if ($Property["PROPERTY_TYPE"] != 'E'):?>
                <? if(!empty($Property["GetPublicEditHTML"])) $Property["PROPERTY_TYPE"] = 'USER_TYPE';?>
                <li class="field__item">
                  <span class="field__title"><?=$Property['NAME'];?><?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="req">*</span><?endif;?></span>
                  <div class="field__value">
                    <?switch ($Property["PROPERTY_TYPE"]):
                        default: ?>
                      <?case 'N': ?>
                      <?case 'S': ?>
                            <?
							if($Property['CODE'] == 'Comment')
							{
								?>
								<textarea
									name="PROPERTY[<?=$propertyID?>][0]"
									class="field<?=(!empty($Property['IS_REQUIRED']) ? ' required' : '')?><?=(!empty($FieldClasses[$propertyID]) ? ' '.$FieldClasses[$propertyID] : '')?> comment-field"
									value=""
								></textarea>
								<?
							} else {
								?>
								<input
									type="text"
									name="PROPERTY[<?=$propertyID?>][0]"
									class="field<?=(!empty($Property['IS_REQUIRED']) ? ' required' : '')?><?=(!empty($FieldClasses[$Property['CODE']]) ? ' '.$FieldClasses[$Property['CODE']] : '')?> text-field"
									value=""
								>
								<?
							}
		                    ?>
                          <?break;?>
                      <?case 'T': ?>
                        <textarea
                            name="PROPERTY[<?=$propertyID?>][0]"
                            class="field<?=(!empty($Property['IS_REQUIRED']) ? ' required' : '')?><?=(!empty($FieldClasses[$propertyID]) ? ' '.$FieldClasses[$propertyID] : '')?> comment-field"
                            value=""
                        ></textarea>
                        <?break;?>
                      <?case 'USER_TYPE': ?>
                        <?switch ($Property["USER_TYPE"]):
                            default: ?>
                            <?=call_user_func_array(
                              $arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
		                          array(
			                          $Property,
			                          array(
				                          "VALUE" => '',
				                          "DESCRIPTION" => '',
			                          ),
			                          array(
				                          "VALUE" => "PROPERTY[".$propertyID."][0][VALUE]",
				                          "DESCRIPTION" => "PROPERTY[".$propertyID."][0][DESCRIPTION]",
				                          "FORM_NAME"=>"iblock_add",
			                          ),
		                          )
	                          );?>
                            <?break;?>
                          <?case 'HTML':?>
                            <textarea
                                name="PROPERTY[<?=$propertyID?>][0]"
                                class="field<?=(!empty($Property['IS_REQUIRED']) ? ' required' : '')?><?=(!empty($FieldClasses[$propertyID]) ? ' '.$FieldClasses[$propertyID] : '')?> comment-field"
                                value=""
                            ></textarea>
                            <?break;?>
                        	<?endswitch;?>
                        <?break;?>
                      <?case 'F': ?>
					              <input type="hidden" name="PROPERTY[<?=$propertyID?>][0]" value="" />
					              <input type="file" size="<?=$Property['COL_COUNT']?>" name="PROPERTY_FILE_<?=$propertyID?>_0" />
                        <?break;?>
                  	<?endswitch;?>
                  </div>
                </li>
              <?elseif(!empty($Property['CODE'])):?>
                <? $ElementIdFields[$Property['CODE']] = $Property;?>
              <?endif;?>
            <?endif;?>
          <?endforeach;?>
        <?endif;?>
      </ul>
      <?if(!empty($ElementIdFields['Person']['ID'])):?>
        <input
          type="hidden"
          name="PROPERTY[<?=$ElementIdFields['Person']['ID'];?>][0][VALUE]"
          class="js__person-field person-field"
          value=""
        />
      <?endif;?>
      <div class="form-note">
        <span class="req">*</span> Обязательно для заполнения
      </div>
      <div class="form-actions">
        <input name="iblock_submit" type="submit" class="submit" value="Отправить">
      </div>
    </form>
</div>
<?if($showForm){?>
  <script type="text/javascript">
    $(document).ready(function(){
      $('a[href="#feedbackForm"]').first().click();
    })
  </script>
<?} elseif($showSuccessForm) {?>
	<div id="feedbackSuccessForm" class="b-popup b-popup-form b-popup-form_feedback">
		<div style="font-size: 19px;"><?=$arResult["MESSAGE"]?></div>
	</div>
	<div style="display: none; visibility: hidden;">
		<a class="js__openFormInPopupFeedback" href="#feedbackSuccessForm"></a>
	</div>
	<script type="text/javascript">
	    $(document).ready(function(){
	      $('a[href="#feedbackSuccessForm"]').first().click();
	    })
  </script>
<?}?>
