<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<div class = "clear"></div>
<div class = "filtr">
	<form action = "">
		<table class = "tab_left">
			<tr>
				<td>�����:</td>
				<td>
					<select class = "select_opt">
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>���-�� ���������:</td>
				<td><select class = "select_opt">
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
					</select></td>
			</tr>
			<tr>
				<td>������ ������:</td>
				<td><select class = "select_opt">
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
					</select></td>
			</tr>
			<tr>
				<td>�������� ����:</td>
				<td><select class = "select_opt">
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
						<option>����� ��������</option>
					</select></td>
			</tr>
		</table>

		<table class = "tab_right">
			<tr>
				<td>��� ����������:</td>
			</tr>
			<tr>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>�������� ��������� 1</span>
					</label>
				</td>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>�������� ��������� 1</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>�������� ��������� 1</span>
					</label>
				</td>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>�������� ��������� 1</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>�������� ��������� 1</span>
					</label>
				</td>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>�������� ��������� 1</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>�������� ��������� 1</span>
					</label>
				</td>
				<td>
					<label>
						<input type = "checkbox" name = "checkbox"/>
						<span>�������� ��������� 1</span>
					</label>
				</td>
			</tr>

		</table>
		<div class = "clear"></div>
		<div class = "center_sub">
			<input type = "reset" name = "reset" value = "��������" class = "sub4"/>
			<input type = "submit" name = "submit" value = "���������" class = "sub4"/>
		</div>
	</form>
</div>
<div class = "clear"></div>
<pre><?print_r($arResult['debug'])?></pre>
<div>
	<form action="/velo/" method="GET">
		<h2>��������� �� ��������:</h2>
		<?foreach ($arResult['FORMS'] as $key => $vol): ?>
			<div class = "option_filter"><?=$key?> <?=$vol?></div>
		<? endforeach?>
		<div style="clear: both">
			<input class="sub_a" type="submit" value="���������">
		</div>
	</form>
</div>


