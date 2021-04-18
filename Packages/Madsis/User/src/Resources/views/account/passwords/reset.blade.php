@extends('user::layouts.master')

@section('content')
<br>
<br>
<br>
<br>
<br>
<div class="text-center animated fadeInDown">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Restablecer Contraseña</div>

                <div class="panel-body gray-bg">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <!--<h1 class="logo-name">INDUCCION</h1>-->
                        <a href="{{ url('/') }}"> <img class="logo-name" src="{{ asset('images/logos/logo.png') }}" alt=""></a>
                    </div>
                    <br>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electronico:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" placeholder="Correo Electrónico Institucional" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Nueva Contraseña:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" placeholder="Nueva Contraseña" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña:</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="Confirmar Contraseña"    class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Restablecer Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="m-t"> <small> SIEC v1.0 - MADSIS ® 2020 Todos los Derechos Reservados</small> </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
