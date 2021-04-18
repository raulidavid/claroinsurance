@extends('layouts.home') <!--Extendemos layaout home-->
@section('title', 'Inicio') <!-- Cambiamos el titulo de la página-->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="col-sm-offset-5  no-padding">
            <h1 class="text-navy"> <i class="fa fa-user" aria-hidden="true"></i> BIENVENIDO {{ Auth::user()->nombres }}</h1>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-sm-offset-5 col-sm-2 no-padding">
                    <input id="Buscar" class="form-control " type="text" placeholder="&#xF002; Buscar Usuario" style="font-family:Arial, FontAwesome">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="validar_ventas" class="table table-hover table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ACCIÓN</th>
                            <th>NUMERO DOCUMENTO</th>
                            <th>USUARIO</th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>EMAIL</th>
                            <th>EDAD</th>
                            <th>PROVINCIA</th>
                            <th>CANTÓN</th>
                            <th>PARROQUIA</th>
                            <th>ACTIVO</th>
                        </tr>
                        </thead>
        
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>ACCIÓN</th>
                            <th>NUMERO DOCUMENTO</th>
                            <th>USUARIO</th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>EMAIL</th>
                            <th>EDAD</th>
                            <th>PROVINCIA</th>
                            <th>CANTÓN</th>
                            <th>PARROQUIA</th>
                            <th>ACTIVO</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal inmodal"  role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><b>EDITAR USUARIO</b></h4>
                    </div>
                    <div class="modal-body" style="padding: 20px 0px 20px !important; min-height: 480px;">
                        <div class="col-xs-12">
                            <label class="label-black control-label">Número de Documento*</label>
                            <input id="ndocumento" name="ndocumento" type="text" placeholder="Número Documento"
                                    class="ndocumento form-control">
                            <p style="color:red;" class="errorNDocumento text-center hidden"></p>
                        </div>
                        <div class="col-xs-12">
                            <label class="label-black control-label">Nombres*</label>
                            <input id="nombres" name="nombres" type="text" placeholder="Nombres"
                                    class="nombres form-control">
                            <p style="color:red;" class="errorNombres text-center hidden"></p>
                        </div>
                        <div class="col-xs-12">
                            <label class="label-black control-label">Apellidos*</label>
                            <input id="apellidos" name="apellidos" type="text" placeholder="Apellidos"
                                    class="apellidos form-control">
                            <p style="color:red;" class="errorApellidos text-center hidden"></p>
                        </div>
                        <div class="col-xs-12">
                            <label class="label-black control-label">Fecha Nacimiento*</label>
                            <input id="Fechanacimiento" name="Fechanacimiento" type="text" placeholder="Fecha Nacimiento"
                                    class="fechanacimiento form-control">
                            <p style="color:red;" class="errorFechanacimiento text-center hidden"></p>
                        </div>
                        <div class="col-xs-12">
                            <label class="label-black control-label">Número Celular*</label>
                            <input id="Ncelular" name="Ncelular" type="text" placeholder="Número Celular"
                                    class="Ncelular form-control">
                            <p style="color:red;" class="errorNcelular text-center hidden"></p>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-md-4 pl-0">
                                <label class="label-black control-label">Provincia</label>
                                <select id="provincia" class="provincia form-control m-b" >
                                    <option value=""></option>
                                </select>
                                <p style="color:red;" class="errorProvincia text-center hidden"></p>
                            </div>
                            <div class="col-md-4 pl-0">
                                <label class="label-black control-label">Canton</label>
                                <select id="canton" class="canton form-control m-b" >
                                    <option value=""></option>
                                </select>
                                <p style="color:red;" class="errorCanton text-center hidden"></p>
                            </div>
                            <div class="col-md-4 pl-0">
                                <label class="label-black control-label">Parroquia</label>
                                <select id="parroquia" class="parroquia form-control m-b" >
                                    <option value=""></option>
                                </select>
                                <p style="color:red;" class="errorParroquia text-center hidden"></p>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-md-3 pl-0">
                                <label class="label-black control-label">Activo</label>
                                <select id="Activo" class="Activo form-control m-b" >
                                    <option value=""></option>
                                </select>
                                <p style="color:red;" class="errorActivo text-center hidden"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="EditUser" class="btn btn-info" type="button">
                            <i class="fa fa-save" aria-hidden="true"></i> Guardar
                        </button>
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@stop
@section('scripts.form')
<script>
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
$( document ).ready(function() {
     
				var sampleArray = [
					{id:"1",text:'SI'},
					{id:"0",text:'NO'}
				];

				$("#Activo").select2({
					placeholder: 'Activo',
					allowClear: true,
					data: sampleArray,
					dropdownParent: $('#myModal .modal-content'),
				});
				let oTable = $('#validar_ventas').DataTable({
					processing: true,
					serverSide: true,
					lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
					ordering: false,
					bLengthChange: false,
					searching:false,
					ajax: {
						url: '/getUsuarios',
						data: function (d) {
							d.Buscar = $('#Buscar').val();
						}
					},
					/*rowCallback: function( row, data, index ) {
						if(data['USERACTIVE']===0){
							$(row).hide();
						}
					},*/
					columns: [
						{data: 'USERID', name: 'USERID'/*,visible: false*/},
						{
							data: 'OPERACION', name: 'OPERACION',
							render: function ( data, type, row ) {
								var operacion;
								if (row['ACTIONEDITARUSUARIO']){
									operacion = row['ACTIONEDITARUSUARIO'];
									//var operacion = '<button type="button" data-order="'+row['ORDNUMERO']+'" class="PaymentAssign btn btn-warning btn-xs">Editar Usuario</button>';
								}
								
								operacion += row['ACTIONELIMINARUSUARIO'];
								
								if(operacion){
									return operacion;
								}
								return '';
							}
						},
						
						{data: 'IDTNDOCUMENTO', name: 'IDTNDOCUMENTO'},
						{data: 'USERUSUARIO', name: 'USERUSUARIO'},
						{data: 'USERNOMBRES', name: 'USERNOMBRES'},
						{data: 'USERAPELLIDOS', name: 'USERAPELLIDOS'},
						{data: 'USEREMAIL', name: 'USEREMAIL'},
                        {data: 'USEREDAD', name: 'USEREDAD'},
                        {data: 'IDTPROVINCIA.nombre', name: 'IDTPROVINCIA.nombre'},
                        {data: 'IDTCANTON.nombre', name: 'IDTCANTON.nombre'},
                        {data: 'IDTPARROQUIA.nombre', name: 'IDTPARROQUIA.nombre'},
						{
							data: 'USERACTIVE', name: 'USERACTIVE',
							render: function ( data, type, row ) {
								if(row['USERACTIVE']==1){
									return "SI";
								}else{
									return "NO";
								}
							}
						}
					]
				});
				$('#Buscar').on('keyup', function(e) {
					oTable.draw();
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
							if(perfil[i].id==1) {
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
				
				var btn,user;
				$(document).on('click', '.UserEdit', function(){
					$('#EditUser').attr('disabled',true);
					btn = $(this).data("user");
					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						cache:false,
						url: '/user/'+btn,
						type: 'get',

						dataType: "json",
					}).done(function (data, textStatus, jqXHR) {
                        

                        $("#provincia").ready(function (event) {
                                $("#canton").ready(function (event) {
                                    $('#canton').select2({
                                        placeholder: "Selecciona Canton",
                                        allowClear: true,
                                        dropdownParent: $('#myModal .modal-content')
                                    });
                                    $("#canton").prop('disabled', true);
                                });
                                $("#parroquia").ready(function (event) {
                                    $('#parroquia').select2({
                                        placeholder: "Selecciona Parroquia",
                                        allowClear: true,
                                        dropdownParent: $('#myModal .modal-content')
                                    });
                                    $("#parroquia").prop('disabled', true);
                                });
                                $('#provincia').select2({
                                    placeholder: "Selecciona Provincia",
                                    allowClear: true,
                                    dropdownParent: $('#myModal .modal-content')
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



						
						$('#myModal').find('.contact-box .nombres-apellidos').html(data.USERNOMBRES+' '+data.USERAPELLIDOS);
						$('.ndocumento').val(data.IDTNDOCUMENTO);
                        $('.nombres').val(data.USERNOMBRES);
                        $('.apellidos').val(data.USERAPELLIDOS);
						$('.telefonomovil').val(data.IDTCELULAR);
						$('.edad').val(data.USEREDAD);
						$('.fechanacimiento').val(data.IDTFECNACIMIENTO);
                        $('.Ncelular').val(data.IDTCELULAR);

						if(data.IDTPROVINCIA){
							$('.provincia').val(data.IDTPROVINCIA.nombre);
						}
						if (data.IDTCANTON){
							$('.canton').val(data.IDTCANTON.nombre);
						}
						if (data.IDTCANTON){
							$('.parroquia').val(data.IDTPARROQUIA.nombre);
						}
					
						
						if(data.USERACTIVE==1){
							$('.activo').text("SI");
						}else{
							$('.activo').text("NO");
						}
						user = data.USERID;
                        oTable.draw();
						$('#myModal').modal('show');
						$('#EditUser').attr('disabled',false);
					}).fail(function (jqXHR, textStatus, errorThrown) {
						//console.log(jqXHR);
					});
				});


				$('#myModal').on('hidden.bs.modal', function () {
					ResetModal();
					ClearValidation();
				});

				function ResetModal(){
					$(".perfil").val([]).trigger("change");
					$(".supervisor").val([]).trigger("change");
					$("#Activo").val([]).trigger("change");
					$("#obsuser").val([]).trigger("change");
				}

				var convertTypeNull = function (value){
					if (value === null) return "";
					if (value === undefined) return "";
					return value;
				};

				function LoadFormData() {
					var form = new FormData();
					form.append('User', user);
					form.append('ndocumento', convertTypeNull($('.ndocumento').val()));
                    form.append('nombres', convertTypeNull($('.nombres').val()));
                    form.append('apellidos', convertTypeNull($('.apellidos').val()));
                    form.append('fechanacimiento', convertTypeNull($('.fechanacimiento').val()));
                    form.append('ncelular', convertTypeNull($('.Ncelular').val()));
					form.append('Activo', convertTypeNull($('#Activo').val()));
					form.append('obsuser', $('#obsuser option:selected').text());
					return form;
				}

				function ClearValidation(){
					$('.errorOrder').addClass('hidden');
					$('.errorOrderF').addClass('hidden');
					$('.errorFactura').addClass('hidden');
					$('.errorTipoPropietario').addClass('hidden');
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

					return band;
				}

				function ValidationFail(data){
					if (data) {
						ValidationFailStep1(data);
					}
				}

				function LoadAjaxRegister(Form,url,operacion) {
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
						oTable.page(oTable.page.info().page).draw('page');
						if(jqXHR.status==201){
							toastr.success(data.nombres+' '+data.apellidos, operacion + ' Correctamente', {positionClass: "toast-top-center",timeOut: 8000});
						}
						ClearValidation();
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

				$('#EditUser').on('click', function(e) {
					var Form = LoadFormData();
					var url = '/User/Update';
                    var operacion = 'Actualizado';
					LoadAjaxRegister(Form,url);
				});

			})
		</script>
@stop