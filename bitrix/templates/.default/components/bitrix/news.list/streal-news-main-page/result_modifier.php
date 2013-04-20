<?
$list_page = $arResult["LIST_PAGE_URL"];
$site_dir = SITE_DIR;
$list_page = str_replace("#SITE_DIR#/", $site_dir, $list_page);
$arResult["LIST_PAGE_URL_"] = $list_page;
?>