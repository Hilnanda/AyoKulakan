<script type="text/javascript">
function convertToRupiah(angka)
{
	var rupiah = '';    
	var angkarev = angka.toString().split('').reverse().join('');
	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
		return rupiah.split('',rupiah.length-1).reverse().join('');
}

function convertToAngka(rupiah)
{
	return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}
function showBarang(judul = '',length = '', order = '', url = ''){
	var id_lapak = $('input[name="id_lapaks"]').val();
	if(judul == ''){
		judul = '';
	}else{
		judul = judul;
	}
	if(url == ''){
		url = '{{ url($pageUrl."show-barang") }}';
	}else{
		url = url;
	}


	$.ajax({
		url: url,
		data:{id_lapak:id_lapak,judul:judul,length:length,order:order,},
		type: 'GET',
		success: function(resp){
			$('.show-barang').html(resp);
		},
		error : function(resp){
			$('.show-barang').html('Data Tidak Ditemukan');
		}
	});

}

$('body').on('click', '.page-numbers li a', function(e) {
	e.preventDefault();

	$('#load a').css('color', '#dfecf6');
	$('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

	var url = $(this).attr('href');
	showBarang('','','',url);
	window.history.pushState("", "");
});

$(document).on('click','.filter.btn',function(){
	var name = $('input[name="filter[nama]"]').val();
	var sort = $('select[name="filter[sort]"]').val();
	var tampilkan = $('select[name="filter[tampilkan]"]').val();
	showBarang(name,tampilkan,sort,'')
});
$('.reset.button').on('click', function(e) {
	setTimeout(function(){
		showBarang();
	}, 100);
});

$(document).ready(function(){
	showBarang();
	var uangs = $('.duits').text()
	var converts = convertToRupiah(convertToAngka(uangs));
	$('.duits').val(converts);  
});
// form-input lapak
$(document).ready(function(){
	$('ul#lapaks-barang').each(function(){
      var $dropdown = $(this);
	  $("a#links",$dropdown).on('click',function(e){
		  e.preventDefault();
		  $("a#links").addClass(['active']);
		  $("ul#seconds",$dropdown).toggle();
		  $("ul#seconds").addClass('abs');
		  return false;
	  });
	});
	  $('html').click(function(){
        $("ul#seconds").hide();
        $("a#links").removeClass('active');
	  });
});
</script>