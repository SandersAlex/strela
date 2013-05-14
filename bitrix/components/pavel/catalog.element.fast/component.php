<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

	CModule::IncludeModule('my_module');
	CModule::IncludeModule('iblock');

	if($_REQUEST['ELEMENT_ID']){
		$res = CIBlockElement::GetByID($_REQUEST['ELEMENT_ID'])->GetNextElement();
		$props = $res->GetProperties();
		$fields = $res->GetFields();
		$fields['PROPERIES'] = $props;
		$arResult = $fields;
		$arResult['OFFERS'] = velo::GetOffers($arResult['ID']);
		$arResult['COLORS'] = velo::GetColorsByTovarID($arResult['ID']);
		$arResult['SIZE'] = velo::GetSizeByTovarID($arResult['ID']);
	}else{
		$arResult['ERRORS'] = 'Нет ни одного элемента';
	}



	$this->IncludeComponentTemplate();
?>