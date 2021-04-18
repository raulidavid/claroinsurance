{{--<!--Inicio Footer-->
<div class="row">
    <footer class="footer">
        <div class="pull-right">
            <strong>Copyright</strong> Market&Delivery &copy;  {{Carbon\Carbon::now()->format('Y')}}
        </div>
        <div>
            @if (env('APP_DEBUG'))
                <small> Auth::user()->rol->tipo_rol->display_name </small>
            @endif
            <small class="text-muted" >Hora de Ingreso: {{Carbon\Carbon::now()}}</small>
        </div>
    </footer>
</div>
<!--Fin Footer-->--}}