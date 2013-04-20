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
        	"IBLOCK_TYPE" => "goods",	// ��� ���������
        	"IBLOCK_ID" => "9",	// ��������
        	"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID �������
        	"SECTION_CODE" => "",	// ��� �������
        	"COUNT_ELEMENTS" => "N",	// ���������� ���������� ��������� � �������
        	"TOP_DEPTH" => "1",	// ������������ ������������ ������� ��������
        	"SECTION_FIELDS" => array(	// ���� ��������
        		0 => "",
        		1 => "",
        	),
        	"SECTION_USER_FIELDS" => array(	// �������� ��������
        		0 => "",
        		1 => "",
        	),
        	"SECTION_URL" => "",	// URL, ������� �� �������� � ���������� �������
        	"CACHE_TYPE" => "A",	// ��� �����������
        	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
        	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
        	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
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