<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="left-block-catalog">
    <?
    $res = CIBlock::GetByID($arParams["IBLOCK_ID"]);
    if($ar_res = $res->GetNext())
      echo "<h3>".$ar_res['NAME']."</h3>";
    ?>
    <div class="clear"></div>

    <ul class="menu_left">
        <li><span><?=GetMessage('CATALOG_ALL_BRAND')?></span>
        <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "strela-left-menu-block-all-brand", Array(
        	"IBLOCK_TYPE" => "goods",	// Тип инфоблока
        	"IBLOCK_ID" => "9",	// Инфоблок
        	"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
        	"SECTION_CODE" => "",	// Код раздела
        	"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
        	"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
        	"SECTION_FIELDS" => array(	// Поля разделов
        		0 => "",
        		1 => "",
        	),
        	"SECTION_USER_FIELDS" => array(	// Свойства разделов
        		0 => "",
        		1 => "",
        	),
        	"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
        	"CACHE_TYPE" => "A",	// Тип кеширования
        	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
        	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
        	),
        	false
        );?>
        </li>
	<?foreach($arResult["ITEMS_TIP"] as $arTip):?>
      <li><span><?=$arTip[0]["DISPLAY_PROPERTIES"]["TIP_VELOSIPEDA"]["DISPLAY_VALUE"]?></span>
        <ul class="vip_spisok">
            <?foreach($arTip as $arElement):?>
        	<?
        	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
        	?>
        	<li id="<?=$this->GetEditAreaId($arElement['ID']);?>">
        	    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a>
        	</li>
        	<?endforeach;?>
        </ul>
      </li>
    <?endforeach;?>
    </ul>
</div>