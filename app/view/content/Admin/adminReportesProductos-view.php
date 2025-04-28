<?php

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename= Productos.xls");

?>

<table id="tablaProd">
                    <tr>
                        <td><strong>PRODUCTOS</strong></td>
                        <td><strong>ID</strong></td>
                        <td><strong>NOMBRE</strong></td>
                        <td><strong>DESCRIPCION</strong></td>
                        <td><strong>CATEGORIA</strong></td>
                        <td><strong>VALOR UNITARIO</strong></td>
                        <td><strong>CANTIDAD TOTAL</strong></td>
                        <td><strong>CANTIDAD EXISTENTE</strong></td>
                        <td><strong>FECHA ENTRADA</strong></td>
                        <td><strong>FECHA SALIDA</strong></td>
                        
                        
                        
                    </tr>

                    <tbody>
                    
                    

                        <?php


                            
                            $query = $insLogin->ejecutarConsulta("SELECT c.Nombre_CAT,p.* FROM productos p, categoria_producto c where p.ID_CAT = c.ID_CAT");
                            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
                            
                            
                            foreach($rows as $row){ ?>
                                <tr>
                                    <td><img src='../<?= $row['Img']; ?>' alt=""></td>
                                    <td><?php echo $row['ID_PRO'] ?></td>
                                    <td><?php echo $row['Nombre_PRO'] ?></td>
                                    <td><?php echo $row['Descripcion_PRO'] ?></td>
                                    <td><?php echo $row['Categoria_PRO'] ?></td>
                                    <td><?php echo $row['Valor_Unitario'] ?></td>
                                    <td><?php echo $row['Cantidad_Total'] ?></td>
                                    <td><?php echo $row['Cantidad_Existente'] ?></td>
                                    <td><?php echo $row['Fecha_Entrada'] ?></td>
                                    <td><?php echo $row['Fecha_Expedicion']?></td>
                                    
                                
                            <?php } ?>    
                            

                            
                    </tr>  
                    </tbody>
                            
                </table>