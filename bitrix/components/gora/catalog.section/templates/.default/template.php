<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<!--<pre>--><?//print_r($arResult)?><!--</pre>-->
<ul id="nav">
    <? foreach ($arResult['ITEMS'] as $key => $item): ?>
    <li><a href="<?=$item['LIST_PAGE_URL']?>"><?=$key?></a>
	<ul>
        <? if (isset($item['brands']) && !empty($item['brands'])): ?>
		<li><a href="">Все Бренды</a>
			<ul>
                <? foreach ($item['brands'] as $k => $brand): ?>
            <li><a href="/velo/<?=urlencode($brand['CODE'])?>/"><?=$brand['VALUE'];?></a>
                <? endforeach;?>
			</ul>
		</li>
        <? endif;?>
        <? if (isset($item['types']) && !empty($item['types'])): ?>
        <? foreach ($item['types'] as $k => $type): ?>
			<li>
				<a href="/type/<?=urlencode($type[0]['CODE'])?>/"><?=$k;?></a>
                <?if (isset($type[0]) && !empty($type[0])): ?>
				<ul>
                    <? foreach ($type as $id => $brandInType): ?>
					<li>
						<a href="/type/<?=$type[0]['CODE']?>/<?=urlencode($brandInType['VALUE'])?>/"><?=$brandInType['VALUE']?></a>
					</li>
                    <? endforeach;?>
				</ul>
                <? endif;?>
			</li>
            <? endforeach; ?>
        <? endif;?>
	</ul>
    <? endforeach;?>
</ul>

