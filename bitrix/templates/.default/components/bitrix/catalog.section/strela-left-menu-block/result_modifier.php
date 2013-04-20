<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption
foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arRes = array();
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement["PROPERTIES"][$pid], "catalog_out");
	}
	$arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $arRes;
}
?>
<?
foreach($arResult["ITEMS"] as $key => $arElement)
{
    $tip_this = $arElement["DISPLAY_PROPERTIES"]["TIP_VELOSIPEDA"]["DISPLAY_VALUE"];
    $tip_this = Cutil::translit($tip_this,"ru",array("replace_space"=>"-","replace_other"=>"-"));
    $arResult["ITEMS_TIP"][$tip_this][] = $arElement;

}
unset($arResult["ITEMS"]);
?>