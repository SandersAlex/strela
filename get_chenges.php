<?
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
	$APPLICATION->SetTitle("Title");
?>
<?
	CModule::IncludeModule('my_module');
	CModule::IncludeModule('iblock');
	CModule::IncludeModule('catalog');


	$time = microtime();
	$res = velo::GetPriceVeloByComPredlozh();

	foreach ($res as $item) {
		$fields = array(
			'PRODUCT_ID' => $item['ID'],
			'CATALOG_GROUP_ID' => 2,
			'PRICE' => $item['price'],
			'CURRENCY' => "RUB",
		);
		$res = CPrice::GetList(
		        array(),
		        array(
		                "PRODUCT_ID" => $item['ID'],
		                "CATALOG_GROUP_ID" => 2
		            )
		    );

		if ($arr = $res->Fetch())
		{
		    CPrice::Update($arr["ID"], $fields);
		}
		else
		{
		    CPrice::Add($fields);
		}
	}
	echo $time = microtime() - $time;
?>
	<pre><?print_r($res)?></pre>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php"); ?>