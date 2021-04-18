

//Inicializamos los dropdowns select2
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
        cargaSelect2Nacionalidad(data.nacionalidad);
        cargaSelect2TipoDocumento(data.tipodocumento);
        cargaInputNdocumento(data.identificacion);
        cargaInputNombres(data.names);
        cargaInputApellidos(data.surnames);
        cargaInputUsername(data.username);
        cargaInputEmail(data.email);
        cargaSelect2Rol(data.rol);
        cargaSelect2UserFather(data.userfather);
        cargaCheckboxActive(data.active);
        cargaInputNacimiento(data.nacimiento);
        cargaInputIngreso(data.ingreso);
        cargaSelect2EstadoCivil(data.estadocivil);
        cargaSelect2Genero(data.genero);
        cargaInputTelefonoDomicilio(data.telefonodomicilio);
        cargaInputTelefonoMovil(data.telefonomovil);
        //cargaSelect2Provincia(data.provincia);
        //cargaSelect2Canton(data.canton);
        //cargaSelect2Parroquia(data.parroquia);
        cargaInputCodigoPostal(data.codigopostal);
        cargaInputCallePrimaria(data.calleprimaria);
        cargaInputCalleSecundaria(data.callesecundaria);
        cargaInputReferencia(data.referencia);
        cargaImgUser(data.urlimgprofile);
        localidad(data.provincia.id,data.canton.id,data.parroquia.id);

    }

    var $image = $(".image-crop > img")
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
        $image.attr('src', UserImgProfile);
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

    //

    function cargaSelect2Nacionalidad(UserInfoNacionalidad){
        //alert(UserInfoNacionalidad)
        $("#nacionalidad").ready( function(event) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/nacionalidades',
                type: 'get',
                dataType: "json"
            }).done(function (nacionalidad){
                $('#nacionalidad').append($('<option></option>'));
                $.each(nacionalidad, function(i) {
                    if (UserInfoNacionalidad.id==nacionalidad[i].id) {
                        $('#nacionalidad').append("<option value=\""+nacionalidad[i].id+"\" selected>"+nacionalidad[i].nombre+"<\/option>");
                    } else {
                        $('#nacionalidad').append("<option value=\""+nacionalidad[i].id+"\">"+nacionalidad[i].nombre+"<\/option>");
                    }
                });
                $('#nacionalidad').select2({
                    placeholder: "Selecciona Nacionalidad",
                    allowClear: true
                });

            });
        });
    }

    function cargaSelect2TipoDocumento(UserInfoTipoDocumento){
        $("#tipo_documento").ready( function(event) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/tipos_documentos',
                type: 'get',
                dataType: "json"
            }).done(function (documento){
                $('#tipo_documento').append($('<option></option>'));
                $.each(documento, function(i) {
                    if (UserInfoTipoDocumento.id==documento[i].id) {
                        $('#tipo_documento').append("<option value=\""+documento[i].id+"\" selected>"+documento[i].nombre+"<\/option>");
                    } else {
                        $('#tipo_documento').append("<option value=\""+documento[i].id+"\">"+documento[i].nombre+"<\/option>");
                    }
                });
                $('#tipo_documento').select2({
                    placeholder: "Selecciona Documento",
                    allowClear: true
                });

            });
        });
    }

    function cargaInputNdocumento(UserInfoIdentificacion){
        $("#ndocumento").ready( function(event) {
            $('#ndocumento').val(UserInfoIdentificacion);
        });
    }

    function cargaInputNombres(UserInfoNames){
        $("#nombres").ready( function(event) {
            $('#nombres').val(UserInfoNames);
        });
    }

    function cargaInputApellidos(UserInfoSurNames){
        $("#apellidos").ready( function(event) {
            $('#apellidos').val(UserInfoSurNames);
        });
    }

    function cargaInputUsername(UserInfoUsername){
        $("#username").ready( function(event) {
            $('#username').val(UserInfoUsername);
        });
    }

    function cargaInputEmail(UserInfoEmail){
        $("#email").ready( function(event) {
            $('#email').val(UserInfoEmail);
        });
    }

    function cargaSelect2Rol(UserInfoRol){
        $("#perfil").ready( function(event) {
            if($("#perfil").data('id')==3)
            {
                $("span.select2").css("width", "100%");
                $('#hide_supervisor').show();
            }else{
                $('#hide_supervisor').hide()
            }
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
                    if (UserInfoRol.id==perfil[i].id) {
                        $('#perfil').append("<option value=\""+perfil[i].id+"\" selected>"+perfil[i].display_name+"<\/option>");
                    } else {
                        $('#perfil').append("<option value=\""+perfil[i].id+"\">"+perfil[i].display_name+"<\/option>");
                    }
                });
                $('#perfil').select2({
                    placeholder: "Selecciona Perfil",
                    allowClear: true
                });

            });
        });

    }

    function cargaSelect2UserFather(UserInfoUserFather){
        $("#supervisor").ready( function(event) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/supervisores',
                type: 'get',
                dataType: "json"
            }).done(function (supervisor){
                $('#supervisor').append($('<option></option>'));
                $.each(supervisor, function(i) {
                    if (UserInfoUserFather.id==supervisor[i].id) {
                        $('#supervisor').append("<option value=\""+supervisor[i].id+"\" selected>"+supervisor[i].nombres_apellidos+"<\/option>");
                    } else {
                        $('#supervisor').append("<option value=\""+supervisor[i].id+"\">"+supervisor[i].nombres_apellidos+"<\/option>");
                    }
                });
                $('#supervisor').select2({
                    placeholder: "Selecciona Supervisor",
                    allowClear: true
                });

            });
        });

    }

    function cargaCheckboxActive(UserInfoActive){
        if(UserInfoActive==1){
            $('#user_activo').iCheck('check');
        }else{
            $('#user_activo').iCheck('uncheck');
        }
    }
    $("#fec_ingreso").ready( function(event) {
        $('#fec_ingreso ').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd/mm/yyyy"
        });
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

    function cargaInputIngreso(UserInfoIngreso){
        if(UserInfoIngreso){
            $('#fec_ingreso').datepicker('update', UserInfoIngreso.split("-").reverse().join("-"));
        }
    }

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
                    if (UserInfoEstadoCivil.id==estado_civil[i].id) {
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
                    if (UserInfoGenero.id==genero[i].id) {
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

    function cargaInputCodigoPostal(UserInfoCodigoPostal){
        $("#cod_postal").ready( function(event) {
            $('#cod_postal').val(UserInfoCodigoPostal);
        });
    }

    function cargaInputCallePrimaria(UserInfoCallePrimaria){
        $("#calle_primaria").ready( function(event) {
            $('#calle_primaria').val(UserInfoCallePrimaria);
        });
    }

    function cargaInputCalleSecundaria(UserInfoCalleSecundaria){
        $("#calle_secundaria").ready( function(event) {
            $('#calle_secundaria').val(UserInfoCalleSecundaria);
        });
    }

    function cargaInputReferencia(UserInfoReferencia){
        $("#referencia").ready( function(event) {
            $('#referencia').val(UserInfoReferencia);
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
                        if(UserInfoCanton==canton[i].id)
                        {
                            $('#canton').append("<option value=\""+canton[i].id+"\" selected>"+canton[i].nombre+"<\/option>");
                        }
                        else
                        {
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
                        if(UserInfoParroquia==parroquia[i].id)
                        {
                            $('#parroquia').append("<option value=\""+parroquia[i].id+"\" selected>"+parroquia[i].nombre+"<\/option>");
                        }
                        else
                        {

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


    $('#save_user').on('click', function() {
        console.log("Solo para vista");
    });


})
