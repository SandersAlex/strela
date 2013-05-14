<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<?$pics = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'],array(
	'width' => 200,
	'height' => 200,
))?>
<!--<pre>--><?//print_r($arResult['OFFERS'])?><!--</pre>-->
<div class = "main_picture">
	<div class = "big_picture">
		<a href = "<?= CFile::GetPath($arResult['DETAIL_PICTURE']) ?>" class = 'cloud-zoom' id = 'zoom1'
		   rel = "adjustX: 10, adjustY:-4, softFocus:true">
			<img src = "<?= $pics['src'] ?>" alt = ""/>
		</a>
	</div>
	<? if (count($arResult['PROPERTIES']['FILES']['VALUE']) > 0): ?>
		<? foreach ($arResult['PROPERTIES']['FILES']['VALUE'] as $photo): ?>
			<div class = "small_picture">
				<img src = "<?=
				CFile::ResizeImageGet($photo, array(
					'width' => 50,
					'height' => 50
				)) ?>" alt = ""/>
			</div>
		<? endforeach ?>
	<? endif ?>
</div>

<?$price = preg_replace("/(.*)\.[0-9]+/","$1",$arResult['OFFERS'][0]['PRICE'][0]['PRICE'])." ���."?>

<div class = "opisanie">
	<h4><?= $arResult['NAME'] ?></h4>

	<div class = "price1"><?= $price ?></div>

	<form method = "post" action = "#">
		<input type = "submit" name = "text" class = "sub2" value = "� �������"/>

		<div class = "clear"></div>
		<p>� �������</p>

		<p>������ �� �����: <input type = "text" id = "growth" class = "text-form"/>
			<a href = "#" id = "btn_calc_frame_size">���������</a>
		</p>


		<div id = "frame_size_content" class = "m10"></div>


		<? if (count($arResult['SIZE']) > 0): ?>
			<div class = "select_main">
				<span>�������� ������:</span>
				<ul class = "select_size">
					<? foreach ($arResult['SIZE'] as $vol): ?>
						<li><a href = "#"><?= $vol['VALUE'] ?></a></li>
					<? endforeach ?>
				</ul>
			</div>
		<? endif?>
		<? if (count($arResult['COLORS']) > 0): ?>
		<div class = "clear"></div>

		<div class = "select_main">
			<span>�������� ����:</span>
			<ul class = "setting_color">
				<? foreach ($arResult['COLORS'] as $color): ?>
					<li><a href = "#"><?= $color['VALUE'] ?></a></li>
				<? endforeach ?>
			</ul>
		</div>
		<? endif ?>


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
	<? foreach ($arResult['PROPERIES'] as $key => $prop): ?>
		<? if ($prop['VALUE'] != '' && !is_array($prop['VALUE']) && $prop['NAME'] != '������� �������' && !in_array($key, $types)
	): ?>
	<tr>
		<td width = "300"><b><?= $prop['NAME'] ?></b></td>
		<td><?= $prop['VALUE'] ?></td>
	</tr>
	<? endif ?>
	<? endforeach ?>
</table>
<div class = "marg">
	<p> <?= str_replace("\n", "<br>", $arResult['DETAIL_TEXT']) ?></p>
</div>
<div class = "clear"></div>

