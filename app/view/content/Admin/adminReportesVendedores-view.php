<?php

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename= Vendedores.xls");

?>

<table id="TableVen">
                    <tr>
                        <td><strong>IDENTIFICACION</strong></td>
                        <td><strong>NOMBRE</strong></td>
                        <td><strong>CORREO</strong></td>
                        <td><strong>DIRECCION</strong></td>
                        <td><strong>TELEFONO</strong></td>
                        
                        
                        
                    </tr>                  
                    <tbody>
                        
                        
                            <?php

                            
                                
                                $queryVen = $insLogin->ejecutarConsulta("SELECT * FROM usuarios WHERE ID_TU = 2");
                                $row = $queryVen->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach($row as $rowVen){ ?>
                                <tr>
                                        <td><?php echo $rowVen['ID_US'] ?></td>
                                        <td><?php echo $rowVen['Nombre_US'] ?></td>
                                        <td><?php echo $rowVen['Correo_US'] ?></td>
                                        <td><?php echo $rowVen['Direccion_US'] ?></td>
                                        <td><?php echo $rowVen['Telefono_US'] ?></td>
                                    

                                        
                                <?php } ?>    
                                
                        </tr>  
                    </tbody>   
                </table>