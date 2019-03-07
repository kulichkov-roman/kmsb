<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?global $BREND_ID?>
<?if(count($arResult["ITEMS"])):?>
<script language='javascript'>
 var backurl = '/brands/<?=$BREND_ID?>/';
 function add_in_basket(param, id)
 {
   if(id)
   {
     var obj = document.getElementById('cnt_'+id);
     if(obj)
     {
       if(param)
         var l_backurl = backurl;
       else
         var l_backurl = '/basket/';
       location.href = '/catalog/add_in_basket.php?id='+id+'&cnt='+obj.value+'&backurl='+l_backurl;
     }
   }
 }
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="3" class="RecordsTable">
 <form name="tovars" action="/catalog/add_in_basket_all.php" method="post">
 <tr align="left">
  <th width="20%" class="RecordsTableHeader">Название</th>
  <th width="15%" class="RecordsTableHeader">Фото</th>
  <th class="RecordsTableHeader">Описание</th>
 </tr>
 <?foreach($arResult["ITEMS"] as $arElement):?>
  <?$arElement["DETAIL_PAGE_URL"] = str_replace("#BREND_ID#", $BREND_ID, $arElement["DETAIL_PAGE_URL"])?>
	 <tr valign="top">
   <td width="20%" class="Record"><b><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></b></td>
			<td width="15%" class="Record" align="center"> 
	   <table width="100%" border="0" bordercolor="000000" cellspacing="0" cellpadding="0">
	    <tr>
      <td align="center" bgcolor="FFFFFF">
       <?if(is_array($arElement["PREVIEW_PICTURE"])):?>
						  <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>"  border="0" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a>
					  <?else:?>
						  <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img src="/images/noimage.jpg" width="80" height="30" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a>
					  <?endif?>
      </td>
     </tr>
    </table>
   </td>
		 <td class="Record">
    <p><font face="Verdana" size="2"><?=$arElement["PREVIEW_TEXT"]?></font></p>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
     <tr>
      <td align="right">&nbsp;<?if($arElement["PROPERTIES"]["price"]["VALUE"]):?><font face="Verdana" size="1">Цена: <?=$arElement["PROPERTIES"]["price"]["VALUE"]?> руб.</font><?endif?></td>
      <td align="right" width="100"><a href="#" onClick="document.getElementById('d_<?=$arElement["ID"]?>').style.display = 'block'; return false;">В корзину</a></td>
      <td width="1">
       <table border="0" cellpadding="5" cellspacing="0" id="d_<?=$arElement["ID"]?>" style="display: none; position: absolute; margin-left: -123px; margin-top: -58px; width: 123px; background-color: #fff; border: solid 1px #000; text-align: center;">
        <tr>
         <td align="center">
          <input type="text" size="4" name="cnt_<?=$arElement["ID"]?>" id="cnt_<?=$arElement["ID"]?>" value="<?if(array_key_exists("tov_".$arElement["ID"], $_COOKIE)):?><?=$_COOKIE["tov_".$arElement["ID"]]?><?else:?>1<?endif?>"><br><br>
          <input type="button" value="OK" onClick="add_in_basket(1, <?=$arElement["ID"]?>);">&nbsp;<input type="button" value="Отмена" onClick="document.getElementById('d_<?=$arElement["ID"]?>').style.display = 'none';">
         </td>
        </tr>
       </table>
       <img src="/images/1.gif" width="1" height="1">
      </td>
     </tr>
    </table>
   </td>
		</tr>
 <?endforeach;?>
 <tr><td colspan="4" align="right">&nbsp;<?/*<input type="hidden" name="backurl" value="/brands/<?=$BREND_ID?>/"><input type="submit" name="apply" value="В корзину">&nbsp;&nbsp;&nbsp;<input type="submit" name="save" value="Купить">*/?></td></tr>
 </form>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?endif?>