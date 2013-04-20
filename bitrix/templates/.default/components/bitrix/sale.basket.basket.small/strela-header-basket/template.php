<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="basket">
        <?if (strlen($arParams["PATH_TO_BASKET"])>0):?>
            <a href="<?=$arParams["PATH_TO_BASKET"]?>">Корзина</a>
		<?endif;?>
		<?
        $quantity_all = 0;
        $prise_all = 0;
		foreach ($arResult["ITEMS"] as $v)
		{
			if ($v["DELAY"]=="N" && $v["CAN_BUY"]=="Y")
			{
             $quantity_all= $quantity_all + $v['QUANTITY'];
             $prise_all = $prise_all + $v['PRICE'];
			}
		}
		?>
        <p><?=GetMessage("TSBS_QUANTITY")?> <?=$quantity_all?> <?=GetMessage("TSBS_QUANTITY_ITEMS")?></p>
        <p><?=GetMessage("TSBS_PRICE")?> <?=$prise_all?> руб.</p>
</div>