<?php 
    include("../../model/Conexion.php");

    session_start();

    if (empty($_SESSION['correo'])) {
        header("location: ../registro/inicio.php");
        session_destroy();
        die();
    }
    $conexion = new Conexion();
    $conn = $conexion->getConexion();

    $creditosPorPagina = 4;
    $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $creditosPorPagina;

    $totalCreditosQuery = "SELECT COUNT(*) as total FROM credito";
    $totalResult = mysqli_query($conn, $totalCreditosQuery);
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalPaginas = ceil($totalRow['total'] / $creditosPorPagina);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creditos</title>
    <?php require_once '../inc/headAdmin.php' ?>
    <link rel="stylesheet" href="../../../public/css/Administrador/AdministradorCreditos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../../public/js/alerts.js"></script>
</head>
<body>

    <?php require_once '../inc/headerAdmin.php' ?>

    <section>
        <div class="contenedorprincipal">
            

            <?php require_once '../inc/MenuLateral.php' ?>

            <div class="apartadoCreditos">
                    <div id="tittleDashboard">

                        <h1><strong>Creditos</strong></h1>

                    </div>

                <div id="tablaCreditos">

                    <!--modal de agregar creditos -->

                    <table id="Cred">
                    <thead>
                            <tr>
                                <th>CODIGO</th>
                                <th>ID_USUARIO</th>
                                <th>NOMBRE</th>
                                <th>CORREO</th>
                                <th>TELEFONO</th>
                                <th>DIRECCION</th>
                                <th>ESTADO</th>
                                <th>FECHA</th>
                                <th>VALOR</th>
                                <th>ACEPTAR</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <Tbody>
                            <?php 
                                $query ="SELECT c.ID_CR, u.ID_US, u.Nombre_US, c.Correo_CR, c.Telefono_CR,
                                        c.Direccion_CR, c.Estado_CR, c.Fecha_CR, c.Valor_CR
                                        FROM credito c, usuarios u WHERE c.ID_US = u.ID_US LIMIT $creditosPorPagina OFFSET $offset";  
                                $resul_tareas = mysqli_query($conn, $query);

                                while($row = mysqli_fetch_array($resul_tareas)){
                            ?>

                            <tr>
                                
                                <td><?php echo $row['ID_CR']?></td>
                                <td><?php echo $row['ID_US']?></td>
                                <td><?php echo $row['Nombre_US']?></td>
                                <td><?php echo $row['Correo_CR']?></td>
                                <td><?php echo $row['Telefono_CR']?></td>
                                <td><?php echo $row['Direccion_CR']?></td>
                                <td><?php echo $row['Estado_CR']?></td>
                                <td><?php echo $row['Fecha_CR']?></td>
                                <td><?php echo $row['Valor_CR']?></td>

                                <td>

                                    <div id="aceptarCr" data-bs-toggle="modal" data-bs-target="#Aceptar_credito<?php echo $row['ID_CR']?>"><img src="../../../public/img/Administrador/AceptarCreditos.png" alt="" class="btnedit" id="aceptarImg"></div>

                                </td>

                                <td>

                                    <div id="editarCr" data-bs-toggle="modal" data-bs-target="#editar_credito<?php echo $row['ID_CR']?>"><img src="../../../public/img/Administrador/Editar.png" alt="" class="btnedit" id="editarImg"></div>
        
                                </td>

                                <td>
        
                                    <div id="deleteCr" data-bs-toggle="modal" data-bs-target="#delete_creditos<?php echo $row['ID_CR']?>"><img src="../../../public/img/Administrador/Eliminar.png" alt="" id="deleteImg"  ></div>
                                </td>
                            </tr>

                        <?php include("../../model/Modals/modal_aceptar_creditos.php");
                                include("../../model/Modals/modal_delete_creditos.php");
                                include("../../model/Modals/modal_edit_creditos.php");
                            }?>
                        </Tbody>
                        <?php 
                            if(isset($_SESSION["msg"])){
                                $msg = $_SESSION["msg"];
                                if($msg){
                                    echo("<script> $msg </script>");

                                    unset($_SESSION["msg"]);
                                }

                            }
                        ?>
                        
                    </table>
                    
                    <div class="paginacion">

                                <?php if ($paginaActual > 1): ?>
                                    <a href="?pagina=<?php echo $paginaActual - 1; ?>">
                                        <img src="../../../public/img/Administrador/FlechaIzquierda.png" class="Flechas" alt="Anterior">
                                    </a>

                                    <?php else: ?>
                                        <img src="../../../public/img/Administrador/FlechaIzquierda.png" class="Flechas" alt="Anterior" style="opacity: 0.5; cursor: default;">
                                    <?php endif; ?>
                                    
                                    <?php if ($paginaActual < $totalPaginas): ?>
                                        <a href="?pagina=<?php echo $paginaActual + 1; ?>">
                                            <img src="../../../public/img/Administrador/FlechaDerecha.png" class="Flechas" alt="Siguiente">
                                        </a>
                                    
                                    <?php else: ?>
                                        <img src="../../../public/img/Administrador/FlechaDerecha.png" class="Flechas" alt="Siguiente" style="opacity: 0.5; cursor: default;">
                                    <?php endif; ?>
                            </div>
                </div>
            </div>
        </div>
    </section>

        
    <?php include '../../view/inc/footer.php' ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> -->
