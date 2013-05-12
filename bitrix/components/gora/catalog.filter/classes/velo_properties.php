<?
	class velo_properties
	{
		static $types = array( //������������� ���� ������� ���������
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
		public $proprs = array( //������ ������� ��� �������
//			'������' => array(
//				'ID' => '265',
//				'CODE' => 'STRANA'
//			),
			'�����' => array(
				'ID' => '267',
				'CODE' => 'MARKA'
			),
			'��� ����������' => array(
				'ID' => '268',
				'CODE' => 'TIP_VELOSIPEDA'
			),
			'���-�� ���������' => array(
				'ID' => '269',
				'CODE' => 'KOL_VO_SKOROSTEY'
			),
			'�������� ����' => array(
				'ID' => '270',
				'CODE' => 'MATERIAL_RAMY'
			),
			'������ ������' => array(
				'ID' => '308',
				'CODE' => 'RAZMER_KOLESA'
			),
		);


		static $prop_id = 267;

		static $eges = array( //������� ������ �� ��������� �����
			'�� 1,5 �� 3 ���' => array(
				'12"'
			),
			'�� 3 �� 5 ���' => array(
				'14"',
				'16"'
			),
			'�� 5 �� 10 ���' => array(
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
				"<option value=''>����� ��������</option>"
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
