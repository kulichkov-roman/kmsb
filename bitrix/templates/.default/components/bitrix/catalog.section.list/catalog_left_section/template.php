<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//echo "<pre>"; var_dump($arResult); echo "</pre>";
?>

<div class="catalog-menu">
    <ul class="catalog-type__list">
        <li class="catalog-type__item"><span class="catalog-type__link catalog-type__link_state_active" title="Каталог"><span class="link-text">По всем товарам</span></span></li>
        <li class="catalog-type__item"><a href="<?=CATALOG_MANUFACTURERS_URL_KS?>" class="catalog-type__link" title="По производителям"><span class="link-text">По производителям</span></a></li>
    </ul>
    <div class="catalog-menu-tools">
        <div class="menu-toggler">
            <ul class="menu-toggle__list">
                <?
                if(!isset($_GET["balances"]))
                {
                    ?>
                    <li class="menu-toggle__item menu-toggle__item_state_active"><a href="javascript:;" class="menu-toggle__link" data-action="show-available" title="Показать только с остатками"><span class="link-text">Показать только с остатками</span></a></li>
                    <li class="menu-toggle__item"><a href="javascript:;" class="menu-toggle__link" data-action="show-all" title="Показать все"><span class="link-text">Показать все</span></a></li>
                    <?
                }
                else
                {
                    ?>
                    <li class="menu-toggle__item"><a href="javascript:;" class="menu-toggle__link" data-action="show-available" title="Показать только с остатками"><span class="link-text">Показать только с остатками</span></a></li>
                    <li class="menu-toggle__item menu-toggle__item_state_active"><a href="javascript:;" class="menu-toggle__link" data-action="show-all" title="Показать все"><span class="link-text">Показать все</span></a></li>
                    <?
                }
                ?>
            </ul>
        </div>
        <div class="menu-toggler">
            <ul class="menu-toggle__list">
                <li class="menu-toggle__item menu-toggle__item_state_active"><a href="javascript:;" class="menu-toggle__link" data-action="open-all" title="Развернуть все"><span class="link-text">Развернуть все</span></a></li>
                <li class="menu-toggle__item"><a href="javascript:;" class="menu-toggle__link" data-action="close-all" title="Свернуть все"><span class="link-text">Свернуть все</span></a></li>
            </ul>
        </div>
    </div>
	<?
	$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
	
	$CURRENT_DEPTH = $TOP_DEPTH;
	
	foreach($arResult["SECTIONS"] as $arSection)
	{
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		
		if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
		{
			if($CURRENT_DEPTH === 0)
			{
				if(isset($_GET["balances"]))
                {
                    $class = ' catalog-menu__list_mode_balances';
                }
                else
                {
                    $class = '';
                }
                $ulCurLvl = "<ul class='catalog-menu__list".$class."'>";
			}
			else
			{
				$ulCurLvl = "<ul class='catalog-menu__list catalog-menu__list-level-".$CURRENT_DEPTH."'>";
			}
			echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH), $ulCurLvl;
		}
		elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
		{
			echo "</li>";
		}
		else
		{
			while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
			{
				echo "</li>";
				echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
				$CURRENT_DEPTH--;
			}
			echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</li>";
		}
		
		$count = $arSection["UF_COUNT_ELEM"];
		$countBalance = $arSection["UF_COUNT_BALANCE"];

		if ($_REQUEST['SECTION_ID']==$arSection['ID'])
		{
			$link = '<b>'.$arSection["NAME"].$count.'</b>';
			$strTitle = $arSection["NAME"];
		}
		else
		{
			if($arSection["UF_POSITIVE_BALANCES"] !== '1')
            {
                $link = '<a class="catalog-menu__link" href="'.$arSection["SECTION_PAGE_URL"].'"><span class="link-text">'.$arSection["NAME"].'</span> <span class="catalog-menu__count">('.$count.')</span></a>';
            }
            else
            {
                if($arSection["UF_POSITIVE_BALANCES"] === '1')
                {
                    $arParseUrl = array_unique(explode("/", $arSection["SECTION_PAGE_URL"]));
                    $arParseUrl = array_diff($arParseUrl, array(''));

                    $urlStr = "/".$arParseUrl[1]."/".CATALOG_BALANCES_DIR_KS."/".$arParseUrl[2]."/";

                    $link = '<a class="catalog-menu__link" href="'.$arSection["SECTION_PAGE_URL"].'"><span class="link-text">'.$arSection["NAME"].'</span> <span class="catalog-menu__count">('.$count.')</span></a>';
                    $linkBalance = '<a class="catalog-menu__link js_positive-balances-link" href="'.$urlStr.'"><span class="link-text">'.$arSection["NAME"].'</span> <span class="catalog-menu__count">('.$countBalance.')</span></a>';
                }
                else
                {
                    $link = '<a class="catalog-menu__link" href="'.$arSection["SECTION_PAGE_URL"].'"><span class="link-text">'.$arSection["NAME"].'</span> <span class="catalog-menu__count">('.$count.')</span></a>';
                }
            }
		}
		echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
		?>
        <?if($arSection["UF_POSITIVE_BALANCES"] === '1'){?>
            <li class="catalog-menu__item js_positive-balances<?=$arSection["SELECTED"] === true ? " catalog-menu__item_state_active" : "";?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                <?=$link;?>
                <?=$linkBalance;?>
        <?} else {?>
            <li class="catalog-menu__item <?=$arSection["SELECTED"] === true ? " catalog-menu__item_state_active" : "";?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>"><?=$link?>
        <?}?>
        <?
		$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
	}
	
	while($CURRENT_DEPTH > $TOP_DEPTH)
	{
		echo "</li>";
		echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
		$CURRENT_DEPTH--;
	}
	?>
	<div class="catalog-summary">
        Всего <span class="catalog-summary__value"><?=$arResult["ELEMENTS_CNT"]?></span> <?=plural($arResult["ELEMENTS_CNT"], 'товар', 'товара', 'товаров');?>
    </div>
</div>