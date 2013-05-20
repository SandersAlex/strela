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


		public function velo_properties()
		{
			foreach (velo_config::$proprs as $key => $vol) {
				$this->result[$vol['CODE']] = $this->getPropsUniq($vol['ID'],$vol['TYPE_HTML']);
			}

		}

		static function GetNamePropsByPropsCode($prop_code)
		{
			global $DB;
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
		public function getPropsUniq($prop_id,$type)
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
				$t['type'] = $type;
				$result[] = $t;
			}
			return $result;

		}


	}


