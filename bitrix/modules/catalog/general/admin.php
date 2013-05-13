<?
IncludeModuleLangFile(__FILE__);
class CCatalogAdmin
{
	function get_sections_menu($IBLOCK_TYPE_ID, $IBLOCK_ID, $DEPTH_LEVEL, $SECTION_ID)
	{
		$arSections = array();
		$rsSections = CIBlockSection::GetList(array(
			"left_margin" => "ASC",
		), array(
			"IBLOCK_ID" => $IBLOCK_ID,
			"SECTION_ID" => $SECTION_ID,
		), false, array(
			"ID",
			"IBLOCK_SECTION_ID",
			"NAME",
			"LEFT_MARGIN",
			"RIGHT_MARGIN",
		));
		while ($arSection = $rsSections->Fetch())
		{
			$arSections[] = array(
				"text" => htmlspecialcharsex($arSection["NAME"]),
				"url" => "cat_section_admin.php?lang=".LANGUAGE_ID."&type=".$IBLOCK_TYPE_ID."&IBLOCK_ID=".$IBLOCK_ID."&find_section_section=".$arSection["ID"],
				"more_url" => array(
					"cat_section_admin.php?IBLOCK_ID=".$IBLOCK_ID."&find_section_section=".$arSection["ID"],
					"cat_section_edit.php?IBLOCK_ID=".$IBLOCK_ID."&find_section_section=".$arSection["ID"],
				),
				"title" => htmlspecialcharsex($arSection["NAME"]),
				"icon" => "iblock_menu_icon_sections",
				"page_icon" => "iblock_page_icon_sections",
				//"skip_chain" => true,
				"items_id" => "menu_catalog_category_".$IBLOCK_ID."/".$arSection["ID"],
				"module_id" => "catalog",
				"items" => ($arSection["RIGHT_MARGIN"] - $arSection["LEFT_MARGIN"]) > 1 ? CCatalogAdmin::get_sections_menu($IBLOCK_TYPE_ID, $IBLOCK_ID, $DEPTH_LEVEL + 1, $arSection["ID"]) : array(),
			);
		}
		return $arSections;
	}

