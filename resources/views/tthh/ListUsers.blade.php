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
                    <th>ACTIVO</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div id="myModal" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><b>EDITAR USUARIO</b></h4>
                <div  class="contact-box center-version" style="border:none;margin-bottom: 0;">
                    <a style="padding:0;">
                        <img alt="image" class="img-circle img-rounded imageprofile" src="/images/user/fotoperfil.jpg">
                        <h3 class="m-b-xs"><span class="nombres-apellidos"></span></h3>
                        <address class="m-t-md">
                            <strong>ACTIVO: <span class="activo"></span></strong><br>
                            <strong><span class="tipodocumento"></span>: </strong><span class="ndocumento"></span><br>
                            <strong>MÓVIL: </strong><span class="telefonomovil"></span><br>
                            <strong>EDAD: </strong><span class="edad"></span> <strong>FECHA NACIMIENTO: </strong><span class="fechanacimiento"></span><br>
                            <span class="provincia"></span>, <span class="canton"></span>, <span class="parroquia"></span>
                        </address>
                    </a>
                </div>
            </div>
            <div class="modal-body" style="padding: 20px 0px 20px !important; min-height: 260px;">
                <div class="col-xs-12">
                    <label class="label-black control-label">Perfil</label>
                    <select id="perfil" class="perfil form-control m-b"  name="perfil">
                    </select>
                    <p style="color:red;" class="errorPerfil text-center hidden"></p>
                </div>
                <div class="col-xs-12">
                    <div class="col-md-3 pl-0">
                        <label class="label-black control-label">Activo</label>
                        <select id="Activo" class="form-control m-b" >
                            <option value=""></option>
                        </select>
                        <p style="color:red;" class="errorSupervisor text-center hidden"></p>
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



