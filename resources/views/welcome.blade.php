<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--  Genera User  -->
   <meta name="user" content="{{ Auth::user() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Inventory</title>
    <!-- General CSS Files -->

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link rel="stylesheet" href="{{asset('backEnd')}}/assets/css/app.min.css">
    <link rel="stylesheet" href="{{asset('backEnd')}}/assets/bundles/bootstrap-social/bootstrap-social.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('backEnd')}}/assets/css/style.css">
    <link rel="stylesheet" href="{{asset('backEnd')}}/assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset('backEnd')}}/assets/bundles/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('backEnd')}}/assets/bundles/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="{{asset('backEnd')}}/assets/css/custom.css">

    <link rel='shortcut icon' type='image/x-icon' href='{{asset('backEnd')}}/assets/img/favicon.ico' />
    <style>
        .hover a:hover{
            background: #83bceb !important;
            color: white !important;
        }
    </style>
</head>

<body>
{{--<div class="loader"></div>--}}
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky" id="topnav" style="display: none" v-show="$route.path === '/' || $route.path === '/register' ? false : true ">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                    <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a></li>
                    <li>
                        <form class="form-inline mr-auto">
                            <div class="search-element">
                                <input class="form-control" type="search" placeholder="Buscar" aria-label="Search" data-width="200">
                                <button class="btn" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="main-sidebar sidebar-style-2" v-show="$route.path === '/' || $route.path === '/register' ? false : true " style="display: none" id="sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <router-link :to="{name: 'materialIndex'}"> <img alt="image" src="{{asset('backEnd')}}/assets/img/usfx.ico" class="header-logo" style="width:80px;height:100px" /> <span
                            class="logo-name">LABORATORIO ROBOTICA</span>
                    </router-link>
                </div>
                <ul class="sidebar-menu">
                    <li class="dropdown active">
                        <router-link :to="{name: 'personaIndex'}" class="nav-link"><i data-feather="monitor"></i><span>Menu Clientes</span></router-link>
                    </li>

                    
                    


                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                data-feather="briefcase"></i><span>Tipo Persona</span></a>
                        <ul class="dropdown-menu">
                            <li><router-link class="nav-link" :to="{name: 'tipoCreate'}">Agregar Tipo</router-link></li>
                            <li><router-link class="nav-link" :to="{name:'tipoIndex'}">Listar Tipos</router-link></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                data-feather="briefcase"></i><span>Registro Personas</span></a>
                        <ul class="dropdown-menu">
                            <li><router-link class="nav-link" :to="{name: 'personaCreate'}">Agregar Nuevo Registro</router-link></li>
                            <li><router-link class="nav-link" :to="{name:'personaIndex'}">Listar Registro</router-link></li>
                        </ul>
                    </li>


                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                data-feather="briefcase"></i><span>Materiales Laboratorio</span></a>
                        <ul class="dropdown-menu">
                            <li><router-link class="nav-link" :to="{name: 'materialCreate'}">Agregar Nuevo Material</router-link></li>
                            <li><router-link class="nav-link" :to="{name:'materialIndex'}">Listar Materiales</router-link></li>
                        </ul>
                    </li>



                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                data-feather="briefcase"></i><span>Prestamos Devoluciones</span></a>
                        <ul class="dropdown-menu">
                            <li><router-link class="nav-link" :to="{name: 'prestamoCreate'}">Nuevo Prestamo</router-link></li>
                            <li><router-link class="nav-link" :to="{name:'prestamoIndex'}">Devolucion Prestamo</router-link></li>
                        </ul>
                    </li>


                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                data-feather="briefcase"></i><span>Estado de los Prestamos</span></a>
                        <ul class="dropdown-menu">
                            <li><router-link class="nav-link" :to="{name: 'pendientesIndex'}">Pendientes de Devolucion</router-link></li>
                            <li><router-link class="nav-link" :to="{name:'devueltosIndex'}">Prestamos Devueltos</router-link></li>
                        </ul>
                    </li>

                    

                    

                   <li class="dropdown">
                                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                data-feather="briefcase"></i><span>Stock</span></a>
                        <ul class="dropdown-menu">
                            <li><router-link class="nav-link" :to="{name: 'disponible'}">Material Disponible</router-link></li>
                            <li><router-link class="nav-link" :to="{name:'ocupado'}">Material Ocupado</router-link></li>
                        </ul>

                    </li>





                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-cogs"></i><span>Settings</span></a>
                        <ul class="dropdown-menu">
                            <li><router-link class="nav-link" :to="{name: 'logout'}">Logout</router-link></li>
                        </ul>
                    </li>
                </ul>
            </aside>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <router-view></router-view>
            </section>

        </div>

    </div>
</div>
<!-- General JS Scripts -->

<script src="{{asset('js/app.js')}}"></script>
<script>
    let token = localStorage.getItem('token');
    if(token){
        $("topnav").css('display','');
        $("sidebar").css('display','')
    }

</script>

<script src="{{asset('backEnd')}}/assets/js/app.min.js"></script>
<script src="{{asset('backEnd')}}/assets/bundles/select2/dist/js/select2.full.min.js"></script>
<script src="{{asset('backEnd')}}/assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
<!-- JS Libraies -->
<script src="{{asset('backEnd')}}/assets/bundles/apexcharts/apexcharts.min.js"></script>
<!-- Page Specific JS File -->
<script src="{{asset('backEnd')}}/assets/js/page/index.js"></script>
<!-- Template JS File -->
<script src="{{asset('backEnd')}}/assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="{{asset('backEnd')}}/assets/js/custom.js"></script>



</body>
</html>
