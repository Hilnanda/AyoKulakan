@extends('layouts.grid')

@section('js-filters')
@endsection

@section('rules')
@endsection

@section('filters')
<div class="field">
	<select name="role" class="ui fluid search selection dropdown">
		<option value="">Pilih Role</option>
		<option value="0">Admin</option>
		<option value="1">Staff HSE</option>
		<option value="2">Pekerja</option>
	</select>
</div>
@endsection

@section('subcontent')
<table class="ui celled table">
	<thead>
		<tr>
			<th class="ten wide column">Modul</th>
			<th class="center aligned">Lihat</th>
			<th class="center aligned">Tambah</th>
			<th class="center aligned">Ubah</th>
			<th class="center aligned">Hapus</th>
			<th class="center aligned"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Man Power Record</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Audit</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Manajemen Resiko</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Rapat K3</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Inspeksi</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Induksi</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Training</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>HSE Plan</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Emergency Drill</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Toolbox Toolkit</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Toolbox Meeting</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Komunikasi</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Equipment</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Dokumen K3</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Master</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
		<tr>
			<td>Sistem</td>
			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="view[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="add[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="edit[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="delete[manpower_record]" data-id="1" value="1"><label for=""></label></div></td>

			<td class="center aligned"><div class="ui fitted checkbox"><input type="checkbox" name="select_all[manpower_record]" class="check all reviewer"><label for=""></label></div></td>
		</tr>
	</tbody>
</table>
@endsection