	function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
	{
		global $USER;

		if (!CModule::IncludeModule("iblock"))
			return;
		//When UnRegisterModuleDependences is called from module uninstall
		//cached EventHandlers may be called
		if (defined("BX_CATALOG_UNINSTALLED"))
			return;

		$aMenu = array(
			"text" => GetMessage("CAT_MENU_ROOT"),
			"title" => "",
			"items_id" => "menu_catalog_list",
			"items" => array(),
		);
		$arCatalogs = array();
		$rsCatalog = CCatalog::GetList(array(
			"sort" => "asc",
		));
		while ($ar = $rsCatalog->Fetch())
		{
			if (!$ar["PRODUCT_IBLOCK_ID"])
				$arCatalogs[$ar["IBLOCK_ID"]] = 1;
		}
		$arIBlocksU = array();
		$rsIBlocks = CIBlock::GetList(array(
			"SORT" => "asc",
			"NAME" => "ASC",
		), array(
			"MIN_PERMISSION" => "U",
		));
		while ($arIBlock = $rsIBlocks->Fetch())
		{
			if (array_key_exists($arIBlock["ID"], $arCatalogs))
			{
				$arItems = array(
					array(
						"text" => GetMessage("CAT_MENU_PRODUCT_LIST"),
						"url" => "cat_product_admin.php?lang=".LANGUAGE_ID."&IBLOCK_ID=".$arIBlock["ID"]."&type=".urlencode($arIBlock["IBLOCK_TYPE_ID"]),
						"more_url" => array(
							"cat_product_admin.php?IBLOCK_ID=".$arIBlock["ID"],
							"cat_product_edit.php?IBLOCK_ID=".$arIBlock["ID"],
						),
						"title" => "",
						"page_icon" => "iblock_page_icon_elements",
						"items_id" => "menu_catalog_goods_".$arIBlock["ID"],
						"module_id" => "catalog",
					),
					array(
						"text" => htmlspecialcharsex(CIBlock::GetArrayByID($arIBlock["ID"], "SECTIONS_NAME")),
						"url" => "cat_section_admin.php?lang=".LANGUAGE_ID."&type=".$arIBlock["IBLOCK_TYPE_ID"]."&IBLOCK_ID=".$arIBlock["ID"]."&find_section_section=0",
						"more_url" => array(
							"cat_section_admin.php?IBLOCK_ID=".$arIBlock["ID"]."&find_section_section=0",
							"cat_section_edit.php?IBLOCK_ID=".$arIBlock["ID"]."&find_section_section=0",
						),
						"title" => "",
						"page_icon" => "iblock_page_icon_sections",
						"items_id" => "menu_catalog_category_".$arIBlock["ID"],
						"module_id" => "catalog",
						"items" => CCatalogAdmin::get_sections_menu($arIBlock["IBLOCK_TYPE_ID"], $arIBlock["ID"], 1, 0),
					),
				);
				if(CIBlockRights::UserHasRightTo($arIBlock["ID"], $arIBlock["ID"], "iblock_edit"))
				{
					$arItems[] = array(
						"text" => GetMessage("CAT_MENU_PRODUCT_PROPERTIES"),
						"url" => "iblock_property_admin.php?lang=".LANGUAGE_ID."&IBLOCK_ID=".$arIBlock["ID"]."&admin=N",
						"more_url" => array(
							"iblock_property_admin.php?IBLOCK_ID=".$arIBlock["ID"]."&admin=N",
							"iblock_edit_property.php?IBLOCK_ID=".$arIBlock["ID"]."&admin=N",
						),
						"title" => "",
						"page_icon" => "iblock_page_icon_settings",
						"items_id" => "menu_catalog_attributes_".$arIBlock["ID"],
						"module_id" => "catalog",
					);
				}

				$arCatalog = false;
				if (CModule::IncludeModule("catalog"))
					$arCatalog = CCatalog::GetSkuInfoByProductID($arIBlock["ID"]);

				if (is_array($arCatalog) && CIBlockRights::UserHasRightTo($arCatalog["IBLOCK_ID"], $arCatalog["IBLOCK_ID"], "iblock_edit"))
				{
					$arItems[] = array(
						"text" => GetMessage("CAT_MENU_SKU_PROPERTIES"),
						"url" => "iblock_property_admin.php?lang=".LANGUAGE_ID."&IBLOCK_ID=".$arCatalog["IBLOCK_ID"]."&admin=N",
						"more_url" => array(
							"iblock_property_admin.php?IBLOCK_ID=".$arCatalog["IBLOCK_ID"]."&admin=N",
							"iblock_edit_property.php?IBLOCK_ID=".$arCatalog["IBLOCK_ID"]."&admin=N",
						),
						"title" => "",
						"page_icon" => "iblock_page_icon_settings",
						"items_id" => "menu_catalog_attributes_".$arCatalog["IBLOCK_ID"],
						"module_id" => "catalog",
					);
				}

				if(CIBlockRights::UserHasRightTo($arIBlock["ID"], $arIBlock["ID"], "iblock_edit"))
				{
					$arItems[] = array(
						"text" => GetMessage("CAT_MENU_CATALOG_SETTINGS"),
						"url" => "cat_catalog_edit.php?lang=".LANGUAGE_ID."&IBLOCK_ID=".$arIBlock["ID"],
						"more_url" => array(
							"cat_catalog_edit.php?IBLOCK_ID=".$arIBlock["ID"],
						),
						"title" => "",
						"page_icon" => "iblock_page_icon_settings",
						"items_id" => "menu_catalog_edit_".$arIBlock["ID"],
						"module_id" => "catalog",
					);
				}

				$aMenu["items"][] = array(
					"text" => htmlspecialcharsEx($arIBlock["NAME"]),
					"title" => "",
					"page_icon" => "iblock_page_icon_sections",
					"items_id" => "menu_catalog_".$arIBlock["ID"],
					"module_id" => "catalog",
					"items" => $arItems,
				);
			}
		}
		if (!empty($aMenu["items"]))
		{
			if (count($aMenu["items"]) == 1)
				$aMenu = $aMenu["items"][0];

			$aMenu["parent_menu"] = "global_menu_store";
			$aMenu["section"] = "catalog_list";
			$aMenu["sort"] = 200;
			$aMenu["icon"] = "iblock_menu_icon_sections";
			$aMenu["page_icon"] = "iblock_page_icon_types";
			$aModuleMenu[] = $aMenu;
		}
	}

	function OnAdminListDisplay(&$obList)
	{
		global $USER;

		if(!preg_match("/^tbl_catalog_section_/", $obList->table_id))
			return;

		if(!is_object($USER) || !$USER->CanDoOperation("clouds_upload"))
			return;

		foreach($obList->aRows as $row_num => $obRow)
		{
			$obRow->aActions[] = array("SEPARATOR"=>true);
			$tmpVar = CIBlock::ReplaceDetailUrl($obRow->arRes["SECTION_PAGE_URL"], $obRow->arRes, true, "S");
			$obRow->aActions[] = array(
				"ICON" => "view",
				"TEXT" => GetMessage("CAT_ACT_MENU_VIEW_SECTION"),
				"ACTION" => $obList->ActionRedirect(htmlspecialcharsbx($tmpVar)),
			);
			$tmpVar = CIBlock::GetAdminElementListLink($obRow->arRes["IBLOCK_ID"], array(
				'find_section_section' => $obRow->arRes["ID"],
				'set_filter' => 'Y',
			));
			$obRow->aActions[] = array(
				"ICON" => "list",
				"TEXT" => CIBlock::GetArrayByID($obRow->arRes["IBLOCK_ID"], "ELEMENTS_NAME"),
				"ACTION" => $obList->ActionRedirect(htmlspecialcharsbx($tmpVar)),
			);
		}
	}
}
?>