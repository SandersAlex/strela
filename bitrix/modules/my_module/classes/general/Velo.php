<?
	class Velo
	{

		static $Iblock_id = 30;
		static $property_id = 367; //айди свойства связи торговых предложений с элементом
		static $color_property_id = 370; //айди свойства цветов и размеров

		static function GetOffers($element_id)
		{
			global $DB;
			$result = array();
			$property_id = self::$property_id;
			$color_property_id = self::$color_property_id;
			$q           = "
				SELECT
				     property.*
				FROM
				    b_iblock_element_property AS svyaz
				    INNER JOIN b_iblock_element AS offers
				        ON (svyaz.IBLOCK_ELEMENT_ID = offers.ID)
				    INNER JOIN b_iblock_element_property AS property
				        ON (offers.ID = property.IBLOCK_ELEMENT_ID)
				WHERE (svyaz.IBLOCK_PROPERTY_ID = {$property_id}
				    AND svyaz.VALUE = {$element_id}
				    AND property.IBLOCK_PROPERTY_ID = {$color_property_id})
				GROUP BY property.VALUE
				ORDER BY property.DESCRIPTION ASC;
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
