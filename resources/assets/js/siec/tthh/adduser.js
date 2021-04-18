//Inicializamos los dropdowns select2
$( document ).ready(function() {

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
                $('#nacionalidad').append("<option value=\""+nacionalidad[i].id+"\">"+nacionalidad[i].nombre+"<\/option>");
            });
            $('#nacionalidad').select2({
                placeholder: "Selecciona Nacionalidad",
                allowClear: true
            });

        });
    });

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
                $('#tipo_documento').append("<option value=\""+documento[i].id+"\">"+documento[i].nombre+"<\/option>");
            });
            $('#tipo_documento').select2({
                placeholder: "Selecciona Documento",
                allowClear: true
            });

        });
    });

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
                    $('#perfil').append("<option disabled='disabled' value=\""+perfil[i].id+"\">"+perfil[i].display_name+"<\/option>");
                }else{
                    $('#perfil').append("<option value=\""+perfil[i].id+"\">"+perfil[i].display_name+"<\/option>");
                }
            });
            $('#perfil').select2({
                placeholder: "Selecciona Perfil",
                allowClear: true
            });

        });
    });

    function format (option) {
        if (!option.id) { return option.text; }
        var ob = '<img class="img-circle" src="'+option.urlimgprofilesmall+'" />' +" "+ option.text;	// replace image source with option.img (available in JSON)
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
                            id : item.userid,
                            text: item.identificacion+' '+item.names+' '+item.surnames,
                            urlimgprofilesmall: item.urlimgprofilesmall
                        }
                    })
                };
            }
        },
        templateResult: format,
        escapeMarkup: function(m) { return m; },
        placeholder: "Selecciona Usuario Padre",
        allowClear: true
    });


    $("#tipo_documento").ready( function(event) {
        $("#ndocumento").prop('disabled', true);
    });

    $("#tipo_documento").change( function(event) {
        if($("#tipo_documento").val()=="")
        {
            $("#ndocumento").val("");
            $("#ndocumento").prop('disabled', true);
        }else
        {
            $("#ndocumento").prop('disabled', false);
        }
    });



    $('#save_user').on('click', function() {

        let form = new FormData();
        form.append('_token', $('input[name=_token]').val());
        form.append('nacionalidad', $('#nacionalidad').val());
        form.append('tipo_documento', $('#tipo_documento').val());
        form.append('ndocumento', $('#ndocumento').val());
        form.append('nombres', $('#nombres').val());
        form.append('apellidos', $('#apellidos').val());
        form.append('username', $('#username').val());
        form.append('perfil', $('#perfil').val());
        form.append('email', $('#email').val());
        form.append('supervisor', $('#supervisor').val());
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "/user/store",
            data: form,
            processData: false,
            contentType: false,
        }).done(function(data) {
            toastr.success('Usuario creado correctamente!', '', {timeOut: 1000,progressBar: true});
        }).fail(function(data) {
            $('#inputImage').prop('disabled', false);
            $('.errorNacionalidad').addClass('hidden');
            $('.errorTipoDocumento').addClass('hidden');
            $('.errorNdocumento').addClass('hidden');
            $('.errorNombres').addClass('hidden');
            $('.errorApellidos').addClass('hidden');
            $('.errorUsername').addClass('hidden');
            $('.errorPerfil').addClass('hidden');
            $('.errorEmail').addClass('hidden');
            $('.errorSupervisor').addClass('hidden');

            //console.log(data.responseJSON);
            if ((data.responseJSON)) {
                if (data.responseJSON.nacionalidad) {
                    $('.errorNacionalidad').removeClass('hidden');
                    $('.errorNacionalidad').text(data.responseJSON.nacionalidad);
                }
                if (data.responseJSON.tipo_documento) {
                    $('.errorTipoDocumento').removeClass('hidden');
                    $('.errorTipoDocumento').text(data.responseJSON.tipo_documento);
                }
                if (data.responseJSON.ndocumento) {
                    $('.errorNdocumento').removeClass('hidden');
                    $('.errorNdocumento').text(data.responseJSON.ndocumento);
                }
                if (data.responseJSON.nombres) {
                    $('.errorNombres').removeClass('hidden');
                    $('.errorNombres').text(data.responseJSON.nombres);
                }
                if (data.responseJSON.apellidos) {
                    $('.errorApellidos').removeClass('hidden');
                    $('.errorApellidos').text(data.responseJSON.apellidos);
                }
                if (data.responseJSON.username) {
                    $('.errorUsername').removeClass('hidden');
                    $('.errorUsername').text(data.responseJSON.username);
                }
                if (data.responseJSON.perfil) {
                    $('.errorPerfil').removeClass('hidden');
                    $('.errorPerfil').text(data.responseJSON.perfil);
                }
                if (data.responseJSON.email) {
                    $('.errorEmail').removeClass('hidden');
                    $('.errorEmail').text(data.responseJSON.email);
                }
                if (data.responseJSON.supervisor) {
                    $('.errorSupervisor').removeClass('hidden');
                    $('.errorSupervisor').text(data.responseJSON.supervisor);
                }
            }
            //toastr.error('Error consulta!', '', {timeOut: 1000,progressBar: true});
        });

    });


})

new Vue({
    el:'#app',
    data: {
        message: 'Hello Vue!',
        nombres: '',
        apellidos: ''
    },
    methods:{
        hola: function(){

            if($('#tipo_documento').val()=='')
            {
                return true;//deshabilitado
            }
            return false;
        }
    },
    computed: {
        username: function () {
            if (this.nombres != '' ) {
                var primernombre='',primerapellido='';
                for (var i=0 ; i<this.nombres.length ;i++)
                {
                    if (this.nombres.charAt(i)==' ') {
                        break;
                    }
                    primernombre +=this.nombres.charAt(i);
                }

                for (var i=0 ; i<this.apellidos.length ;i++)
                {
                    if (this.apellidos.charAt(i)==' ') {
                        break;
                    }
                    primerapellido +=this.apellidos.charAt(i);
                }
                return (primernombre+'.'+primerapellido).toLowerCase();
            }
        },
        email: function () {
            if (this.nombres != '' ) {
                var primernombre='',primerapellido='';
                for (var i=0 ; i<this.nombres.length ;i++)
                {
                    if (this.nombres.charAt(i)==' ') {
                        break;
                    }
                    primernombre +=this.nombres.charAt(i);
                }
                for (var i=0 ; i<this.apellidos.length ;i++)
                {
                    if (this.apellidos.charAt(i)==' ') {
                        break;
                    }
                    primerapellido +=this.apellidos.charAt(i);
                }
                return ((primernombre+'.'+primerapellido)+'@mad.ec').toLowerCase();
            }
        }

    }

})

