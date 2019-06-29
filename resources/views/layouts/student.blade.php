<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TechEvents</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('public/dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/student.css') }}">
    <!-- for calendar -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    .view-source {
    position: fixed;
    display: block;
    right: 0;
    bottom: 0;
    z-index: 900;
    width: 100%;
    max-width: 600px;
    }
    .view-up-source {
    position: fixed;
    display: block;
    top: 0;
    z-index: 900;
    width: 100%;
    }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header" style="position: fixed; width: 100%;">
        <!-- Logo -->
        
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  @if(auth()->user()->notifications->count())
                  <span class="label label-warning">{{ auth()->user()->unreadNotifications->count()}}</span>
                  @endif
                </a>
                <ul class="dropdown-menu">
                  {{-- <li class="header">You have 10 notifications</li> --}}
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><a href="{{ route('student.markAsRead')}} "><b>Mark All as Read</b></a></li>
                      @foreach (auth()->user()->unreadNotifications()->paginate(5) as $n)
                        <li style="background-color: lightgrey">
                        <a href="{{ route('student.event',$n->data['event_id']) }}">
                          <i class="fa fa-users text-aqua"></i>{{ $n->data['data']}}
                        </a>
                      </li>
                      @endforeach
                      {{auth()->user()->unreadNotifications()->paginate(5)->links()}}
                      <li><b> Readed Notifications</b></li>
                      @foreach (auth()->user()->readNotifications()->paginate(5) as $n)
                        <li>
                        <a href="{{ route('student.event',$n->data['event_id']) }}">
                          <i class="fa fa-users text-aqua"></i>{{ $n->data['data']}}
                        </a>
                      </li>
                      @endforeach
                      {{auth()->user()->readNotifications()->paginate(5)->links()}}
                      
                      {{-- <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                          page and may cause design problems
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                      </li> --}}
                    </ul>
                  </li>
                  {{-- <li class="footer"><a href="#">View all</a></li> --}}
                </ul>
              </li>
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('public/dist/img/adminphoto.png') }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">Student</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ asset('public/dist/img/adminphoto.png') }}" class="img-circle" alt="User Image">
                    <p>
                      {{ Auth::user()->stu_col_name }}
                      <small>{{ Auth::user()->stu_name }}</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="{{ route('student.logout') }}">
                  <span class="glyphicon glyphicon-log-out"></span>
                </a>
              </li>
            </ul>
          </div>
          <label style="font-size: 24px; margin-top: 8px; ">TechEvent</label>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar" style="position: fixed;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset('public/dist/img/adminphoto.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->stu_name }}</p>
            </div>
          </div>
          <!-- search form -->
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">

            <li>
              <a href="{{ route('student.edit') }}" class="nav-link">
                <i class="fa fa-dashboard"></i> <span>Edit Profile</span>
              </a>
            </li>
            
            <li>
              <a href="{{ route('student.index') }}" class="nav-link">
                <i class="fa fa-dashboard"></i> <span>Events</span>
              </a>
            </li>
            
            <li>
              <a href="{{ route('student.college') }}" class="nav-link">
                <i class="nav-icon fa fa-th"></i> <span>College</span>
                <span class="pull-right-container">
                </span>
              </a>
            </li>
            
            <li>
              <a href="{{ route('student.registerevent') }}" class="">
                <i class="fa fa-pie-chart"></i> <span>Participated Events</span>
              </a>
            </li>

            <li>
              <a href="{{ route('student.score') }}" class="">
                <i class="fa fa-pie-chart"></i> <span>Participated Events Socre</span>
              </a>
            </li>

            <li>
              <a href="{{ route('student.winner') }}" class="">
                <i class="fa fa-pie-chart"></i> <span>Winner List</span>
              </a>
            </li>
            <li class="header">Action</li>
            <li>
              <a class="fa fa-circle-o" href="{{ route('student.logout') }}">
                Logout
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
      </div>
      <!-- /.content-wrapper -->
      <!-- <footer class="main-footer">
        <strong>admin panal<a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
      </footer> -->
      <!-- Control Sidebar -->
      
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 3 -->
    <script src="{{ asset('public/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('public/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="{{ asset('public/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('public/bower_components/morris.js/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('public/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('public/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('public/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('public/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('public/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('public/dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('public/dist/js/demo.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
  </body>
</html>