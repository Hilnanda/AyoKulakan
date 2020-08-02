<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{ config('app.longname') }}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Ayokulakan">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Style --}}
 <!-- <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/bootstrap.min.css') }}"> -->
<!--  <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/ionicons.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/css-plugins-call.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/bundle.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/main.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/responsive.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/colors.css') }}">-->

  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/blue.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/owl.carousel.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/owl.transitions.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/animate.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/rateit.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/new_temp/css/lightbox.css') }}">
  <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'> -->
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/toastr/build/toastr.min.css') }}">


  <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert2.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">

  <link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-lite.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}">
  <style media="screen">
    .container {
      padding-left : 0px !important;
    }
  	.float{
  		bottom:34px;
  		right:40px;
  		text-align:center;
  		box-shadow: 2px 2px 3px #999;
      z-index: 100;
  	}

  	.my-float{
  		margin-top:22px;
  	}

    #myBtn {
      display: none;
      bottom: 35px;
      left: 30px;
      position: fixed;
      z-index: 99;
      font-size: 18px;
      border: none;
      outline: none;
      color: white;
      cursor: pointer;
      padding: 15px;
      border-radius: 4px;
    }
    #myBtn2 {
      position: fixed;

      z-index: 99;
      border: none;
      outline: none;
      color: white;
      cursor: pointer;
      padding: 15px;
      border-radius: 4px;
    }

  </style>
  <style type="text/css">
  .errors{
    background-color: #dc354547!important;
  }
 /* .btn.dropdown-toggle{
    height: 47px
  }*/

  .red-text{
    color: red;
  }
.dropdown-submenu{position:relative;}
.dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
.dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;margin-top:5px;margin-right:-10px;}
.dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}

@media screen and (max-width: 768px) {
	.h3, h3 {
		font-size: 16px;
	}
}
</style>

<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datepicker/datepicker3.css') }}">
<style>
@media (max-width: 767px) {
	.body-content .sidebar {
		padding: 0;
		overflow: hidden;
	}
	.body-content .homebanner-holder {
		padding: 0;
		overflow: hidden;
	}
	.info-boxes .info-box {
		margin-bottom: 0;
		padding: 10px 25px;
	}

	.col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
		padding: 0 15px 0 19px;
		overflow: hidden;
	}

  .search-result-container  {
    padding-left: 10px;
  }

  .carousel {
    height: 150px;
  }

  h3.new-product-title.pull-left {
    padding: 0 10px;
  }

	.col-xs-12 {
		padding: 0;
		overflow: hidden;
	}

	.top-search-holder {
		padding: 0 20px 0 30px;
	}

  .footer .footer-bottom {
    padding: 20px 40px;
  }

  .sidebar-widget.hot-deals.wow.fadeInUp.outer-bottom-xs.animated {
    margin: 0 20px 0 35px;
  }
}
</style>

@yield('css')
@yield('styles')
</head>
<!-- Floating Button  -->
<!-- <a href="mailto:admin@ayokulakan.com" class="float">
  <i class="fa fa-question-circle fa-2x my-float"></i>
</a> -->
<a href="mailto:admin@ayokulakan.com"  id="myBtn2"  class="float btn btn-danger" title="Go to Questions">
  <li class="fa fa-question-circle fa-2x"></li>
</a>
<button onclick="topFunction()" id="myBtn2" class="btn btn-primary" title="Go to top" style="
bottom: 34px;
left: 30px;
text-align: center;
box-shadow: 2px 2px 3px #999;
z-index: 100;">
  <li class="fa fa-arrow-up fa-2x"></li>
</button>
<body class="cnt-home">
  @yield('body')

  <div v-cloak>
    @yield('additional')
  </div>

  @yield('modalss')

  {{-- Script --}}
  <script>
  window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
    ]) !!}
  </script>
  <script src="{{ asset('ayokulakan/js/jquery-3.2.1.min.js') }}"></script>
  <!-- <script src="{{ asset('ayokulakan/js/bootstrap.min.js') }}"></script> -->
  <script src="{{ asset('new_temp/js/bootstrap.min.js') }}"></script>
  <!-- {{-- <script src="{{ asset('new_temp/js/bootstrap-hover-dropdown.min.js') }}"></script> --}} -->
  <script src="{{ asset('new_temp/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/echo.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/jquery.easing-1.3.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/bootstrap-slider.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/jquery.rateit.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/lightbox.min.js') }}"></script>
  <!-- {{-- <script src="{{ asset('new_temp/js/bootstrap-select.min.js') }}"></script> --}} -->
  <!-- <script src="{{ asset('new_temp/js/wow.min.js') }}"></script> -->
  <script src="{{ asset('new_temp/js/scripts.js') }}"></script>
  <!-- {{-- <script src="{{ asset('ayokulakan/js/popper.min.js') }}"></script>
  <script src="{{ asset('ayokulakan/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('ayokulakan/js/jquery.nivo.slider.pack.js') }}"></script>
  <script src="{{ asset('ayokulakan/js/plugins.js') }}"></script>
  <script src="{{ asset('ayokulakan/js/main.js') }}"></script>

  <script src="{{ asset('plugins/jQuery/jquery.form.min.js') }}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
  <script src="{{ asset('plugins/sweetalert/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('semantic/semantic.js') }}"></script> --}} -->
  <script src="{{ asset('plugins/jQuery/jquery.form.min.js') }}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
  <script src="{{ asset('plugins/sweetalert/sweetalert2.js') }}"></script>
