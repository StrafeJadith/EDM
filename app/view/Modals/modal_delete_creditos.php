
     <!--modal delete creditos -->
                
     <div class="modal" id="delete_creditos<?php echo $row['ID_CR'];?>" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1">
                       <div class="modal-dialog">
                           <div class=" m modal-content">
                              <div class=" header modal-header">
                                 <h5 class="modal-title">Eliminar registro de credito</h5>
                                  <button type="button" class=" x btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class=" body modal-body">
                                    <form action="../../controller/controllerAdministrador.php" method = "POST">
                                    <input type="text" name="idcre" value="<?php echo $row['ID_CR'];?>" placeholder="ID Categoria" readonly >
                                        <br><br>
                                        <input type="text" name="idus" value="<?php echo $row['ID_US'];?>" placeholder="ID USUARIO" readonly>
                                        <br><br>
                                        <input type="text" name="nombrecre" value="<?php echo $row['Nombre_US'];?>" placeholder="NOMBRE" readonly>
                                        <br><br>
                                        <input type="text" name="apellidocre" value="<?php echo $row['Correo_CR'];?>" placeholder="APELLIDO" readonly>
                                        <br><br>
                                        <input type="text" name="telefonocre" value="<?php echo $row['Telefono_CR'];?>"placeholder="TELEFONO" readonly>
                                        <br><br>
                                        <input type="text" name="direccioncre" value="<?php echo $row['Direccion_CR'];?>" placeholder="DIRECCION" readonly>
                                        <br><br>
                                        <input type="text" name="estadocre" value="<?php echo $row['Estado_CR'];?>" placeholder="ESTADO" readonly>
                                        <br><br>
                                        <input type="text" name="fechacre" value="<?php echo $row['Fecha_CR'];?>" placeholder="FECHA" readonly>
                                        <br><br>
                                        <input type="text" name="valorcre" value="<?php echo $row['Valor_CR'];?>" placeholder="Valor credito" readonly>
                                        <br><br>
                                        
                                        <button type="submit" class="btn btn-danger" name="delete">ELIMINAR</button>

                                    </form>
                                </div>
                                <div class=" footer modal-footer">
                                   <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                           </div>
                        </div>
                     </div>