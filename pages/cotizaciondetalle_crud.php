<?php
    include '../class/header.php';

    $var00 = $_GET['var00'];
    $var01 = $_GET['var01'];

    if ($var00 == 'CA' || $var00 == 'UA' || $var00 == 'DA') {
        $var02  = 'A';
        $var03  = $_GET['var03'];
        $var04  = 1;
        $var05  = str_replace('T', ' ', $_GET['var05']);
        $var11  = $_GET['var11'];
        $var12  = $_GET['var12'];
        $var21  = $_GET['var21'];
        $var22  = $_GET['var22'];
        $var31  = $_GET['var31'];
        $var32  = $_GET['var32'];
        $var41  = $_GET['var41'];
        $var42  = $_GET['var42'];
        $var51  = $_GET['var51'];
        $var52  = $_GET['var52'];
        $var61  = $_GET['var61'];
        $var62  = $_GET['var62'];
        $var71  = $_GET['var71'];
        $var72  = $_GET['var72'];

        if ($var11 > 0 || $var12 > 0) {
            $data   = getCotizacionId2($var03, 2, 1);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var11, $var12, $var05);
        }
/*        
        if ($var21 > 0 || $var22 > 0) {
            $data   = getCotizacionId2($var03, 3, 1);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var21, $var22, $var05);
        }
*/
/*        
        if ($var31 > 0 || $var32 > 0) {
            $data   = getCotizacionId2($var03, 5, 1);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var31, $var32, $var05);
        }
*/
/*
        if ($var41 > 0 || $var42 > 0) {
            $data   = getCotizacionId2($var03, 4, 1);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var41, $var42, $var05);
        }
*/
        if ($var51 > 0 || $var52 > 0) {
            $data   = getCotizacionId2($var03, 2, 3);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var51, $var52, $var05);
        }

        if ($var61 > 0 || $var62 > 0) {
            $data   = getCotizacionId2($var03, 2, 5);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var61, $var62, $var05);
        }
