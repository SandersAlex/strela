<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
include_once('classes/velo_catalog.php');

CModule::IncludeModule('iblock');


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
    $filter = array('IBLOCK_ID' => $key,);
    $arResult['ITEMS'][$vol] = $key;
}


$arResult['ITEMS']['Велосипеды'] = array('brands' => velo_catalog::getBrends());


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

$value = null;
$types = array();

foreach ($arResult['ITEMS']['Велосипеды']['types'] as $value) {

    if ($value == 'Детские') {
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
$arResult['ITEMS']['Велосипеды']['types'] = $types;


$this->IncludeComponentTemplate();
?>