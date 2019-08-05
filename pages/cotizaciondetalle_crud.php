<?php
    include '../class/header.php';

    $var00 = $_GET['var00'];
    $var01 = $_GET['var01'];

    if ($var00 == 'CA' || $var00 == 'UA' || $var00 == 'DA') {
        $var02  = 'A';
        $var03  = $_GET['var03'];
        $var04  = 1;
        $var05  = $_GET['var05'];
        $var06  = $_GET['var06'];
        $var07  = str_replace('T', ' ', $_GET['var07']);

        $var01  = setCotizacionDetalle($var00, $var01, $var02, $var03, $var04, $var05, $var06, $var07);
        $var02  = '';
        $var03  = '';
        $var04  = '';
        $var05  = '';
        $var06  = '';
        $var07  = '';
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
                                                        <label class="col-12" for="var03"> EMPRESA - SUCURSAL - CIUDAD (MONEDA BASE == MONEDA RELACIONADA)</label>
                                                        <div class="col-12">
                                                            <select class="form-control" id="var03" name="var03" required <?php echo $readonly; ?>>
<?php
    $result = getCotizacion();

    foreach($result as $data) {
        if ($data['estado_codigo'] == 'A') {
?>
                                                                <option value="<?php echo $data['cotizacion_codigo']; ?>"> <?php echo $data['empresa_nombre'].' - '.$data['sucursal_nombre'].' - '.$data['ciudad_nombre'].' ('.$data['moneda_base_bcp'].' == '.$data['moneda_relacionada_bcp'].')'; ?> </option>
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
                                                        <label class="col-12" for="var05"> COMPRA </label>
                                                        <div class="col-12">
                                                            <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var05" name="var05" value="<?php echo $var05; ?>" placeholder="COMPRA" required <?php echo $readonly; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label class="col-12" for="var06"> VENTA </label>
                                                        <div class="col-12">
                                                            <input type="number" step="any" class="form-control" style="text-transform:uppercase;" id="var06" name="var06" value="<?php echo $var06; ?>" placeholder="VENTA" required <?php echo $readonly; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label class="col-12" for="var07"> FECHA HORA PIZARRA</label>
                                                        <div class="col-12">
                                                            <input type="datetime-local" class="form-control" style="text-transform:uppercase;" id="var07" name="var07" value="<?php echo $var07; ?>" placeholder="FECHA HORA PIZARRA" required <?php echo $readonly; ?>>
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