<?
	class velo_properties
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
		public $proprs = array( //список свойств для фильтра
//			'Страна' => array(
//				'ID' => '265',
//				'CODE' => 'STRANA'
//			),
			'Марка' => array(
				'ID' => '267',
				'CODE' => 'MARKA'
			),
			'Тип велосипеда' => array(
				'ID' => '268',
				'CODE' => 'TIP_VELOSIPEDA'
			),
			'Кол-во скоростей' => array(
				'ID' => '269',
				'CODE' => 'KOL_VO_SKOROSTEY'
			),
			'Материал рамы' => array(
				'ID' => '270',
				'CODE' => 'MATERIAL_RAMY'
			),
			'Размер колеса' => array(
				'ID' => '308',
				'CODE' => 'RAZMER_KOLESA'
			),
		);


		static $prop_id = 267;

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
		public $result = array();


		public function __construct()
		{
			$result = array();
			foreach ($this->proprs as $key => $vol) {
				$this->result[$vol['CODE']] = $this->getPropsUniq($vol['ID']);
			}
			return $result;
		}

		static function GetNamePropsByPropsCode($prop_code)
		{
			global $DB;
			$result = array();
			$q      = "
				SELECT
		          prop.NAME
		        FROM
		         b_iblock_property as prop
		         WHERE
		           prop.CODE = '{$prop_code}'
		        ";
			$res    = $DB
					->Query($q)
					->Fetch();
			return $res['NAME'];
		}

		/**
		 * @param $prop_id
		 * @return array
		 */
		public function getPropsUniq($prop_id)
		{
			global $DB;
			$result = array();
			$q      = "
				SELECT
		          prop.VALUE, prop.ID
		        FROM
		         b_iblock_element_property as prop
		         WHERE
		           prop.IBLOCK_PROPERTY_ID = '{$prop_id}'
		         GROUP BY
		           prop.VALUE
		        ";
			$res    = $DB->Query($q);
			while ($t = $res->Fetch()) {
				$result[] = $t;
			}
			return $result;

		}


	}

	class FORM
	{
		static function Select($array, $name)
		{
			$props  = array(
				"<option value=''>Любое значение</option>"
			);
			$before = "<select name='{$name}'>";
			foreach ($array as $vol) {
				$selected = $_REQUEST[$name] == $vol['VALUE'] ? "selected='selected'" : '';
				$props[]  = "<option {$selected} value='{$vol['VALUE']}'>{$vol['VALUE']}</option>";
			}
			$after = "</select>";
			return $before . implode("\n", $props) . $after;
		}
	}
