<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
	CModule::IncludeModule('iblock');
	include_once('classes/velo_catalog.php');

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
		$filter                  = array('IBLOCK_ID' => $key,);
		$arResult['ITEMS'][$vol] = $key;
	}

	//    �������� ������
	$q         = "
SELECT
      prop.VALUE
    FROM
     b_iblock_element_property as prop
     WHERE
       IBLOCK_PROPERTY_ID = 73
       GROUP BY prop.VALUE
    ";
	$CDBResult = $DB->Query($q);
	while ($t = $CDBResult->Fetch()) {
		$result[] = $t;
	}
	$arResult['ITEMS']['����������'] = array('brands' => $result);


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
	$value                                    = null;
	$types                                    = array();
	foreach ($arResult['ITEMS']['����������']['types'] as $value) {
		$types[$value] = velo_catalog::getBrandsByType($value);
	}
	$arResult['ITEMS']['����������']['types'] = $types;


	$this->IncludeComponentTemplate();
?>