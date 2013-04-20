<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="baner_down" id="carousel">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<li class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if($arItem["DISPLAY_PROPERTIES"]["REFERENCE"]["DISPLAY_VALUE"]):?>
				<a href="<?=htmlspecialcharsEx($arItem["DISPLAY_PROPERTIES"]["REFERENCE"]["VALUE"])?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="255" height="144" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/></a>
			<?else:?>
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="255" height="144" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
			<?endif;?>
		<?endif?>
	</li>
<?endforeach;?>
</ul>
