<?
	class velo_catalog
	{
		static $types = array( //мнемонические коды свойств инфоблока
			'Горные' => 'GORNYE',
			'Горные женские' => 'GORNYE_ZHENSKIE',
			'Горные двухподвесы' => 'GORNYE_DVUKHPODVESY',
			'Горные 29\'' => 'GORNYE_29',
			'Дорожные' => 'DOROZHNYE',
			'Подростковые' => 'PODROSTKOVYE',
			'Циклокроссовые' => 'TSIKLOKROSSOVYE',
			'Детские' => 'DETSKIE',
			'Шоссейные' => 'SHOSSEYNYE',
			'Складные' => 'SKLADNYE',
			'Гибридные' => 'GIBRIDNYE',
			'Электро' => 'ELEKTRO',
		);

		static $eges = array( //размеры дисков по возростам детей
			'от 1,5 до 3 лет' => array(
				'12"'
			),
			'от 3 до 5 лет' => array(
				'14"',
				'16"'
			),
			'от 5 до 10 лет' => array(
				'18"',
				'20"'
			),
		);

		/**
		 * @param $type
		 * @return array
		 */

		static function getBrandsByType($type)
		{

			$result = array();
			global $DB;

			$prop_code = self::$types[$type];

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
		           prop_type.CODE = '{$prop_code}' AND
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
				$t['URL'] = "/type/" . $prop_code . "/" . $t['VALUE'] . "/";
				$result[] = $t;
			}
			return $result;
		}


		/**
		 * @return array
		 */
		static function getBrandsByEge($code)
		{
			global $DB;
			$result = array();

			foreach (self::$eges as $key => $vol) {

				$values    = implode('\',\'', $vol);
				$q         = "
				SELECT
				    brand.VALUE,
				    prop_type.CODE as CODE
				FROM
				    strela333_strela.b_iblock_element_property AS duim
				    INNER JOIN strela333_strela.b_iblock_element AS element
				        ON (duim.IBLOCK_ELEMENT_ID = element.ID)
				    INNER JOIN strela333_strela.b_iblock_property AS prop_type
				        ON (duim.IBLOCK_PROPERTY_ID = prop_type.ID)
				    INNER JOIN strela333_strela.b_iblock_element_property AS brand
				        ON (brand.IBLOCK_ELEMENT_ID = element.ID)
				WHERE (duim.VALUE IN ('{$values}')
				    AND prop_type.CODE = 'RAZMER_KOLESA'
				    AND brand.IBLOCK_PROPERTY_ID = 73)
				GROUP BY brand.VALUE;
				";
				$CDBResult = $DB->Query($q);
				$brends    = array();
				while ($t = $CDBResult->Fetch()) {
					$t['URL'] = "/type/DETSKIE/".str_replace("\"", "", implode('_', $vol))."/".$t['VALUE']."/";
					$brends[]  = $t;
				}
				$result[] = array(
					'VALUE' => $key,
					'SUBMENU' => $brends,
					'URL' => "/type/DETSKIE/".str_replace("\"", "", implode('_', $vol))."/"
				);
			}
			//			$result['CODE'] = $code;
			return $result;
		}


		/**
		 * @return array
		 */
		static function getBrends()
		{
			global $DB;
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
			return $result;
		}


		/**
		 * @param $array
		 * @return string
		 */
		static function GetHtmlMenu($array, $ul = false)
		{
			$str = $ul ? "<ul>" : "";
			foreach ($array as $vol) {
				$str .= "<li>";
				$str .= "<a href='{$vol["URL"]}'>";
				$str .= $vol['VALUE'];
				$str .= "</a>";
				if (count($vol['SUBMENU']) > 0) {
					$str .= self::GetHtmlMenu($vol['SUBMENU'], true);
				}
				$str .= "</li>";
			}
			$str .= $ul ? "</ul>" : "";
			return $str;
		}

	}
