<?php
	class Form_alter
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
		static function Checkbox($array, $name)
		{
			$props  = array(
				"<table>"
			);
			$before = "<select name='{$name}'>";
			foreach ($array as $vol) {
				$selected = $_REQUEST[$name] == $vol['VALUE'] ? "selected='selected'" : '';
				$props[]  = "<option {$selected} value='{$vol['VALUE']}'>{$vol['VALUE']}</option>";
			}
			$after = "</table>";
			return $before . implode("\n", $props) . $after;
		}
	}