<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

	CModule::IncludeModule('my_module');


	$props = new velo_properties();

	foreach ($props->result as $key => $vol) {
		if ($vol[0]['type'] == 'select') {
			$forms[velo_properties::GetNamePropsByPropsCode($key)] = Form_alter::Select($vol, $key);
		}elseif($vol[0]['type'] == 'checkbox'){
			$forms[velo_properties::GetNamePropsByPropsCode($key)] = Form_alter::Select($vol, $key);
		}

	}
	$arResult['debug'] = $props->result;

	$arResult['result'] = $props;
	$arResult['FORMS']  = $forms;


	$this->IncludeComponentTemplate();
?>