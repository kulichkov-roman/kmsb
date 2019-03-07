<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<TABLE WIDTH=100% ALIGN=CENTER  CELLSPACING=0 CELLPADDING=0 BORDER=0 style="padding:10 20 10 20;">
 <tr>
  <TD width=70> 
  	<?if($arResult["DISPLAY_ACTIVE_FROM"]):?>
		  <?=$arResult["DISPLAY_ACTIVE_FROM"]?><br>
	  <?endif;?>
  </TD>
	 <td>
	  <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		  <h1><?=$arResult["NAME"]?></h1>
	  <?endif;?>
  </td>
 </tr>
 <tr>
  <td width="70">
   <?if(is_array($arResult["PREVIEW_PICTURE"])):?>
    <?if(is_array($arResult["DETAIL_PICTURE"])):?><a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" target="_blank"><?endif?>
		   <img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"  title="<?=$arResult["NAME"]?>">
	   <?if(is_array($arResult["DETAIL_PICTURE"])):?></a><?endif?>
   <?else:?>
    &nbsp;
   <?endif?>
  </td>
  <td style="text-align: justify;">
	  <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
		  <?echo $arResult["DETAIL_TEXT"];?>
   <?else:?>
		  <?echo $arResult["PREVIEW_TEXT"];?>
	  <?endif?>
  </td>
 </tr>
</table>