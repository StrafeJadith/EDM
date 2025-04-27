<?php

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename= Usuarios.xls");
    
?>
            
            <table id="Cl">
                <tr>
                    <td><strong>IDENTIFICACION</strong></td>
                    <td><strong>NOMBRE</strong></td>
                    <td><strong>CORREO</strong></td>
                    <td><strong>DIRECCION</strong></td>
                    <td><strong>TELEFONO</strong></td>
                    
                    
                </tr>                  
                <tbody>          
                        <?php

                            $query = $insLogin->ejecutarConsulta("SELECT * FROM usuarios WHERE ID_TU = 3");
                            $row = $query->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach($row as $rowusu){ ?>
                            <tr>
                                    <td><?php echo $rowusu['ID_US'] ?></td>
                                    <td><?php echo $rowusu['Nombre_US'] ?></td>
                                    <td><?php echo $rowusu['Correo_US'] ?></td>
                                    <td><?php echo $rowusu['Direccion_US'] ?></td>
                                    <td><?php echo $rowusu['Telefono_US'] ?></td>
                            
                            <?php } ?> 
                    </tr>  
                </tbody>   
            </table>
            

    
