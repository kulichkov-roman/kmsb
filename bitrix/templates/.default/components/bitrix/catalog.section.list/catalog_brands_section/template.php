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
		echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
		?>
        <li class="catalog-menu__item <?=$arSection["SELECTED"] === true ? " catalog-menu__item_state_active" : "";?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
            <a class="catalog-menu__link" href="<?=$arSection["SECTION_PAGE_URL"]?>"><span class="link-text"><?=$arSection["NAME"]?></span></a>
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
</div>