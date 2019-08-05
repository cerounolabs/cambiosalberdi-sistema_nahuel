<?php
    include '../class/header.php';

    $var01 = $_GET['var01'];
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
                                COTIZACIONES DETALLE
                            </h1>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <a type="button" class="btn btn-gradient-primary btn-fw mr-2" style="float:right; margin-bottom: .75rem; background-color: rgba(172, 50, 228, 0.9); background-image: linear-gradient(to right, #da8cff, #9a55ff);" href="#" onclick="exportToExcel('exTable')"><i class="mdi mdi-file-excel "></i> Exportar a Excell </a>
                                        <a type="button" class="btn btn-gradient-primary btn-fw mr-2" style="float:right; margin-bottom: .75rem; background-color: rgba(172, 50, 228, 0.9); background-image: linear-gradient(to right, #da8cff, #9a55ff);" href="../pages/cotizacion.php"> VOLVER </a>
                                        <table id="exTable" class="table table-striped" border="1">
                                            <thead>
                                                <tr valign="middle">
                                                    <th style="text-align:center;"> NRO </th>
                                                    <th style="text-align:center;"> C&Oacute;DIGO </th>
                                                    <th style="text-align:center;"> ESTADO</th>
                                                    <th style="text-align:center;"> TIPO </th>
                                                    <th style="text-align:center;"> MONEDA </th>
                                                    <th style="text-align:center;"> COMPRA </th>
                                                    <th style="text-align:center;"> VENTA </th>
                                                    <th style="text-align:center;"> FECHA HORA PIZARRA </th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
    $item   = 0;
    $result = getCotizacionDetalleId($var01);

    foreach($result as $data) {
        $item = $item + 1;
?>
                                                <tr>
                                                    <td style="text-align:left;">   <?php echo $item; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $data['cotizacion_detalle_codigo']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $data['estado_nombre']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $data['cotizacion_tipo_nombre']; ?> </td>
                                                    <td style="text-align:center;">   <?php echo $data['moneda_base_bcp']. ' == '.$data['moneda_relacionada_bcp']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $data['cotizacion_detalle_compra']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $data['cotizacion_detalle_venta']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $data['cotizacion_detalle_fecha_pizarra']; ?> </td>
                                                </tr>
<?php

    }
?>
                                            </tbody>
                                        </table>
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
            function exportToExcel(tableID){
                var tab_text    ="<table border='2px'><tr bgcolor='#87AFC6' style='height: 75px; text-align: center; width: 250px'>";
                var textRange   = 0; 
                var j           = 0;
                tab             = document.getElementById(tableID);

                for(j = 0 ; j < tab.rows.length ; j++) {
                    tab_text = tab_text;
                    tab_text = tab_text+tab.rows[j].innerHTML.toUpperCase() + "</tr>";
                }

                tab_text    = tab_text + "</table>";
                tab_text    = tab_text.replace(/<A[^>]*>|<\/A>/g, "");
                tab_text    = tab_text.replace(/<img[^>]*>/gi,"");
                tab_text    = tab_text.replace(/<input[^>]*>|<\/input>/gi, "");
                
                var ua      = window.navigator.userAgent;
                var msie    = ua.indexOf("MSIE ");
                
                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
                    txtArea1.document.open("txt/html","replace");
                    txtArea1.document.write('sep=,\r\n' + tab_text);
                    txtArea1.document.close();
                    txtArea1.focus();
                    sa = txtArea1.document.execCommand("SaveAs",true,"sudhir123.txt");
                }
                else {
                    sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
                }
                
                return (sa);
            }
        </script>
    </body>
</html>