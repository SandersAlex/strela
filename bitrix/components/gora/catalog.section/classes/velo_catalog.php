<?
	class velo_catalog
	{
		function getBrandsByType($type)
		{
			$types  = array(
				'������' => 'GORNYE',
				'������ �������' => 'GORNYE_ZHENSKIE',
				'������ �����������' => 'GORNYE_DVUKHPODVESY',
				'������ 29\'' => 'GORNYE_29',
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

			$q         = "SELECT
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
				if ($type == '�������') {
					$t['submenu'] = self::getBrandsByEge();
				}
				$result[] = $t;
			}
			return $result;
		}


		function getBrandsByEge()
		{
			global $DB;
			$result = array();
			$eges   = array(
				'�� 1,5 �� 3 ���' => array('12'),
				'�� 3 �� 5 ���' => array(
					'14',
					'16'
				),
				'�� 5 �� 10 ���' => array(
					'18',
					'20'
				),
			);
			foreach ($eges as $key => $vol) {

				echo $values = implode(',', $vol);
				$q         = "
				SELECT
				    brand.VALUE
				FROM
				    strela333_strela.b_iblock_element_property AS duim
				    INNER JOIN strela333_strela.b_iblock_element AS element
				        ON (duim.IBLOCK_ELEMENT_ID = element.ID)
				    INNER JOIN strela333_strela.b_iblock_property AS prop_type
				        ON (duim.IBLOCK_PROPERTY_ID = prop_type.ID)
				    INNER JOIN strela333_strela.b_iblock_element_property AS brand
				        ON (brand.IBLOCK_ELEMENT_ID = element.ID)
				WHERE (duim.VALUE IN ('14\"','12\"')
				    AND prop_type.CODE = 'RAZMER_KOLESA'
				    AND brand.IBLOCK_PROPERTY_ID = 73)
				GROUP BY brand.VALUE;
				";
				$CDBResult = $DB->Query($q);
				while ($t = $CDBResult->Fetch()) {
					$result[$key] = $t;
				}
			}
			return $result;
		}

	}
