<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<div class = "clear"></div>
<div class = "filtr">
	<form action = "">
		<table class = "tab_left">
			<tr>
				<td>Марка:</td>
				<td>
					<select class = "select_opt">
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Кол-во скоростей:</td>
				<td><select class = "select_opt">
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
					</select></td>
			</tr>
			<tr>
				<td>Размер колеса:</td>
				<td><select class = "select_opt">
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
					</select></td>
			</tr>
			<tr>
				<td>Материал рамы:</td>
				<td><select class = "select_opt">
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
						<option>любое значение</option>
					</select></td>
			</tr>
		</table>

		<table class = "tab_right">
			<tr>
				<td>Тип велосипеда:</td>
			</tr>
			<tr>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>Значение параметра 1</span>
					</label>
				</td>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>Значение параметра 1</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>Значение параметра 1</span>
					</label>
				</td>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>Значение параметра 1</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>Значение параметра 1</span>
					</label>
				</td>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>Значение параметра 1</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>Значение параметра 1</span>
					</label>
				</td>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>Значение параметра 1</span>
					</label>
				</td>
			</tr>

		</table>
		<div class = "clear"></div>
		<div class = "center_sub">
			<input type = "reset" name = "reset" value = "Сбросить" class = "sub4"/>
			<input type = "submit" name = "submit" value = "Подобрать" class = "sub4"/>
		</div>
	</form>
</div>
<div class = "clear"></div>
<pre><?print_r($arResult['debug'])?></pre>
<div>
	<form action="/velo/" method="GET">
		<h2>Подобрать по своствам:</h2>
		<?foreach ($arResult['FORMS'] as $key => $vol): ?>
			<div class = "option_filter"><?=$key?> <?=$vol?></div>
		<? endforeach?>
		<div style="clear: both">
			<input class="sub_a" type="submit" value="Подобрать">
		</div>
	</form>
</div>


