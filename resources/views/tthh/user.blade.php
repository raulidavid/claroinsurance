@extends('layouts.home')
	@if( $route == 'ShowUsersPath')
		@section('title','Usuarios')
	@endif
	@if( $route == 'show_postulants_path')
		@section('title','Postulantes')
	@endif
	@if( $route == 'create_user_path')
		@section('title','Agregar Contacto')
	@endif
	@if( $route == 'show_postulant_path' )
		@section('title','Ver Postulante')
	@endif
	@if( $route == 'UserProfileUpdate' )
		@section('title','Mi Información')
	@endif
@section('body_class', '')
@section('content')
	<div class="panel panel-primary">
    	<div class="panel-heading">
			@if( $route == 'ShowUsersPath')
				<h1>Listado de Usuarios</h1>
			@endif
			@if( $route == 'ContactCreatePath')
        		<h1>Agregar contacto</h1>
			@endif
			@if( $route == 'approve_user_path' )
				<h1>Revisar usuario</h1>
			@endif
			@if( $route == 'show_postulant_path' )
				<h1>Ver Postulante</h1>
			@endif
			@if( $route == 'show_postulants_path')
				<h1>Listado de Postulantes</h1>
			@endif
			@if( $route == 'UserProfileUpdate' )
				<h1><i class="fa fa-user"></i> Mi Información</h1>
			@endif
		</div>                                    
	</div>
	<div class="row wrap">
    	<div class="col-lg-12">
	       	<div class=" gray-bg">
				@if( $route == 'ShowUsersPath' )
					@include('tthh.ListUsers')
				@endif
				@if( $route == 'show_postulants_path' )
					@include('tthh.ListPostulants')
				@endif
				@if( $route == 'show_postulant_path' )
					@include('tthh.FormPostulantApprove')
				@endif
	       		@if( $route == 'ContactCreatePath')
	           		@include('tthh.FormContactCreate')
	           	@endif
				@if( $route == 'UserProfileUpdate' )
					@include('tthh.FormUserProfileUpdate')
				@endif
	       	</div>
    	</div>
	</div>
@stop
@section('scripts.form')
	@if( $route == 'ShowUsersPath' )
		<script>
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
								if (row['IDTHOJAVIDAURL']){
									operacion = operacion.concat('<a target="_blank" href="'+row['IDTHOJAVIDAURL']+'" class="btn btn-success btn-xs">Hoja de Vida</a></br>');
								}
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

						
						oTable.draw();
						$('#myModal').find('.contact-box .nombres-apellidos').html(data.USERNOMBRES+' '+data.USERAPELLIDOS);
						$('.imageprofile').attr("src",data.IDTIMGPROFILESMALL+'/foto.jpg');
						$('.nacionalidad').text(data.CATNACIONALIDAD.nombre);
						$('.tipodocumento').text(data.CATTIPOIDENTIFICACION.nombre);
						$('.ndocumento').text(data.IDTNDOCUMENTO);
						$('.telefonomovil').text(data.IDTCELULAR);
						$('.telefonodomicilio').text(data.IDTTELEFONO);
						$('.edad').text(data.USEREDAD);
						$('.fechanacimiento').text(data.IDTFECNACIMIENTO);
						$('.calleprimaria').text(data.IDTDIRECCION);
						if(data.IDTPROVINCIA){
							$('.provincia').text(data.IDTPROVINCIA.nombre);
						}
						if (data.IDTCANTON){
							$('.canton').text(data.IDTCANTON.nombre);
						}
						if (data.IDTCANTON){
							$('.parroquia').text(data.IDTPARROQUIA.nombre);
						}
						$('.rol').text(data.RUSROL.nombre);
						$('.userpadre').text(data.USERPADRE.nombre);
						if(data.USERACTIVE==1){
							$('.activo').text("SI");
						}else{
							$('.activo').text("NO");
						}
						user = data.USERID;

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
					form.append('Rol', convertTypeNull($('.perfil option:selected').text()));
					form.append('UsuarioPadre', convertTypeNull($('#supervisor').val()));
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
						oTable.page(oTable.page.info().page).draw('page');
						if(jqXHR.status==201){
							toastr.success(data.nombres+' '+data.apellidos, 'Actualizado Correctamente', {positionClass: "toast-top-center",timeOut: 8000});
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
					LoadAjaxRegister(Form,url);
				});

			})
		</script>
	@endif
@stop
	
	
