<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<!--<pre>--><?//print_r($arResult)?><!--</pre>-->
<ul id = "nav">
	<? foreach ($arResult['ITEMS'] as $key => $item): ?>
	<li><a href = "<?= $item['LIST_PAGE_URL'] ?>"><?=$key?></a>
		<ul>
			<? if (isset($item['brands']) && !empty($item['brands'])): ?>
				<li><a href = "">Все Бренды</a>
					<ul>
						<? foreach ($item['brands'] as $k => $brand): ?>
						<li><a href = "/velo/<?= urlencode($brand['CODE']) ?>/"><?=$brand['VALUE'];?></a>
							<? endforeach;?>
					</ul>
				</li>
			<? endif;?>
			<?=velo_catalog::GetHtmlMenu($item['types'])?>
		</ul>
		<? endforeach;?>
</ul>

