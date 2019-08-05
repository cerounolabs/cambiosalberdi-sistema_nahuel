<?php
    include '../class/header.php';
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
                                EMPRESAS
                            </h1>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <a type="button" class="btn btn-gradient-primary btn-fw mr-2" style="float:right; margin-bottom: .75rem; background-color: rgba(172, 50, 228, 0.9); background-image: linear-gradient(to right, #da8cff, #9a55ff);" href="#" onclick="exportToExcel('exTable')"><i class="mdi mdi-file-excel "></i> Exportar a Excell </a>
                                        <a type="button" class="btn btn-gradient-primary btn-fw mr-2" style="float:right; margin-bottom: .75rem; background-color: rgba(172, 50, 228, 0.9); background-image: linear-gradient(to right, #da8cff, #9a55ff);" href="../pages/empresa_crud.php?var00=CB"> NUEVO </a>
                                        <table id="exTable" class="table table-striped" border="1">
                                            <thead>
                                                <tr valign="middle">
                                                    <th style="text-align:center;"> NRO </th>
                                                    <th style="text-align:center;"> C&Oacute;DIGO </th>
                                                    <th style="text-align:center;"> ESTADO</th> 
                                                    <th style="text-align:center;"> EMPRESA </th>
                                                    <th style="text-align:center;"> SITIO WEB </th>
                                                    <th style="text-align:center;" colspan='3'> ACCI&Oacute;N </th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
    $item   = 0;
    $result = getEmpresa();

    foreach($result as $data) {
        $item = $item + 1;
?>
                                                <tr>
                                                    <td style="text-align:left;">   <?php echo $item; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $data['empresa_codigo']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $data['estado_nombre']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $data['empresa_nombre']; ?> </td>
                                                    <td style="text-align:left;">   <a href="<?php echo strtolower($data['empresa_url']); ?>" target="_blank"> <?php echo $data['empresa_url']; ?> </a></td>
                                                    <td style="text-align:center;"> <a href="../pages/empresa_crud.php?var00=R&var01=<?php echo $data['empresa_codigo']; ?>"> <span class="mr-2 text-info"> VER </span></a></td>
                                                    <td style="text-align:center;"> <a href="../pages/empresa_crud.php?var00=UB&var01=<?php echo $data['empresa_codigo']; ?>"> <span class="mr-2 text-success"> EDITAR </span></a></td>
                                                    <td style="text-align:center;"> <a href="../pages/empresa_crud.php?var00=DB&var01=<?php echo $data['empresa_codigo']; ?>"> <span class="mr-2 text-danger"> ELIMINAR </span></a></td>
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