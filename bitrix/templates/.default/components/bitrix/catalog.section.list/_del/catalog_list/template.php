<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script language='javascript'>
function show_sub(id)
{
	var obj = document.getElementById('sub_'+id);
	var imgo = document.getElementById('img_'+id);
	if(obj)
	{
	if(obj.style.display == 'none'){
		obj.style.display = 'block';
		if(imgo){
		imgo.src = "/images/signminus.gif";
		}
	}
	else{
		obj.style.display = 'none';
		if (imgo){
		imgo.src = "/images/signplus.gif";
		}
	}
	}
}
</script>
<?
$id_sec = 0;
$id_sec1 = 0;
$page = $APPLICATION->GetCurPage();
if(strpos($page, "catalog") !== false)
{
	$sec_code = "";
	$page = explode("/", $page);
	$sec_code = $page[2];
	$arFilter = Array('IBLOCK_ID'=>6, 'GLOBAL_ACTIVE'=>'Y', 'CODE'=>$sec_code);
	$db_list = CIBlockSection::GetList(Array(), $arFilter, false);
	if($sec = $db_list->Fetch())
	{
	if($sec["DEPTH_LEVEL"] == 1){
		$id_sec = $sec["ID"];
		$id_sec1 = $sec["ID"];
	}
	else
		$id_sec = $sec["IBLOCK_SECTION_ID"];
	}
} 

?>
<?$first = 1;?>
<?$ul = 0;?>
<?foreach($arResult["SECTIONS"] as $ind=>$arSection):?>
<?
	$href = "#";
	$plus = '<img id=img_'.$arSection["ID"].' style="border: 0px solid ; width: 12px; height: 12px;" src="/images/signplus.gif" alt="+  ">';
	$minus = '<img id=img_'.$arSection["ID"].' style="border: 0px solid ; width: 12px; height: 12px;" src="/images/signminus.gif" alt="+  ">';
	$dot = '<img style="border: 0px solid ; width: 12px; height: 12px;" src="/images/signdot.gif" alt="   ">';
	$click = 'show_sub('.$arSection["ID"].'); return false;';
?>
	<?if($arSection["DEPTH_LEVEL"] == 1):?>
		<?if(!$first):?>
			</table>
		<?else:?>
			<?$first = 0?>
		<?endif?>
<?
		if(count($arResult["SECTIONS"]) > $ind+1) // Если есть следующий элемент
			{
				if($arResult["SECTIONS"][$ind+1]["DEPTH_LEVEL"] == 1) // И DEPTH_LEVEL след. элемента = 1
					{
						$href = $arSection["SECTION_PAGE_URL"];
						$plus = '<img style="border: 0px solid ; width: 12px; height: 12px;" src="/images/signdot.gif" alt="   ">';
						$click = "";
						if($arSection["ID"] == $id_sec) $id_sec = 0;
					}
			}
		elseif($arSection["DEPTH_LEVEL"] == 1) // Если след. элемнета нет и DEPTH_LEVEL текущего элемента = 1
			{
				$href = $arSection["SECTION_PAGE_URL"];
				$plus = '<img style="border: 0px solid ; width: 12px; height: 12px;" src="/images/signdot.gif" alt="   ">';
				$click = "";
				if($arSection["ID"] == $id_sec) $id_sec = 0;
			}
?>
		<table class="MenuTable" border="0" cellpadding="2" cellspacing="0" width="300">
			<tr> 
				<td class="RecordsTableHeaderCat2" valign="top"><a href="<?=$href?>" onClick="<?=$click?>"> <?if($id_sec == $arSection["ID"]):?><?=$minus?><?else:?><?=$plus?><?endif?><b> <?=$arSection["NAME"]?></b></a></td>
			</tr>
		</table>
		<div align="right"><table id="sub_<?=$arSection["ID"]?>"  style="display: <?if($id_sec == $arSection["ID"]):?>block<?else:?>none<?endif?>;" border="0" cellpadding="2" cellspacing="0" width="<?=300-$arSection["DEPTH_LEVEL"]*20?>"></div>
	<?else:?>
		<tr>
			<td>
				<? if($arResult["SECTIONS"][$ind+1]["DEPTH_LEVEL"] > $arSection["DEPTH_LEVEL"]):?>
					<a href="<?=$href?>" onClick=show_sub(<?=$arSection["ID"]?>); return false;> <?if($id_sec == $arSection["ID"]):?><?=$minus?><?else:?><?=$plus?><?endif?><b> <?=$arSection["NAME"]?></b></a>
					<table id="sub_<?=$arSection["ID"]?>" style="display: <?if($id_sec == $arSection["ID"]):?>block<?else:?>none<?endif?>;" border="0" cellpadding="2" cellspacing="0" width="<?=300-$arSection["DEPTH_LEVEL"]*20?>" align="right" >
				  <?else:?>
					<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="t"><?=$dot?><b> <?=$arSection["NAME"]?></b></a> 
					</td>
					</tr>
					<?if($arResult["SECTIONS"][$ind+1]["DEPTH_LEVEL"] < $arSection["DEPTH_LEVEL"]):?>
						<?if(!($arSection["DEPTH_LEVEL"] == 2)):?>
						</table>
						<?endif?>
					<?endif?>
				 <?endif?>
	<?endif?>
<?endforeach?>

<?if(!$first):?>
</table>
<table class="MenuTable" border="0" cellpadding="2" cellspacing="0" width="300">
<tr><td class="RecordsTableHeaderCat2" valign="top">
<a href="/service" ><?=$dot?><b> Сервисный центр</b></a>
</td></tr></table>

<?endif?>