
<div class="row">
    <div class="col-md-offset-10 col-sm-2">
        <div class="panel panel-default text-center">
            <div class="panel-body gray-bg">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button id="save_user"  type="button" class="ladda-button ladda-button-demo btn btn-warning"  data-style="zoom-in">Actualizar</button>
                        <!--<button type="button" class="ladda-button ladda-button-demo btn btn-danger"  data-style="zoom-in"><i class="fa fa-close"></i> Descartar</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="DatosInformativos panel panel-default">
    <div class="panel-body gray-bg">
        <div class="row">
            <div class="col-sm-2 text-center">
                <div id="OpenModal" ><!--data-toggle="modal" data-target="#myModal">-->
                    <div class="image-crop">
                        <img id="imgProfile" src="" alt="Foto Perfil" class="img-responsive img-rounded imageprofile">
                    </div>{{--
                    <div class="">
                        <img id="imgProfile" src="" alt="Foto Perfil" class="img-responsive img-rounded imageprofile">
                    </div>--}}
                    <a type="button" class="btn btn-primary" href="#"><i class="fa fa-camera" aria-hidden="true"></i> Cambiar Foto</a>
                    <p style="color:red;" class="errorImagen text-center hidden"></p>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label class="label-black control-label">FECHA DE NACIMIENTO*</label>
                            <input id="fec_nacimiento" type='text' class="form-control" placeholder="Fecha de Nacimiento" />
                            <p style="color:red;" class="errorFecNacimiento text-center hidden"></p>
                        </div>
                        <div class="col-sm-4">
                            <label class="label-black control-label">ESTADO CIVIL*</label>
                            <select id="civil" class="civil form-control m-b"></select>
                            <p style="color:red;" class="errorCivil text-center hidden"></p>
                        </div>
                        <div class="col-sm-4">
                            <label class="label-black control-label">GÉNERO*</label>
                            <select id="genero" class="genero form-control m-b"></select>
                            <p style="color:red;" class="errorGenero text-center hidden"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label class="label-black control-label">PROVINCIA*</label>
                            <select id="provincia" class="provincia form-control m-b"></select>
                            <p style="color:red;" class="errorProvincia text-center hidden"></p>
                        </div>
                        <div class="col-sm-4">
                            <label class="label-black control-label">CANTÓN*</label>
                            <select id="canton" class="canton form-control m-b"></select>
                            <p style="color:red;" class="errorCanton text-center hidden"></p>
                        </div>
                        <div class="col-sm-4">
                            <label class="label-black control-label">PARROQUIA*</label>
                            <select id="parroquia" class="parroquia form-control m-b"></select>
                            <p style="color:red;" class="errorParroquia text-center hidden"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-8">
                            <label class="label-black control-label">DIRECCIÓN*</label>
                            <input id='calle_primaria' type='text' class="form-control" placeholder="Dirección" />
                            <p style="color:red;" class="errorCallePrimaria text-center hidden"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label class="label-black control-label">TELÉFONO MÓVIL*</label>
                            <input id="tlf_movil" type="tel" placeholder="Teléfono Móvil" class="form-control">
                            <p style="color:red;" class="errorTlfMovil text-center hidden"></p>
                        </div>
                        <div class="col-sm-4">
                            <label class="label-black control-label">TELÉFONO DOMICILIO*</label>
                            <input id="tlf_domicilio" type="tel" placeholder="Teléfono Domicilio" class="form-control">
                            <p style="color:red;" class="errorTlfDocimicilio text-center hidden"></p>
                        </div>
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

    let user = getUrlParameter('user');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/user/'+user,
        type: 'get',
        dataType: "json",
    }).done(function(data){
        getUserInfoById(data);
    });

    const getUserInfoById = function(data){
        if(data.CATESTADOCIVIL!=null){
            cargaSelect2EstadoCivil(data.CATESTADOCIVIL.id);
        }else{
            cargaSelect2EstadoCivil(null);
        }
        if(data.CATESTADOCIVIL!=null) {
            cargaSelect2Genero(data.CATGENERO.id);
        }else{
            cargaSelect2Genero(null);
        }
        if(data.IDTPROVINCIA!=null && data.IDTCANTON!=null&& data.IDTPARROQUIA!=null) {
            localidad(data.IDTPROVINCIA.id,data.IDTCANTON.id,data.IDTPARROQUIA.id);
        }else{
            localidad(null,null,null);
        }
        //
        cargaInputNacimiento(data.IDTFECNACIMIENTO);
        cargaInputTelefonoDomicilio(data.IDTTELEFONO);
        cargaInputTelefonoMovil(data.IDTCELULAR);
        cargaInputCallePrimaria(data.IDTDIRECCION);
        cargaImgUser(data.IDTIMGPROFILESMALL);

    }

    var $image = $(".image-crop > img");

    $($image).cropper({
        //aspectRatio: NaN,
        //aspectRatio: 1.618,
        aspectRatio: 128/128,
        preview: ".img-preview",
        done: function(data) {
            // Output the result data for cropping image.
        }
    });

    function cargaImgUser(UserImgProfile){
        $("#imgProfile").attr('src', UserImgProfile+'foto.jpg?rnd='+Math.random());
    }
    var $inputImage = $("#inputImage");

    if (window.FileReader) {
        $inputImage.change(function() {
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

    $("#download").click(function() {
        window.open($image.cropper('getCroppedCanvas').toDataURL('image/jpeg', 0.3));
        //window.open($image.cropper('getCroppedCanvas', {width: 48,height: 48}).toDataURL('image/jpeg',1.0));

    });

    $("#zoomIn").click(function() {
        $image.cropper("zoom", 0.1);
    });

    $("#zoomOut").click(function() {
        $image.cropper("zoom", -0.1);
    });

    $("#rotateLeft").click(function() {
        $image.cropper("rotate", 45);
    });

    $("#rotateRight").click(function() {
        $image.cropper("rotate", -45);
    });

    $("#setDrag").click(function() {
        $image.cropper("setDragMode", "crop");
    });

    $('#OpenModal').click(function(){
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $(".ClearImageProfile").click(function() {
        $image.cropper('destroy');
        cargaImgUser(data.urlimgprofile);
        //$image.cropper("reset");
        //$image.cropper("clear");

    });

    $("#fec_nacimiento").ready( function(event) {
        $('#fec_nacimiento ').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd/mm/yyyy"
        });
    });

    function cargaInputNacimiento(UserInfoNacimiento){
        if(UserInfoNacimiento){
            $('#fec_nacimiento').datepicker('update', UserInfoNacimiento.split("-").reverse().join("-"));
        }
    }

    function cargaSelect2EstadoCivil(UserInfoEstadoCivil){
        $("#civil").ready( function(event) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/estado_civil',
                type: 'get',
                dataType: "json"
            }).done(function (estado_civil){
                $('#civil').append($('<option></option>'));
                $.each(estado_civil, function(i) {
                    if (UserInfoEstadoCivil==estado_civil[i].id) {
                        $('#civil').append("<option value=\""+estado_civil[i].id+"\" selected>"+estado_civil[i].nombre+"<\/option>");
                    } else {
                        $('#civil').append("<option value=\""+estado_civil[i].id+"\">"+estado_civil[i].nombre+"<\/option>");
                    }
                });
                $('#civil').select2({
                    placeholder: "Selecciona Estado Civil",
                    allowClear: true
                });

            });
        });
    }

    function cargaSelect2Genero(UserInfoGenero){
        $("#genero").ready( function(event) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/genero',
                type: 'get',
                dataType: "json"
            }).done(function (genero){
                $('#genero').append($('<option></option>'));
                $.each(genero, function(i) {
                    if (UserInfoGenero==genero[i].id) {
                        $('#genero').append("<option value=\""+genero[i].id+"\" selected>"+genero[i].nombre+"<\/option>");
                    } else {
                        $('#genero').append("<option value=\""+genero[i].id+"\">"+genero[i].nombre+"<\/option>");
                    }
                });
                $('#genero').select2({
                    placeholder: "Selecciona Genero",
                    allowClear: true
                });

            });
        });
    }

    function cargaInputTelefonoDomicilio(UserInfoTelefonoDomicilio){
        $("#tlf_domicilio").ready( function(event) {
            $('#tlf_domicilio').val(UserInfoTelefonoDomicilio);
        });
    }

    function cargaInputTelefonoMovil(UserInfoTelefonoMovil) {
        $("#tlf_movil").ready(function (event) {
            $('#tlf_movil').val(UserInfoTelefonoMovil);
        });
    }

    function cargaInputCallePrimaria(UserInfoCallePrimaria){
        $("#calle_primaria").ready( function(event) {
            $('#calle_primaria').val(UserInfoCallePrimaria);
        });
    }



    function localidad(UserInfoProvincia,UserInfoCanton,UserInfoParroquia){

        //Al iniciar mandamos consultar todos los paises que se mantienen en nuestra base de datos atravez de la ruta paises
        $("#provincia").ready( function(event) {
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
                data: 'provincias',
                dataType: "json"
            }).done(function ( provincia ){
                $('#provincia').html('');
                $('#provincia').append($('<option></option>').text('Selecciona Provincia').val(''));
                $.each(provincia, function(i) {
                    if (UserInfoProvincia==provincia[i].id) {
                        $('#provincia').append("<option value=\""+provincia[i].id+"\" selected>"+provincia[i].nombre+"<\/option>");
                    } else {
                        $('#provincia').append("<option value=\""+provincia[i].id+"\">"+provincia[i].nombre+"<\/option>");
                    }
                });

            });

            if($("#provincia").val()!="")
            {
                $("#canton").ready( function(event) {
                    $('#canton').select2({
                        placeholder: "Selecciona Canton",
                        allowClear: true
                    });
                    $("#canton").prop('disabled', false);
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/cantones/'+UserInfoProvincia,
                    type: 'get',
                    //data: 'provincia=' +UserInfoProvincia,
                    dataType: "json"
                }).done(function ( canton ){
                    $.each(canton, function(i) {
                        if(UserInfoCanton==canton[i].id) {
                            $('#canton').append("<option value=\""+canton[i].id+"\" selected>"+canton[i].nombre+"<\/option>");
                        } else {
                            $('#canton').append("<option value=\""+canton[i].id+"\">"+canton[i].nombre+"<\/option>");
                        }
                    });
                });
            }

            if($("#canton").val()!="")
            {
                $("#parroquia").ready( function(event) {
                    $('#parroquia').select2({
                        placeholder: "Selecciona Parroquia",
                        allowClear: true
                    });
                    $("#parroquia").prop('disabled', false);
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/parroquias/'+UserInfoCanton,
                    type: 'get',
                    //data: 'canton=' +UserInfoCanton,
                    dataType: "json"
                }).done(function ( parroquia ){
                    $.each(parroquia, function(i) {
                        if(UserInfoParroquia==parroquia[i].id) {
                            $('#parroquia').append("<option value=\""+parroquia[i].id+"\" selected>"+parroquia[i].nombre+"<\/option>");
                        } else {
                            $('#parroquia').append("<option value=\""+parroquia[i].id+"\">"+parroquia[i].nombre+"<\/option>");
                        }
                    });
                });
            }
        });

        $("#provincia").change( function(event) {
            if($("#provincia").val()=="")
            {
                $("#canton").val("");
                $('#canton').select2({
                    placeholder: "Selecciona Canton",
                    allowClear: true
                });
                $("#canton").prop('disabled', true);
                $("#parroquia").val("");
                $('#parroquia').select2({
                    placeholder: "Selecciona Parroquia",
                    allowClear: true
                });
                $("#parroquia").prop('disabled', true);
            }
            else
            {
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
                url: '/cantones/'+$("#provincia option:selected").val(),
                type: 'get',
                //data: 'provincia=' + $("#provincia option:selected").val(),
                dataType: "json"
            }).done(function ( canton ){
                $.each(canton, function(i) {
                    $('#canton').append("<option value=\""+canton[i].id+"\">"+canton[i].nombre+"<\/option>");
                });
            });
        });


        $("#canton").change( function(event) {
            if($("#canton").val()=="")
            {
                $("#parroquia").val("");
                $('#parroquia').select2();
                $("#parroquia").prop('disabled', true);
            }else
            {
                $('#parroquia').html('');
                $("#parroquia").prop('disabled', false);
                $('#parroquia').append($('<option></option>').text('Selecciona parroquia').val(''));
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/parroquias/'+$("#canton option:selected").val(),
                type: 'get',
                //data: 'canton=' + $("#canton option:selected").val(),
                dataType: "json"
            }).done(function ( parroquia ){

                $.each(parroquia, function(i) {
                    $('#parroquia').append("<option value=\""+parroquia[i].id+"\">"+parroquia[i].nombre+"<\/option>");
                });
            });
        });


    }

    var convertTypeNull = function (value){
        if (value === null) return "";
        if (value === undefined) return "";
        return value;
    };

    $('#save_user').on('click', function() {
        var form = new FormData();
        form.append('_token', $('input[name=_token]').val());
        form.append('USRID', user);
        form.append('IDTFECNACIMIENTO', $('#fec_nacimiento').data('datepicker').getFormattedDate('yyyy-mm-dd'));
        form.append('CATESTADOCIVIL', $('#civil').val());
        form.append('CATGENERO', $('#genero').val());
        form.append('IDTTELEFONO', $('#tlf_domicilio').val());
        form.append('IDTCELULAR', $('#tlf_movil').val());
        form.append('UBCPROVINCIA',convertTypeNull($('#provincia').val()));
        form.append('UBCCANTON', convertTypeNull($('#canton').val()));
        form.append('UBCPARROQUIA', convertTypeNull($('#parroquia').val()));
        form.append('IDTDIRECCION', $('#calle_primaria').val());
        if(($image.cropper('getCroppedCanvas'))==null){
        }else{
            form.append('imagen',$image.cropper('getCroppedCanvas').toDataURL('image/jpeg',0.3));
            form.append('imagen-profile',$image.cropper('getCroppedCanvas',{width: 48, height: 48,fillColor: '#fff',
                imageSmoothingEnabled: false,
                imageSmoothingQuality: 'high',
            }).toDataURL('image/jpeg',1.0));
        }
        var url="/User/Profile/Update/"+user;


        $('#inputImage').prop('disabled', true);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: url,
            data: form,
            processData: false,
            contentType: false,
        }).done(function(data) {
            $('#inputImage').prop('disabled', false);
            toastr.success(data, '', {timeOut: 5000});
        }).fail(function(data) {
            console.log(data.responseJSON);
            $('#inputImage').prop('disabled', false);
            $('.errorFecNacimiento').addClass('hidden');
            $('.errorCivil').addClass('hidden');
            $('.errorGenero').addClass('hidden');
            $('.errorTlfDocimicilio').addClass('hidden');
            $('.errorTlfMovil').addClass('hidden');
            $('.errorProvincia').addClass('hidden');
            $('.errorCanton').addClass('hidden');
            $('.errorParroquia').addClass('hidden');
            $('.errorCallePrimaria').addClass('hidden');
            $('.errorImagen').addClass('hidden');
            //console.log(data.responseJSON);
            if ((data.responseJSON)) {
                if (data.responseJSON.imagen) {
                    $('.errorImagen').removeClass('hidden');
                    $('.errorImagen').text(data.responseJSON.imagen);
                }
                if (data.responseJSON.IDTFECNACIMIENTO) {
                    $('.errorFecNacimiento').removeClass('hidden');
                    $('.errorFecNacimiento').text(data.responseJSON.IDTFECNACIMIENTO);
                }
                if (data.responseJSON.CATESTADOCIVIL) {
                    $('.errorCivil').removeClass('hidden');
                    $('.errorCivil').text(data.responseJSON.CATESTADOCIVIL);
                }
                if (data.responseJSON.CATGENERO) {
                    $('.errorGenero').removeClass('hidden');
                    $('.errorGenero').text(data.responseJSON.CATGENERO);
                }
                if (data.responseJSON.IDTTELEFONO) {
                    $('.errorTlfDocimicilio').removeClass('hidden');
                    $('.errorTlfDocimicilio').text(data.responseJSON.IDTTELEFONO);
                }
                if (data.responseJSON.IDTCELULAR) {
                    $('.errorTlfMovil').removeClass('hidden');
                    $('.errorTlfMovil').text(data.responseJSON.IDTCELULAR);
                }
                if (data.responseJSON.UBCPROVINCIA) {
                    $('.errorProvincia').removeClass('hidden');
                    $('.errorProvincia').text(data.responseJSON.UBCPROVINCIA);
                }
                if (data.responseJSON.UBCCANTON) {
                    $('.errorCanton').removeClass('hidden');
                    $('.errorCanton').text(data.responseJSON.UBCCANTON);
                }
                if (data.responseJSON.UBCPARROQUIA) {
                    $('.errorParroquia').removeClass('hidden');
                    $('.errorParroquia').text(data.responseJSON.UBCPARROQUIA);
                }
                if (data.responseJSON.IDTDIRECCION) {
                    $('.errorCallePrimaria').removeClass('hidden');
                    $('.errorCallePrimaria').text(data.responseJSON.IDTDIRECCION);
                }
            }
            //toastr.error('Error consulta!', '', {timeOut: 1000,progressBar: true});
        });
    });

})
</script>
@stop
