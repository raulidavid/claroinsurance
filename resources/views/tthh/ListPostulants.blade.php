<div class="row">
    <div class="col-lg-12">
        <div class="col-sm-offset-5 col-sm-2 no-padding">
            <input id="Buscar" class="form-control " type="text" placeholder="&#xF002; Buscar Postulante" style="font-family:Arial, FontAwesome">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table id="postulantes" class="table table-hover table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ACCIÓN</th>
                    <th>ESTADO POSTULANTE</th>
                    <th>NÚMERO DOCUMENTO</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>EMAIL</th>
                    <th>USERNAME</th>
                    <th>PROVINCIA</th>
                    <th>CANTON</th>
                    <th>PARROQUIA</th>
                    <th>TELÉFONO MÓVIL</th>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>ACCIÓN</th>
                    <th>ESTADO POSTULANTE</th>
                    <th>NÚMERO DOCUMENTO</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>EMAIL</th>
                    <th>USERNAME</th>
                    <th>PROVINCIA</th>
                    <th>CANTON</th>
                    <th>PARROQUIA</th>
                    <th>TELÉFONO MÓVIL</th>
                </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>
<div id="ApproveModal" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <!--<i class="fa fa-laptop modal-icon"></i>-->
                <h4 class="modal-title">Formulario de Aprobación</h4>
                <!--<small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>-->
                <div  class="contact-box center-version" style="border:none;margin-bottom: 0;">
                    <a style="padding:0;">
                        <img alt="image" class="img-circle img-rounded imageprofile" src="/images/user/default-imageprofile.jpg">
                        <h3 class="m-b-xs"><span class="nombres"></span> <span class="apellidos"></span></h3>

                        <address class="m-t-md">
                            <strong>NACIONALIDAD: </strong><span class="nacionalidad"></span><br>
                            <strong><span class="tipodocumento"></span>: </strong><span class="ndocumento"></span><br>
                            <strong>MÓVIL: </strong><span class="telefonomovil"></span> <strong>DOMICILIO: </strong><span class="telefonodomicilio"></span><br>
                            <strong>EDAD: </strong><span class="edad"></span> <strong>FECHA NACIMIENTO: </strong><span class="fechanacimiento"></span><br>
                            <strong>DIRECCIÓN: </strong>
                            <span class="calleprimaria"></span><br>
                            <span class="provincia"></span>, <span class="canton"></span>, <span class="parroquia"></span>
                        </address>
                    </a>
                </div>
            </div>
            <div class="modal-body">
                <div class="col-xs-12">
                    <label class="label-black control-label">Correo Electrónico Empresarial*</label>
                    <input class="form-control" id="email" placeholder="Correo Electrónico Empresarial" type="email">
                    <p style="color:red;" class="errorEmailEmpresarial text-center hidden"></p>
                </div>
                <div class="col-xs-12">
                    <label class="label-black control-label">Perfil*</label>
                    <select id="perfil" class="perfil form-control m-b"  name="perfil">
                    </select>
                    <p style="color:red;" class="errorPerfil text-center hidden"></p>
                </div>
                <div class="col-xs-12">
                    <label class="label-black control-label">Obervación Usuario*</label>
                    <select id="obsuser" class="obsuser form-control m-b"  name="obsuser">
                    </select>
                    <p style="color:red;" class="errorObsUser text-center hidden"></p>
                </div>
                <div class="col-xs-12">
                    <label class="label-black control-label">Usuario Padre*</label>
                    <select id="supervisor" class="supervisor form-control m-b" name="supervisor">
                    </select>
                    <p style="color:red;" class="errorSupervisor text-center hidden"></p>
                </div>
                <p style="margin-top:130px;"><strong>Nota: </strong>Verificar que los datos sean correctos y posterior a este proceso activa el usuario.</p>
                <p style="color:red;" class="errorPostulant text-center hidden"></p>
            </div>
            <div class="modal-footer">
                <button id="Approve" type="button" class="btn btn-info"><i class="fa fa-check"></i> Aprobar</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


