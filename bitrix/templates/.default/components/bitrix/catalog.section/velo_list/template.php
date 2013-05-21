<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<?CModule::IncludeModule('my_module')?>
<!--    <pre>--><?//print_r($arResult)?><!--</pre>-->
<? if (count($arResult["ITEMS"]) > 0): ?>
	<h3><?=$_REQUEST['BRAND']?></h3>
	<div class = "clear"></div>
	<?
	$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
	$arNotify     = unserialize($notifyOption);
	?>
	<? if ($arParams["FLAG_PROPERTY_CODE"] == "NEWPRODUCT"): ?>
		<h3 class = "newsale"><span></span><?=GetMessage("CR_TITLE_" . $arParams["FLAG_PROPERTY_CODE"])?></h3>
	<? elseif (strlen($arParams["FLAG_PROPERTY_CODE"]) > 0): ?>
		<h3 class = "hitsale"><span></span><?=GetMessage("CR_TITLE_" . $arParams["FLAG_PROPERTY_CODE"])?></h3>
	<?endif ?>

	<ul class = "tovar">

		<?foreach ($arResult["ITEMS"] as $key => $arItem):
			if (is_array($arItem)) {
				$offers = velo::GetOffers($arItem['ID']);
				$bPicture = is_array($arItem["DETAIL_PICTURE"]);
				?>
				<li>
					<? if ($bPicture): ?>
						<div class = "img_tovar">
							<a class = "link" href = "<?= $arItem["DETAIL_PAGE_URL"] ?>">
								<?$img = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array(
									'width' => 220,
									'height' => 150
								))?>
								<img class = "item_img" itemprop = "image" src = "<?= $img['src'] ?>" alt = "<?= $arElement["NAME"] ?>"/></a>
						</div>
					<? else: ?>
						<div class = "img_tovar">
							<a href = "<?= $arItem["DETAIL_PAGE_URL"] ?>">
								<div class = "no-photo-div-big" style = "height:130px; width:130px;"></div>
							</a>
						</div>
					<?endif ?>

					<p><?=$arItem["NAME"]?></p>
					<!--	<div class="buy">
							<div class="price">--><?
					if (is_array($arItem["OFFERS"]) && !empty($arItem["OFFERS"])) //if product has offers
					{
						if (count($arItem["OFFERS"]) > 1) {
							?>
							<div itemprop = "price" class = "price">
								<?
								//echo GetMessage("CR_PRICE_OT")."&nbsp;";
								echo $arItem["PRINT_MIN_OFFER_PRICE"];

								?>
							</div>
						<?
						}
						else {
							foreach ($arItem["OFFERS"] as $arOffer):?>
								<? foreach ($arOffer["PRICES"] as $code => $arPrice): ?>
									<? if ($arPrice["CAN_ACCESS"]): ?>
										<? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
											<div itemprop = "discount-price" class = "price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div><br>
											<div class = "old-price"><?=$arPrice["PRINT_VALUE"]?></div><br>
										<? else: ?>
											<div itemprop = "price" class = "price"><?=$arPrice["PRINT_VALUE"]?></div>
										<?endif ?>
									<? endif; ?>
								<? endforeach; ?>
							<?endforeach;
						}
					}
					else // if product doesn't have offers
					{
						foreach ($arItem["PRICES"] as $code => $arPrice):
							if ($arPrice["CAN_ACCESS"]):
								?>
								<? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
								<div itemprop = "price" class = "price discount-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div><br>
								<div itemprop = "price" class = "old-price"><?=$arPrice["PRINT_VALUE"]?></div>
							<? else: ?>
								<div itemprop = "price" class = "price"><?=$arPrice["PRINT_VALUE"]?></div>
							<?endif; ?>
							<?
							endif;
						endforeach;
					}
					?>
					<div class = "prop">Кол-во скоростей <span><?=$arItem['PROPERTIES']['KOL_VO_SKOROSTEY']['VALUE']?></span></div>
					<div class = "prop">Материал рамы <span><?=$arItem['PROPERTIES']['MATERIAL_RAMY']['VALUE']?></span></div>
					<div class = "prop">Диаметр колеса <span><?=$arItem['PROPERTIES']['RAZMER_KOLESA']['VALUE']?></span></div>
					<a class = "sub_a" href = "<?= $arItem["DETAIL_PAGE_URL"] ?>">Подробно</a>
					<!--		</div>

						   </div>    -->
					<? if (!(is_array($arItem["OFFERS"]) && !empty($arItem["OFFERS"])) && !$arItem["CAN_BUY"]): ?>
						<div class = "badge"><?=$offers[0]['PRICE'][0]['PRICE'];?> руб.</div>
					<? endif ?>
				</li>
			<?
			}
		endforeach;
		?>
	</ul>

	<?= $arResult['NAV_STRING'] ?>
<? elseif ($USER->IsAdmin()): ?>
	<h3 class = "hitsale"><span></span><?=GetMessage("CR_TITLE_" . $arParams["FLAG_PROPERTY_CODE"])?></h3>
	<div class = "listitem-carousel">
		<?=GetMessage("CR_TITLE_NULL")?>
	</div>
<?endif; ?>
