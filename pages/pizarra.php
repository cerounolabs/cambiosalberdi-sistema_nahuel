<?php
    include '../class/function.php';

    $var00 = $_GET['var00'];
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
    include '../incl/pizarra.php';
?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">                        
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <a type="button" class="btn btn-gradient-primary btn-fw mr-2" style="float:right; margin-bottom: .75rem; background-color: rgba(172, 50, 228, 0.9); background-image: linear-gradient(to right, #da8cff, #9a55ff);" href="#" onclick="exportToExcel('exTable')"><i class="mdi mdi-file-excel "></i> Exportar a Excell </a>
                                        <table id="exTable" class="table table-striped" border="1">
                                            <thead>
                                                <tr valign="middle">
                                                    <th style="text-align:center; font-size:1.25em;" colspan="2"> USD / PYG </th>
                                                    <th style="text-align:center; font-size:1.25em;" colspan="2"> BRL / PYG </th>
                                                    <th style="text-align:center; font-size:1.25em;" colspan="2"> ARS / PYG </th>
                                                    <th style="text-align:center; font-size:1.25em;" colspan="2"> EUR / PYG </th>
                                                    <th style="text-align:center; font-size:1.25em;" colspan="2"> USD / BRL </th>
                                                    <th style="text-align:center; font-size:1.25em;" colspan="2"> USD / ARS </th>
                                                </tr>
                                                <tr valign="middle">
                                                    <th style="text-align:center; font-size:1.25em;"> COMPRA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> VENTA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> COMPRA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> VENTA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> COMPRA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> VENTA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> COMPRA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> VENTA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> COMPRA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> VENTA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> COMPRA </th>
                                                    <th style="text-align:center; font-size:1.25em;"> VENTA </th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
    $item   = 0;
    $result = getPizarra($var00);

    foreach($result as $data) {
?>
                                                <tr>
                                                    <td style="text-align:center; font-size:1.5em;" colspan="14">   <?php echo $data['empresa_nombre'].' - '.$data['sucursal_nombre'].' - '.$data['ciudad_nombre']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_compra_usd_pyg'], 2, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_venta_usd_pyg'], 2, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_compra_brl_pyg'], 2, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_venta_brl_pyg'], 2, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_compra_ars_pyg'], 2, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_venta_ars_pyg'], 2, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_compra_eur_pyg'], 2, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_venta_eur_pyg'], 2, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_compra_usd_brl'], 2, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_venta_usd_brl'], 3, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_compra_usd_ars'], 3, ',', '.'); ?> </td>
                                                    <td style="text-align:right; font-size:1.90em;">   <?php echo number_format($data['cotizacion_detalle_venta_usd_ars'], 3, ',', '.'); ?> </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:center; font-size:1.25em;" colspan="2">   <?php echo $data['cotizacion_detalle_fecha_pizarra_usd_pyg']; ?> </td>
                                                    <td style="text-align:center; font-size:1.25em;" colspan="2">   <?php echo $data['cotizacion_detalle_fecha_pizarra_brl_pyg']; ?> </td>
                                                    <td style="text-align:center; font-size:1.25em;" colspan="2">   <?php echo $data['cotizacion_detalle_fecha_pizarra_ars_pyg']; ?> </td>
                                                    <td style="text-align:center; font-size:1.25em;" colspan="2">   <?php echo $data['cotizacion_detalle_fecha_pizarra_eur_pyg']; ?> </td>
                                                    <td style="text-align:center; font-size:1.25em;" colspan="2">   <?php echo $data['cotizacion_detalle_fecha_pizarra_usd_brl']; ?> </td>
                                                    <td style="text-align:center; font-size:1.25em;" colspan="2">   <?php echo $data['cotizacion_detalle_fecha_pizarra_usd_ars']; ?> </td>
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