@section('scripts.form')
<script>
$( document ).ready(function() {
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
                dropdownParent: $('#ApproveModal .modal-content')
            });

        });
    });

    $("#obsuser").ready( function(event) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/obsusuarios',
            type: 'get',
            dataType: "json"
        }).done(function (obsuser){
            $('#obsuser').append($('<option></option>'));
            $.each(obsuser, function(i) {
                $('#obsuser').append("<option value=\""+obsuser[i].id+"\">"+obsuser[i].nombre+"<\/option>");
            });
            $('#obsuser').select2({
                placeholder: "Selecciona Observación Usuario",
                allowClear: true,
                dropdownParent: $('#ApproveModal .modal-content')
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
        dropdownParent: $('#ApproveModal .modal-content')
    });

    let oTable = $('#postulantes').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        ordering: false,
        searching:false,
        bLengthChange: false,
        ajax: {
            url: '{{ route('PostulantsInfo') }}',
            data: function (d) {
                d.Buscar = $('#Buscar').val();
            }
        },
        columns: [
            {data: 'PTLID', name: 'PTLID'/*,visible: false*/},
            {
                data: 'PTLACCION', name: 'PTLACCION',
                render: function ( data, type, row ) {
                    var operacion = '<button type="button" data-ptlid="'+row['PTLID']+'" class="Approve btn btn-primary btn-xs">Aprobar</button></br>';
                    if (row['ACTIONASIGNARDEPOSITOS']){
                        operacion = operacion.concat('<button type="button" class="PaymentAssign btn btn-warning btn-xs">Asignar Depósito</button>');
                    }
                    if (row['ACTIONASIGNARORDEN']){
                        operacion = operacion.concat('<button type="button" class="OrderAssign btn btn-success btn-xs">Asignar Orden</button>');
                    }
                    return operacion;
                }
            },
            {data: 'PTLESTADOPOSTULANTE.nombre', name: 'PTLESTADOPOSTULANTE.nombre'/*,visible: false*/},
            {data: 'PTLNDOCUMENTO', name: 'PTLNDOCUMENTO'},
            {data: 'PTLNOMBRES', name: 'PTLNOMBRES'},
            {data: 'PTLAPELLIDOS', name: 'PTLAPELLIDOS'},
            {data: 'PTLEMAIL', name: 'PTLEMAIL'},
            {data: 'PTLUSERNAME', name: 'PTLUSERNAME'},
            {data: 'PTLPROVINCIA.nombre', name: 'PTLPROVINCIA.nombre'},
            {data: 'PTLCANTON.nombre', name: 'PTLCANTON.nombre'},
            {data: 'PTLPARROQUIA.nombre', name: 'PTLPARROQUIA.nombre'},
            {data: 'PTLCELULAR', name: 'PTLCELULAR'},
            
        ]
    });
    $('#Buscar').on('keyup', function(e) {
        oTable.draw();
    });
    var loadPostulantInfoById =  function(data){
        $('.nombres').text(data.PTLNOMBRES);
        $('.apellidos').text(data.PTLAPELLIDOS);
        $('.username').text(data.PTLUSERNAME);
        $('.ndocumento').text(data.PTLNDOCUMENTO);
        $('.email').text(data.PTLEMAIL);
        $('.fechanacimiento').text(data.PTLFECNACIMIENTO);
        $('.edad').text(data.PTLEDAD);
        $('.provincia').text(data.PTLPROVINCIA.nombre);
        $('.canton').text(data.PTLCANTON.nombre);
        $('.parroquia').text(data.PTLPARROQUIA.nombre);
        $('.telefonomovil').text(data.PTLCELULAR);
    }
    var btn;
    $(document).on('click', '.Approve', function(){
        $('#PaymentAssign').attr('disabled',true);
        btn = $(this).data("ptlid");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache:false,
            url: '/Postulant/'+btn,
            type: 'get',
            dataType: 'json',
        }).done(function (data, textStatus, jqXHR) {
            console.log(data);
            loadPostulantInfoById(data);
            //$('#myModal').find('.modal-title span').html(data[0].ORDNUMERO);
            $('#ApproveModal').modal('show');
            //$('#PaymentAssign').attr('disabled',false);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //console.log(jqXHR);
        });
    });

    $('.modal').on('hidden.bs.modal', function () {
        ResetModal();
        ClearValidation();
    });

    function ResetModal(){
        $('#ApproveModal').find('.modal-title span').html("");
        $('#email').val("");
        $('#perfil').val("");
        $('#supervisor').val("");
        $('#obsuser').val("");
    }

    function ClearValidation(){
        $('.errorEmailEmpresarial').addClass('hidden');
        $('.errorPerfil').addClass('hidden');
        $('.errorPostulant').addClass('hidden');
        $('.errorSupervisor').addClass('hidden');
        $('.errorObsUser').addClass('hidden');
    }

    function ValidationFailStep1(data) {
        var band = false;
        if (data.Order) {
            $('.errorOrder').removeClass('hidden');
            $('.errorOrder').text(data.Order);
            band = true;
        }
        if (data.OrderOwner) {
            $('.errorOrderOwner').removeClass('hidden');
            $('.errorOrderOwner').text(data.OrderOwner);
            band = true;
        }
        if (data.EntidadFinanciera) {
            $('.errorEntidadFinanciera').removeClass('hidden');
            $('.errorEntidadFinanciera').text(data.EntidadFinanciera);
            band = true;
        }
        if (data.DatePayment) {
            $('.errorDatePayment').removeClass('hidden');
            $('.errorDatePayment').text(data.DatePayment);
            band = true;
        }

        return band;
    }

    function ValidationFail(data){
        if (data) {
            ValidationFailStep1(data);
        }
    }

    function LoadAjaxRegister(Form,url) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache:false,
            url: url,
            type: 'post',
            data: Form,
            dataType: "json",
            processData: false,
            contentType: false,
        }).done(function (data, textStatus, jqXHR) {
            if(jqXHR.status==201){
                toastr.success(data, '', {positionClass: "toast-top-center",timeOut: 8000});
                //oTable.draw();
            }
            //ClearValidation();
        }).fail(function (jqXHR, textStatus, errorThrown) {
            if(jqXHR.status==401){
                toastr.info(jqXHR.responseText, '', {positionClass: "toast-top-center",timeOut: 8000});
            }
            if(jqXHR.status==422){
                ClearValidation();
                ValidationFail(jqXHR.responseJSON);
            }
        });
    }

    function FormPostulantContactado(PTLID,PTLCONTACTED) {
        let form = new FormData();
        form.append('PTLID', PTLID);
        form.append('PTLCONTACTED', PTLCONTACTED);
        return form;
    }

    // Handle iCheck change event for checkboxes in table body
    $(oTable.table().container()).on('ifChanged', '.i-checks', function(event){
        var PTLCONTACTED = $(this).is(":checked");
        var PTLID = $(this).data("id");
        var url = '/Postulant/Contacted';
        var Form = FormPostulantContactado(PTLID,PTLCONTACTED);
        if (PTLCONTACTED) {
            LoadAjaxRegister(Form,url);
        } else {
            LoadAjaxRegister(Form,url);
        }
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
        form.append('postulant', btn);
        form.append('emailempresarial', $('#email').val());
        form.append('obsuser', $('#obsuser option:selected').text());
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
            $('.errorObsUser').addClass('hidden');
            if ((data.responseJSON)) {
                if (data.responseJSON.obsuser) {
                    $('.errorObsUser').removeClass('hidden');
                    $('.errorObsUser').text(data.responseJSON.obsuser);
                }
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