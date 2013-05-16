<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
    <?$APPLICATION->ShowHead()?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->SetAdditionalCSS("/include/css/style.css");?>
    <script type="text/javascript" src="/include/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="/include/js/script.js"></script>
    <script type="text/javascript" src="/include/js/jquery.carouFredSel-5.5.5-packed.js"></script>
    <script type="text/javascript" src="/include/js/click-carousel.js"></script>
    <script type="text/javascript" src="/include/js/cloud-zoom.1.0.2.js"></script>
    <script type="text/javascript" src="/include/js/main-script.js"></script>
    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <script type="text/javascript" src="/include/js/mootools-1.2.1.js"></script>
    <script src="/include/js/MenuMatic_0.68.3.js" type="text/javascript"></script>
    <script type="text/javascript">
        window.addEvent('domready', function() {
            var myMenu = new MenuMatic({ orientation:'vertical' });
        });
    </script>
    <script type="text/javascript">
        jQuery(function () {
            var frame_sizes = { "145-155":{ "cm":"0-48", "inc":"13.5-14", "un":"XS" }, "155-160":{ "cm":"48-51", "inc":"14-15", "un":"XS-S" }, "160-165":{ "cm":"48-51", "inc":"15-16", "un":"S" }, "165-170":{ "cm":"51-53", "inc":"16-17", "un":"S-M" }, "170-175":{ "cm":"53-55", "inc":"17-18", "un":"M" }, "175-180":{ "cm":"55-58", "inc":"18-19", "un":"M-L" }, "180-185":{ "cm":"58-61", "inc":"19-20", "un":"L" }, "185-190":{ "cm":"61-63", "inc":"20-21", "un":"L-XL" }, "190-195":{ "cm":"63-65", "inc":"21-24", "un":"XL" } };
            var allowed_size_unit = { "cm":"no", "inc":"yes", "un":"yes" };
            var no_size_param = false;

            function get_frame_size(size) {
                var select = [];

                var st = 0;
                for (i in frame_sizes) {
                    var val = i.split('-');
                    var min = Number(val[0]);
                    var max = Number(val[1]);

                    if (Number(size) >= min && Number(size) <= max) {
                        select[st] = frame_sizes[i];
                        select[st]['min'] = min;
                        select[st]['max'] = max;
                        st++;
                    }
                }

                if (select.length == 1)
                    return select[0];
                else if (select.length == 2) {
                    if (select[1].min > select[0].min)
                        return impl(select[0], select[1]);
                    else
                        return impl(select[1], select[0]);
                }
            }

            function impl(val1, val2) {
                cm1 = val1.cm.split('-')[0];
                inc1 = val1.inc.split('-')[0];
                un1 = val1.un.split('-')[0];

                cm2 = val2.cm.split('-');
                inc2 = val2.inc.split('-');
                un2 = val2.un.split('-');

                cm2 = cm2[1] != undefined ? cm2[1] : cm2[0];
                inc2 = inc2[1] != undefined ? inc2[1] : inc2[0];
                un2 = un2[1] != undefined ? un2[1] : un2[0];

                cm = cm1 != cm2 ? cm1 + '-' + cm2 : cm1;
                inc = inc1 != inc2 ? inc1 + '-' + inc2 : inc1;
                un = un1 != un2 ? un1 + '-' + un2 : un1;

                return {'cm':cm, 'inc':inc, 'un':un};
            }

            function sel_duplicate_size(id) {
                if (assigner.getParentWindow().jQuery('#' + id).length != 0) {
                    assigner.getParentWindow().jQuery('span.radio.el-name-sizes').removeClass('check_radio');
                    assigner.getParentWindow().jQuery('#' + id).next().addClass('check_radio');
                }
            }

//            set_size_data(no_size_param, {});

            jQuery('#btn_calc_frame_size').on('click', function (e) {
                e.preventDefault();
                var growth = jQuery('#growth').val();

                jQuery('#frame_size_content').html('');

                if (growth == '') {
                    alert('Введите рост !');
                    return;
                }

                var message = '';
                if (growth < 145)
                    message = 'Вам подойдет детский или подростковый велосипед';
                else if (growth > 195)
                    frame_size_data = frame_sizes['190-195'];
                else
                    frame_size_data = get_frame_size(growth);

                if (message == '' && frame_size_data != undefined) {
                    jQuery('#frame_size_content').append('<div>Рекомендуемая ростовка велосипеда:</div>');
                    if (allowed_size_unit.cm == 'yes')
                        jQuery('#frame_size_content').append('<div>см. : ' + frame_size_data.cm + '</div>');
                    if (allowed_size_unit.inc == 'yes')
                        jQuery('#frame_size_content').append('<div>inc. : ' + frame_size_data.inc + '</div>');
                    if (allowed_size_unit.un == 'yes')
                        jQuery('#frame_size_content').append('<div>Un. : ' + frame_size_data.un + '</div>');
                }
                else
                    jQuery('#frame_size_content').append('<div>' + message + '</div>');
            });

            jQuery('span.radio.el-name-sizes').live('click', function (e) {
                var input = jQuery(this).prev();
                var matches = input.attr('id').match(/param_(\d+)_value_(\w+)/);
                var param_id = matches[1];
                var param_value = matches[2];

                var size_param = {};
                size_param[param_id] = param_value;
                set_size_data(no_size_param, size_param);
                set_basket_params(size_param);

                if (assigner.isPopup() && POPUP_IN_BASKET == false) {
                    if (assigner.getParentWindow().show_dialog_storage_empty()) {
                        sel_duplicate_size(input.attr('id'));
                        var basket_data = get_basket_data();
                        assigner.getParentWindow().to_basket(basket_data.id, basket_data.quant, basket_data.params);
                        assigner.getParentWindow().jQuery('#basket-add-' + basket_data.id).addClass('added');
                    }
                    assigner.getActiveWindow().assigner.close()
                }
            });
            jQuery('.basket_params').attr("autocomplete", "off");
        });
        jQuery(document).ready(function(){
            jQuery('.option tr:odd').css({
                'background': '#DEDEDE'
            });
        });

    </script>
