<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<!--<pre>--><?//print_r($arResult)?><!--</pre>-->
<?
$array = array();
CModule::IncludeModule('my_module');
foreach ($arResult['OFFERS'] as $offer) {
	foreach ($offer['DISPLAY_PROPERTIES']['CML2_ATTRIBUTES']['VALUE'] as $key => $atr) {
		$array[$offer['ID']][] = $atr . " ";
		$colors[]              = $atr[1];
		$size[]                = $atr[0];
		//		$offer['DISPLAY_PROPERTIES']['CML2_ATTRIBUTES']['DESCRIPTION'][$key] . " : " .
	}
	//        $colors[$offer['ID']] = $offer['DISPLAY_PROPERTIES']['CML2_ATTRIBUTES']['VALUE'][1];
	//        $radius[$offer['ID']] = $offer['DISPLAY_PROPERTIES']['CML2_ATTRIBUTES']['VALUE'][0];
}
$pics = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array(
	'width' => 186,
	'height' => 186
));

?>
<!--    --><? //= count($arResult['OFFERS'])?>
<pre><?print_r($array)?></pre>

<div class = "main_picture">
	<div class = "big_picture">
		<a href = "<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" class = 'cloud-zoom' id = 'zoom1' rel = "adjustX: 10, adjustY:-4, softFocus:true">
			<img src = "<?= $pics['src'] ?>" alt = ""/>
		</a>
	</div>
	<?if (count($arResult['PROPERTIES']['FILES']['VALUE']) > 0): ?>
		<? foreach ($arResult['PROPERTIES']['FILES']['VALUE'] as $photo): ?>
			<div class = "small_picture">
				<img src = "<?= CFile::ResizeImageGet($photo, array(
					'width' => 50,
					'height' => 50
				)) ?>" alt = ""/>
			</div>
		<? endforeach ?>
	<? endif?>
</div>


<div class = "opisanie">
	<h4><?=$arResult['NAME']?></h4>

	<div class = "price1">17 900 ���</div>

	<form method = "post" action = "#">
		<input type = "submit" name = "text" class = "sub2" value = "� �������"/>

		<div class = "clear"></div>
		<p>� �������</p>

		<p>������ �� �����: <input type = "text" id = "growth" class = "text-form"/>
			<a href = "#" id = "btn_calc_frame_size">���������</a>
		</p>


		<div id = "frame_size_content" class = "m10"></div>


		<?if ((bool)$array): ?>
			<div class = "select_main">
				<span>�������� ������:</span>
				<ul class = "select_size">
					<?foreach ($array as $size): ?>
						<li><a href = "#"><?=$size[0]?></a></li>
					<? endforeach?>
				</ul>
			</div>
			<div class = "clear"></div>

			<div class = "select_main">
				<span>�������� ����:</span>
				<ul class = "setting_color">
					<?foreach ($array as $color): ?>
						<li><a href = "#"><?=$color[1]?></a></li>
					<? endforeach?>
				</ul>
			</div>
		<? endif?>


	</form>

</div>
<div class = "clear"></div>

<table class = "option" cellpadding = "0" cellspacing = "0">
	<?
	$types = array(
		'������' => 'GORNYE',
		'������ �������' => 'GORNYE_ZHENSKIE',
		'������ �����������' => 'GORNYE_DVUKHPODVESY',
		'������ 29"' => 'GORNYE_29',
		'��������' => 'DOROZHNYE',
		'������������' => 'PODROSTKOVYE',
		'��������������' => 'TSIKLOKROSSOVYE',
		'�������' => 'DETSKIE',
		'���������' => 'SHOSSEYNYE',
		'��������' => 'SKLADNYE',
		'���������' => 'GIBRIDNYE',
		'�������' => 'ELEKTRO',
	);
	?>
	<?foreach ($arResult['PROPERTIES'] as $key => $prop): ?>
		<? if ($prop['VALUE'] != '' && !is_array($prop['VALUE']) && $prop['NAME'] != '������� �������' && !in_array($key, $types)
		): ?>
			<tr>
				<td width = "300"><b><?=$prop['NAME']?></b></td>
				<td><?=$prop['VALUE']?></td>
			</tr>
		<? endif ?>
	<? endforeach?>
</table>
<div class = "marg">
	<p> <?=str_replace("\n", "<br>", $arResult['DETAIL_TEXT'])?></p>
</div>
<div class = "clear"></div>
