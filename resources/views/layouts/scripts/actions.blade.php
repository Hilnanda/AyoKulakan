<script type="text/javascript">
	function goBack() {
		window.history.back();
	}

	$('.special.cards .image').dimmer({
	  on: 'hover'
	});

	$('.ui.vertical.footer.segment.seconds').hide();
	$(document).on('click', '.item', function(e) {

		$('.ui.vertical.footer.segment.firsts').hide();
		$('.ui.vertical.footer.segment.seconds').show();
	});

	$(document).on('click', '.add-page.button', function(e){
		var url = "{{ url($pageUrl) }}/create";
		window.location = url;
	});

	$(document).on('change', '.show.child', function(e) {
		var flagChild = $(this).data('show');
		var dataChild = $(this).data('target');
		var check = false;
		if($(this).prop('checked') == true)
		{
			var check = true;
		}
		$(".attached.segment").each(function(index, value) {
			if($(value).data('parent') == dataChild && $(value).data('flag') == flagChild)
			{
				if(check == true)
				{
					$(value).show();
					$(value).find('input:checkbox').prop('checked', true);
					$(value).find('.attached.segment').show();
					$(value).find('input:checkbox').trigger('checked');
				}else{
					$(value).hide();
				}
			}
		});
	});

	$(document).on('click', '.edit-page.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/"+id+"/edit";
		window.location = url;
	});

	$(document).on('click', '.view-page.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/"+id;
		window.location = url;
	});

	$(document).on('click', '.detail-page.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/"+id;
		window.location = url;
	});

	$(document).on('submit', '#dataForm', function(e){
		return false;
	});

	{{--  $(document).on('keydown', '.field input', function(e){
		if(e.keyCode == 13){
			e.preventDefault();
			$( ".save.button" ).trigger( "click" );
		}
	});  --}}

	$(document).on('click', '.add.button', function(e){
		var url = "{{ url($pageUrl) }}/create";
		loadModal(url);
	});

	$(document).on('click', '.edit.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/"+id+"/edit";

		loadModal(url);
	});

	$(document).on('click', '.others.button', function(e){
		var id = $(this).data('id');
		var url = $(this).data('url');
		console.log(url);
		var url = "{{ url($pageUrl) }}/"+id+"/"+url;

		loadModal(url);
	});

	$(document).on('click', '.detail.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/"+id+"/detail";

		loadModal(url);
	});

	$(document).on('click', 'i.download.icon', function (e) {
		$(this).closest('.icon.button').trigger('click');
	});

	$(document).on('click', '.delete.button', function(e){
		var id = $(this).data('id');

		swal({
			title: 'Are You Sure?',
			text: "Record deleted cannot be recovered!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Delete',
			cancelButtonText: 'Cancel'
		}).then((result) => {
			if (result) {
				$.ajax({
					url: '{{ url($pageUrl) }}/'+id,
					type: 'POST',
					data: {_token: "{{ csrf_token() }}", _method: "delete"},
					success: function(resp){
						swal(
							'Terhapus!',
							'Record remove success.',
							'success'
							).then(function(e){
								dt.draw();
							});
						},
						error : function(resp){
							swal(
								'Gagal!',
								'Data gagal dihapus, karena sedang dipakai',
								'error'
								).then(function(e){
									dt.draw();
								});
							}
						});

			}
		})
	});

	$(document).on('click', '.publish.button', function(e){
		var id = $(this).data('id');

		swal({
			title: 'Are You Sure?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Publish',
			cancelButtonText: 'Cancel'
		});
	});

	$(document).on('click', '.approve.button', function(e){
		var id = $(this).data('id');

		swal({
			title: 'Are You Sure?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Approve',
			cancelButtonText: 'Cancel'
		});
	});

	$(document).on('click', '.reject.button', function(e){
		var id = $(this).data('id');
		swal({
			title: 'Are You Sure?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#ff0101',
			cancelButtonColor: '#9d9d9d',
			confirmButtonText: 'Reject',
			cancelButtonText: 'Cancel'
		});
	});

	function loadModal(url) {
		$('#formModals').modal('show');
	}

	function showLoadingInput(elemchild)
	{
		var loading = `<div class="ui active mini centered inline loader"></div>`;

		$('#'+elemchild).parent().closest('.field').addClass('disabled');
		$('#'+elemchild).parent().closest('.field').append(loading);
	}

	function  stopLoadingInput(elemchild)
	{
		$('#'+elemchild).parent().closest('.field').removeClass('disabled');
		$('#'+elemchild).parent().closest('.field').find('.inline.loader').remove();
	}

	function injectLoading(element)
	{
		$(element).html(`
			<div class="ui active inverted dimmer">
			<div class="ui text loader">Loading</div>
			</div>`);
	}

	function stopInjectLoading(element)
	{
		$(element).html(``);
	}

	function saveForm()
	{
		if($("#dataForm").form('is valid')){
			$('#cover').show();
			$("#dataForm").ajaxSubmit({
				success: function(resp){
					$("#formModal").modal('hide');
					swal(
						'Tersimpan!',
						'Record saved success.',
						'success'
						).then((result) => {
							$('#cover').hide();
							// window.location = "{{ url($pageUrl) }}";
							return true;
						})
					},
					error: function(resp){
						
						$('#cover').hide();
						clearAllError('#contentBody');
						if(resp.status == 500)
						{
							clearQueryError('#contentBody');
							showQueryError('#contentBody',resp.responseJSON.message);
						}
						$.each(resp.responseJSON, function(index, val) {
							clearFormError(index,val);
							showFormError(index,val);
						});
						swal(
							'Gagal!',
							'Data Gagal Disimpan Isi Data Dengan Lengkap.',
							'error'
						);
						time = 5;
						interval = setInterval(function(){
							time--;
							if(time == 0){
								clearInterval(interval);
								$('.pointing.prompt.label.transition.visible').remove();
								$('.error').each(function (index, val) {
									$(val).removeClass('error');
								});
							}
						},1000)
					}
				});
		}
	}

	$(document).on('click', '.public-save.save', function(e){
		saveForm();
	});

	$(document).ready(function() {
		var today = new Date();
		var month = today.getMonth()+1;
		$('.dateNOW').calendar({
			type: 'date',
			minDate: new Date(" "+month+" "+today.getDate()+" "+today.getFullYear()),
			text: {
				months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
			},
		});
			$('.date').calendar({type: 'date'});
			$('.month').calendar({type: 'month'});
			$('.year').calendar({type: 'year'});
			$('.dateInd').calendar({
				type: 'date',
				text: {
					months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
				},
			});
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$(input).closest('.area.picture').find('.show.picture').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}
		var lengthAttachment = $('input[name^="attachment"]').length;

		function getAttachmentInput(length) {
			$('input[name="attachment['+length+']"]').click()
		}

		function multiAppendUrl(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('img[name="img['+lengthAttachment+']"]').parent().parent().show();
					$('img[name="img['+lengthAttachment+']"]').attr('src', e.target.result);
				}
				lengthAttachment = lengthAttachment + 1;
				var html = `<div class="card">
				<div class="image">
				<img class="ui image" src="" name="img[`+lengthAttachment+`]">
				<input type="file" name="attachment[`+lengthAttachment+`]" style="display:none;" accept="image/*">
				</div>
				</div>`;
				$('#multiShowPic').append(html);
				reader.readAsDataURL(input.files[0]);

				$('input[name="attachment['+lengthAttachment+']"]').change(function () {
					multiAppendUrl(this);
				});
			}
		}

		$(document)
		.on('click', '.ui.teal.button.safety-file', function(e) {
			getAttachmentInput(lengthAttachment);
		});

		$(".browse.picture").change(function () {
			readURL(this);
		});

		$('input[name="attachment['+lengthAttachment+']"]').change(function () {
			multiAppendUrl(this);
		});

		showQueryError =  function (formName, message)
		{
			$(formName).find('.content').prepend(`<div class="ui negative message error 500">
					  <i class="close icon"></i>
					  <div class="header">
							`+ message +`
					  </div>
						Sorry Trouble Comes up, call the developer to fix it!
					</div>`);
		}

		clearQueryError =  function (formName)
		{
			$(formName).find('.content').find(`.error.500`).remove();
		}

		clearAllError =  function (formName)
		{
			$.each($(formName).find('.ui.basic.red.pointing.prompt.label.transition.visible'), function (index, val) {
					$(val).closest('.field').removeClass('error');
					$(val).remove();
			});
			$(formName).find('.ui.basic.red.pointing.prompt.label.transition.visible').remove();
		}

		clearError = function(key, value)
		{
			if(key.includes("."))
			{
				res = key.split('.');
				key = res[0] + '[' + res[1] + ']';
				if(res[1] == 0)
				{
					key = res[0] + '\\[\\]';
				}
			}
			var elm = $('#formModal' + ' [name^=' + key + ']').closest('.field');
			$(elm).removeClass('error');

			var showerror = $('#formModal' + ' [name^=' + key + ']').closest('.field').find('.ui.basic.red.pointing.prompt.label.transition.visible').remove();
		}

		showError = function(key, value)
		{
			if(key.includes("."))
			{
				res = key.split('.');
				key = res[0] + '[' + res[1] + ']';
				if(res[1] == 0)
				{
					key = res[0] + '\\[\\]';
				}
			}

			var elm = $('#formModal' + ' [name^=' + key + ']').closest('.field');
			$(elm).addClass('error');
			var message = `<div class="ui basic red pointing prompt label transition visible">`+ value +`</div>`;

			var showerror = $('#formModal' + ' [name^=' + key + ']').closest('.field');
			$(showerror).append('<div class="ui basic red pointing prompt label transition visible">' + value + '</div>');
		}

		clearElementError = function(key, value, element)
		{
			if(key.includes("."))
			{
				res = key.split('.');
				key = res[0] + '[' + res[1] + ']';
				if(res[1] == 0)
				{
					key = res[0] + '\\[\\]';
				}
			}
			var elm = $(element + ' [name^=' + key + ']').closest('.field');
			$(elm).removeClass('error');

			var showerror = $(element + ' [name^=' + key + ']').closest('.field').find('.ui.basic.red.pointing.prompt.label.transition.visible').remove();
		}

		showElementError = function(key, value, element)
		{
			if(key.includes("."))
			{
				res = key.split('.');
				key = res[0] + '[' + res[1] + ']';
				if(res[1] == 0)
				{
					key = res[0] + '\\[\\]';
				}
			}

			var elm = $(element + ' [name^=' + key + ']').closest('.field');
			$(elm).addClass('error');
			var message = `<div class="ui basic red pointing prompt label transition visible">`+ value +`</div>`;

			var showerror = $(element + ' [name^=' + key + ']').closest('.field');
			$(showerror).append('<div class="ui basic red pointing prompt label transition visible">' + value + '</div>');
		}

		showFormError = function(key, value)
		{
			if(key.includes("."))
			{
				res = key.split('.');
				key = res[0] + '[' + res[1] + ']';
				if(res[1] == 0)
				{
					key = res[0] + '\\[\\]';
				}
			}
			var elm = $('#dataForm' + ' [name=' + key + ']').closest('.field');
			$(elm).addClass('error');
			var message = `<div class="ui basic red pointing prompt label transition visible">`+ value +`</div>`;

			var showerror = $('#dataForm' + ' [name=' + key + ']').closest('.field');
			$(showerror).append('<div class="ui basic red pointing prompt label transition visible">' + value + '</div>');
		}

		clearFormError = function(key, value)
		{
			if(key.includes("."))
			{
				res = key.split('.');
				key = res[0] + '[' + res[1] + ']';
				if(res[1] == 0)
				{
					key = res[0] + '\\[\\]';
				}
			}
			var elm = $('#dataForm' + ' [name=' + key + ']').closest('.field');
			$(elm).removeClass('error');

			var showerror = $('#dataForm' + ' [name=' + key + ']').closest('.field').find('.ui.basic.red.pointing.prompt.label.transition.visible').remove();
		}

	});

