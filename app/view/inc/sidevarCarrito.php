<button id="openCart" class="esconderCarrito" ><img src="<?= APP_URL ?>public/img/Usuario/Carrito.png" width="40px" height="40px" style="margin-top: -18px;"></button>

    <!-- Sidebar del carrito -->
    <div id="cartSidebar" class="sidebar">
        <button id="closeCart">✖</button>
        <h2 style="color: #804e23;">Tu Carrito</h2>
        <div id="cartItems">
            
            <?php

                

                $correo = $_SESSION['correo'];

                // $sqlTraerId = $insLogin->ejecutarConsulta("SELECT ID_US FROM usuarios WHERE Correo_US = $correo");
                // $rowId = $sqlTraerId->fetch();
                // $ID_US = $rowId['ID_US'];


                $sql = $insLogin->ejecutarConsulta("SELECT p.Descripcion_PRO, p.Valor_Unitario, p.Img, v.* FROM productos p, ventas v, usuarios u Where p.ID_PRO = v.ID_PRO AND v.ID_US = u.ID_US AND v.Estado_VENT = 'Proceso' AND u.Correo_US = '$correo'");
                $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row) { ?>

                    <div id="Productos">
                        
                        <img src="<?= APP_URL.$row['Img'] ?>" class="imgpro" width="70px" height="50px" style="position: relative; left: 20px; top:20px;">
                        <p class="descripcion"><strong><?php echo $row['Descripcion_PRO'] ?></strong></p>
                        <p class="valorUnitario"><strong>$<?php echo $row['Valor_Unitario'] ?></strong></p>
                        <p class="cantidad"><strong>Cant: <?php echo $row['Cantidad_VENT'] ?></strong></p>
                    </div>
                    

            <?php } ?>
            
        </div>
        <div id="cartPagos" class="pagoTotal">

            <?php

                $traerId = $insLogin->ejecutarConsulta("SELECT ID_US FROM usuarios WHERE Correo_US = '$correo'");
                $resultId = $traerId->fetch();
                $ID_US = $resultId['ID_US'];

                $sql = $insLogin->ejecutarConsulta("SELECT SUM(Valor_Total) AS valorTotal FROM ventas WHERE ID_US = $ID_US AND Estado_VENT = 'Proceso'");
                $result = $sql->fetch();
                $valorTotal = $result['valorTotal'];
                
                
            ?>
            <h5 style="color: #804e23;"><strong>Subtotal</strong></h5>
            <h5 class="subTotal"><strong>$<?= $valorTotal ?></strong></h5>
            <a href="<?= APP_URL ?>userCarritoCompra/"><button class="irACarrito"><strong>Ir al carrito</strong></button></a>
        </div>
    </div>