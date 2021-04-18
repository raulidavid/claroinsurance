<!DOCTYPE html>
<html><head>
        <meta charset="UTF-8" />
        <!-- Inicio Styles -->
        <link rel="stylesheet" href="css/bootstrap.min.css" /><!--Boostrap-->
        <style type="text/css">
            body {margin-top: 0px;margin-left: 0px;}
            .facturador {
                padding-top: 21px;
                font-size: 10px;
                padding-left: 64px;
            }
            .cliente {
                font-size: 10px;
                padding-left: 108px;
            }
            .cedula {
                font-size: 14px;
                padding-left: 42px;
            }
            .cedulac {
                font-size: 14px;
                padding-left: 275px;
            }

        </style>
        <!-- Fin Styles -->
    </head><body>
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
        {{--
        <div class="facturador">
            {{$datos['facturador']}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   {{$datos['cliente']}}           
        </div>--}}
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label facturador col-sm-6">{{$datos['facturador']}}</label>
                <label class="control-label cliente col-sm-6">{{$datos['cliente']}}</label>
            </div>
        </div>
        <div class="row">
            <label class="control-label cedula">{{$datos['cedula']}}</label>
            <label class="control-label cedulac">{{$datos['cedulac']}}</label>
        </div>


        
    </body></html>
    
