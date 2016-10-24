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
                <a class="navbar-brand" href="{{ url('compra/create') }}">SystemContab</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->name}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    <?php $estatus=1; ?>
                        <li>
                            <a href="{{ url('empleado/edit',array('id'=>Auth::user()->id,'estatus'=>$estatus)) }}"><i class="fa fa-fw fa-user"></i> Perfil</a>
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
<!--
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
                        
                        -->
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
        <div style="font: 140% 'News Cycle', arial, sans-serif; color: #FFF;
  text-align: center;"><BR><CENTER >SISTEMAS HECHOS A SU MEDIDAD<BR><br>
_____$$$$$$$$$$$$$$$$$$$$$ <BR>
_____$$$$$$$$$$$$$$$$$$$$$$$$$$$ <BR>
____$$$$$$$____$$$$$$$$$____$$$$$$$$ <BR>
___$$$$$$$_______$$$$$$$_______$$$$$$$ <BR>
__$$$$$$$________$$$$$$$________$$$$$$$$ <BR>
_$$$$$$$_________$$$$$$$_________$$$$$$$$ <BR>
$$$$$$$$__________$$$$$$$__________$$$$$$$$ <BR>
$$$$$$$$_________$$$$$$$$$_________$$$$$$$$$ <BR>
$$$$$$$$________$$$_$$$_$$$________$$$$$$$$$ <BR>
$$$$$$$$$$______$$$___$___$$$______$$$$$$$$$$$ <BR>
$$$$$$$$$$$$$$$$$$___$$$___$$$$$$$$$$$$$$$_"$$ <BR>
$$$$_$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$__o$$$ <BR>
$$$__$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$____$$$$ <BR>
_$$$__$"$$$$$$$$$$$$$$$$$$$$$$$$$$"_____o$$$$ <BR>
_"$$o__$$__$$"$$$$$$$$$$$$$$"$$__$$____o$$$" <BR>
_$$o$____$$__"$$"""$$"$$"__$$______$_$$$ <BR>
__$$$o$_______$$___$$___$$_____$$_o$$$$ <BR>
___"$$$$o______________________o$$$$$" <BR>
____"$$o$$___$$___$$___$$___o$$$$$ <BR>
____""$$$$o$o$o$o$o$o$o$o$$$$"<br><br>
<footer >
               <!-- pie de pagina-->
               
              <p>Copyright & copy 2016;Powered By CJG & YAO | systemContab.co</p>
            </footer></CENTER></div>
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
