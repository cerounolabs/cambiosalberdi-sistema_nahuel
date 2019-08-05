<?php
    include '../class/header.php';

    $var00 = $_GET['var00'];
    $var01 = $_GET['var01'];

    if ($var00 == 'CA' || $var00 == 'UA' || $var00 == 'DA') {
        $var02  = strtoupper($_GET['var02']);
        $var03  = $_GET['var03'];
        $var04  = $_GET['var04'];
        $var05  = strtoupper($_GET['var05']);

        $var01  = setSucursal($var00, $var01, $var02, $var03, $var04, $var05);
        $var02  = '';
        $var03  = '';
        $var04  = '';
        $var05  = '';
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

    if ($var01 > 0){
        $result = getSucursalId($var01);

        foreach($result as $data) {
            $var02  = $data['estado_codigo'];
            $var03  = $data['empresa_codigo'];
            $var04  = $data['ciudad_codigo'];
            $var05  = $data['sucursal_nombre'];

            if ($var02 == 'A'){
                $selActivo  = 'selected';
                $selInactivo= '';
            } else {
                $selActivo  = '';
                $selInactivo= 'selected';
            }
        }
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
                                SUCURSAL MANTENIMIENTO
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
                                                        <label class="col-12" for="var02"> ESTADO </label>
                                                        <div class="col-12">
                                                            <select class="form-control" id="var02" name="var02" required <?php echo $readonly; ?>>
                                                                <option value="A" <?php echo $selActivo; ?>>ACTIVO</option>
                                                                <option value="I" <?php echo $selInactivo; ?>>INACTIVO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label class="col-12" for="var03"> EMPRESA </label>
                                                        <div class="col-12">
                                                            <select class="form-control" id="var03" name="var03" required <?php echo $readonly; ?>>
<?php
    $result = getEmpresa();

    foreach($result as $data) {
        if ($data['estado_codigo'] == 'A') {
            if ($data['empresa_codigo'] == $var03) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
?>
                                                                <option value="<?php echo $data['empresa_codigo']; ?>" <?php echo $selected; ?>> <?php echo $data['empresa_nombre']; ?> </option>
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
                                                        <label class="col-12" for="var04"> CIUDAD </label>
                                                        <div class="col-12">
                                                            <select class="form-control" id="var04" name="var04" required <?php echo $readonly; ?>>
<?php
    $result = getCiudad();

    foreach($result as $data) {
        if ($data['estado_codigo'] == 'A') {
            if ($data['ciudad_codigo'] == $var04) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
?>
                                                                <option value="<?php echo $data['ciudad_codigo']; ?>" <?php echo $selected; ?>> <?php echo $data['ciudad_nombre']; ?> </option>
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
                                                        <label class="col-12" for="var05"> SUCURSAL </label>
                                                        <div class="col-12">
                                                            <input type="text" class="form-control" style="text-transform:uppercase;" id="var05" name="var05" value="<?php echo $var05; ?>" placeholder="SUCURSAL" required <?php echo $readonly; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <a type="button" class="btn btn-light" style="float:right; " href="../pages/sucursal.php"> Volver </a>
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