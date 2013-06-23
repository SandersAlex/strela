<?
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if($_POST['datas']){
    $result = json_decode($_POST['datas']);
    if(is_array($result)){
        echo "<pre>".print_r($result)."</pre>";
    }else{
        echo false;
    }
}
//	$APPLICATION->SetTitle("Title");
//	$array = array(
//		'ITEMS' => array(
//			array(
//				'ID' => 1,
//				'NAME' => 'TEST_NAME'
//			),
//			array(
//				'ID' => 1,
//				'NAME' => 'TEST_NAME'
//			),
//		)
//	);
?>
<!--	<pre>--><?//print_r($array)?><!--</pre>-->
<!--	--><?//= json_encode($array) ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php"); ?>