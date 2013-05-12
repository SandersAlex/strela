<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<!--<pre>--><?//print_r($arResult)?><!--</pre>-->
<div>
	<form method="GET">
		<h2>Подобрать по своствам:</h2>
		<?foreach ($arResult['FORMS'] as $key => $vol): ?>
			<div class = "option_filter"><?=$key?> <?=$vol?></div>
		<? endforeach?>
		<div style="clear: both">
			<input class="sub_a" type="submit" value="Подобрать">
		</div>
	</form>
</div>


