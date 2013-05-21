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

		static function Checkbox($array, $name,$title, $rows = 2)
		{
			$content = '';
			$props   = array();
			$before  = "
			<tr>
			<td>{$title}
			</td></tr>";
			$i       = 0;
			foreach ($array as $vol) {
				if ($i < $rows-1) {
					$i++;
					$selected = in_array($vol['VALUE'],$_REQUEST[$name]) == $vol['VALUE'] ? "checked='checked'" : '';
					$content .= "
					<td>
					<label>
					<input type='checkbox' {$selected} value='{$vol['VALUE']}' name='{$name}[]'/>
					<span>{$vol['VALUE']}</span>
					</label>
					</td>";
				}
				else {
					$selected = in_array($vol['VALUE'],$_REQUEST[$name]) == $vol['VALUE'] ? "checked='checked'" : '';

					$content .= "
<td>
										<label>
										<input type='checkbox' {$selected} value='{$vol['VALUE']}' name='{$name}[]'/>
										<span>{$vol['VALUE']}</span>
										</label></td>";
					$props[] = "<tr>" . $content . "</tr>";
					$i       = 0;
					$content = '';
				}
			}
			$after = "";
			return $before . implode("\n", $props) . $after;
		}
	}