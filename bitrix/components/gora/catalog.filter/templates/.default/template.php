<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<div class = "clear"></div>
<h2>Подобрать по своствам:</h2>
<div class = "filtr">
	<form action = "">
		<table class = "tab_left">
			<? foreach ($arResult['FORMS']['select'] as $key => $vol): ?>
				<tr>
					<td><?= $key ?>:</td>
					<td>
						<?= $vol ?>
					</td>
				</tr>
			<? endforeach ?>
		</table>
		<table class = 'tab_right'>
			<? foreach ($arResult['FORMS']['checkbox'] as $vol): ?>
				<?= $vol ?>
			<? endforeach ?>
		</table>
		<div class = "clear"></div>
		<div class = "center_sub">
			<input type = "reset" name = "reset" value = "Сбросить" class = "sub4"/>
			<input type = "submit" name = "submit" value = "Подобрать" class = "sub4"/>
		</div>
	</form>
</div>
<div class = "clear"></div>
<!--<pre>--><?// print_r($arResult['debug']) ?><!--</pre>-->
<!--<div>-->
<!--	<form action = "/velo/" method = "GET">-->
<!--		<h2>Подобрать по своствам:</h2>-->
<!--		--><? // foreach ($arResult['FORMS']['select'] as $key => $vol): ?>
<!--			<div class = "option_filter">--><?//= $key ?><!-- --><?//= $vol ?><!--</div>-->
<!--		--><? // endforeach ?>
<!--		<div style = "clear: both">-->
<!--			<input class = "sub_a" type = "submit" value = "Подобрать">-->
<!--		</div>-->
<!--	</form>-->
<!--</div>-->


