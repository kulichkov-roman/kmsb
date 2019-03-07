<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (count($arResult["ITEMS"]) < 1)
	return;
?>

<div class="content-block">
	<h3><?=GetMessage("SDNW_TITLE")?><a href="/news/rss/" title="<?=GetMessage("SDNW_RSS")?>" class="rss-icon"></a></h3>
	<dl class="block-list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<dt><?=$arItem["DISPLAY_ACTIVE_FROM"]?></dt>
		<dd><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></dd>
	<?endforeach;?>
	</dl>

	<a href="<?=SITE_DIR?>news/"><?=GetMessage("SDNW_ALLNEWS")?></a>
</div>