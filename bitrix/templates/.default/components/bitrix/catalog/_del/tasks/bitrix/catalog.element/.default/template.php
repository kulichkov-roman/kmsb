<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script language='javascript'>
 var backurl = '<?=$arResult["DETAIL_PAGE_URL"]?>';
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
<table width="100%" cellspacing="0" cellpadding="10" border="0"> 
 <tr valign="top"> 
  <td> 
   <table cellpadding="10" cellspacing="0" width="100%" border="0"> 
    <tr align="center">
     <td>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
       <tr>
        <td><h2><?=$arResult["NAME"]?></h2></td>
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
    <?if(is_array($arResult["PROPERTIES"]["gost"]["VALUE"]) && count($arResult["PROPERTIES"]["gost"]["VALUE"])):?>
     <b><?=$arResult["PROPERTIES"]["gost"]["NAME"]?></b>:
     <?
      for($i=0; $i < count($arResult["PROPERTIES"]["gost"]["VALUE"]); $i++)
      { 
        if($i)
          echo " / ";
        echo $arResult["PROPERTIES"]["gost"]["VALUE"][$i];
      }
     ?>
     <br>
    <?endif?>
    <?if(is_array($arResult["PROPERTIES"]["astm"]["VALUE"]) && count($arResult["PROPERTIES"]["astm"]["VALUE"])):?>
     <b><?=$arResult["PROPERTIES"]["astm"]["NAME"]?></b>:
     <?
      for($i=0; $i < count($arResult["PROPERTIES"]["astm"]["VALUE"]); $i++)
      { 
        if($i)
          echo " / ";
        echo $arResult["PROPERTIES"]["astm"]["VALUE"][$i];
      }
     ?>
     <br>
    <?endif?>
    <?if(is_array($arResult["PROPERTIES"]["din"]["VALUE"]) && count($arResult["PROPERTIES"]["din"]["VALUE"])):?>
     <b><?=$arResult["PROPERTIES"]["din"]["NAME"]?></b>:
     <?
      for($i=0; $i < count($arResult["PROPERTIES"]["din"]["VALUE"]); $i++)
      { 
        if($i)
          echo " / ";
        echo $arResult["PROPERTIES"]["din"]["VALUE"][$i];
      }
     ?>
     <br>
    <?endif?>
    <?if(is_array($arResult["PROPERTIES"]["en"]["VALUE"]) && count($arResult["PROPERTIES"]["en"]["VALUE"])):?>
     <b><?=$arResult["PROPERTIES"]["en"]["NAME"]?></b>:
     <?
      for($i=0; $i < count($arResult["PROPERTIES"]["en"]["VALUE"]); $i++)
      { 
        if($i)
          echo " / ";
        echo $arResult["PROPERTIES"]["en"]["VALUE"][$i];
      }
     ?>
     <br>
    <?endif?>
    <?/*
    <?if(is_array($arResult["PROPERTIES"]["number"]["VALUE"]) && count($arResult["PROPERTIES"]["number"]["VALUE"])):?>
     <b><?=$arResult["PROPERTIES"]["number"]["NAME"]?></b>:
     <?
      for($i=0; $i < count($arResult["PROPERTIES"]["number"]["VALUE"]); $i++)
      { 
        if($i)
          echo " / ";
        echo $arResult["PROPERTIES"]["number"]["VALUE"][$i];
      }
     ?>
     <br>
    <?endif?>
    */?>
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
    <tr>
     <td>
      <?if((is_array($arResult["PROPERTIES"]["complect"]["VALUE"]) && count($arResult["PROPERTIES"]["complect"]["VALUE"])) || (is_array($arResult["PROPERTIES"]["dop_tovars"]["VALUE"]) && count($arResult["PROPERTIES"]["dop_tovars"]["VALUE"]))):?>
       <b>Состав:</b>
       <table width="100%" border="0" cellspacing="0" cellpadding="2" class="RecordsTable">
        <?foreach($arResult["PROPERTIES"]["complect"]["VALUE"] as $sost):?>
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
        <?foreach($arResult["PROPERTIES"]["dop_tovars"]["VALUE"] as $sost):?>
          <tr>
           <td class="Record"><?=$sost["NAME"]?></td>
           <td class="Record" width="50" align="right"><?=$sost["COUNT"]?> шт.</td>
          </tr>
        <?endforeach?>
       </table>
      <?endif?>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>