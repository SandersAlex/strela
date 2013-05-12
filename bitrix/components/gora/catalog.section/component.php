<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
include_once('classes/velo_catalog.php');

CModule::IncludeModule('iblock');


$base = array(
    '17' => '����������',
    '9' => '����������',
    '19' => '������������',
    '21' => '��������������',
    '24' => '���������������',
    '26' => '���������',
    '28' => '������������',
);


foreach ($base as $key => $vol) {
    $filter = array('IBLOCK_ID' => $key,);
    $arResult['ITEMS'][$vol] = $key;
}


$arResult['ITEMS']['����������'] = array('brands' => velo_catalog::getBrends());


$arResult['ITEMS']['����������']['types'] = array(
    '������',
    '������ �������',
    '������ 29\'',
    '������ �������������',
    '���������',
    '��������',
    '��������',
    '������������',
    '�������',
    '��������',
    '���������',
    '��������������',
    '�������',
);

$value = null;
$types = array();

foreach ($arResult['ITEMS']['����������']['types'] as $value) {

    if ($value == '�������') {
        $types[] = array(
            'URL' => '/type/DETSKIE/',
            'VALUE' => $value,
            'SUBMENU' => velo_catalog::getBrandsByEge('DETSKIE'));
    } else {
        $types[] = array(
            'VALUE' => $value,
            'URL' => '/type/' . velo_catalog::$types[$value] . "/",
            'SUBMENU' => velo_catalog::getBrandsByType($value)
        );
    }

}
$arResult['ITEMS']['����������']['types'] = $types;


$this->IncludeComponentTemplate();
?>