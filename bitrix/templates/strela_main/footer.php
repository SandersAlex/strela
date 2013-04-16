<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
</div><?$APPLICATION->AddChainItem($APPLICATION->GetTitle());?>
<div class="clear"></div>

<?$APPLICATION->IncludeComponent("bitrix:news.list", "strela-banner-footer", array(
	"IBLOCK_TYPE" => "information",
	"IBLOCK_ID" => "14",
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
		0 => "REFERENCE",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
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
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

</div>
<div class="clear"></div>
<div id="footer">
    <div class="footer_center">
        <div class="adres">
            <a href="#">
                <img src="<?=SITE_DIR?>include/life.png" alt=""/>
            </a>
            <p>
              <?$APPLICATION->IncludeFile(
  	            SITE_DIR."include/file/fotter_title_address.php",
  	            Array(),
  	            Array("MODE"=>"html")
                  );
              ?>
            </p>
            <p>
              <?$APPLICATION->IncludeFile(
  	            SITE_DIR."include/file/fotter_address.php",
  	            Array(),
  	            Array("MODE"=>"html")
                  );
              ?>
            </p>
        </div>
        <div class="copyright">
            <p>
              <?$APPLICATION->IncludeFile(
  	            SITE_DIR."include/file/fotter_copyright.php",
  	            Array(),
  	            Array("MODE"=>"html")
                  );
              ?>
            </p>
            <p>
              <?$APPLICATION->IncludeFile(
  	            SITE_DIR."include/file/fotter_law.php",
  	            Array(),
  	            Array("MODE"=>"html")
                  );
              ?>
            </p>
        </div>
        <div class="develop">
            <p>Создание сайта</p>
            <a href="http://hit-media.ru">High-Tech Media</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    var slideshow = new TINY.slider.slide('slideshow', {
        id:'slider',
        auto:10,
        resume:false,
        vertical:false,
        navid:'pagination',
        activeclass:'current',
        position:0,
        rewind:false,
        elastic:false,
        left:'slideleft',
        right:'slideright'
    });
</script>
</body>
</html>