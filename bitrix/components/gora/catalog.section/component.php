<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
    CModule::IncludeModule('iblock');

    function getBrandsByType($type)
    {
        $types = array(
            '������' => 'GORNYE',
            '������ �������' => 'GORNYE_ZHENSKIE',
            '������ �����������' => 'GORNYE_DVUKHPODVESY',
            '������ 29"' => 'GORNYE_29',
            '��������' => 'DOROZHNYE',
            '������������' => 'PODROSTKOVYE',
            '��������������' => 'TSIKLOKROSSOVYE',
            '�������' => 'DETSKIE',
            '���������' => 'SHOSSEYNYE',
            '��������' => 'SKLADNYE',
            '���������' => 'GIBRIDNYE',
            '�������' => 'ELEKTRO',
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

    //    �������� ������
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
    $arResult['ITEMS']['����������'] = array('brands' => $result);

    //    �������� ����
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
//    $arResult['ITEMS']['����������']['types'] = $result;
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
    foreach ($arResult['ITEMS']['����������']['types'] as &$value) {
        $types[$value] = getBrandsByType($value);
    }
    $arResult['ITEMS']['����������']['types'] = $types;


    $this->IncludeComponentTemplate();
?>