<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>


<?$pics = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array(
	'width' => 200,
	'height' => 200,
))?>
<!--<pre>--><?//print_r($arResult['OFFERS'])?><!--</pre>-->
<div class = "main_picture">
	<div class = "big_picture">
		<a href = "<?= CFile::GetPath($arResult['DETAIL_PICTURE']) ?>" class = 'cloud-zoom big' id = 'zoom1'
		   rel = "adjustX: 20, adjustY:0, softFocus:true, zoomWidth: 200, zoomHeight : 200">
			<img id = 'small' src = "<?= $pics['src'] ?>" alt = ""/>
		</a>
	</div>
	<br>
	<? if (count($arResult['PROPERIES']['MORE_PHOTO']['VALUE']) > 0): ?>
		<? foreach ($arResult['PROPERIES']['MORE_PHOTO']['VALUE'] as $photo): ?>
			<?
			$small = CFile::ResizeImageGet($photo, array(
				'width' => 51,
				'height' => 51
			)) ?>
			<?
			$small_script = CFile::ResizeImageGet($photo, array(
				'width' => 200,
				'height' => 200
			)) ?>


			<div onClick = "ChangeIMG('<?= $small_script['src'] ?>', '<?= CFile::GetPath($photo) ?>')" class = "small_picture">
				<img src = "<?= $small['src'] ?>" alt = ""/>
			</div>
		<? endforeach ?>
	<? endif ?>
</div>

<? $price = preg_replace("/(.*)\.[0-9]+/", "$1", $arResult['OFFERS'][0]['PRICE'][0]['PRICE']) . " ���." ?>

<div class = "opisanie">
	<h4><?= $arResult['NAME'] ?></h4>

	<div class = "price1"><?= $price ?></div>

	<form method = "get" action = "<?=POST_FORM_ACTION_URI?>">
<!--		<input type="hidden" name="--><?//echo $arParams["ACTION_VARIABLE"]?><!--" value="BUY">-->
		<input type="hidden" value="<?=$arResult['COLORS'][0]['ID']?>" id="tovar_id" name="id">
		<input type="hidden" value="ADD2BASKET"  name="action">
		<input type = "submit" name = "ADD2BASKET"  class = "sub2" value = "� �������"/>

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
						<li><a rel="<?=$arResult['ID']?>" href = "#"><?= $vol['VALUE'] ?></a></li>
					<? endforeach ?>
				</ul>
			</div>
		<? endif?>
		<? if (count($arResult['COLORS']) > 0): ?>
			<div class = "clear"></div>

			<div id='colors_select' class = "select_main">
				<span>�������� ����:</span>
				<ul class = "setting_color">
					<? foreach ($arResult['COLORS'] as $color): ?>
						<li><a  href = "#"><?= $color['VALUE'] ?></a></li>
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
