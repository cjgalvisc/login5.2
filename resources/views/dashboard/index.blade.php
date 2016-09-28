<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PRINCIPAL</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SystemContab</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->name}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>

                        <li>
                            <a href="{{ url('/logout') }}"><i class="fa fa-fw fa-power-off"></i>Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="#" class="active"><i class="fa fa-fw fa-dashboard"></i> Compras<span class="fa arrow"> </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('compra/create')}}">Ingresar</a>
                            </li>
                            <li>
                                <a href="{{url('compra/list')}}">Listar</a>
                            </li>

                        </ul>

                        <a href="#" class="active"><i class="fa fa-fw fa-dashboard"></i> Proveedor<span class="fa arrow"> </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('proveedor/create')}}">Ingresar</a>
                            </li>
                            <li>
                                <a href="{{url('proveedor/list')}}">Listar</a>
                            </li>

                        </ul>

                        <a href="#" class="active"><i class="fa fa-fw fa-dashboard"></i> Tipo de Producto<span class="fa arrow"> </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('tipoProducto/create')}}">Ingresar</a>
                            </li>
                            <li>
                                <a href="{{url('tipoProducto/list')}}">Listar</a>
                            </li>

                        </ul>
                        
                        <a href="#" class="active"><i class="fa fa-fw fa-dashboard"></i> Producto<span class="fa arrow"> </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('producto/create')}}">Ingresar</a>
                            </li>
                            <li>
                                <a href="{{url('producto/list')}}">Listar</a>
                            </li>
                        </ul>
                        
                        
                        <!--
                        <a href="#" class="active"><i class="fa fa-fw fa-dashboard"></i> Empleado<span class="fa arrow"> </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('empleado/create')}}">Ingresar</a>
                            </li>
                            <li>
                                <a href="{{url('empleado/list')}}">Listar</a>
                            </li>

                        </ul>
                        -->
                        
                    </li>
                 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        @yield('contenido')
       
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/js/jquery.js"></script>
    
    

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="/js/plugins/morris/raphael.min.js"></script>
    <script src="/js/plugins/morris/morris.min.js"></script>
    <script src="/js/plugins/morris/morris-data.js"></script>

</body>

</html>
