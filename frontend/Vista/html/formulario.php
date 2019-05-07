<div class="container register">
<div class="row">
    <div class="col-md-9 register-right" id="card_register"> 
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="candidato" role="tabpanel" aria-labelledby="home-tab">
                <br>
                <div class="text-right">
                  <div class="btn-group btn-toggle"> 
                    <button class="btn btntoogle" id="candForm">CANDIDATO</button>
                    <button class="btn btntoogle" id="empForm">EMPRESA</button>
                  </div>
                </div>

                <h3 class="register-heading">Registrarse como Candidato</h3>
                <form id="preregistroFormulario" action="<?php echo PUERTO."://".HOST;?>/preregistro/" method="POST">
                    
                    <div class="row register-form">
                            <input type="hidden" name="form_pre" value="1">
                            <input type="hidden" name="tipo_usuario" id="tipo_usuario" value="">
                            <input type="hidden" name="tipo_doc" id="tipo_doc">
                            <div class="col-md-6 col-xs-12 form-group">
                                <div></div>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres *" />
                            </div>

                            <div class="col-md-6 col-xs-12 form-group">
                                <div></div>
                                <select class="form-control" name="sectorind" id="sectorind">
                                    <option value="" selected="selected" disabled="disabled">Sector industrial</option>
                                    <?php 
                                        if(!empty($arrsectorind)){
                                            foreach ($arrsectorind as $sector) {
                                                echo "<option value='".$sector['id_sectorindustrial']."'>".$sector['descripcion']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6 col-xs-12 form-group">
                                <div></div>
                                <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos *" />
                            </div>



                            <div class="col-md-6 col-xs-12 form-group">
                                <div></div>
                                <select class="form-control" name="tipo_documentacion" id="tipo_documentacion">
                                    <option disabled="disabled" selected="selected" value="">Tipo de documentación</option>
                                    <?php foreach (TIPO_DOCUMENTO as $key => $value): ?>
                                        <?php
                                            if($key != 1){
                                            
                                                echo "<option value='".$key."'>".utf8_encode($value)."</option>";
                                            
                                            }
                                         ?>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-6 col-xs-12 form-group">
                                <div></div>
                                <input class="form-control" type="text" name="documento" id="documento" placeholder="Documento *">
                            </div>

                            <div class="col-md-6 col-xs-12 form-group">
                                <div></div>
                                <input type="text" id="fecha_nacimiento" class="form-control" data-field="date" placeholder="Fecha de nacimiento" name="fecha_nacimiento">
                                <div id="fechanac"></div>
                            </div>

                            <div class="col-md-6 col-xs-12 form-group">
                                <div></div>
                                <select class="form-control" name="id_genero" id="id_genero">
                                    <option value="" selected="selected" disabled="disabled">Género</option>
                                    <?php foreach ($arrgenero as $key=>$value){ ?>                                      
                                        <option value="<?php echo $value["id_genero"]; ?>"><?php echo utf8_encode($value["descripcion"]); ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6 col-xs-12 form-group">
                                <div></div>
                                <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Celular">
                            </div>

                            <div class="col-md-6 col-xs-12 form-group">
                                <div></div>
                                <input class="form-control" type="text" name="correo" id="correo" placeholder="Correo">
                            </div>
                    <div class="text-center">
                        <div class="form-group check_box">
                            <div></div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="terminosCond" name="terminosCond" id="terminosCond"> He le&iacute;do y acepto las <a class="link" href="https://www.micamello.com.ec/desarrollov3/docs/politicas_de_privacidad1.pdf" target="_blank">pol&iacute;ticas de privacidad</a> y <a class="link" href="https://www.micamello.com.ec/desarrollov3/docs/terminos_y_condiciones1.pdf" target="_blank">t&eacute;rminos y condiciones</a>
                                    </label>
                                    <label>Nota: Después de registrarte te llegará un E-mail.</label>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn-blue"  value="Registrarse"/>
                </div>


                </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
