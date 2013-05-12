<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}


	include_once('classes/velo_properties.php');

	$props = new velo_properties();

	foreach ($props->result as $key => $vol) {
		$forms[velo_properties::GetNamePropsByPropsCode($key)] = FORM::Select($vol, $key);
	}
	$arResult['result'] = $props->result;
	$arResult['FORMS'] = $forms;


	$this->IncludeComponentTemplate();
?>