$(document).on('click', '.close', function(e){
	$('.ui.negative').hide();
})

$(document).on('change', '.child.target', function () {
	var elemchild = $(this).find('select').data('child');
	var departemen_id = $(this).find('select').val();
	showLoadingInput(elemchild);
	if(departemen_id != null)
	{
		$.ajax({
			url: '{{ url("option") }}/'+ elemchild +'/'+ departemen_id,
			type: 'GET',
			success: function(resp){
				stopLoadingInput(elemchild);
				$('#'+elemchild).html(resp);
			},
			error : function(resp){

			}
		});
	}
});

$(document).on('click', '.save.as.drafting', function(e){
	$('#dataForm').find('input[name="status"]').val("0");
	saveForm();
});

$(document).on('click', '.save.as.publicity', function(e){swal({
	title: 'Are you sure ready to publish ?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Publish',
		cancelButtonText: 'Cancel'
	}).then((result) => {
		if (result) {
			$('#dataForm').find('input[name="status"]').val("1");
			saveForm();
		}
	})
});
$(document).on('click', '.save.as.page', function(e){swal({
	title: 'Are you sure?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Save',
		cancelButtonText: 'Cancel'
	}).then((result) => {
		if (result) {
			saveForm();
		}
	})
});

$(document).on('keypress', 'input[name^="filter"]', function (e) {
	if (e.which == 13) {
		$('.filter.button').click();
		return false;
	}
});