<script src="{{ asset('semantic/semantic.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/moment.js') }}"></script>
  <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
  <script src="{{ asset('plugins/summernote/summernote-lite.js') }}"></script>
  <script src="{{ asset('plugins/toastr/build/toastr.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap-input-spinner-master/src/bootstrap-input-spinner.js') }}"></script>
  <script src="{{ asset('js/chart.bundle.min.js') }}"></script>

  <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
  <script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js" integrity="sha256-gJWdmuCRBovJMD9D/TVdo4TIK8u5Sti11764sZT1DhI=" crossorigin="anonymous"></script>
 <script type="text/javascript">
    $.fn.selectpicker.Constructor.BootstrapVersion = '3';
  </script>
@yield('js')

@yield('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $(".notifChat").html("Pesan");
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault();
			event.stopPropagation();
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
    @if(auth()->user())
    var configs = {
      apiKey: "AIzaSyC9RkqD-bAwror4VF5XClRTgx9CbPGD37I",
      authDomain: "ayokulakan-chat.firebaseapp.com",
      databaseURL: "https://ayokulakan-chat.firebaseio.com",
      projectId: "ayokulakan-chat",
      storageBucket: "ayokulakan-chat.appspot.com",
      messagingSenderId: "619200437741",
      appId: "1:619200437741:web:fbf2da6ebbe48fdc945be4",
      measurementId: "G-8YXMZXYM2K"

    };
    firebase.initializeApp(configs);
    var dbRef = firebase.database();
    var register = dbRef.ref('chat_register');
    var chat_room = dbRef.ref('chat_room');
    var personal_chat = dbRef.ref('chat_private');
    let isNotRegistered = true;
    let dataPath = null;
    register.on("value",function(snap){
      $("#listChatGroup").html("");
      snap.forEach(function(childSnapshot) {
        // console.log(childSnapshot.key);
        var data = childSnapshot.val();
        if (data.id != "{{auth()->user()->id}}") {
          // console.log("New User Arrived");
          var key = childSnapshot.key;
          // console.log(key);
          // console.log(data.name);
          var templateRoll = [
            '<li class="users_chat list-group-item d-flex justify-content-between align-items-center" data-path="'+key+'">',
            data.name,
            '</li>'
          ];
          // console.log(templateRoll);
          $("#listChatGroup").append(templateRoll.join(""));
        }
        if (data.id == "{{auth()->user()->id}}" && data.name == "{{auth()->user()->nama}}") {
          // console.log("Is Not Registered");
          isNotRegistered = false;
          localStorage.setItem("chatId",childSnapshot.key);
          return;
        }


      });
      // console.log(isNotRegistered);
      if (isNotRegistered) {
        register.push({
          id:"{{auth()->user()->id}}",
          created:"{{time()}}",
          name:"{{auth()->user()->nama}}"
        })
        // console.log("Register Successfully");
      }
    });
    toPath = null;
    $("#listChatGroup").on("click", '.users_chat', function(event) {
      // console.log("Selected");
      id = $(this).data("path");
      toPath = id;
      my = localStorage.getItem("chatId");
      // console.log(id);
      $("#listChatGroup").find(".users_chat").removeClass("active");
      $(this).addClass("active");
      chat_room.on("value",function(snap){
        $("#chatBoxContent").html("");
        snap.forEach(function(childSnapshot) {
          var data = childSnapshot.val();
          // console.log(data);
          var key = childSnapshot.key;
          // console.log(data.chatId);
          // console.log((my+id));
          if ((my+id) == data.chatId || (id+my) == data.chatId) {
            if (data.toPath != localStorage.getItem("chatId")) {
              // console.log("Ini Pesan Punyaku");
              var meTemplate = [
                '<li style="margin:5px 5px 5px" class="list-group-item d-flex justify-content-between align-items-center">',
                '<p><b>Saya</b></p>',
                '<hr>',
                '<p>'+data.msg+'</p>',
                '</li>'
              ];
              $("#chatBoxContent").append(meTemplate.join(""))
            }

            if (data.toPath == localStorage.getItem("chatId")) {
              {
                // console.log("Ini Pesan Punya Dia");
                path = dbRef.ref('chat_register/'+data.fromPath);
                path.on("value",function(s){
                  s.forEach(function(x) {
                    k = x.key;
                    d = x.val();
                    if (k == "name") {
                      var youTemplate = [
                        '<li style="text-align:right;margin:5px 5px 5px" class="list-group-item d-flex justify-content-between align-items-center">',
                        '<p><b>'+d+'</b></p>',
                        '<hr>',
                        '<p>'+data.msg+'</p>',
                        '</li>'
                      ];
                      $("#chatBoxContent").append(youTemplate.join(""))
                      return;
                    }
                  });
                })
              }
            }
          }


        });
      });

    });
    $("#chatText").on("submit", function(event) {
      text = $("#isiCitCat").val();
      fromPath = localStorage.getItem("chatId");
      if (toPath != null) {
        chat_room.push({
          	toPath:toPath,
          	fromPath:fromPath,
            chatId:(fromPath+toPath),
            msg:text
        });
        $("#isiCitCat").val("");
      }else {
        swal("Tolong Pilih Salah Satu Percakapan");
      }
    })
    @endif
  });
    var mybutton = document.getElementById("myBtn");
    // console.log('mybutton',mybutton)
    
    window.onscroll = function() {
      scrollFunction()
    };
    function scrollFunction() {
      if(mybutton != null){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          mybutton.style.display = "block";
        } else {
          mybutton.style.display = "none";
        }
      } 
    }
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }

</script>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
// (function() { // DON'T EDIT BELOW THIS LINE
// var d = document, s = d.createElement('script');
// s.src = 'https://ayokulakan-com.disqus.com/embed.js';
// s.setAttribute('data-timestamp', +new Date());
// (d.head || d.body).appendChild(s);
// })();
</script>
<!-- <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript> -->

</body>
</html>
