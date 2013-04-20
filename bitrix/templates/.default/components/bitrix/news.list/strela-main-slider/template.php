<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="sliderbutton" id="slideleft" onclick="slideshow.move(-1)"></div>
<div id="slider">
<ul>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
		    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="978" height="463" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
		<?endif?>
	</li>
<?endforeach;?>
</ul>
<ul id="pagination" class="pagination">
    <?$cnt=0;
    foreach($arResult["ITEMS"] as $arItem):?>
        <li onclick='slideshow.pos(<?=$cnt?>)'></li>
        <?$cnt++;
    endforeach;?>
</ul>
</div>
<div class="sliderbutton" id="slideright" onclick="slideshow.move(1)"></div>