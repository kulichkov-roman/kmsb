<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script language='javascript'>
 function show_el()
 {
   var obj = document.getElementById('el');
   var obji = document.getElementById('img_el');
   if(obj)
   {
     if(obj.style.display == 'none'){
       obj.style.display = 'block';
       obji.src = "/images/signminus.gif";}
     else{
       obj.style.display = 'none';
       obji.src = "/images/signplus.gif";}
   }
 }
</script>
<?
 $display = 'none';
 $page = $APPLICATION->GetCurPage();
 if(strpos($page, "brands") !== false)
   $display = 'block';
?>
<table class="MenuTable" border="0" cellpadding="2" cellspacing="0" width="300">
 <tr> 
  <td class="RecordsTableHeaderCat2" valign="top"><a href="#" onClick="show_el(); return false;"><img id=img_el style="border: 0px solid ; width: 12px; height: 12px;" src="/images/signplus.gif"> По производителям</a></td>
 </tr>
</table>
<table id="el" class="MenuTable" style="display: <?=$display?>;" border="0" cellpadding="2" cellspacing="0" width="300">
<?foreach($arResult["ITEMS"] as $arItem):?>
 <tr>
  <td>
 	 <li><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="t"><b><?echo $arItem["NAME"]?></b></a></li>
  </td>
 </tr>
<?endforeach;?>
</table>