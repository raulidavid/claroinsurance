<div class="DatosInformativos panel panel-default">
    <div class="panel-heading">
        Datos básicos para trabajar en el sistema
    </div>
    <div class="panel-body gray-bg">
        <div class="row">
            <div class="col-sm-2">
                <img class="img-responsive img-rounded imageprofile" src="/images/user/default-imageprofile.jpg" alt="Foto Perfil">
            </div>
            <div class="col-sm-10">
                <div class="table-responsive">
                    <table id="ventasusuariototal" class="table  table-hover table-striped table-condensed border-right">
                        <thead>
                        <tr>
                            <th>NACIONALIDAD</th>
                            <th>TIPO DOCUMENTO</th>
                            <th>NÚMERO DE DOCUMENTO</th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="nacionalidad"></span></td>
                            <td><span class="tipodocumento"></span></td>
                            <td><span class="ndocumento"></span></td>
                            <td><span class="nombres"></span></td>
                            <td><span class="apellidos"></span></td>
                        </tr>
                        </tbody>
                        <thead>
                        <tr>
                            <th>EMAIL</th>
                            <th>FECHA DE NACIMIENTO</th>
                            <th>EDAD</th>
                            <th>ESTADO CIVIL</th>
                            <th>GÉNERO</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="email"></span></td>
                            <td><span class="fechanacimiento"></span></td>
                            <td><span class="edad"></span></td>
                            <td><span class="estadocivil"></span></td>
                            <td><span class="genero"></span></td>
                        </tr>
                        </tbody>
                        <thead>
                        <tr>
                            <th>USUARIO</th>
                            <th>PROVINCIA</th>
                            <th>CANTÓN</th>
                            <th>PARROQUIA</th>
                            <th>DIRECCIÓN</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="username"></span></td>
                            <td><span class="provincia"></span></td>
                            <td><span class="canton"></span></td>
                            <td><span class="parroquia"></span></td>
                            <td><span class="calleprimaria"></span></td>
                        </tr>
                        </tbody>
                        <thead>
                        <tr>
                            <th>TELÉFONO MÓVIL</th>
                            <th>TELÉFONO DOMICILIO</th>
                            <th>HOJA DE VIDA</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="telefonomovil"></span></td>
                            <td><span class="telefonodomicilio"></span></td>
                            <td><a target="_blank" href="#" class="hojavida"><i class="fa fa-file-o fa-lg"></i></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default text-center">
            <div class="panel-body gray-bg">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button id="save_user" data-toggle="modal" data-target="#myModal" type="button" class="ladda-button ladda-button-demo btn btn-info"  data-style="zoom-in"><i class="fa fa-check"></i> Aprobar</button>
                        <!--<button type="button" class="ladda-button ladda-button-demo btn btn-danger"  data-style="zoom-in"><i class="fa fa-close"></i> Descartar</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal" tabindex="-1"  role="dialog" style="z-index: 999;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close ClearImageProfile" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <!--<i class="fa fa-laptop modal-icon"></i>-->
                <h4 class="modal-title">Editar Foto de Perfil</h4>
                <!--<small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>-->
                <div  class="contact-box center-version" style="border:none;margin-bottom: 0;">

                </div>
            </div>
            <div class="modal-body">
                <div class="col-xs-12">
                    <div id=previewimagen>
                        <div class="row">
                            <hr class="hidden-md hidden-lg">
                            <div class="col-xs-12">
                                <div class="image-crop">
                                    <img id="imgHolder" src="" class="img-responsive img-rounded imageprofile">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <h4>Vista Previa</h4>
                                <div class="docs-preview clearfix">
                                    <div class="img-preview img-preview-sm"></div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-xs-6" style="margin-top: 10%;">
                                <div class="form-group">
                                    <label title="Upload image file" for="inputImage" class="btn btn-warning">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" accept="image/*" id="inputImage" class="hide">
                                        Subir Foto
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="btn-group">
                                        <button id="zoomIn" type="button" class="btn btn-info" title="Acercar">
                                      <span class="docs-tooltip" data-toggle="tooltip">
                                        <span class="fa fa-search-plus"></span>
                                      </span>
                                        </button>
                                        <button id="zoomOut" type="button" class="btn btn-info" title="Alejar">
                                      <span class="docs-tooltip" data-toggle="tooltip">
                                        <span class="fa fa-search-minus"></span>
                                      </span>
                                        </button>
                                        <button id="rotateLeft" type="button" class="btn btn-info" title="Girar Izquierda">
                                        <span class="docs-tooltip" data-toggle="tooltip">
                                            <span class="fa fa-rotate-left"></span>
                                        </span>
                                        </button>
                                        <button id="rotateRight" type="button" class="btn btn-info" title="Girar Derecha">
                                        <span class="docs-tooltip" data-toggle="tooltip">
                                            <span class="fa fa-rotate-right"></span>
                                        </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p style="margin-top:130px;"><strong>Nota: </strong>Edita tu imagen moviendo o redimensionando el crop o a su vez los controles.</p>
                <p style="color:red;" class="errorPostulant text-center hidden"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-check"></i> Listo</button>
                <button type="button" class="btn btn-white ClearImageProfile" data-dismiss="modal"> Cancelar</button>
            </div>
        </div>
    </div>
</div>

@section('scripts.form')
<script>
$( document ).ready(function() {

    let getUrlParameter = function getUrlParameter(sParam) {
        let sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    let postulant = getUrlParameter('Postulant');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/Postulant/'+postulant,
        type: 'get',
        dataType: "json",
    }).done(function(data){
        loadPostulantInfoById(data);
    });

    const loadPostulantInfoById =  function(data){
        $('.nacionalidad').text(data.PTLNACIONALIDAD.nombre);
        $('.tipodocumento').text(data.PTLTIPODOCUMENTO.nombre);
        $('.nombres').text(data.PTLNOMBRES);
        $('.apellidos').text(data.PTLAPELLIDOS);
        $('.username').text(data.PTLUSERNAME);
        $('.ndocumento').text(data.PTLNDOCUMENTO);
        $('.email').text(data.PTLEMAIL);
        $('.fechanacimiento').text(data.PTLFECNACIMIENTO);
        $('.edad').text(data.PTLEDAD);
        $('.estadocivil').text(data.PTLESTADOCIVIL.nombre);
        $('.genero').text(data.PTLGENERO.nombre);
        $('.provincia').text(data.PTLPROVINCIA.nombre);
        $('.canton').text(data.PTLCANTON.nombre);
        $('.parroquia').text(data.PTLPARROQUIA.nombre);
        $('.calleprimaria').text(data.PTLDIRECCION);
        $('.telefonomovil').text(data.PTLCELULAR);
        $('.telefonodomicilio').text(data.PTLTELEFONO);
        $('.hojavida').attr("href",data.PTLHOJAVIDAURL);
        $('.imageprofile').attr("src",data.PTLIMGURL);
    }

    $("#perfil").ready( function(event) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/perfiles',
            type: 'get',
            dataType: "json"
        }).done(function (perfil){
            $('#perfil').append($('<option></option>'));
            $.each(perfil, function(i) {
                if(perfil[i].id==1)
                {
                    $('#perfil').append("<option disabled='disabled' value=\""+perfil[i].id+"\">"+perfil[i].name+"<\/option>");
                }else{
                    $('#perfil').append("<option value=\""+perfil[i].id+"\">"+perfil[i].name+"<\/option>");
                }
            });
            $('#perfil').select2({
                placeholder: "Selecciona Perfil",
                allowClear: true,
                dropdownParent: $('#myModal .modal-content')
            });

        });
    });

    function format (option) {
        if (!option.id) { return option.text; }
        var ob = '<img class="img-circle" src="'+option.urlimgprofilesmall+'fotoperfil.jpg" />' +" "+ option.text;	// replace image source with option.img (available in JSON)
        return ob;
    };
    $('#supervisor').select2({
        ajax: {
            minimumInputLength: 4,
            delay: 250,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/User/search',
            type: 'get',
            dataType: "json",
            data: function (params) {
                var query = {
                    search: params.term
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id : item.USERID,
                            text: item.IDTNDOCUMENTO+' '+item.USERNOMBRES+' '+item.USERAPELLIDOS,
                            urlimgprofilesmall: item.IDTIMGPROFILESMALL
                        }
                    })
                };
            }
        },
        templateResult: format,
        escapeMarkup: function(m) { return m; },
        placeholder: "Selecciona Supervisor",
        allowClear: true,
        dropdownParent: $('#myModal .modal-content')
    });



    var convertTypeNull = function (value){
        if (value === null) return "";
        if (value === undefined) return "";
        return value;
    };

    $('#Approve').on('click', function() {
        let form = new FormData();
        form.append('_token', $('input[name=_token]').val());
        form.append('perfil', $('#perfil option:selected').text());
        form.append('userfather', convertTypeNull($('#supervisor').val()));
        form.append('postulant', postulant);
        form.append('emailempresarial', $('#email').val());
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "/Postulant",
            data: form,
            processData: false,
            contentType: false,
        }).done(function(data) {
            toastr.success(data, '', {timeOut: 4000,progressBar: true});
        }).fail(function(data) {
            $('.errorPerfil').addClass('hidden');
            $('.errorSupervisor').addClass('hidden');
            $('.errorEmailEmpresarial').addClass('hidden');
            $('.errorPostulant').addClass('hidden');
            if ((data.responseJSON)) {
                if (data.responseJSON.perfil) {
                    $('.errorPerfil').removeClass('hidden');
                    $('.errorPerfil').text(data.responseJSON.perfil);
                }
                if (data.responseJSON.userfather) {
                    $('.errorSupervisor').removeClass('hidden');
                    $('.errorSupervisor').text(data.responseJSON.userfather);
                }
                if (data.responseJSON.emailempresarial) {
                    $('.errorEmailEmpresarial').removeClass('hidden');
                    $('.errorEmailEmpresarial').text(data.responseJSON.emailempresarial);
                }
                if (data.responseJSON.postulant) {
                    $('.errorPostulant').removeClass('hidden');
                    $('.errorPostulant').text(data.responseJSON.postulant);
                }



            }
        });
    });



})
</script>
@stop
