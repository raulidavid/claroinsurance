<!DOCTYPE html>
<html><head>
        <meta charset="UTF-8" />
        <!-- Inicio Styles -->
        <link rel="stylesheet" href="css/bootstrap.min.css" /><!--Boostrap-->
        <style type="text/css">
            body {margin-top: 0px;margin-left: 0px;}
            .direccion {
                padding-top: 7px;
                font-size: 10px;
                padding-left: 232px;
            }
            .ciudad {
                padding-top: 4px;
                font-size: 10px;
                padding-left: 220px;
            }
            .telefono {
                padding-top: 4px;
                font-size: 10px;
            }
            .convencional{
                padding-left: 295px;
            }
            .movil{
                padding-left: 397px;
            }
            .direcciona {
                padding-top: 15px;
                font-size: 10px;
                padding-left: 442px;
            }
            .ciudada {
                padding-top: 4px;
                font-size: 10px;
                padding-left: 432px;
            }
            .convencionala{
                padding-left: 504px;
            }
            .movila{
                padding-left: 608px;
            }
            .direccionag {
                padding-top: 29px;
                font-size: 10px;
                padding-left: 442px;
            }
            .ciudadag {
                padding-top: 4px;
                font-size: 10px;
                padding-left: 432px;
            }
        </style>
        <!-- Fin Styles -->
    </head><body>@if($datos['tipocliente']=="propietario")
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
            <div class="direccion">
                {{$datos['direccion']}}
            </div>
            <div class="ciudad">
                {{$datos['ciudad']}} 
            </div>
            @if($datos['tipotelefono']=="movil")
            <div class="telefono movil">
            @else
            <div class="telefono convencional">
            @endif
                {{$datos['telefono']}}
            </div>
            @elseif ($datos['tipocliente']=="arrendatario")
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="direcciona">
                    {{$datos['direccion']}}
                </div>
                <div class="ciudada">
                    {{$datos['ciudad']}} 
                </div>
                @if($datos['tipotelefono']=="movil")
                    <div class="telefono movila">
                @else
                    <div class="telefono convencionala">
                @endif
                    {{$datos['telefono']}}
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="direccionag">
                    {{$datos['direccion']}}
                </div>
                <div class="ciudadag">
                    {{$datos['ciudad']}} 
                </div>
            @endif
	</body></html>
	
