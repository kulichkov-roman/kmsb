<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])):?>
 <table width="100%">
	 <tr>
		 <td style="padding: 5px;">
    <?foreach($arResult["ITEMS"] as $arItem):?>
     <p align="justify">
		    <?if($arItem["DISPLAY_ACTIVE_FROM"]):?><?echo $arItem["DISPLAY_ACTIVE_FROM"]?><?endif?>
		    <?if($arItem["NAME"]):?>
			    <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
		    <?endif;?>
		    <?if($arItem["PREVIEW_TEXT"]):?>
			    <?echo $arItem["PREVIEW_TEXT"];?>
		    <?endif;?>
      <br><br>
     </p>
    <?endforeach;?>
   </td>
  </tr>
 </table>
<?endif?>