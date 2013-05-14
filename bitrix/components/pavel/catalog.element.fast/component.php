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
		$colorsAndSizes = Velo::GetOffers($arResult['ID']);
		if(is_array($colorsAndSizes)){
			foreach($colorsAndSizes as $value){
				if($value['DESCRIPTION'] == 'Размер'){
					$arResult['SIZES'][] = $value['VALUE'];
				}else{
					$arResult['COLORS'][] = $value['VALUE'];
				}
			}
		}
	}else{
		$arResult['ERRORS'] = 'Нет ни одного элемента';
	}



	$this->IncludeComponentTemplate();
?>