/*
        if ($var71 > 0 || $var72 > 0) {
            $data   = getCotizacionId2($var03, 4, 2);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var71, $var72, $var05);
        }
*/
        $var02  = '';
        $var03  = '';
        $var04  = '';
        $var05  = '';
        $var11  = '';
        $var12  = '';
        $var21  = '';
        $var22  = '';
        $var31  = '';
        $var32  = '';
        $var41  = '';
        $var42  = '';
        $var51  = '';
        $var52  = '';
        $var61  = '';
        $var62  = '';
        $var71  = '';
        $var72  = '';
    }

    switch ($var00) {
        case 'CB':
            $var00      = 'CA';
            $readonly   = '';
            $btnAction  = 'Guardar';
            $btnReadonly= '';
            break;

        case 'CA':
            $readonly   = '';
            $btnAction  = 'Guardar';
            $btnReadonly= '';
            break;

        case 'R':
            $readonly   = 'readonly';
            $btnAction  = '';
            $btnReadonly= 'disabled';
            break;

        case 'UB':
            $var00      = 'UA';
            $readonly   = '';
            $btnAction  = 'Modificar';
            $btnReadonly= '';
            break;

        case 'UA':
            $readonly   = '';
            $btnAction  = 'Modificar';
            $btnReadonly= '';
            break;

        case 'DB':
            $var00      = 'DA';
            $readonly   = 'readonly';
            $btnAction  = 'Eliminar';
            $btnReadonly= '';
            break;

        case 'DA':
            $readonly   = 'readonly';
            $btnAction  = 'Eliminar';
            $btnReadonly= '';
            break;
        
        default:
            $readonly   = '';
            $btnAction  = '';
            $btnReadonly= 'disabled';
            break;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
<?php
  include '../incl/head.php';
?>

    </head>
    <body>
        <div class="container-scroller">
<?php
    include '../incl/menu.php';
?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
                            <h1 class="page-title" style="font-size:2.19rem !important;">
                                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                    <i class="mdi mdi-home"></i>                 
                                </span>
                                COTIZACI&Oacute;N DETALLE MANTENIMIENTO
                            </h1>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="forms-sample" method="get">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label class="col-12" for="var01"> C&Oacute;DIGO </label>
                                                        <div class="col-12">
                                                            <input type="text" class="form-control" style="text-transform:uppercase;" id="var01" name="var01" value="<?php echo $var01; ?>" placeholder="C&Oacute;DIGO" required readonly>
                                                            <input type="hidden" class="form-control" style="text-transform:uppercase;" id="var00" name="var00" value="<?php echo $var00; ?>" placeholder="CRUD" required readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label class="col-12" for="var03"> EMPRESA - SUCURSAL - CIUDAD</label>
                                                        <div class="col-12">
                                                            <select class="form-control" id="var03" name="var03" required <?php echo $readonly; ?>>
<?php
    $result = getSucursal();

    foreach($result as $data) {
        if ($data['estado_codigo'] == 'A') {
?>
                                                                <option value="<?php echo $data['sucursal_codigo']; ?>"> <?php echo $data['empresa_nombre'].' - '.$data['sucursal_nombre'].' - '.$data['ciudad_nombre']; ?> </option>
<?php
        }
    }
?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label class="col-12" for="var07"> FECHA HORA PIZARRA</label>
                                                        <div class="col-12">
                                                            <input type="datetime-local" class="form-control" style="text-transform:uppercase;" id="var05" name="var05" value="<?php echo $var05; ?>" placeholder="FECHA HORA PIZARRA" required <?php echo $readonly; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
<!--
                                            <div class="row">
                                                <div class="col-3">
                                                    <p class="card-description" style="color:#fe7c96;">
                                                        EUR => USD
                                                    </p>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var05"> COMPRA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var71" name="var71" value="<?php echo $var71; ?>" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var06"> VENTA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var72" name="var72" value="<?php echo $var72; ?>" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-3">
                                                    <p class="card-description" style="color:#fe7c96;">
                                                        BRL => PYG
                                                    </p>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var05"> COMPRA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var21" name="var21" value="<?php echo $var21; ?>" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var06"> VENTA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var22" name="var22" value="<?php echo $var22; ?>" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <p class="card-description" style="color:#fe7c96;">
                                                        ARS => PYG
                                                    </p>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var05"> COMPRA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var31" name="var31" value="<?php echo $var31; ?>" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var06"> VENTA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var32" name="var32" value="<?php echo $var32; ?>" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <p class="card-description" style="color:#fe7c96;">
                                                        EUR => PYG
                                                    </p>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var05"> COMPRA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var41" name="var41" value="<?php echo $var41; ?>" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var06"> VENTA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var42" name="var42" value="<?php echo $var42; ?>" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
-->
                                            <div class="row">
                                                <div class="col-3">
                                                    <p class="card-description" style="color:#fe7c96;">
                                                        USD => BRL
                                                    </p>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var05"> COMPRA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var51" name="var51" value="<?php echo $var51; ?>" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var06"> VENTA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var52" name="var52" value="<?php echo $var52; ?>" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-3">
                                                    <p class="card-description" style="color:#fe7c96;">
                                                        USD => ARS
                                                    </p>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var05"> COMPRA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var61" name="var61" value="<?php echo $var61; ?>" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var06"> VENTA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var62" name="var62" value="<?php echo $var62; ?>" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <p class="card-description" style="color:#fe7c96;">
                                                        USD => PYG
                                                    </p>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var05"> COMPRA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var11" name="var11" value="<?php echo $var11; ?>" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col-12" for="var06"> VENTA </label>
                                                            <div class="col-12">
                                                                <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var12" name="var12" value="<?php echo $var12; ?>" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <a type="button" class="btn btn-light" style="float:right; " href="../pages/cotizacion.php"> Volver </a>
                                            <button type="submit" class="btn btn-gradient-primary mr-2" style="float:right;" <?php echo $btnReadonly; ?>><?php echo $btnAction; ?></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php  include '../incl/footer.php'; ?>
    </body>
</html>