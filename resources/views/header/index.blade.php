        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg " role="navigation" style="margin-bottom: 0">
                <!--Inicio barra buscar -->
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <!--Fin barra buscar -->
                <!--Inicio barra salir -->
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a data-toggle="dropdown" class="dropdown-toggle" type="button"> {{ Auth::user()->email }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--Fin barra salir -->
            </nav>
        </div>