</head>
<body> <?$APPLICATION->ShowPanel();?>
<div id="header">
    <div class="header_center">
        <div class="phone">
            <p>
              <?$APPLICATION->IncludeFile(
  	            SITE_DIR."include/file/header_title_phone.php",
  	            Array(),
  	            Array("MODE"=>"html")
                  );
              ?>
            </p>
            <h3>
              <?$APPLICATION->IncludeFile(
  	            SITE_DIR."include/file/header_phone.php",
  	            Array(),
  	            Array("MODE"=>"html")
                  );
              ?>
            </h3>
        </div>

        <div class="grafik">
            <p>
              <?$APPLICATION->IncludeFile(
  	            SITE_DIR."include/file/header_title_time_work.php",
  	            Array(),
  	            Array("MODE"=>"html")
                  );
              ?>
            </p>
            <h3>
              <?$APPLICATION->IncludeFile(
  	            SITE_DIR."include/file/header_time_work.php",
  	            Array(),
  	            Array("MODE"=>"html")
                  );
              ?>
            </h3>
        </div>
        <h1>
            <a href="<?=SITE_DIR?>">
                <img src="<?=SITE_DIR?>include/image/logo.png" alt=""/>
            </a>
        </h1>

        <?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "strela-header-auth", array(
	"REGISTER_URL" => SITE_DIR."auth/",
	"FORGOT_PASSWORD_URL" => SITE_DIR."auth/",
	"PROFILE_URL" => "",
	"SHOW_ERRORS" => "N",
	"AUTH_WHOLESALER" => SITE_DIR."test/"
	),
	false
);?>

        <?$APPLICATION->IncludeComponent(
        	"bitrix:sale.basket.basket.small",
        	"strela-header-basket",
        	Array(
        		"PATH_TO_BASKET" => "/personal/basket.php",
        		"PATH_TO_ORDER" => "/personal/order.php"
        	)
        );?>

        <div class="clear"></div>
          <?$APPLICATION->IncludeComponent(
          	"bitrix:search.title",
          	"strela-header-title",
          	Array(
          		"SHOW_INPUT" => "Y",
          		"INPUT_ID" => "title-search-input",
          		"CONTAINER_ID" => "title-search",
          		"PAGE" => "#SITE_DIR#search/index.php",
          		"NUM_CATEGORIES" => "1",
          		"TOP_COUNT" => "5",
          		"ORDER" => "date",
          		"USE_LANGUAGE_GUESS" => "Y",
          		"CHECK_DATES" => "N",
          		"SHOW_OTHERS" => "N",
          		"CATEGORY_0_TITLE" => "",
          		"CATEGORY_0" => ""
          	)
          );?>
    </div>
