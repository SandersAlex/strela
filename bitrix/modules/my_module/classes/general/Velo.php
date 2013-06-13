<?
	class Velo
	{

		static $Iblock_id = 30;
		static $property_id = 367; //айди свойства связи торговых предложений с элементом
		static $color_property_id = 370; //айди свойства цветов и размеров



		static function GetPriceVeloByComPredlozh(){
			$tor_connect = self::$property_id;
			global $DB;
			$q = "
			SELECT
			   velo.ID,
			   velo.IBLOCK_ID,
			   velo.NAME,
			   predlozh.ID as predlozhenie,
			   predlozh.NAME as predName,
			   price.PRICE as price
			FROM
			 b_iblock_element as velo
			 LEFT JOIN b_iblock_element_property AS property
			 ON(property.VALUE = velo.ID)

			 LEFT JOIN b_iblock_element AS predlozh
			 ON(property.IBLOCK_ELEMENT_ID = predlozh.ID)

			 LEFT JOIN b_catalog_price AS price
			 ON(price.PRODUCT_ID = predlozh.ID)

			 WHERE
			   velo.IBLOCK_ID = 30 AND
			   property.IBLOCK_PROPERTY_ID = {$tor_connect}
			   GROUP BY velo.ID
			";

			$result = array();
			$temp = $DB->Query($q);
			while($t = $temp->Fetch()){
				$result[] = $t;
			}
			return $result;
		}

		/**
		 * @param $element_id
		 * @return array
		 * Получение уникальных значений цвета и размера велосипеда из торговых предложений
		 */
		static function GetOffersColorsAndSize($element_id)
		{
			global $DB;
			$result            = array();
			$property_id       = self::$property_id;
			$color_property_id = self::$color_property_id;
			$q                 = "
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
			$s                 = $DB->Query($q);
			while ($t = $s->Fetch()) {
				$result[] = $t;
			}
			return $result;
		}

		/**
		 * @param $element_id
		 * @param $size
		 * @return array
		 * Получение списка цветов и айди товаров с этими цветами, по размеру велосипеда и айдишнику карточки товара
		 */
		static function GetColorBySize($element_id, $size)
		{
			global $DB;
			$result            = array();
			$property_id       = self::$property_id;
			$color_property_id = self::$color_property_id;
			$q                 = "
				SELECT
				    size.VALUE
				    , color.VALUE
				    , comm.ID
				FROM
				    b_iblock_element_property AS svyaz
				    INNER JOIN b_iblock_element AS element 
				        ON (svyaz.VALUE = element.ID)
				    INNER JOIN b_iblock_element AS comm
				        ON (svyaz.IBLOCK_ELEMENT_ID = comm.ID)
				    INNER JOIN b_iblock_element_property AS color 
				        ON (color.IBLOCK_ELEMENT_ID = comm.ID)
				    INNER JOIN b_iblock_element_property AS size 
				        ON (size.IBLOCK_ELEMENT_ID = comm.ID)
				WHERE (element.ID = {$element_id}
				    AND svyaz.IBLOCK_PROPERTY_ID = {$property_id}
				    AND color.IBLOCK_PROPERTY_ID = {$color_property_id}
				    AND size.VALUE = '{$size}'
				    AND size.IBLOCK_PROPERTY_ID = {$color_property_id}
				    AND size.DESCRIPTION = 'Размер'
				    AND color.DESCRIPTION = 'Цвет')
				GROUP BY
				    color.VALUE;
				    ";

			$s = $DB->Query($q);
			while ($t = $s->Fetch()) {
				$result[] = $t;
			}
			return $result;
		}


		/**
		 * @param $element_id
		 * @return array
		 * Получение списка цен для велосипеда
		 */
		static function GetVeloPrice($element_id)
		{
			global $DB;
			$result      = array();
			$property_id = self::$property_id;
			$q           = "
				SELECT
				     price.*
				FROM
				    b_catalog_price AS price

				WHERE
				price.PRODUCT_ID = {$element_id}
			";
			$s           = $DB->Query($q);
			while ($t = $s->Fetch()) {
				$result[] = $t;
			}
			return $result;
		}


		/**
		 * @param $element_id
		 * @return arrayПолучение списка комерческих предложений для товара
		 */
		static function GetOffers($element_id)
		{
			global $DB;
			$result      = array();
			$property_id = self::$property_id;
			$q           = "
				SELECT
				     offers.*
				FROM
				    b_iblock_element_property AS svyaz
				    INNER JOIN b_iblock_element AS offers
				        ON (svyaz.IBLOCK_ELEMENT_ID = offers.ID)
				WHERE (svyaz.IBLOCK_PROPERTY_ID = {$property_id}
				    AND svyaz.VALUE = {$element_id}
				 )
			";
			$s           = $DB->Query($q);
			while ($t = $s->Fetch()) {
				$price           = self::GetVeloPrice($t['ID']);
				$fields          = $t;
				$fields['PRICE'] = $price;
				$result[]        = $fields;
			}
			return $result;
		}


		/**
		 * @param $element_id
		 * @return array
		 * Получение списка цветов по айди товара
		 */
		static function GetColorsByTovarID($element_id)
		{
			global $DB;
			$result            = array();
			$property_id       = self::$property_id;
			$color_property_id = self::$color_property_id;
			$q                 = "
				SELECT
				     property.VALUE
				FROM
				    b_iblock_element_property AS svyaz
				    INNER JOIN b_iblock_element AS offers
				        ON (svyaz.IBLOCK_ELEMENT_ID = offers.ID)
				    INNER JOIN b_iblock_element_property AS property
				        ON (offers.ID = property.IBLOCK_ELEMENT_ID)
				WHERE (svyaz.IBLOCK_PROPERTY_ID = {$property_id}
				    AND svyaz.VALUE = {$element_id}
				    AND property.DESCRIPTION = 'Цвет'
				    AND property.IBLOCK_PROPERTY_ID = {$color_property_id})
				GROUP BY property.VALUE
				ORDER BY property.DESCRIPTION ASC;
			";
			$s                 = $DB->Query($q);
			while ($t = $s->Fetch()) {
				$result[] = $t;
			}
			return $result;
		}


		/**
		 * @param $element_id
		 * @return array
		 * Получение списка размеров по айдишнику карточки товара
		 */
		static function GetSizeByTovarID($element_id)
		{
			global $DB;
			$result            = array();
			$property_id       = self::$property_id;
			$color_property_id = self::$color_property_id;
			$q                 = "
				SELECT
				     property.VALUE
				FROM
				    b_iblock_element_property AS svyaz
				    INNER JOIN b_iblock_element AS offers
				        ON (svyaz.IBLOCK_ELEMENT_ID = offers.ID)
				    INNER JOIN b_iblock_element_property AS property
				        ON (offers.ID = property.IBLOCK_ELEMENT_ID)
				WHERE (svyaz.IBLOCK_PROPERTY_ID = {$property_id}
				    AND svyaz.VALUE = {$element_id}
				    AND property.DESCRIPTION = 'Размер'
				    AND property.IBLOCK_PROPERTY_ID = {$color_property_id})
				GROUP BY property.VALUE
				ORDER BY property.VALUE ASC;
			";
			$s                 = $DB->Query($q);
			while ($t = $s->Fetch()) {
				$result[] = $t;
			}
			return $result;
		}


	}
