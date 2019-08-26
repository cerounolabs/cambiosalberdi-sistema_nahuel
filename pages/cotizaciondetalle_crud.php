<?php
    session_start();
    
    include '../class/header.php';

    $var00 = $_GET['var00'];
    $var01 = $_GET['var01'];
    $var03 = $_GET['var03'];
    $var06 = $_GET['var06'];
    $var11 = 0;
    $var12 = 0;
    $var21 = 0;
    $var22 = 0;
    $var31 = 0;
    $var32 = 0;
    $var41 = 0;
    $var42 = 0;
    $var51 = 0;
    $var52 = 0;
    $var61 = 0;
    $var62 = 0;
    $var71 = 0;
    $var72 = 0;
    $sysUse= $_SESSION['Sys02'];

    if ($var00 == 'CA' || $var00 == 'UA' || $var00 == 'DA') {
        $var02  = 'A';
        $var03  = $_GET['var03'];
        $var04  = 1;
        $var05  = date("Y-m-d H:i");
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

//        if ($var11 > 0 || $var12 > 0) {
            $data   = getCotizacionId2($var03, 2, 1);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var11, $var12, $var05, $sysUse);
//        }
        
//        if ($var21 > 0 || $var22 > 0) {
            $data   = getCotizacionId2($var03, 3, 1);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var21, $var22, $var05, $sysUse);
//        }
        
//        if ($var31 > 0 || $var32 > 0) {
            $data   = getCotizacionId2($var03, 5, 1);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var31, $var32, $var05, $sysUse);
//        }

//        if ($var41 > 0 || $var42 > 0) {
            $data   = getCotizacionId2($var03, 4, 1);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var41, $var42, $var05, $sysUse);
//        }

//        if ($var51 > 0 || $var52 > 0) {
            $data   = getCotizacionId2($var03, 2, 3);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var51, $var52, $var05, $sysUse);
//        }

//        if ($var61 > 0 || $var62 > 0) {
            $data   = getCotizacionId2($var03, 2, 5);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var61, $var62, $var05, $sysUse);
//        }

//        if ($var71 > 0 || $var72 > 0) {
            $data   = getCotizacionId2($var03, 4, 2);
            $var01  = setCotizacionDetalle($var00, $var01, $var02, $data[0]['cotizacion_codigo'], $var04, $var71, $var72, $var05, $sysUse);
//        }
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

    $result = getPizarra3($var03);
    foreach($result as $data) {
        $var11 = number_format($data['cotizacion_detalle_compra_usd_pyg'], 0, '.', '');
        $var12 = number_format($data['cotizacion_detalle_venta_usd_pyg'], 0, '.', '');

        $var21 = number_format($data['cotizacion_detalle_compra_brl_pyg'], 0, '.', '');
        $var22 = number_format($data['cotizacion_detalle_venta_brl_pyg'], 0, '.', '');

        $var31 = number_format($data['cotizacion_detalle_compra_ars_pyg'], 0, '.', '');
        $var32 = number_format($data['cotizacion_detalle_venta_ars_pyg'], 0, '.', '');

        $var41 = number_format($data['cotizacion_detalle_compra_eur_pyg'], 0, '.', '');
        $var42 = number_format($data['cotizacion_detalle_venta_eur_pyg'], 0, '.', '');

        $var51 = number_format($data['cotizacion_detalle_compra_usd_brl'], 3, '.', '');
        $var52 = number_format($data['cotizacion_detalle_venta_usd_brl'], 3, '.', '');

        $var61 = number_format($data['cotizacion_detalle_compra_usd_ars'], 3, '.', '');
        $var62 = number_format($data['cotizacion_detalle_venta_usd_ars'], 3, '.', '');

        $var71 = number_format($data['cotizacion_detalle_compra_eur_usd'], 3, '.', '');
        $var72 = number_format($data['cotizacion_detalle_venta_eur_usd'], 3, '.', '');
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
                                                        <label class="col-12" for="var06"> CIUDAD</label>
                                                        <div class="col-12">
                                                            <select class="form-control" id="var06" name="var06" onchange="reload()" required <?php echo $readonly; ?>>
<?php
    $result = getCiudad();

    foreach($result as $data) {
        if ($data['estado_codigo'] == 'A') {
            if ($data['ciudad_codigo'] == $var06) {
                $selCiu = 'selected';
            } else {
                $selCiu = '';
            }
?>
                                                                <option value="<?php echo $data['ciudad_codigo']; ?>" <?php echo $selCiu; ?>> <?php echo $data['ciudad_nombre']; ?> </option>
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
                                                        <label class="col-12" for="var03"> EMPRESA - SUCURSAL</label>
                                                        <div class="col-12">
                                                            <select class="form-control" id="var03" name="var03" onchange="reload()" required <?php echo $readonly; ?>>
<?php
    $result = getSucursal();

    foreach($result as $data) {
        if ($data['estado_codigo'] == 'A' && $data['ciudad_codigo'] == $var06) {
            if ($data['sucursal_codigo'] == $var03) {
                $selSuc = 'selected';
            } else {
                $selSuc = '';
            }
?>
                                                                <option value="<?php echo $data['sucursal_codigo']; ?>" <?php echo $selSuc; ?>> <?php echo $data['empresa_nombre'].' - '.$data['sucursal_nombre']; ?> </option>
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
                                                        <div class="col-sm-12 col-md-4">
                                                            <label class="col-12 col-form-label"> DOLAR </label>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var11" name="var11" value="<?php echo $var11; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var12" name="var12" value="<?php echo $var12; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-md-4">
                                                            <label class="col-12 col-form-label"> REAL </label>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var21" name="var21" value="<?php echo $var21; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var22" name="var22" value="<?php echo $var22; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-md-4">
                                                        <label class="col-12 col-form-label"> PESO ARGENTINO </label>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var31" name="var31" value="<?php echo $var31; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var32" name="var32" value="<?php echo $var32; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-md-4">
                                                            <label class="col-12 col-form-label"> EURO </label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var41" name="var41" value="<?php echo $var41; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var42" name="var42" value="<?php echo $var42; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-md-4">
                                                            <label class="col-12 col-form-label"> DOLAR vs REAL </label>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var51" name="var51" value="<?php echo $var51; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var52" name="var52" value="<?php echo $var52; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-md-4"> 
                                                            <label class="col-12 col-form-label"> DOLAR vs PESO ARGENTINO</label>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var61" name="var61" value="<?php echo $var61; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var62" name="var62" value="<?php echo $var62; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-md-4">
                                                            <label class="col-12 col-form-label"> DOLAR vs EURO </label>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var71" name="var71" value="<?php echo $var71; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input type="number" step="any" class="form-control" id="var72" name="var72" value="<?php echo $var72; ?>" style="text-transform:uppercase; font-weight:bold;" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <a type="button" class="btn btn-light" style="float:right; " href="../pages/cotizacion.php"> Volver </a>
                                            <button type="submit" class="btn btn-gradient-primary mr-2" style="float:right;">Guardar</button>
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
        <script>
            function reload(){
                var var03 = document.getElementById("var03").value;
                var var06 = document.getElementById("var06").value;
                location="http://10.168.196.152/sistema_nahuel/pages/cotizaciondetalle_crud.php?var00=CB&var03="+var03+"&var06="+var06;
            }
        </script>
    </body>
</html>