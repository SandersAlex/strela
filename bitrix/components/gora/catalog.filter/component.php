<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

	CModule::IncludeModule('my_module');


	$props = new velo_properties();

	foreach ($props->result as $key => $vol) {
		if ($vol[0]['type'] == 'select') {
			$select[velo_properties::GetNamePropsByPropsCode($key)] = Form_alter::Select($vol, $key);
		}
		elseif ($vol[0]['type'] == 'checkbox') {
			$checkbox[velo_properties::GetNamePropsByPropsCode($key)] = Form_alter::Checkbox($vol, $key, velo_properties::GetNamePropsByPropsCode($key));
		}

	}
	$arResult['debug'] = $props->result;


	$arResult['result']            = $props;
	$arResult['FORMS']['select']   = $select;
	$arResult['FORMS']['checkbox'] = $checkbox;


	$this->IncludeComponentTemplate();
?>