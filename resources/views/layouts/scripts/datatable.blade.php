<script type="text/javascript">
	$(document).ready(function() {
		$('button[data-content]').popup({
			hoverable: true,
			position : 'top center',
			delay: {
				show: 300,
				hide: 800
			}
		});

		dt = $('#listTable').DataTable({
	        dom: 'rt<"bottom"ip><"clear">',
			responsive: true,
			autoWidth: false,
			processing: true,
			@if(!$mockup)
			serverSide: true,
			@endif
			lengthChange: false,
			pageLength: 10,
			filter: false,
			sorting: [],
			language: {
				url: "{{ asset('plugins/datatables/indonesian.json') }}"
			},
			@if(!$mockup)
			ajax:  {
				url: "{{ url($pageUrl) }}/grid",
				type: 'POST',
				data: function (d) {
					d._token = "{{ csrf_token() }}";
					@yield('js-filters')
				}
			},
			@endif
			columns: {!! json_encode($tableStruct) !!},
			drawCallback: function() {
				var api = this.api();
				api.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
					start = cell.innerHTML;
					cell.innerHTML = (parseInt(start) + (i+1));
				});

				$('[data-content]').popup({
					hoverable: true,
					position : 'top center',
					delay: {
						show: 300,
						hide: 800
					}
				});

				//Calender
				// $('.ui.calendar').calendar({
				// 	type: 'date'
				// });

				//Popup
				$('.checked.checkbox')
				  .popup({
				    popup : $('.custom.popup'),
				    on    : 'click'
				  })
				;
			}
		});

		$('.filter.button').on('click', function(e) {
			dt.draw();
			e.preventDefault();
		});
		$('.reset.button').on('click', function(e) {
			$('input').val();
			$("select").val('default').selectpicker("refresh");
			setTimeout(function(){
				dt.draw();
			}, 100);
		});
		// $.fn.dataTable.ext.errMode = 'none';

	 //    $('#listTable').on( 'error.dt', function ( e, settings, techNote, message ) {
	 //    	console.log( 'An error has been reported by DataTables: ', message );
	 //    }) ;
	});
 
	
</script>
