<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>
 <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- new -->
 <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>  
     <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">   

    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

     <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('admin/layouts/sidebar')
    @include('admin/layouts/header')
    <div class="content-wrapper">
         <main class="bg-main">

         @yield('content')
         
     </main>
        </div>
    
    @include('admin/layouts/footer')
</div>
</body>
</html>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  


<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>  -->

     <!-- search functionality js -->

<script src="{{asset('js/adminlte.js')}}"></script>

<script src="{{asset('js/main.js')}}"></script>

<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!-- datatable -->
  <script>
$(document).ready( function () {
    $('#myTable').DataTable({
    //    "bPaginate": false, //hide pagination
    // "bFilter": false, //hide Search bar
    // "bInfo": false, 
     "pageLength": 10,
     "oLanguage": {
        "sEmptyTable": "Nenhum registro disponível",
         "sLengthMenu": "Mostrar_MENU_ registros",
         "sSearch": "Pesquisa",
          "sInfo": "Mostrando _START_ to _END_ of _TOTAL_ entradas",
            "sInfoEmpty": "Mostrando 0 to 0 of 0 entradas",
            "oPaginate": {
                    "sFirst": "First",
                    "sLast": "Last",
                    "sNext": "próximo",
                    "sPrevious": "prévio"
                },// hide showing entries

    },
     
    }
      );
} );
</script>
   
<script>
$(document).ready( function () {
    $('#mytable').DataTable({
    //    "bPaginate": false, //hide pagination
    // "bFilter": false, //hide Search bar
    // "bInfo": false, 
     "pageLength": 10,
     "oLanguage": {
        "sEmptyTable": "Nenhum registro disponível",
         "sLengthMenu": "Mostrar_MENU_ registros",
         "sSearch": "Pesquisa",
          "sInfo": "Mostrando _START_ to _END_ of _TOTAL_ entradas",
            "sInfoEmpty": "Mostrando 0 to 0 of 0 entradas",
            "oPaginate": {
                    "sFirst": "First",
                    "sLast": "Last",
                    "sNext": "próximo",
                    "sPrevious": "prévio"
                },// hide showing entries

    },
     
    }
      );
} );
</script>

<!-- <script type="text/javascript">
    $('#tabs-nav li:first-child').addClass('active');
$('.tab-content').hide();
$('.tab-content:first').show();

// Click function
$('#tabs-nav li').click(function(){
  $('#tabs-nav li').removeClass('active');
  $(this).addClass('active');
  $('.tab-content').hide();

  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});
</script> -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Tem certeza de que deseja excluir este registro?`,
              text: "Se você excluir isso, ele desaparecerá para sempre.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>
<!-- <script>
$(document).ready(function(){
  $('ul li').click(function(){
   $('li').removeClass("menu-open");
    $(this).addClass("menu-open");
});
});
</script> -->
 <script>
    $('#search').click(function() {



var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();


    $.ajax({
      url: "{{ url('/bhistory') }}", 
      type: "GET",  
      data:{
        from_date:from_date,to_date:to_date
      },
      success:function(data)
      {

        // var colids = data.booking;

      // alert(data);

          // $('#my').html('');
          //  for(var i = 0; i < colids.length; i++)
          //           {

                     
          //               var option = '<tr><td>'+ids[i]+'</td><tr>';
          //               $('#my').append(option);
                  

          //           }          
      }
  });
}); 
</script> 