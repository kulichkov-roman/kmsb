<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?global $BREND_ID?>
<script language='javascript'>
 var backurl = '/brands/<?=$BREND_ID?>/<?=$arResult["ID"]?>/';
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
<?
 $id_sec = $arResult["IBLOCK_SECTION_ID"];
 /*
 $chains = array();
 while($id_sec)
 {
   $res = CIBlockSection::GetByID($id_sec);
   if($sec = $res->Fetch())
   {
     $chains[] = array($sec["NAME"], $sec["CODE"]);
     $id_sec = $sec["IBLOCK_SECTION_ID"];
   }
 }
 
 for($i = count($chains)-1; $i >= 0; $i--)
   $APPLICATION->AddChainItem($chains[$i][0], "/catalog/".$chains[$i][1]."/");
 */
?>
<table width="100%" cellspacing="0" cellpadding="10" border="0"> 
 <tr valign="top"> 
  <td> 
   <table cellpadding="10" cellspacing="0" width="100%" border="0"> 
    <tr><td><h1><?=$arResult["PROPERTIES"]["h1"]["VALUE"] ? $arResult["PROPERTIES"]["h1"]["VALUE"] : $arResult["NAME"]?></h1></td></tr> 
    <tr align="center">
     <td>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
       <tr>
        <td align="center">
         <?if(is_array($arResult["PREVIEW_PICTURE"]) || is_array($arResult["DETAIL_PICTURE"])):?>
          <?if(is_array($arResult["DETAIL_PICTURE"])):?>
					      <a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" target="_blank"><img border="0" src="/upload/400/400/<?=$arResult["DETAIL_PICTURE"]["ID"]?>.jpg" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /></a>
				      <?else:?>
					      <img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
				      <?endif?>
         <?else:?>
          &nbsp;
         <?endif?>
        </td>
        <td width="150" align="right">
         <?if($arResult["PROPERTIES"]["price"]["VALUE"]):?>
          <p>Цена <?=$arResult["PROPERTIES"]["price"]["VALUE"]?> руб.</p>
         <?endif?>
         <a href="#" onClick="document.getElementById('d_<?=$arResult["ID"]?>').style.display = 'block'; return false;">В корзину</a>
         <table border="0" cellpadding="5" cellspacing="0" id="d_<?=$arResult["ID"]?>" style="display: none; position: absolute; margin-left: 27px; margin-top: -58px; width: 123px; background-color: #fff; border: solid 1px #000; text-align: center;">
          <tr>
           <td align="center">
            <input type="text" size="4" name="cnt_<?=$arResult["ID"]?>" id="cnt_<?=$arResult["ID"]?>" value="<?if(array_key_exists("tov_".$arResult["ID"], $_COOKIE)):?><?=$_COOKIE["tov_".$arResult["ID"]]?><?else:?>1<?endif?>"><br><br>
            <input type="button" value="OK" onClick="add_in_basket(1, <?=$arResult["ID"]?>);">&nbsp;<input type="button" value="Отмена" onClick="document.getElementById('d_<?=$arResult["ID"]?>').style.display = 'none';">
           </td>
          </tr>
         </table>
         <br>
         <?/*<a href="#" onClick="add_in_basket(0, <?=$arResult["ID"]?>); return false;">Купить</a>*/?>
        </td>
       </tr>
      </table>
     </td> 
    </tr>
    <tr>
     <td>
      <?if($arResult["DETAIL_TEXT"]):?>
		     <?=$arResult["DETAIL_TEXT"]?>
	     <?elseif($arResult["PREVIEW_TEXT"]):?>
		     <?=$arResult["PREVIEW_TEXT"]?>
	     <?endif;?>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>

<?php if($arResult["PROPERTIES"]["meta_title"]["VALUE"]) $APPLICATION->SetPageProperty("meta_title", $arResult["PROPERTIES"]["meta_title"]["VALUE"]);?>