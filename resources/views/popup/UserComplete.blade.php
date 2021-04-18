<div id="ModalUserComplete" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header" style="padding: 12px 15px !important;">
                <h4 class="modal-title"><b>COMPLETAR TUS DATOS</b></h4>
            </div>
            <div class="modal-body" style="padding: 20px 0px 20px !important; min-height: 305px;">
                <div id=previewimagen>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="image-cropUser">
                                <img id="imgHolder" src="" class="img-responsive img-rounded imageprofile">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label title="Upload image file" for="inputImageUser" class="btn btn-warning">
                                    <i class="fa fa-upload"></i>
                                    <input type="file" accept="image/*" id="inputImageUser" class="hide">
                                    Subir Foto
                                </label>
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
                    <p style="color:red;font-weight: bold;" class="errorImagen text-center hidden"></p>
                </div>
                <div class="col-xs-12">
                    <div class="col-sm-4 p-0">
                        <label class="label-black control-label">PROVINCIA*</label>
                        <select id="ProvinciaUser" class="form-control m-b"></select>
                        <p style="color:red;" class="errorProvincia text-center hidden"></p>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-black control-label">CANTÓN*</label>
                        <select id="CantonUser" class="form-control m-b"></select>
                        <p style="color:red;" class="errorCanton text-center hidden"></p>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-black control-label">PARROQUIA*</label>
                        <select id="ParroquiaUser" class="form-control m-b"></select>
                        <p style="color:red;" class="errorParroquia text-center hidden"></p>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-4 p-0">
                        <label class="label-black control-label">FECHA DE NACIMIENTO*</label>
                        <input id="fec_nacimientoUser" type='text' class="form-control"/>
                        <p style="color:red;" class="errorFecNacimiento text-center hidden"></p>
                    </div>
                    <div class="col-xs-4">
                        <label class="label-black control-label">ESTADO CIVIL*</label>
                        <select id="civilUser" class="civil form-control m-b"></select>
                        <p style="color:red;" class="errorCivil text-center hidden"></p>
                    </div>
                    <div class="col-xs-4">
                        <label class="label-black control-label">GÉNERO*</label>
                        <select id="generoUser" class="genero form-control m-b"></select>
                        <p style="color:red;" class="errorGenero text-center hidden"></p>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-sm-4 pl-0">
                        <label class="label-black control-label">TELÉFONO MÓVIL*</label>
                        <input id="tlf_movilUser" type="tel" placeholder="Teléfono Móvil" class="form-control">
                        <p style="color:red;" class="errorTlfMovil text-center hidden"></p>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-black control-label">TELÉFONO DOMICILIO*</label>
                        <input id="tlf_domicilioUser" type="tel" placeholder="Teléfono Domicilio" class="form-control">
                        <p style="color:red;" class="errorTlfDocimicilio text-center hidden"></p>
                    </div>
                </div>
                <div class="col-xs-12">
                    <label class="label-black control-label">DIRECCIÓN*</label>
                    <input id='calle_primariaUser' type='text' class="form-control" placeholder="Calle Primaria Secundaria Referencia" />
                    <p style="color:red;" class="errorCallePrimaria text-center hidden"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button id="CompleteUser" class="btn btn-info" data-user="" type="button">
                    <i class="fa fa-save" aria-hidden="true"></i> Guardar
                </button>
                <!--<button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>-->
            </div>
        </div>
    </div>
</div>