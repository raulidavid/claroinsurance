@extends('layouts.app') <!--Extendemos layaout home-->
@section('title','404 Error')<!--Cambiamos el título de la página-->
@section('body_class', 'gray-bg') <!--Agregamos una clase al body por default-->
@section('content')
    <div class="middle-box text-center animated fadeInDown">
    	<div>
    		<a href="javascript:history.back()"> <img class="logo-name " src="{{ asset('images/logos/logo.png') }}" alt=""></a>
    	</div>
    	<p>SIEC SISTEMA INDUCCION ECUADOR</p>
    	<h2 class="font-bold">Página No Encontrada</h2>
        <h1>404</h1>
        <div class="error-desc">
            Lo sentimos, pero la página que está buscando ha sido encontrada. Prueba a comprobar la URL de error, luego pulsa el botón de actualización en tu navegador o intenta encontrar algo más en nuestra aplicación.
        </div>
        <br>
        <a href="javascript:history.back()" type="button" class="ladda-button ladda-button-demo btn btn-primary"  data-style="zoom-in">Regresar</a>
        <p class="m-t"> <small> SIEC v1.0 - INDUCCION ® 2017 Todos los Derechos Reservados</small> </p>
    </div>
	
@stop


