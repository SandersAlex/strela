<?
	class Velo
	{

		static $Iblock_id = 30;
		static $property_id = 367; //айди свойства связи торговых предложений с элементом

		static function GetOffers($element_id)
		{
			global $DB;
			$result = array();
			$property_id = self::$property_id;
			$q           = "
				SELECT
				 COUNT(offers)
				FROM
						b_iblock_element_property as svyaz,
						b_iblock_element_property as property,
						b_iblock_element as element,
						b_iblock_element as offers
				WHERE
						svyaz.IBLOCK_PROPERTY_ID = '{$property_id}' AND
						svyaz.VALUE = '{$element_id}' AND
						offers.ID = svyaz.IBLOCK_ELEMENT_ID

			";
			$s = $DB->Query($q);
			while($t = $s->Fetch()){
				$result[] = $t;
			}
			return $result;
		}

		static function GetColorsAndSizes($elemet_id)
		{

		}
	}
