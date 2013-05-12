<?
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
    $APPLICATION->SetTitle("Велосипеды");
?> <?
    Global $arrFilter;

	CModule::IncludeModule('my_module');
    $arrFilter['PROPERTY_MARKA'] = isset($_REQUEST['BRAND']) ? urldecode($_REQUEST['BRAND']) : null;
    if (isset($_REQUEST['TYPE'])) {
        $arrFilter["PROPERTY_".$_REQUEST['TYPE']] = 'Да';
    }
    if (isset($_REQUEST['SEIZE'])) {
	    $res = explode("_",$_REQUEST['SEIZE']);
	    foreach($res as &$vol){
		    $vol .= "\"";
	    }
        $arrFilter["PROPERTY_RAZMER_KOLESA"] = $res;
    }
	foreach(velo_config::$proprs as $key=>$vol){
		if(isset($_REQUEST[$vol['CODE']]) && $_REQUEST[$vol['CODE']] != ''){
			$arrFilter["PROPERTY_".$vol['CODE']] = $_REQUEST[$vol['CODE']];
		}
	}

?> <?$APPLICATION->IncludeComponent(
	"gora:catalog.filter",
	"",
Array(),
false
);?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"velo_list",
	Array(
		"IBLOCK_TYPE" => "goods",
		"IBLOCK_ID" => "30",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"[object Object]",2=>"",),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(0=>"VES_BRUTTO_KG",1=>"KOL_VO_SKOROSTEY",2=>"MARKA",3=>"MATERIAL_RAMY",4=>"MODELNYY_GOD",5=>"RAZMER_RAMY",6=>"STRANA",7=>"TIP_VELOSIPEDA",8=>"CML2_ARTICLE",9=>"CML2_BASE_UNIT",10=>"CML2_TRAITS",11=>"CML2_TAXES",12=>"CML2_ATTRIBUTES",13=>"CML2_BAR_CODE",14=>"RAZMER_KOLESA",15=>"[object Object]",16=>"",),
		"OFFERS_FIELD_CODE" => array(0=>"",1=>"",),
		"OFFERS_PROPERTY_CODE" => array(0=>"",1=>"",),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_LIMIT" => "5",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => array(0=>"Обмен с сайтом",),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"CONVERT_CURRENCY" => "N",
		"OFFERS_CART_PROPERTIES" => array(),
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "modern",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>