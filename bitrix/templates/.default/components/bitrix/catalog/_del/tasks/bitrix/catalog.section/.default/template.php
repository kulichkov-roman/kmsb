<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])):?>
<script language='javascript'>
 var backurl = '<?=$arResult["SECTION_PAGE_URL"]?>';
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
  <th class="RecordsTableHeader">Описание / Состав</th>
 </tr>
	<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<tr valign="top">
   <td width="20%" class="Record"><b><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></b></td>
			<td class="Record">
    <p><font face="Verdana" size="2"><?=$arElement["PREVIEW_TEXT"]?></font></p>
    <p><font face="Verdana" size="2">
    <?if(is_array($arElement["PROPERTIES"]["gost"]["VALUE"]) && count($arElement["PROPERTIES"]["gost"]["VALUE"])):?>
     <b><?=$arElement["PROPERTIES"]["gost"]["NAME"]?></b>:
     <?
      for($i=0; $i < count($arElement["PROPERTIES"]["gost"]["VALUE"]); $i++)
      { 
        if($i)
          echo " / ";
        echo $arElement["PROPERTIES"]["gost"]["VALUE"][$i];
      }
     ?>
     <br>
    <?endif?>
    <?if(is_array($arElement["PROPERTIES"]["astm"]["VALUE"]) && count($arElement["PROPERTIES"]["astm"]["VALUE"])):?>
     <b><?=$arElement["PROPERTIES"]["astm"]["NAME"]?></b>:
     <?
      for($i=0; $i < count($arElement["PROPERTIES"]["astm"]["VALUE"]); $i++)
      { 
        if($i)
          echo " / ";
        echo $arElement["PROPERTIES"]["astm"]["VALUE"][$i];
      }
     ?>
     <br>
    <?endif?>
    <?if(is_array($arElement["PROPERTIES"]["din"]["VALUE"]) && count($arElement["PROPERTIES"]["din"]["VALUE"])):?>
     <b><?=$arElement["PROPERTIES"]["din"]["NAME"]?></b>:
     <?
      for($i=0; $i < count($arElement["PROPERTIES"]["din"]["VALUE"]); $i++)
      { 
        if($i)
          echo " / ";
        echo $arElement["PROPERTIES"]["din"]["VALUE"][$i];
      }
     ?>
     <br>
    <?endif?>
    <?if(is_array($arElement["PROPERTIES"]["en"]["VALUE"]) && count($arElement["PROPERTIES"]["en"]["VALUE"])):?>
     <b><?=$arElement["PROPERTIES"]["en"]["NAME"]?></b>:
     <?
      for($i=0; $i < count($arElement["PROPERTIES"]["en"]["VALUE"]); $i++)
      { 
        if($i)
          echo " / ";
        echo $arElement["PROPERTIES"]["en"]["VALUE"][$i];
      }
     ?>
     <br>
    <?endif?>
    <?/*
    <?if(is_array($arElement["PROPERTIES"]["number"]["VALUE"]) && count($arElement["PROPERTIES"]["number"]["VALUE"])):?>
     <b><?=$arElement["PROPERTIES"]["number"]["NAME"]?></b>:
     <?
      for($i=0; $i < count($arElement["PROPERTIES"]["number"]["VALUE"]); $i++)
      { 
        if($i)
          echo " / ";
        echo $arElement["PROPERTIES"]["number"]["VALUE"][$i];
      }
     ?>
     <br>
    <?endif?>
    */?>
    </font></p>
    <?if((is_array($arElement["PROPERTIES"]["complect"]["VALUE"]) && count($arElement["PROPERTIES"]["complect"]["VALUE"])) || (is_array($arElement["PROPERTIES"]["dop_tovars"]["VALUE"]) && count($arElement["PROPERTIES"]["dop_tovars"]["VALUE"]))):?>
     <b>Состав:</b>
     <table width="100%" border="0" cellspacing="0" cellpadding="2" class="RecordsTable">
      <?foreach($arElement["PROPERTIES"]["complect"]["VALUE"] as $sost):?>
       <?$res = CIBlockElement::GetByID($sost["ELEMENT"])?>
       <?if($elem = $res->Fetch()):?>
        <tr>
         <td class="Record">
          <?
           $elem["DETAIL_PAGE_URL"] = str_replace("#SITE_DIR#", "", $elem["DETAIL_PAGE_URL"]);
           $elem["DETAIL_PAGE_URL"] = str_replace("#CODE#", $elem["CODE"], $elem["DETAIL_PAGE_URL"]);
           $res = CIBlockSection::GetByID($elem["IBLOCK_SECTION_ID"]);
           $sec = $res->Fetch();
           $elem["DETAIL_PAGE_URL"] = str_replace("#SECTION_CODE#", $sec["CODE"], $elem["DETAIL_PAGE_URL"]);
          ?>
          <a href="<?=$elem["DETAIL_PAGE_URL"]?>"><?=$elem["NAME"]?></a>
         </td>
         <td class="Record" width="50" align="right"><?=$sost["COUNT"]?> шт.</td>
        </tr>
       <?endif?>
      <?endforeach?>
      <?foreach($arElement["PROPERTIES"]["dop_tovars"]["VALUE"] as $sost):?>
       <tr>
        <td class="Record"><?=$sost["NAME"]?></td>
        <td class="Record" width="50" align="right"><?=$sost["COUNT"]?> шт.</td>
       </tr>
      <?endforeach?>
     </table>
    <?endif?>
    <br>
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
	<?endforeach?>
 <tr><td colspan="4" align="right">&nbsp;<?/*<input type="hidden" name="backurl" value="<?=$arResult["SECTION_PAGE_URL"]?>"><input type="submit" name="apply" value="В корзину">&nbsp;&nbsp;&nbsp;<input type="submit" name="save" value="Купить">*/?></td></tr>
 </form>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?endif?>