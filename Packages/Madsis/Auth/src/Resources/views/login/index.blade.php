@extends('auth::layouts.master')
@section('title', 'Inicia sesión')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <ul class="middle-box  animated fadeInDown" style="padding-top: 15px;">
                <li><a href="{{ url('/register') }}"> 1.- Primero debes registrarte Click Aquí</a></li>
                <li><a href="{{ url('/register') }}"> 2.- Hacer Login con tu usuario y contraseña en esta pantalla</a></li>
            </ul>
        </div>
        <div class="col-md-offset-2 col-md-6">
            <div class="row">
                <form class="m-t col-md-12" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} col-md-5">
                        <label class="label-black control-label">Correo electrónico</label>
                        <input id="username" type="email" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-5">
                        <label class="label-black control-label">Contraseña</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-1" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-primary block m-b">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop