<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

	CModule::IncludeModule('my_module');



	$props = new velo_properties();

	foreach ($props->result as $key => $vol) {
		$forms[velo_properties::GetNamePropsByPropsCode($key)] = Form_alter::Select($vol, $key);
	}
	$arResult['result'] = $props;
	$arResult['FORMS'] = $forms;


	$this->IncludeComponentTemplate();
?>