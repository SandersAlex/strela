<?
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
	$APPLICATION->SetTitle("ajax");
?>
<?
	$html = '';
	if (isset($_REQUEST['id']) && (bool)$_REQUEST['id']) {
		CModule::IncludeModule('iblock');

		$filter = array(
			'IBLOCK_ID' => 13,
			'PROPERTY_CML2_LINK' => $_REQUEST['id'],
		);
		$t      = CIblockElement::GetList(null, $filter);
		while ($res = $t->GetNextElement()) {
			$ttt              = $res->GetFields();
			$ttt['PROP']      = $res->GetProperty('CML2_ATTRIBUTES');
			$prop[$ttt['ID']] = array(
				'size' => $ttt['PROP']['VALUE'][0],
				'color' => $ttt['PROP']['VALUE'][1],
			);
		}

		foreach ($prop as $key => $vol) {
			if ($vol['size'] == $_REQUEST['size']) {
				$result[$key] = $vol['color'];

				$html .= "<li><a href = ''>{$vol['color']}</a></li>";
			}
		}
	}

	echo $html;
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php"); ?>