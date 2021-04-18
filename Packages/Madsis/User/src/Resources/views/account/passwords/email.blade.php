@extends('user::layouts.master')
@section('title','Recuperar Contraseña')
@section('content')
    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content gray-bg">
                    <div class="text-center">
                        <a href="{{ url('/') }}"> <img class="logo-name " src="{{ asset('images/logos/logo.png') }}" alt=""></a>
                    </div>
                    <h2 class="font-bold">Restablecer Contraseña</h2>

                    <p>
                        Ingrese su dirección de correo electrónico y su contraseña será restablecida y enviada por correo electrónico.
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" type="email" class="form-control" placeholder="Correo Electrónico Institucional" name="email" value="{{ old('email') }}" required>
                                    <br>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b">Enviar nueva contraseña</button>

                            </form>
                             <div class="row">
            <div class="col-md-12">
                <p class="m-t"> <small> SIEC v1.0 - Market and Delivery ® 2020 Todos los Derechos Reservados</small> </p>
            </div>
        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
@endsection
