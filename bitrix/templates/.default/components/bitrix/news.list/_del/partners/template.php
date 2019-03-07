<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table cellpadding=0 cellspacing=0 width=100% >
	<tr>
		<td valign=top style="padding:10 30 10 30;" width=100%>
		 <B>Компания получила права представлять оборудование таких известных фирм как: <br></B>
   <?foreach($arResult["ITEMS"] as $arItem):?>
    <?$site = $arItem["PROPERTIES"]["site"]["VALUE"]?>
    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
     <tr>
      <td width='16'>&nbsp;</td>
      <td width='140'>&nbsp;</td><td width='16'>&nbsp;</td>
      <td width='*'>&nbsp;</td>
      <td width='16'>&nbsp;</td>
     </tr>
     <tr>
      <td>&nbsp;</td>
      <td width='140'>
       <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
        <?if($site):?><a href="http://<?=$site?>" target="_blank"><?endif?><img border='0' hspace='2' src='<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>' width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>"><?if($site):?></a><?endif?>
       <?else:?>
        &nbsp;
       <?endif?>
      </td>
      <td width='16'>&nbsp;</td>
      <td>
       <?if($site):?><a title='<?=$arItem["NAME"]?>' href="http://<?=$site?>" target="_blank"><?endif?><b><?=$arItem["NAME"]?></b><?if($site):?></a><?endif?><?if($arItem["PREVIEW_TEXT"]):?>  - <?=$arItem["PREVIEW_TEXT"]?><?endif?>
      </td>
     </tr>
    </table>
    <hr size="2" width="100%">
   <?endforeach;?>
   <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	   <br /><?=$arResult["NAV_STRING"]?>
   <?endif;?>
  </td>
 </tr>
</table>