</div>

<?$dir = $APPLICATION->GetCurDir();      /*Name directory*/
    if ($dir == "/"):                   /*If it is main directory then  show main slader*/?>
<div id="slaider">
    <div class="menu_main">
        <?$APPLICATION->IncludeComponent("bitrix:menu", "strela-first-top-menu", array(
	"ROOT_MENU_TYPE" => "first_top",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "2",
	"CHILD_MENU_TYPE" => "first_inner_top",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
    </div>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "strela-main-slider", array(
	"IBLOCK_TYPE" => "information",
	"IBLOCK_ID" => "15",
	"NEWS_COUNT" => "",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "N",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "N",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
</div>
<?else:                        /*Else show special offer*/?>
<?$APPLICATION->IncludeComponent("bitrix:eshop.catalog.top", "strela-main-slider-special", array(
	"IBLOCK_TYPE_ID" => "goods",
	"IBLOCK_ID" => "30",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_COUNT" => "9",
	"FLAG_PROPERTY_CODE" => "",
	"OFFERS_LIMIT" => "15",
	"OFFERS_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"OFFERS_PROPERTY_CODE" => array(
		0 => "CML2_LINK",
		1 => "",
	),
	"OFFERS_SORT_FIELD" => "sort",
	"OFFERS_SORT_ORDER" => "asc",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600",
	"CACHE_GROUPS" => "Y",
	"DISPLAY_COMPARE" => "N",
	"PRICE_CODE" => array(
		0 => "Обмен с сайтом",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"DISPLAY_IMG_WIDTH" => "186",
	"DISPLAY_IMG_HEIGHT" => "186",
	"SHARPEN" => "30"
	),
	false
);?>
<?endif;?>

<div id="content">
<?$APPLICATION->IncludeComponent("bitrix:menu", "strela-second-top-menu", Array(
	"ROOT_MENU_TYPE" => "second_top",	// Тип меню для первого уровня
	"MENU_CACHE_TYPE" => "A",	// Тип кеширования
	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	"MAX_LEVEL" => "1",	// Уровень вложенности меню
	"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
	"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	"DELAY" => "N",	// Откладывать выполнение шаблона меню
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	),
	false
);?>

<div class="sidebar_L">
    <div class="clear"></div>
 <?$APPLICATION->IncludeComponent(
	"gora:catalog.section",
	"",
	Array(
		"IBLOCK_TYPE" => "goods",
		"IBLOCK_ID" => "9",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"FILTER_NAME" => "arrFilter_",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"PAGE_ELEMENT_COUNT" => "10000",
		"LINE_ELEMENT_COUNT" => "1",
		"PROPERTY_CODE" => array(0=>"TIP_VELOSIPEDA",1=>"",),
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
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "N",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => "",
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"CONVERT_CURRENCY" => "N",
		"OFFERS_CART_PROPERTIES" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>

    <div class="baner">
        <a href="#">
            <img src="<?=SITE_DIR?>include/image/baner.jpg" alt=""/>
        </a>
    </div>
</div>

<div class="sidebar_R">
    <?if ($dir != "/"):?>
        <h3><?$APPLICATION->ShowTitle(false);?></h3>
        <div class="clear"></div>
    <?endif;?>