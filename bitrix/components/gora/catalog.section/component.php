<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
    CModule::IncludeModule('iblock');

    function getBrandsByType($type)
    {
        $types = array(
            'Горные' => 'GORNYE',
            'Горные женские' => 'GORNYE_ZHENSKIE',
            'Горные двухподвесы' => 'GORNYE_DVUKHPODVESY',
            'Горные 29"' => 'GORNYE_29',
            'Дорожные' => 'DOROZHNYE',
            'Подростковые' => 'PODROSTKOVYE',
            'Циклокроссовые' => 'TSIKLOKROSSOVYE',
            'Детские' => 'DETSKIE',
            'Шоссейные' => 'SHOSSEYNYE',
            'Складные' => 'SKLADNYE',
            'Гибридные' => 'GIBRIDNYE',
            'Электро' => 'ELEKTRO',
        );
        $result = array();
        global $DB;

        $prop_id = $types[$type];

        $q = "SELECT
          brand.VALUE,
          element.ID,
          prop_type.CODE as CODE
        FROM
         b_iblock_element_property as prop,
         b_iblock_element_property as brand,
         b_iblock_property as prop_type,
         b_iblock_element as element
         WHERE
           prop_type.CODE = '{$prop_id}' AND
           prop.IBLOCK_PROPERTY_ID = prop_type.ID AND
           prop.VALUE IS NOT NULL  AND
           brand.IBLOCK_PROPERTY_ID = 73 AND
           element.ID = brand.IBLOCK_ELEMENT_ID AND
           element.ID = prop.IBLOCK_ELEMENT_ID
         GROUP BY
           brand.VALUE
        ";
        $CDBResult = $DB->Query($q);
        while ($t = $CDBResult->Fetch()) {
            $result[] = $t;
        }
        return $result;
    }


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

    //    получаем бренды
    $q = "
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

    //    получаем типы
//    $result = array();
//    $q = "
//    SELECT
//      prop.VALUE
//    FROM
//     b_iblock_element_property as prop
//     WHERE
//       prop.IBLOCK_PROPERTY_ID = 74
//       GROUP BY prop.VALUE
//    ";
//    $CDBResult = $DB->Query($q);
//    while ($t = $CDBResult->Fetch()) {
//        $result[] = $t;
//    }
//    $arResult['ITEMS']['Велосипеды']['types'] = $result;
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
    foreach ($arResult['ITEMS']['Велосипеды']['types'] as &$value) {
        $types[$value] = getBrandsByType($value);
    }
    $arResult['ITEMS']['Велосипеды']['types'] = $types;


    $this->IncludeComponentTemplate();
?>