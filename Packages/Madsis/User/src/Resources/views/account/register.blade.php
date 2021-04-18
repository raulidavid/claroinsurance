@extends('user::layouts.master')
@section('title', 'Regístrate')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="demo">
                    <div class="step-app">
                        <ul class="step-steps">
                            <li class="tab1"><a href="#step1">1. Datos Básicos</a></li>
                        </ul>
                        <div class="step-content">
                            <div class="step-tab-panel" id="step1">
                                <h2>Datos Básicos</h2>
                                <form class="row"name="frmInfo" id="frmInfo">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="col-sm-4">
                                                    <label class="label-black control-label">Cédula*</label>
                                                    <input id="ndocumento" name="ndocumento" type="text"
                                                           placeholder="No de Documento" class="form-control">
                                                    <p style="color:red;"
                                                       class="errorNdocumento text-center hidden"></p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="label-black control-label">Password*</label>
                                                    <input id="password" name="password" type="password"
                                                           placeholder="Password" class="form-control">
                                                    <p style="color:red;"
                                                       class="errorPassword text-center hidden"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="col-sm-4">
                                                    <label class="label-black control-label">Nombres*</label>
                                                    <input id="nombres" name="nombres" type="text" placeholder="Nombres"
                                                           class="form-control">
                                                    <p style="color:red;" class="errorNombres text-center hidden"></p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="label-black control-label">Apellidos*</label>
                                                    <input id="apellidos" name="apellidos" type="text"
                                                           placeholder="Apellidos" v-model="apellidos"
                                                           class="form-control">
                                                    <p style="color:red;" class="errorApellidos text-center hidden"></p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="label-black control-label">Email*</label>
                                                    <input id="email" name="email" type="text" placeholder="Email"
                                                           v-model="email" class="form-control">
                                                    <p style="color:red;" class="errorEmail text-center hidden"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class='col-sm-4'>
                                                    <label class="label-black control-label">Fecha de Nacimiento*</label>
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <input id='fec_nacimiento' name="fec_nacimiento" type='text' class="form-control" placeholder="Eje: 01/06/1988"/>
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                    <p style="color:red;" class="errorFecNacimiento text-center hidden"></p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="label-black control-label">Teléfono Movil*</label>
                                                    <input id="tlf_movil" name="tlf_movil" type="tel"
                                                            placeholder="Teléfono Movil" class="form-control">
                                                    <p style="color:red;"
                                                        class="errorTlfMovil text-center hidden"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="col-sm-4">
                                                    <label for="provincia" class="label-black control-label">Seleccione
                                                        Provincia*</label>
                                                    <select style="width:100%" id="provincia"
                                                            class="provincia form-control m-b" name="provincia">
                                                    </select>
                                                    <p style="color:red;"
                                                        class="errorProvincia text-center hidden"></p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="canton" class="label-black control-label">Seleccione
                                                        Canton*</label>
                                                    <select style="width:100%" id="canton" class="form-control m-b"
                                                            name="canton">
                                                    </select>
                                                    <p style="color:red;"
                                                        class="errorCanton text-center hidden"></p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="parroquia" class="label-black control-label">Seleccione
                                                        Parroquia*</label>
                                                    <select style="width:100%" id="parroquia"
                                                            class="form-control m-b" name="parroquia">
                                                    </select>
                                                    <p style="color:red;" class="errorParroquia text-center hidden"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="step-footer text-right">
                            <button data-direction="finish" class="btn btn-primary ">Finalizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts.form')
    {{--<script src="https://www.google.com/recaptcha/api.js" async defer></script>--}}
    <script>
        $(document).ready(function () {
            var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
                return false;
            };
            var logo = getUrlParameter('logo');

            if (logo==='false'){
                $('.logo-name').css({"display":"none"});
            }
            $('input[type=text]').on('keyup keydown keypress', function(e)
            {
                $(this).val($(this).val().toUpperCase());
            });
            $("#fec_nacimiento").ready(function (event) {
                $('#fec_nacimiento ').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd/mm/yyyy"
                });
            });
            //
            $("#nacionalidad").ready(function (event) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/nacionalidades',
                    type: 'get',
                    dataType: "json"
                }).done(function (nacionalidad) {
                    $('#nacionalidad').append($('<option></option>'));
                    $.each(nacionalidad, function (i) {
                        $('#nacionalidad').append("<option value=\"" + nacionalidad[i].id + "\">" + nacionalidad[i].nombre + "<\/option>");
                    });
                    $('#nacionalidad').select2({
                        placeholder: "Selecciona Nacionalidad",
                        allowClear: true
                    });

                });
            });

            $("#tipo_documento").ready(function (event) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/tipos_documentos',
                    type: 'get',
                    dataType: "json"
                }).done(function (documento) {
                    $('#tipo_documento').append($('<option></option>'));
                    $.each(documento, function (i) {
                        $('#tipo_documento').append("<option value=\"" + documento[i].id + "\">" + documento[i].nombre + "<\/option>");
                    });
                    $('#tipo_documento').select2({
                        placeholder: "Selecciona Documento",
                        allowClear: true
                    });

                });
            });
            $("#genero").ready(function (event) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/genero',
                    type: 'get',
                    dataType: "json"
                }).done(function (genero) {
                    $('#genero').append($('<option></option>'));
                    $.each(genero, function (i) {
                        $('#genero').append("<option value=\"" + genero[i].id + "\">" + genero[i].nombre + "<\/option>");
                    });
                    $('#genero').select2({
                        placeholder: "Selecciona Genero",
                        allowClear: true
                    });

                });
            });

            $("#civil").ready(function (event) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/estado_civil',
                    type: 'get',
                    dataType: "json"
                }).done(function (estado_civil) {
                    $('#civil').append($('<option></option>'));
                    $.each(estado_civil, function (i) {
                        $('#civil').append("<option value=\"" + estado_civil[i].id + "\">" + estado_civil[i].nombre + "<\/option>");
                    });
                    $('#civil').select2({
                        placeholder: "Selecciona Estado Civil",
                        allowClear: true
                    });

                });
            });
            $("#provincia").ready(function (event) {
                $("#canton").ready(function (event) {
                    $('#canton').select2({
                        placeholder: "Selecciona Canton",
                        allowClear: true
                    });
                    $("#canton").prop('disabled', true);
                });
                $("#parroquia").ready(function (event) {
                    $('#parroquia').select2({
                        placeholder: "Selecciona Parroquia",
                        allowClear: true
                    });
                    $("#parroquia").prop('disabled', true);
                });
                $('#provincia').select2({
                    placeholder: "Selecciona Provincia",
                    allowClear: true
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/provincias",
                    type: 'get',
                    dataType: "json"
                }).done(function (provincia) {

                    $('#provincia').html('');
                    $('#provincia').append($('<option></option>').text('Selecciona Provincia').val(''));
                    $.each(provincia, function (i) {
                        $('#provincia').append("<option value=\"" + provincia[i].id + "\">" + provincia[i].nombre + "<\/option>");
                    });

                });
            });

            //El metodo Change nos permite realizar una acción al momento que estamos interactuando con el elemento con ID pais
            $("#provincia").change(function (event) {
                if ($("#provincia").val() == "") {
                    $("#canton").val("");
                    $('#canton').select2();
                    $("#canton").prop('disabled', true);
                    $("#parroquia").val("");
                    $('#parroquia').select2();
                    $("#parroquia").prop('disabled', true);
                } else {
                    $('#canton').html('');
                    $('#canton').append($('<option></option>').text('Selecciona canton').val(''));
                    $("#canton").prop('disabled', false);

                    //$("#parroquia").val("");
                    $('#parroquia').val('').trigger('change');
                    //$('#parroquia').select2();
                    $("#parroquia").prop('disabled', true);
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/cantones/' + $("#provincia option:selected").val(),
                    type: 'get',
                    dataType: "json"
                }).done(function (canton) {
                    $.each(canton, function (i) {
                        $('#canton').append("<option value=\"" + canton[i].id + "\">" + canton[i].nombre + "<\/option>");
                    });
                });
            });


            $("#canton").change(function (event) {
                if ($("#canton").val() == "") {
                    $("#parroquia").val("");
                    $('#parroquia').select2();
                    $("#parroquia").prop('disabled', true);
                } else {
                    $('#parroquia').html('');
                    $("#parroquia").prop('disabled', false);
                    $('#parroquia').append($('<option></option>').text('Selecciona parroquia').val(''));
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/parroquias/' + $("#canton option:selected").val(),
                    type: 'get',
                    dataType: "json"
                }).done(function (parroquia) {
                    $.each(parroquia, function (i) {
                        $('#parroquia').append("<option value=\"" + parroquia[i].id + "\">" + parroquia[i].nombre + "<\/option>");
                    });
                });
            });


            var $image = $(".image-cropRegister > img")
            $($image).cropper({
                //aspectRatio: NaN,
                //aspectRatio: 1.618,
                aspectRatio: 1/1,
                preview: ".img-preview",
                done: function (data) {
                    // Output the result data for cropping image.
                }
            });

            $image.attr('src', 'images/user/default-user-image.png');

            var $inputImage = $("#inputImage");

            if (window.FileReader) {
                $inputImage.change(function () {
                    var fileReader = new FileReader(),
                        files = this.files,
                        file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Por favor, elija un archivo de imagen.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function () {
                window.open($image.cropper('getCroppedCanvas').toDataURL('image/jpeg', 0.3));
                //window.open($image.cropper('getCroppedCanvas', {width: 48,height: 48}).toDataURL('image/jpeg',1.0));
            });

            $("#zoomIn").click(function () {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function () {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function () {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function () {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function () {
                $image.cropper("setDragMode", "crop");
            });

            var convertTypeNull = function (value){
                if (value === null) return "";
                if (value === undefined) return "";
                return value;
            };

            function LoadFormData() {
                let form = new FormData();
                form.append('ndocumento', $('#ndocumento').val());
                form.append('nombres', $('#nombres').val());
                form.append('apellidos', $('#apellidos').val());
                form.append('email', $('#email').val());
                form.append('fecnacimiento', $('#fec_nacimiento').val());
                form.append('telfmovil', $('#tlf_movil').val());
                form.append('provincia', convertTypeNull($('#provincia').val()));
                form.append('canton', convertTypeNull($('#canton').val()));
                form.append('parroquia', convertTypeNull($('#parroquia').val()));
                form.append('password', convertTypeNull($('#password').val()));
                return form;
            }
            function ClearValidation(){
                $('#inputImage').prop('disabled', false);
                $('.errorNacionalidad').addClass('hidden');
                $('.errorTipoDocumento').addClass('hidden');
                $('.errorNdocumento').addClass('hidden');
                $('.errorNombres').addClass('hidden');
                $('.errorApellidos').addClass('hidden');
                $('.errorHojaVida').addClass('hidden');
                $('.errorPerfil').addClass('hidden');
                $('.errorEmail').addClass('hidden');
                $('.errorFecNacimiento').addClass('hidden');
                $('.errorCivil').addClass('hidden');
                $('.errorGenero').addClass('hidden');
                $('.errorTlfDocimicilio').addClass('hidden');
                $('.errorTlfMovil').addClass('hidden');
                $('.errorProvincia').addClass('hidden');
                $('.errorCanton').addClass('hidden');
                $('.errorParroquia').addClass('hidden');
                $('.errorDireccion').addClass('hidden');
                $('.errorImagen').addClass('hidden');
                $('.errorPassword').addClass('hidden');
                $('.errorGoogleCaptcha').addClass('hidden');
            }

            function ValidationFailStep1(data) {
                var band = false;
                if (data.nacionalidad) {
                    $('.errorNacionalidad').removeClass('hidden');
                    $('.errorNacionalidad').text(data.nacionalidad);
                    band = true;
                }
                if (data.tipodocumento) {
                    $('.errorTipoDocumento').removeClass('hidden');
                    $('.errorTipoDocumento').text(data.tipodocumento);
                    band = true;
                }
                if (data.password) {
                    $('.errorPassword').removeClass('hidden');
                    $('.errorPassword').text(data.password);
                    band = true;
                }
                if (data.ndocumento) {
                    $('.errorNdocumento').removeClass('hidden');
                    $('.errorNdocumento').text(data.ndocumento);
                    band = true;
                }
                if (data.nombres) {
                    $('.errorNombres').removeClass('hidden');
                    $('.errorNombres').text(data.nombres);
                    band = true;
                }
                if (data.apellidos) {
                    $('.errorApellidos').removeClass('hidden');
                    $('.errorApellidos').text(data.apellidos);
                    band = true;
                }
                if (data.email) {
                    $('.errorEmail').removeClass('hidden');
                    $('.errorEmail').text(data.email);
                    band = true;
                }
                if (data.fecnacimiento) {
                    $('.errorFecNacimiento').removeClass('hidden');
                    $('.errorFecNacimiento').text(data.fecnacimiento);
                    band = true;
                }
                if (data.estadocivil) {
                    $('.errorCivil').removeClass('hidden');
                    $('.errorCivil').text(data.estadocivil);
                    band = true;
                }
                if (data.genero) {
                    $('.errorGenero').removeClass('hidden');
                    $('.errorGenero').text(data.genero);
                    band = true;
                }
                return band;
            }

            function ValidationFailStep2(data){
                var band = false;
                if (data.provincia) {
                    $('.errorProvincia').removeClass('hidden');
                    $('.errorProvincia').text(data.provincia);
                    band = true;
                }
                if (data.canton) {
                    $('.errorCanton').removeClass('hidden');
                    $('.errorCanton').text(data.canton);
                    band = true;
                }
                if (data.parroquia) {
                    $('.errorParroquia').removeClass('hidden');
                    $('.errorParroquia').text(data.parroquia);
                    band = true;
                }
                if (data.telfdomicilio) {
                    $('.errorTlfDocimicilio').removeClass('hidden');
                    $('.errorTlfDocimicilio').text(data.telfdomicilio);
                    band = true;
                }
                if (data.telfmovil) {
                    $('.errorTlfMovil').removeClass('hidden');
                    $('.errorTlfMovil').text(data.telfmovil);
                    band = true;
                }
                if (data.hojavida) {
                    $('.errorHojaVida').removeClass('hidden');
                    $('.errorHojaVida').text(data.hojavida);
                    band = true;
                }
                if (data.direccion) {
                    $('.errorDireccion').removeClass('hidden');
                    $('.errorDireccion').text(data.direccion);
                    band = true;
                }

                return band;
            }

            function ValidationFailStep3(data){
                var band = false;
                if (data.imagen) {
                    $('.errorImagen').removeClass('hidden');
                    $('.errorImagen').text(data.imagen);
                    band = true;
                }
                return band;
            }

            function ValidationFailStep4(data){
                var band = false;
                if (data.googlecaptcha) {
                    $('.errorGoogleCaptcha').removeClass('hidden');
                    $('.errorGoogleCaptcha').text(data.googlecaptcha);
                    return true;
                }
                return band;
            }

            function ValidationFail(data){
                if (data) {
                    ValidationFailStep1(data);
                    ValidationFailStep2(data);
                    ValidationFailStep3(data);
                    ValidationFailStep4(data);

                    if(ValidationFailStep1(data)==true){
                        $('.tab1').removeClass('done');
                        $('.tab1').addClass('error');
                    }
                    if(ValidationFailStep2(data)==true){
                        $('.tab2').removeClass('done');
                        $('.tab2').addClass('error');
                    }
                    if(ValidationFailStep3(data)==true){
                        $('.tab3').removeClass('done');
                        $('.tab3').addClass('error');
                    }
                    if(ValidationFailStep4(data)==true){
                        $('.tab4').removeClass('done');
                        $('.tab4').addClass('error');
                    }
                }
            }

            function LoadAjaxRegister() {
                $.ajax({
                    url: '/register',
                    type: 'post',
                    data: LoadFormData(),
                    processData: false,
                    contentType: false,
                }).done(function (data, textStatus, jqXHR) {
                    if(jqXHR.status==201);{
                        toastr.success(data, '', {timeOut: 4000});
                        setTimeout(function(){ window.location.href = '/'; }, 3000);
                    }
                    ClearValidation();
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    ClearValidation();
                    ValidationFail(jqXHR.responseJSON);
                });
            }

            $('#demo').steps({
                onFinish:  function () {
                    LoadAjaxRegister();
                }
            });
        })

    </script>
@endsection