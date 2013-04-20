<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul class="menu_top">
<?
if ($arResult["FORM_TYPE"] == "login"):
?>
	<li><a href="<?echo $arParams["REGISTER_URL"]."?login=yes"?>"><?=GetMessage("AUTH_LOGIN_BUTTON")?></a></li>
<?
	if($arResult["NEW_USER_REGISTRATION"] == "Y")
	{
?>
	<li><a href="<?=$arResult["AUTH_REGISTER_URL"]?>"><?=GetMessage("AUTH_REGISTER")?></a></li>
<?
	}
?>
<?
else:
?>
  <!--	<a href="<?=$arResult['PROFILE_URL']?>">  -->
<?
  //	$name = trim($USER->GetFullName());
  //	if (strlen($name) <= 0)
  //		$name = $USER->GetLogin();

  //	echo htmlspecialcharsEx($name);
?>
  <!--	</a>   -->
	<li><a href="<?=$APPLICATION->GetCurPageParam("logout=yes", Array("logout"))?>"><?=GetMessage("AUTH_LOGOUT_BUTTON")?></a></li>
<?
endif;
?>
<li><a href="<?=$arParams["AUTH_WHOLESALER"];?>"><?=GetMessage("AUTH_LOGOUT_WHOLESALER")?></a></li>
</ul>