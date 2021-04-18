$(document).ready(function () {
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    $("#metismenu").metisMenu();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/user',
        type: 'get',
        dataType: "json",
    }).done(function(data){
        $('#image-profile').attr('src', data.IDTIMGPROFILESMALL+'fotoperfil.jpg?rnd='+Math.random());
        getUserInfoById(data);
        $('#ModalUserComplete').find('.modal-footer #CompleteUser').attr("data-user",data.USERID);
        if(data.IDTCOMPLETE==false){
            $('#ModalUserComplete').modal('show');
        }
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

    var $image = $(".image-cropUser > img");

    $($image).cropper({
        //aspectRatio: NaN,
        //aspectRatio: 1.618,
        aspectRatio: 1/1,
        preview: ".img-preview",
        done: function(data) {
            // Output the result data for cropping image.
        }
    });

    function cargaImgUser(UserImgProfile){
        $("#ModalUserComplete #imgHolder").attr('src', UserImgProfile+'foto.jpg?rnd='+Math.random());
    }
    var $inputImage = $("#inputImageUser");

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

    $("#fec_nacimientoUser").ready( function(event) {
        $('#fec_nacimientoUser').datepicker({
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
            $('#fec_nacimientoUser').datepicker('update', UserInfoNacimiento.split("-").reverse().join("-"));
        }
    }

    function cargaSelect2EstadoCivil(UserInfoEstadoCivil){
        $("#civilUser").ready( function(event) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/estado_civil',
                type: 'get',
                dataType: "json"
            }).done(function (estado_civil){
                $('#civilUser').append($('<option></option>'));
                $.each(estado_civil, function(i) {
                    if (UserInfoEstadoCivil==estado_civil[i].id) {
                        $('#civilUser').append("<option value=\""+estado_civil[i].id+"\" selected>"+estado_civil[i].nombre+"<\/option>");
                    } else {
                        $('#civilUser').append("<option value=\""+estado_civil[i].id+"\">"+estado_civil[i].nombre+"<\/option>");
                    }
                });
                $('#civilUser').select2({
                    placeholder: "Selecciona Estado Civil",
                    allowClear: true,
                    dropdownParent: $('#ModalUserComplete .modal-content')
                });

            });
        });
    }

    function cargaSelect2Genero(UserInfoGenero){
        $("#generoUser").ready( function(event) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/genero',
                type: 'get',
                dataType: "json"
            }).done(function (genero){
                $('#generoUser').append($('<option></option>'));
                $.each(genero, function(i) {
                    if (UserInfoGenero==genero[i].id) {
                        $('#generoUser').append("<option value=\""+genero[i].id+"\" selected>"+genero[i].nombre+"<\/option>");
                    } else {
                        $('#generoUser').append("<option value=\""+genero[i].id+"\">"+genero[i].nombre+"<\/option>");
                    }
                });
                $('#generoUser').select2({
                    placeholder: "Selecciona Genero",
                    allowClear: true,
                    dropdownParent: $('#ModalUserComplete .modal-content')
                });

            });
        });
    }

    function cargaInputTelefonoDomicilio(UserInfoTelefonoDomicilio){
        $("#tlf_domicilioUser").ready( function(event) {
            $('#tlf_domicilioUser').val(UserInfoTelefonoDomicilio);
        });
    }

    function cargaInputTelefonoMovil(UserInfoTelefonoMovil) {
        $("#tlf_movilUser").ready(function (event) {
            $('#tlf_movilUser').val(UserInfoTelefonoMovil);
        });
    }

    function cargaInputCallePrimaria(UserInfoCallePrimaria){
        $("#calle_primariaUser").ready( function(event) {
            $('#calle_primariaUser').val(UserInfoCallePrimaria);
        });
    }



    function localidad(UserInfoProvincia,UserInfoCanton,UserInfoParroquia){

        //Al iniciar mandamos consultar todos los paises que se mantienen en nuestra base de datos atravez de la ruta paises
        $("#ProvinciaUser").ready( function(event) {
            $('#ProvinciaUser').select2({
                placeholder: "Selecciona Provincia",
                allowClear: true,
                dropdownParent: $('#ModalUserComplete .modal-content')
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
                $('#ProvinciaUser').html('');
                $('#ProvinciaUser').append($('<option></option>').text('Selecciona Provincia').val(''));
                $.each(provincia, function(i) {
                    if (UserInfoProvincia==provincia[i].id) {
                        $('#ProvinciaUser').append("<option value=\""+provincia[i].id+"\" selected>"+provincia[i].nombre+"<\/option>");
                    } else {
                        $('#ProvinciaUser').append("<option value=\""+provincia[i].id+"\">"+provincia[i].nombre+"<\/option>");
                    }
                });

            });

            if($("#ProvinciaUser").val()!="")
            {
                $("#CantonUser").ready( function(event) {
                    $('#CantonUser').select2({
                        placeholder: "Selecciona Canton",
                        allowClear: true,
                        dropdownParent: $('#ModalUserComplete .modal-content')
                    });
                    $("#CantonUser").prop('disabled', false);
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
                            $('#CantonUser').append("<option value=\""+canton[i].id+"\" selected>"+canton[i].nombre+"<\/option>");
                        } else {
                            $('#CantonUser').append("<option value=\""+canton[i].id+"\">"+canton[i].nombre+"<\/option>");
                        }
                    });
                });
            }

            if($("#CantonUser").val()!="")
            {
                $("#ParroquiaUser").ready( function(event) {
                    $('#ParroquiaUser').select2({
                        placeholder: "Selecciona Parroquia",
                        allowClear: true,
                        dropdownParent: $('#ModalUserComplete .modal-content')
                    });
                    $("#ParroquiaUser").prop('disabled', false);
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
                            $('#ParroquiaUser').append("<option value=\""+parroquia[i].id+"\" selected>"+parroquia[i].nombre+"<\/option>");
                        } else {
                            $('#ParroquiaUser').append("<option value=\""+parroquia[i].id+"\">"+parroquia[i].nombre+"<\/option>");
                        }
                    });
                });
            }
        });

        $("#ProvinciaUser").change( function(event) {
            if($("#ProvinciaUser").val()=="")
            {
                $("#CantonUser").val("");
                $('#CantonUser').select2({
                    placeholder: "Selecciona Canton",
                    allowClear: true
                });
                $("#CantonUser").prop('disabled', true);
                $("#ParroquiaUser").val("");
                $('#ParroquiaUser').select2({
                    placeholder: "Selecciona Parroquia",
                    allowClear: true,
                    dropdownParent: $('#ModalUserComplete .modal-content')
                });
                $("#ParroquiaUser").prop('disabled', true);
            }
            else
            {
                $('#CantonUser').html('');
                $('#CantonUser').append($('<option></option>').text('Selecciona canton').val(''));
                $("#CantonUser").prop('disabled', false);

                //$("#parroquia").val("");
                $('#ParroquiaUser').val('').trigger('change');
                //$('#parroquia').select2();
                $("#ParroquiaUser").prop('disabled', true);
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/cantones/'+$("#ProvinciaUser option:selected").val(),
                type: 'get',
                //data: 'provincia=' + $("#provincia option:selected").val(),
                dataType: "json"
            }).done(function ( canton ){
                $.each(canton, function(i) {
                    $('#CantonUser').append("<option value=\""+canton[i].id+"\">"+canton[i].nombre+"<\/option>");
                });
            });
        });


        $("#CantonUser").change( function(event) {
            if($("#CantonUser").val()=="")
            {
                $("#ParroquiaUser").val("");
                $('#ParroquiaUser').select2();
                $("#ParroquiaUser").prop('disabled', true);
            }else
            {
                $('#ParroquiaUser').html('');
                $("#ParroquiaUser").prop('disabled', false);
                $('#ParroquiaUser').append($('<option></option>').text('Selecciona parroquia').val(''));
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/parroquias/'+$("#CantonUser option:selected").val(),
                type: 'get',
                //data: 'canton=' + $("#canton option:selected").val(),
                dataType: "json"
            }).done(function ( parroquia ){

                $.each(parroquia, function(i) {
                    $('#ParroquiaUser').append("<option value=\""+parroquia[i].id+"\">"+parroquia[i].nombre+"<\/option>");
                });
            });
        });
    }

    var convertTypeNull = function (value){
        if (value === null) return "";
        if (value === undefined) return "";
        return value;
    };

    $('#CompleteUser').on('click', function() {
        var form = new FormData();
        form.append('_token', $('input[name=_token]').val());
        form.append('USRID', $('#CompleteUser').data('user'));
        form.append('IDTFECNACIMIENTO', $('#fec_nacimientoUser').data('datepicker').getFormattedDate('yyyy-mm-dd'));
        form.append('CATESTADOCIVIL', $('#civilUser').val());
        form.append('CATGENERO', $('#generoUser').val());
        form.append('IDTTELEFONO', $('#tlf_domicilioUser').val());
        form.append('IDTCELULAR', $('#tlf_movilUser').val());
        form.append('UBCPROVINCIA',convertTypeNull($('#ProvinciaUser').val()));
        form.append('UBCCANTON', convertTypeNull($('#CantonUser').val()));
        form.append('UBCPARROQUIA', convertTypeNull($('#ParroquiaUser').val()));
        form.append('IDTDIRECCION', $('#calle_primariaUser').val());
        if(($image.cropper('getCroppedCanvas'))==null){
        }else{
            form.append('imagen',$image.cropper('getCroppedCanvas').toDataURL('image/jpeg',0.3));
            form.append('imagen-profile',$image.cropper('getCroppedCanvas',{width: 48, height: 48,fillColor: '#fff',
                imageSmoothingEnabled: false,
                imageSmoothingQuality: 'high',
            }).toDataURL('image/jpeg',1.0));
        }
        var url="/User/Profile/Update/"+$('#CompleteUser').data('user');


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
        }).done(function(data, textStatus, jqXHR) {
            if(jqXHR.status==200){
                $('#inputImage').prop('disabled', false);
                toastr.success(data, '', {timeOut: 5000});
                //$('#ModalUserComplete').modal('toggle');
                //$('#ModalUserComplete').modal().hide();
                $('#ModalUserComplete').modal('hide');

            }
        }).fail(function(data) {
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
