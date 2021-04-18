@extends('layouts.home') <!--Extendemos layaout home-->
@section('title','404 Error')<!--Cambiamos el título de la página-->
@section('body_class', '') <!--Agregamos una clase al body por default-->
@section('content')

    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Página No Encontrada</h3>

        <div class="error-desc">
            Lo sentimos, pero la página que está buscando ha sido encontrada. Prueba a comprobar la URL de error, luego pulsa el botón de actualización en tu navegador o intenta encontrar algo más en nuestra aplicación.
        </div>
    </div>

@stop




    



