<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <title>SIEC | @yield('title','Induccion')</title>
        <!-- Inicio Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" /><!--Boostrap-->
        <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.css') }}" /><!--Styles Inspinia-->
        <style type="text/css">

        body {margin-top: 0px;margin-left: 0px;}
        /*
        #page_1 {position:relative; overflow: hidden;margin: 58px 0px 174px 113px;padding: 0px;border: none;width: 703px;}
        #page_1 #p1dimg1 {position:absolute;top:0px;left:96px;z-index:-1;width:394px;height:99px;}
        #page_1 #p1dimg1 #p1img1 {width:394px;height:99px;}
        .dclr {clear:both;float:none;height:1px;margin:0px;padding:0px;overflow:hidden;}
        .ft0{font: bold 21px 'Calibri';line-height: 26px;}
        .ft1{font: 15px 'Calibri';line-height: 18px;}
        .ft2{font: 14px 'Calibri';line-height: 26px;}
        .ft3{font: 14px 'Calibri';line-height: 24px;}
        .ft4{font: 15px 'Calibri';line-height: 17px;}
        */
        .hola {
            padding: 6em;
        }
        /*
        .p0{text-align: left;padding-left: 84px;margin-top: 161px;margin-bottom: 0px;}
        .p1{text-align: left;margin-top: 60px;margin-bottom: 0px;}
        .p2{text-align: justify;padding-right: 108px;margin-top: 44px;margin-bottom: 0px;}
        .p3{text-align: justify;padding-right: 108px;margin-top: 27px;margin-bottom: 0px;}
        .p4{text-align: left;padding-right: 478px;margin-top: 102px;margin-bottom: 0px;}
        .p5{text-align: left;margin-top: 2px;margin-bottom: 0px;}
        */
        </style>
        <!-- Fin Styles -->
    </head>
    <body  class="@yield('body_class','')" ><!--Agregamos una clase al body por default-->
        <div class="row">
            <div class="col-lg-12 hola">
                
                    <div class="text-center">
                        <img class="logo-name " src="{{ asset('images/logos/logo.png') }}" alt="">
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <h4>DECLARACIÓN DE RECONOCIMIENTO DE FIRMA</h4>
                    </div>
                    <br>
                    <br>
                    <p>Quito, {{Date::now()->format('l j')}} de {{Date::now()->format('F')}} del {{Date::now()->format('Y')}}</p>
                    <br>
                    <br>
                    <p class="text-justify">
                    Yo, López Altamirano Jaime Rubén Danilo con CC Nro. 1707376719, en calidad de representante Legal de MARKET & DELIVERY SERVICIO A DOMICILIO S.A. con RUC Nro. 1792262429001 en la ciudad de Quito,  por medio de la presente declaración manifiesto que la firma que consta en la documentación adjunta (Pagaré a la orden, Solicitud de Incentivo Tarifario y Acta Entrega-Recepción) corresponde al Sr./ Sra {{$datos['cliente']}} con CC Nro. {{$datos['cedula']}}, CUEN Nro. {{$datos['cuen']}}, quien adquiere una cocina de inducción con financiamiento del Estado, Modelo {{$datos['modelopro']}}, con Número de Serie {{$datos['serie']}}, conforme se desprende de la factura No. 001-001-0000{{$datos['factura']}} con fecha de emisión {{$datos['fecha']}}.  Por lo que declaro asumir total responsabilidad en caso de presentarse reclamo formal por parte del Estado, concerniente con la veracidad de la firma suscrita por parte del cliente en los documentos señalados. 
                    <br>
                    <br>
                    Dejo a salvo dicha responsabilidad en caso que se llegare a comprobar la existencia de actos  dolosos comprobados judicialmente y que pudieran constituir posibles delitos y que se aprovechen de la buena fe de los funcionarios de MARKET & DELIVERY SERVICIO A DOMICILIO S.A..
                    </p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p>
                    López Altamirano Jaime Rubén Danilo <br>
                    1707376719 <br>
                    Representante Legal
                    <p>

            </div>
        </div>
	</body>
</html>
	
