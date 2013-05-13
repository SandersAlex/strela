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
		$arResult['OFFERS'] = Velo::GetOffers($arResult['ID']);
	}else{
		$arResult['ERRORS'] = 'Нет ни одного элемента';
	}



	$this->IncludeComponentTemplate();
?>