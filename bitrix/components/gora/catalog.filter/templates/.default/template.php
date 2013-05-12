<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<!--<pre>--><?//print_r($arResult['FORMS'])?><!--</pre>-->
<div>
	<form method="POST">
		<h2>Подобрать по своствам:</h2>
		<?foreach ($arResult['FORMS'] as $key => $vol): ?>
			<div class = "option_filter"><?=$key?> <?=$vol?></div>
		<? endforeach?>
		<div style="clear: both">
			<input type="submit" value="Подобрать">
		</div>
	</form>
</div>