$(document).on('click', '.ui.green.button.append-lampiran', function () {
	html = `<div class="sixteen wide column" style="padding: .5rem 0">
	<div class="ui fluid file input action">
	<input type="text" readonly>
	<input type="file" class="six wide column" name="file[]" autocomplete="off">
	<div class="ui button file">
	Cari...
	</div>
	<div class="ui red button remove-lampiran">
	Hapus &nbsp;&nbsp;
	</div>
	</div>
	</div>`;

	$(this).closest('.ui.inline.grid.field').append(html);
});

$(document).on('click', '.ui.red.button.remove-lampiran', function () {
	$(this).closest('.sixteen.wide.column').remove();
});

$(document).on('click', '.ui.red.icon.button.hapus.file', function(e){
		var id = $(e.target).parent().parent().find('input:text').data('id');
		swal({
			title: 'Apakah anda yakin?',
			text: "Data File yang sudah dihapus, tidak dapat dikembalikan!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			$('#lampiran-area').html(`<div class="ui active inverted dimmer">
				<div class="ui text loader">Loading</div>
				</div>`);
			if (result) {
				$.ajax({
					url: '{{ url("hapus-download-file")}}/'+id,
					type: 'GET',
					success: function(resp){
						swal(
							'Terhapus!',
							'Data berhasil dihapus.',
							'success'
							).then(function(e){
								$('#lampiran-area').html(resp);
									if($('#hadirinUploadModal').length == 1){
										location.reload();
									}
							});
						},
						error : function(resp){
							swal(
								'Gagal!',
								'Data gagal dihapus.',
								'error'
								).then(function(e){
							// location.reload();
						});
							}
						});

			}
		})
	});

$(document).on('click', '.ui.green.button.append-foto', function () {
	html = `<div class="sixteen wide column" style="padding: .5rem 0">
	<div class="ui fluid file input action">
	<input type="text" readonly>
	<input type="file" class="six wide column" name="attachment[]" autocomplete="off" multiple>
	<div class="ui button file">
	Cari...
	</div>
	<div class="ui red button remove-foto">
	Hapus &nbsp;&nbsp;
	</div>
	</div>
	</div>`;

	$(this).closest('.ui.inline.grid.field').append(html);
});

$(document).on('click', '.ui.red.button.remove-foto', function () {
	$(this).closest('.sixteen.wide.column').remove();
});

$(document).on('click', '.ui.red.icon.button.hapus-picture.file', function(e){
		var id = $(e.target).parent().parent().find('input:text').data('id');

		swal({
			title: 'Apakah anda yakin?',
			text: "Data yang sudah dihapus, tidak dapat dikembalikan!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			$('#foto-area').html(`<div class="ui active inverted dimmer">
				<div class="ui text loader">Loading</div>
				</div>`);
			if (result) {
				$.ajax({
					url: '{{ url("hapus-download-attachment")}}/'+id,
					type: 'GET',
					success: function(resp){
						swal(
							'Terhapus!',
							'Data berhasil dihapus.',
							'success'
							).then(function(e){
								$('#foto-area').html(resp);
							});
						},
						error : function(resp){
							swal(
								'Gagal!',
								'Data gagal dihapus.',
								'error'
								).then(function(e){
								});
							}
						});

			}
		})
	});



</script>
