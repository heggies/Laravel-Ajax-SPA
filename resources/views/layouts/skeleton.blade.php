<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title id="title">AdminLTE 2 | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/nprogress.css') }}">
  <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <script src="{{ asset('dist/js/nprogress.js') }}"></script>
  <script src="{{ asset('dist/js/underscore-min.js') }}"></script>
  <script type="text/javascript">
    $(window).load(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    });
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="index2.html" class="logo">
      <span class="logo-mini"><b>A</b>LT</span>
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li><a href="javascript:void(0)" onclick="ajaxRoute('')"><i class="fa fa-circle-o text-blue"></i> <span>Data Siswa</span></a></li>
        <li><a href="javascript:void(0)" onclick="ajaxRoute('tambah')"><i class="fa fa-circle-o text-blue"></i> <span>Tambah</span></a></li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <p>CATATAN: gunakan <a target="_blank" href="https://developer.mozilla.org/id/docs/Web/JavaScript/Reference/Operators/Conditional_Operator">ternary operator</a> untuk membuat "if statement" pada @ extends</p>
      @yield('content')
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>


  <div class="control-sidebar-bg"></div>
</div>

<script type="text/javascript">
  function ajaxRoute(id, siswa = null) {
    NProgress.set(0.0);
    $.ajax({
      url: '{{ url('') }}/'+id,
      type: 'GET',
      data: siswa,
      success: function(data) {
        if (data.success == 1) {
          window.history.pushState("", "", "/"+id);
          $(".content").html(data.html);
        }
        NProgress.set(1.0);
      }
    });
    return false;
  }
</script>
</body>
</html>
