<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
	CModule::IncludeModule('iblock');
	include_once('classes/velo_catalog.php');

	$base = array(
		'17' => 'Аксессуары',
		'9' => 'Велосипеды',
		'19' => 'Велозапчасти',
		'21' => 'Велоэкипировка',
		'24' => 'Велоинструменты',
		'26' => 'Автомасла',
		'28' => 'Аккумуляторы',
	);


	foreach ($base as $key => $vol) {
		$filter                  = array('IBLOCK_ID' => $key,);
		$arResult['ITEMS'][$vol] = $key;
	}

	//    получаем бренды
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
	$arResult['ITEMS']['Велосипеды'] = array('brands' => $result);


	$arResult['ITEMS']['Велосипеды']['types'] = array(
		'Горные',
		'Горные женские',
		'Горные 29\'',
		'Горные двухподвесные',
		'Гибридные',
		'Дорожные',
		'Складные',
		'Подростковые',
		'Детские',
		'Самокаты',
		'Шоссейные',
		'Циклокроссовые',
		'Электро',
	);
	$value                                    = null;
	$types                                    = array();
	foreach ($arResult['ITEMS']['Велосипеды']['types'] as $value) {
		$types[$value] = velo_catalog::getBrandsByType($value);
	}
	$arResult['ITEMS']['Велосипеды']['types'] = $types;


	$this->IncludeComponentTemplate();
?>