<?php
    function getRealIP() {
        if (isset($_SERVER["HTTP_CLIENT_IP"])){
            return $_SERVER["HTTP_CLIENT_IP"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
            return $_SERVER["HTTP_X_FORWARDED"];
        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_FORWARDED"])){
            return $_SERVER["HTTP_FORWARDED"];
        }else{
            return $_SERVER["REMOTE_ADDR"];
        }
    }

    function getConexion() {
        $host	        = "10.168.196.187";
        $user 	        = "tablero_admin";
        $pass 	        = "t4bl3r02019";
        $db 	        = "tablero";
        $mysqli         = new mysqli($host, $user, $pass, $db);
        $mysqli->set_charset("utf8");

        if ($mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        return $mysqli;
    }

    function setEmpresa($var00, $var01, $var02, $var03, $var04){
        $str_conn       = getConexion();

        switch ($var00) {
            case 'CA':
                $str_qry = "INSERT INTO EMPRESA(codEstado, nomEmpresa, urlEmpresa) VALUES ('".$var02."', '".$var03."', '".$var04."')";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se inserto el registro';
                } else {
                    $result = 'ERROR: No se inserto el registro';
                }
                break;
            
            case 'UA':
                $str_qry = "UPDATE EMPRESA SET codEstado = '".$var02."', nomEmpresa = '".$var03."', urlEmpresa = '".$var04."' WHERE codEmpresa = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se modifico el registro';
                } else {
                    $result = 'ERROR: No se modifico el registro';
                }
                break;

            case 'DA':
                $str_qry = "DELETE FROM EMPRESA WHERE codEmpresa = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = 0;
                    $result = 'CORRECTO: Se elimino el registro';
                } else {
                    $result = 'ERROR: No se elimino el registro';
                }
                break;
        }
        
        $str_conn->close();

        return $result;
    }

    function getEmpresa(){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        a.codEmpresa        AS      empresa_codigo,
        a.codEstado         AS      estado_codigo,
        a.nomEmpresa        AS      empresa_nombre,
        a.urlEmpresa        AS      empresa_url

        FROM EMPRESA a

        ORDER BY a.nomEmpresa";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "empresa_codigo"    => $row00['empresa_codigo'],
                    "estado_codigo"     => $row00['estado_codigo'],
                    "estado_nombre"     => $estado,
                    "empresa_nombre"    => $row00['empresa_nombre'],
                    "empresa_url"       => $row00['empresa_url']
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getEmpresaId($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        a.codEmpresa        AS      empresa_codigo,
        a.codEstado         AS      estado_codigo,
        a.nomEmpresa        AS      empresa_nombre,
        a.urlEmpresa        AS      empresa_url

        FROM EMPRESA a
        WHERE a.codEmpresa = '$var01'

        ORDER BY a.nomEmpresa";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "empresa_codigo"    => $row00['empresa_codigo'],
                    "estado_codigo"     => $row00['estado_codigo'],
                    "estado_nombre"     => $estado,
                    "empresa_nombre"    => $row00['empresa_nombre'],
                    "empresa_url"       => $row00['empresa_url']
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function setSucursal($var00, $var01, $var02, $var03, $var04, $var05){
        $str_conn       = getConexion();

        switch ($var00) {
            case 'CA':
                $fecAlt = date('Y-m-d');
                $horAlt = date('H:i:s');
                $str_qry= "INSERT INTO SUCURSAL(codEstado, codEmpresa, codCiudad, nomSucursal) VALUES ('".$var02."', '$var03', '$var04', '".$var05."')";

                if ($str_conn->query($str_qry) === TRUE) {
                    $codSuc = $str_conn->insert_id;
                    $str_qry= "INSERT INTO COTIZACION(codEstado, codSucursal, codMonedaBase, codMonedaRelacion) VALUES ('A', '$codSuc', '2', '1')";

                    if ($str_conn->query($str_qry) === TRUE) {
                        $codCot = $str_conn->insert_id;
                        $str_qry= "INSERT INTO COTIZACIONDETALLE(codEstado, codCotizacion, codCotizacionTipo, impCompra, impVenta, fecPizarra, fecAlta, horAlta) VALUES ('A', '$codCot', '1', '0', '0', '2019-01-01 00:00', '".$fecAlt."', '".$horAlt."', 'SISTEMA')";

                        if ($str_conn->query($str_qry) === TRUE) {

                        }
                    }

                    $str_qry= "INSERT INTO COTIZACION(codEstado, codSucursal, codMonedaBase, codMonedaRelacion) VALUES ('A', '$codSuc', '3', '1')";

                    if ($str_conn->query($str_qry) === TRUE) {
                        $codCot = $str_conn->insert_id;
                        $str_qry= "INSERT INTO COTIZACIONDETALLE(codEstado, codCotizacion, codCotizacionTipo, impCompra, impVenta, fecPizarra, fecAlta, horAlta) VALUES ('A', '$codCot', '1', '0', '0', '2019-01-01 00:00', '".$fecAlt."', '".$horAlt."', 'SISTEMA')";

                        if ($str_conn->query($str_qry) === TRUE) {

                        }
                    }

                    $str_qry= "INSERT INTO COTIZACION(codEstado, codSucursal, codMonedaBase, codMonedaRelacion) VALUES ('A', '$codSuc', '5', '1')";

                    if ($str_conn->query($str_qry) === TRUE) {
                        $codCot = $str_conn->insert_id;
                        $str_qry= "INSERT INTO COTIZACIONDETALLE(codEstado, codCotizacion, codCotizacionTipo, impCompra, impVenta, fecPizarra, fecAlta, horAlta) VALUES ('A', '$codCot', '1', '0', '0', '2019-01-01 00:00', '".$fecAlt."', '".$horAlt."', 'SISTEMA')";

                        if ($str_conn->query($str_qry) === TRUE) {

                        }
                    }

                    $str_qry= "INSERT INTO COTIZACION(codEstado, codSucursal, codMonedaBase, codMonedaRelacion) VALUES ('A', '$codSuc', '4', '1')";

                    if ($str_conn->query($str_qry) === TRUE) {
                        $codCot = $str_conn->insert_id;
                        $str_qry= "INSERT INTO COTIZACIONDETALLE(codEstado, codCotizacion, codCotizacionTipo, impCompra, impVenta, fecPizarra, fecAlta, horAlta) VALUES ('A', '$codCot', '1', '0', '0', '2019-01-01 00:00', '".$fecAlt."', '".$horAlt."', 'SISTEMA')";

                        if ($str_conn->query($str_qry) === TRUE) {

                        }
                    }

                    $str_qry= "INSERT INTO COTIZACION(codEstado, codSucursal, codMonedaBase, codMonedaRelacion) VALUES ('A', '$codSuc', '2', '3')";

                    if ($str_conn->query($str_qry) === TRUE) {
                        $codCot = $str_conn->insert_id;
                        $str_qry= "INSERT INTO COTIZACIONDETALLE(codEstado, codCotizacion, codCotizacionTipo, impCompra, impVenta, fecPizarra, fecAlta, horAlta) VALUES ('A', '$codCot', '1', '0', '0', '2019-01-01 00:00', '".$fecAlt."', '".$horAlt."', 'SISTEMA')";

                        if ($str_conn->query($str_qry) === TRUE) {

                        }
                    }

                    $str_qry= "INSERT INTO COTIZACION(codEstado, codSucursal, codMonedaBase, codMonedaRelacion) VALUES ('A', '$codSuc', '2', '5')";

                    if ($str_conn->query($str_qry) === TRUE) {
                        $codCot = $str_conn->insert_id;
                        $str_qry= "INSERT INTO COTIZACIONDETALLE(codEstado, codCotizacion, codCotizacionTipo, impCompra, impVenta, fecPizarra, fecAlta, horAlta) VALUES ('A', '$codCot', '1', '0', '0', '2019-01-01 00:00', '".$fecAlt."', '".$horAlt."', 'SISTEMA')";

                        if ($str_conn->query($str_qry) === TRUE) {

                        }
                    }

                    $str_qry= "INSERT INTO COTIZACION(codEstado, codSucursal, codMonedaBase, codMonedaRelacion) VALUES ('A', '$codSuc', '4', '2')";

                    if ($str_conn->query($str_qry) === TRUE) {
                        $codCot = $str_conn->insert_id;
                        $str_qry= "INSERT INTO COTIZACIONDETALLE(codEstado, codCotizacion, codCotizacionTipo, impCompra, impVenta, fecPizarra, fecAlta, horAlta) VALUES ('A', '$codCot', '1', '0', '0', '2019-01-01 00:00', '".$fecAlt."', '".$horAlt."', 'SISTEMA')";

                        if ($str_conn->query($str_qry) === TRUE) {

                        }
                    }

                    $result = 'Se inserto el registro de forma correcta';
                }
                break;
            
            case 'UA':
                $str_qry = "UPDATE SUCURSAL SET codEstado = '".$var02."', codEmpresa = '$var03', codCiudad = '$var04', nomSucursal = '".$var05."' WHERE codSucursal = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se modifico el registro';
                } else {
                    $result = 'ERROR: No se modifico el registro';
                }
                break;

            case 'DA':
                $str_qry = "DELETE FROM SUCURSAL WHERE codSucursal = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = 0;
                    $result = 'CORRECTO: Se elimino el registro';
                } else {
                    $result = 'ERROR: No se elimino el registro';
                }
                break;
        }
        
        $str_conn->close();

        return $result;
    }

    function getSucursal(){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        c.codCiudad         AS      ciudad_codigo,
        c.nomCiudad         AS      ciudad_nombre,
        b.codEmpresa        AS      empresa_codigo,
        b.nomEmpresa        AS      empresa_nombre,
        b.urlEmpresa        AS      empresa_url,
        a.codEstado         AS      estado_codigo,
        a.codSucursal       AS      sucursal_codigo,
        a.nomSucursal       AS      sucursal_nombre

        FROM SUCURSAL a
        INNER JOIN EMPRESA b ON a.codEmpresa = b.codEmpresa
        INNER JOIN CIUDAD c ON a.codCiudad = c.codCiudad

        ORDER BY b.nomEmpresa, c.nomCiudad, a.nomSucursal";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "ciudad_codigo"     => $row00['ciudad_codigo'],
                    "ciudad_nombre"     => $row00['ciudad_nombre'],
                    "empresa_codigo"    => $row00['empresa_codigo'],
                    "empresa_nombre"    => $row00['empresa_nombre'],
                    "empresa_url"       => $row00['empresa_url'],
                    "estado_codigo"     => $row00['estado_codigo'],
                    "estado_nombre"     => $estado,
                    "sucursal_codigo"   => $row00['sucursal_codigo'],
                    "sucursal_nombre"   => $row00['sucursal_nombre']
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getSucursalId($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        c.codCiudad         AS      ciudad_codigo,
        c.nomCiudad         AS      ciudad_nombre,
        b.codEmpresa        AS      empresa_codigo,
        b.nomEmpresa        AS      empresa_nombre,
        b.urlEmpresa        AS      empresa_url,
        a.codEstado         AS      estado_codigo,
        a.codSucursal       AS      sucursal_codigo,
        a.nomSucursal       AS      sucursal_nombre

        FROM SUCURSAL a
        INNER JOIN EMPRESA b ON a.codEmpresa = b.codEmpresa
        INNER JOIN CIUDAD c ON a.codCiudad = c.codCiudad
        WHERE a.codSucursal = '$var01'

        ORDER BY b.nomEmpresa, c.nomCiudad, a.nomSucursal";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "ciudad_codigo"     => $row00['ciudad_codigo'],
                    "ciudad_nombre"     => $row00['ciudad_nombre'],
                    "empresa_codigo"    => $row00['empresa_codigo'],
                    "empresa_nombre"    => $row00['empresa_nombre'],
                    "empresa_url"       => $row00['empresa_url'],
                    "estado_codigo"     => $row00['estado_codigo'],
                    "estado_nombre"     => $estado,
                    "sucursal_codigo"   => $row00['sucursal_codigo'],
                    "sucursal_nombre"   => $row00['sucursal_nombre']
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function setCiudad($var00, $var01, $var02, $var03){
        $str_conn       = getConexion();

        switch ($var00) {
            case 'CA':
                $str_qry = "INSERT INTO CIUDAD(codEstado, nomCiudad) VALUES ('".$var02."', '".$var03."')";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se inserto el registro';
                } else {
                    $result = 'ERROR: No se inserto el registro';
                }
                break;
            
            case 'UA':
                $str_qry = "UPDATE CIUDAD SET codEstado = '".$var02."', nomCiudad = '".$var03."' WHERE codCiudad = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se modifico el registro';
                } else {
                    $result = 'ERROR: No se modifico el registro';
                }
                break;

            case 'DA':
                $str_qry = "DELETE FROM CIUDAD WHERE codCiudad = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = 0;
                    $result = 'CORRECTO: Se elimino el registro';
                } else {
                    $result = 'ERROR: No se elimino el registro';
                }
                break;
        }
        
        $str_conn->close();

        return $result;
    }

    function getCiudad(){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        a.codEstado         AS      estado_codigo,
        a.codCiudad         AS      ciudad_codigo,
        a.nomCiudad         AS      ciudad_nombre

        FROM CIUDAD a

        ORDER BY a.nomCiudad";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "ciudad_codigo"     => $row00['ciudad_codigo'],
                    "ciudad_nombre"     => $row00['ciudad_nombre'],
                    "estado_codigo"     => $row00['estado_codigo'],
                    "estado_nombre"     => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getCiudadId($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        a.codEstado         AS      estado_codigo,
        a.codCiudad         AS      ciudad_codigo,
        a.nomCiudad         AS      ciudad_nombre

        FROM CIUDAD a
        WHERE a.codCiudad = '$var01'

        ORDER BY a.nomCiudad";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "ciudad_codigo"     => $row00['ciudad_codigo'],
                    "ciudad_nombre"     => $row00['ciudad_nombre'],
                    "estado_codigo"     => $row00['estado_codigo'],
                    "estado_nombre"     => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function setMoneda($var00, $var01, $var02, $var03, $var04, $var05){
        $str_conn       = getConexion();

        switch ($var00) {
            case 'CA':
                $str_qry = "INSERT INTO MONEDA(codEstado, nomMoneda, bcpMoneda, patMoneda) VALUES ('".$var02."', '".$var03."', '".$var04."', '".$var05."')";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se inserto el registro';
                } else {
                    $result = 'ERROR: No se inserto el registro';
                }
                break;
            
            case 'UA':
                $str_qry = "UPDATE MONEDA SET codEstado = '".$var02."', nomMoneda = '".$var03."', bcpMoneda = '".$var04."', patMoneda = '".$var05."' WHERE codMoneda = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se modifico el registro';
                } else {
                    $result = 'ERROR: No se modifico el registro';
                }
                break;

            case 'DA':
                $str_qry = "DELETE FROM MONEDA WHERE codMoneda = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = 0;
                    $result = 'CORRECTO: Se elimino el registro';
                } else {
                    $result = 'ERROR: No se elimino el registro';
                }
                break;
        }
        
        $str_conn->close();

        return $result;
    }

    function getMoneda(){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        a.codEstado         AS      estado_codigo,
        a.codMoneda         AS      moneda_codigo,
        a.nomMoneda         AS      moneda_nombre,
        a.bcpMoneda         AS      moneda_bcp,
        a.patMoneda         AS      moneda_path

        FROM MONEDA a

        ORDER BY a.nomMoneda";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "moneda_codigo"     => $row00['moneda_codigo'],
                    "moneda_nombre"     => $row00['moneda_nombre'],
                    "moneda_bcp"        => $row00['moneda_bcp'],
                    "moneda_path"       => $row00['moneda_path'],
                    "estado_codigo"     => $row00['estado_codigo'],
                    "estado_nombre"     => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getMonedaId($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        a.codEstado         AS      estado_codigo,
        a.codMoneda         AS      moneda_codigo,
        a.nomMoneda         AS      moneda_nombre,
        a.bcpMoneda         AS      moneda_bcp,
        a.patMoneda         AS      moneda_path

        FROM MONEDA a
        WHERE a.codMoneda = '$var01'

        ORDER BY a.nomMoneda";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "moneda_codigo"     => $row00['moneda_codigo'],
                    "moneda_nombre"     => $row00['moneda_nombre'],
                    "moneda_bcp"        => $row00['moneda_bcp'],
                    "moneda_path"       => $row00['moneda_path'],
                    "estado_codigo"     => $row00['estado_codigo'],
                    "estado_nombre"     => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function setTablero($var00, $var01, $var02, $var03){
        $str_conn       = getConexion();

        switch ($var00) {
            case 'CA':
                $str_qry = "INSERT INTO TABLERO(codEstado, nomTablero) VALUES ('".$var02."', '".$var03."')";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se inserto el registro';
                } else {
                    $result = 'ERROR: No se inserto el registro';
                }
                break;
            
            case 'UA':
                $str_qry = "UPDATE TABLERO SET codEstado = '".$var02."', nomTablero = '".$var03."' WHERE codTablero = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se modifico el registro';
                } else {
                    $result = 'ERROR: No se modifico el registro';
                }
                break;

            case 'DA':
                $str_qry = "DELETE FROM TABLERO WHERE codTablero = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = 0;
                    $result = 'CORRECTO: Se elimino el registro';
                } else {
                    $result = 'ERROR: No se elimino el registro';
                }
                break;
        }
        
        $str_conn->close();

        return $result;
    }

    function getTablero(){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        a.codEstado         AS      estado_codigo,
        a.codTablero        AS      tablero_codigo,
        a.nomTablero        AS      tablero_nombre

        FROM TABLERO a

        ORDER BY a.nomTablero";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "tablero_codigo"    => $row00['tablero_codigo'],
                    "tablero_nombre"    => $row00['tablero_nombre'],
                    "estado_codigo"     => $row00['estado_codigo'],
                    "estado_nombre"     => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getTableroId($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        a.codEstado         AS      estado_codigo,
        a.codTablero        AS      tablero_codigo,
        a.nomTablero        AS      tablero_nombre

        FROM TABLERO a
        WHERE a.codTablero = '$var01'

        ORDER BY a.nomTablero";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "tablero_codigo"    => $row00['tablero_codigo'],
                    "tablero_nombre"    => $row00['tablero_nombre'],
                    "estado_codigo"     => $row00['estado_codigo'],
                    "estado_nombre"     => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function setTableroDetalle($var00, $var01, $var02, $var03, $var04){
        $str_conn       = getConexion();

        switch ($var00) {
            case 'CA':
                $str_qry = "INSERT INTO TABLERODETALLE(codEstado, codTablero, codSucursal) VALUES ('".$var02."', '$var03', '$var04')";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se inserto el registro';
                } else {
                    $result = 'ERROR: No se inserto el registro';
                }
                break;
            
            case 'UA':
                $str_qry = "UPDATE TABLERODETALLE SET codEstado = '".$var02."', codTablero = '$var03', codSucursal = '$var04' WHERE codTableroDetalle = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se modifico el registro';
                } else {
                    $result = 'ERROR: No se modifico el registro';
                }
                break;

            case 'DA':
                $str_qry = "DELETE FROM TABLERODETALLE WHERE codTableroDetalle = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = 0;
                    $result = 'CORRECTO: Se elimino el registro';
                } else {
                    $result = 'ERROR: No se elimino el registro';
                }
                break;
        }
        
        $str_conn->close();

        return $result;
    }

    function getTableroDetalle(){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        e.codCiudad         AS      ciudad_codigo,
        e.nomCiudad         AS      ciudad_nombre,
        d.codEmpresa        AS      empresa_codigo,
        d.nomEmpresa        AS      empresa_nombre,
        d.urlEmpresa        AS      empresa_url,
        c.codSucursal       AS      sucursal_codigo,
        c.nomSucursal       AS      sucursal_nombre,
        b.codTablero        AS      tablero_codigo,
        b.nomTablero        AS      tablero_nombre,
        a.codEstado         AS      estado_codigo,
        a.codTableroDetalle AS      tablero_detalle_codigo

        FROM TABLERODETALLE a
        INNER JOIN TABLERO b ON a.codTablero = b.codTablero
        INNER JOIN SUCURSAL c ON a.codSucursal = c.codSucursal
        INNER JOIN EMPRESA d ON c.codEmpresa = d.codEmpresa
        INNER JOIN CIUDAD e ON c.codCiudad = e.codCiudad

        ORDER BY b.nomTablero";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "tablero_codigo"            => $row00['tablero_codigo'],
                    "tablero_nombre"            => $row00['tablero_nombre'],
                    "ciudad_codigo"             => $row00['ciudad_codigo'],
                    "ciudad_nombre"             => $row00['ciudad_nombre'],
                    "empresa_codigo"            => $row00['empresa_codigo'],
                    "empresa_nombre"            => $row00['empresa_nombre'],
                    "empresa_url"               => $row00['empresa_url'],
                    "sucursal_codigo"           => $row00['sucursal_codigo'],
                    "sucursal_nombre"           => $row00['sucursal_nombre'],
                    "estado_codigo"             => $row00['estado_codigo'],
                    "tablero_detalle_codigo"    => $row00['tablero_detalle_codigo'],
                    "estado_nombre"             => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getTableroDetalleId($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        e.codCiudad         AS      ciudad_codigo,
        e.nomCiudad         AS      ciudad_nombre,
        d.codEmpresa        AS      empresa_codigo,
        d.nomEmpresa        AS      empresa_nombre,
        d.urlEmpresa        AS      empresa_url,
        c.codSucursal       AS      sucursal_codigo,
        c.nomSucursal       AS      sucursal_nombre,
        b.codTablero        AS      tablero_codigo,
        b.nomTablero        AS      tablero_nombre,
        a.codEstado         AS      estado_codigo,
        a.codTableroDetalle AS      tablero_detalle_codigo

        FROM TABLERODETALLE a
        INNER JOIN TABLERO b ON a.codTablero = b.codTablero
        INNER JOIN SUCURSAL c ON a.codSucursal = c.codSucursal
        INNER JOIN EMPRESA d ON c.codEmpresa = d.codEmpresa
        INNER JOIN CIUDAD e ON c.codCiudad = e.codCiudad
        WHERE a.codTableroDetalle = '$var01'

        ORDER BY b.nomTablero";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "tablero_codigo"            => $row00['tablero_codigo'],
                    "tablero_nombre"            => $row00['tablero_nombre'],
                    "ciudad_codigo"             => $row00['ciudad_codigo'],
                    "ciudad_nombre"             => $row00['ciudad_nombre'],
                    "empresa_codigo"            => $row00['empresa_codigo'],
                    "empresa_nombre"            => $row00['empresa_nombre'],
                    "empresa_url"               => $row00['empresa_url'],
                    "sucursal_codigo"           => $row00['sucursal_codigo'],
                    "sucursal_nombre"           => $row00['sucursal_nombre'],
                    "estado_codigo"             => $row00['estado_codigo'],
                    "tablero_detalle_codigo"    => $row00['tablero_detalle_codigo'],
                    "estado_nombre"             => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getTableroDetallesId($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        e.codCiudad         AS      ciudad_codigo,
        e.nomCiudad         AS      ciudad_nombre,
        d.codEmpresa        AS      empresa_codigo,
        d.nomEmpresa        AS      empresa_nombre,
        d.urlEmpresa        AS      empresa_url,
        c.codSucursal       AS      sucursal_codigo,
        c.nomSucursal       AS      sucursal_nombre,
        b.codTablero        AS      tablero_codigo,
        b.nomTablero        AS      tablero_nombre,
        a.codEstado         AS      estado_codigo,
        a.codTableroDetalle AS      tablero_detalle_codigo

        FROM TABLERODETALLE a
        INNER JOIN TABLERO b ON a.codTablero = b.codTablero
        INNER JOIN SUCURSAL c ON a.codSucursal = c.codSucursal
        INNER JOIN EMPRESA d ON c.codEmpresa = d.codEmpresa
        INNER JOIN CIUDAD e ON c.codCiudad = e.codCiudad
        WHERE a.codTablero = '$var01'

        ORDER BY b.nomTablero";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "tablero_codigo"            => $row00['tablero_codigo'],
                    "tablero_nombre"            => $row00['tablero_nombre'],
                    "ciudad_codigo"             => $row00['ciudad_codigo'],
                    "ciudad_nombre"             => $row00['ciudad_nombre'],
                    "empresa_codigo"            => $row00['empresa_codigo'],
                    "empresa_nombre"            => $row00['empresa_nombre'],
                    "empresa_url"               => $row00['empresa_url'],
                    "sucursal_codigo"           => $row00['sucursal_codigo'],
                    "sucursal_nombre"           => $row00['sucursal_nombre'],
                    "estado_codigo"             => $row00['estado_codigo'],
                    "tablero_detalle_codigo"    => $row00['tablero_detalle_codigo'],
                    "estado_nombre"             => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function setCotizacionTipo($var00, $var01, $var02, $var03){
        $str_conn       = getConexion();

        switch ($var00) {
            case 'CA':
                $str_qry = "INSERT INTO COTIZACIONTIPO(codEstado, nomCotizacionTipo) VALUES ('".$var02."', '".$var03."')";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se inserto el registro';
                } else {
                    $result = 'ERROR: No se inserto el registro';
                }
                break;
            
            case 'UA':
                $str_qry = "UPDATE COTIZACIONTIPO SET codEstado = '".$var02."', nomCotizacionTipo = '".$var03."' WHERE codCotizacionTipo = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se modifico el registro';
                } else {
                    $result = 'ERROR: No se modifico el registro';
                }
                break;

            case 'DA':
                $str_qry = "DELETE FROM COTIZACIONTIPO WHERE codCotizacionTipo = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = 0;
                    $result = 'CORRECTO: Se elimino el registro';
                } else {
                    $result = 'ERROR: No se elimino el registro';
                }
                break;
        }
        
        $str_conn->close();

        return $result;
    }

    function getCotizacionTipo(){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        a.codEstado         AS      estado_codigo,
        a.codCotizacionTipo AS      cotizacion_tipo_codigo,
        a.nomCotizacionTipo AS      cotizacion_tipo_nombre

        FROM COTIZACIONTIPO a

        ORDER BY a.nomCotizacionTipo";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "cotizacion_tipo_codigo"    => $row00['cotizacion_tipo_codigo'],
                    "cotizacion_tipo_nombre"    => $row00['cotizacion_tipo_nombre'],
                    "estado_codigo"             => $row00['estado_codigo'],
                    "estado_nombre"             => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getCotizacionTipoId($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        a.codEstado         AS      estado_codigo,
        a.codCotizacionTipo AS      cotizacion_tipo_codigo,
        a.nomCotizacionTipo AS      cotizacion_tipo_nombre

        FROM COTIZACIONTIPO a
        WHERE a.codCotizacionTipo = '$var01'

        ORDER BY a.nomCotizacionTipo";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "cotizacion_tipo_codigo"    => $row00['cotizacion_tipo_codigo'],
                    "cotizacion_tipo_nombre"    => $row00['cotizacion_tipo_nombre'],
                    "estado_codigo"             => $row00['estado_codigo'],
                    "estado_nombre"             => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function setCotizacion($var00, $var01, $var02, $var03, $var04, $var05){
        $str_conn       = getConexion();

        switch ($var00) {
            case 'CA':
                $str_qry = "INSERT INTO COTIZACION(codEstado, codSucursal, codMonedaBase, codMonedaRelacion) VALUES ('".$var02."', '$var03', '$var04', '$var05')";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se inserto el registro';
                } else {
                    $result = 'ERROR: No se inserto el registro';
                }
                break;
            
            case 'UA':
                $str_qry = "UPDATE COTIZACION SET codEstado = '".$var02."', codSucursal = '$var03', codMonedaBase = '$var04', codMonedaRelacion = '$var05' WHERE codCotizacion = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = $var01;
                    $result = 'CORRECTO: Se modifico el registro';
                } else {
                    $result = 'ERROR: No se modifico el registro';
                }
                break;

            case 'DA':
                $str_qry = "DELETE FROM COTIZACION WHERE codCotizacion = $var01";
                if ($str_conn->query($str_qry) === TRUE) {
                    $result = 0;
                    $result = 'CORRECTO: Se elimino el registro';
                } else {
                    $result = 'ERROR: No se elimino el registro';
                }
                break;
        }
        
        $str_conn->close();

        return $result;
    }

    function getCotizacion(){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        f.codMoneda         AS      moneda_relacionada_codigo,
        f.nomMoneda         AS      moneda_relacionada_nombre,
        f.bcpMoneda         AS      moneda_relacionada_bcp,
        f.patMoneda         AS      moneda_relacionada_path,
        e.codMoneda         AS      moneda_base_codigo,
        e.nomMoneda         AS      moneda_base_nombre,
        e.bcpMoneda         AS      moneda_base_bcp,
        e.patMoneda         AS      moneda_base_path,
        d.codCiudad         AS      ciudad_codigo,
        d.nomCiudad         AS      ciudad_nombre,
        c.codEmpresa        AS      empresa_codigo,
        c.nomEmpresa        AS      empresa_nombre,
        c.urlEmpresa        AS      empresa_url,
        b.codSucursal       AS      sucursal_codigo,
        b.nomSucursal       AS      sucursal_nombre,
        a.codEstado         AS      estado_codigo,
        a.codCotizacion     AS      cotizacion_codigo

        FROM COTIZACION a
        INNER JOIN SUCURSAL b ON a.codSucursal = b.codSucursal
        INNER JOIN EMPRESA c ON b.codEmpresa = c.codEmpresa
        INNER JOIN CIUDAD d ON b.codCiudad = d.codCiudad
        INNER JOIN MONEDA e ON a.codMonedaBase = e.codMoneda
        INNER JOIN MONEDA f ON a.codMonedaRelacion = f.codMoneda

        ORDER BY c.nomEmpresa, b.nomSucursal, d.nomCiudad";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "moneda_relacionada_codigo" => $row00['moneda_relacionada_codigo'],
                    "moneda_relacionada_nombre" => $row00['moneda_relacionada_nombre'],
                    "moneda_relacionada_bcp"    => $row00['moneda_relacionada_bcp'],
                    "moneda_relacionada_path"   => $row00['moneda_relacionada_path'],
                    "moneda_base_codigo"        => $row00['moneda_base_codigo'],
                    "moneda_base_nombre"        => $row00['moneda_base_nombre'],
                    "moneda_base_bcp"           => $row00['moneda_base_bcp'],
                    "moneda_base_path"          => $row00['moneda_base_path'],
                    "ciudad_codigo"             => $row00['ciudad_codigo'],
                    "ciudad_nombre"             => $row00['ciudad_nombre'],
                    "empresa_codigo"            => $row00['empresa_codigo'],
                    "empresa_nombre"            => $row00['empresa_nombre'],
                    "empresa_url"               => $row00['empresa_url'],
                    "sucursal_codigo"           => $row00['sucursal_codigo'],
                    "sucursal_nombre"           => $row00['sucursal_nombre'],
                    "cotizacion_codigo"         => $row00['cotizacion_codigo'],
                    "estado_codigo"             => $row00['estado_codigo'],
                    "estado_nombre"             => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getCotizacionId($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        f.codMoneda         AS      moneda_relacionada_codigo,
        f.nomMoneda         AS      moneda_relacionada_nombre,
        f.bcpMoneda         AS      moneda_relacionada_bcp,
        f.patMoneda         AS      moneda_relacionada_path,
        e.codMoneda         AS      moneda_base_codigo,
        e.nomMoneda         AS      moneda_base_nombre,
        e.bcpMoneda         AS      moneda_base_bcp,
        e.patMoneda         AS      moneda_base_path,
        d.codCiudad         AS      ciudad_codigo,
        d.nomCiudad         AS      ciudad_nombre,
        c.codEmpresa        AS      empresa_codigo,
        c.nomEmpresa        AS      empresa_nombre,
        c.urlEmpresa        AS      empresa_url,
        b.codSucursal       AS      sucursal_codigo,
        b.nomSucursal       AS      sucursal_nombre,
        a.codEstado         AS      estado_codigo,
        a.codCotizacion     AS      cotizacion_codigo

        FROM COTIZACION a
        INNER JOIN SUCURSAL b ON a.codSucursal = b.codSucursal
        INNER JOIN EMPRESA c ON b.codEmpresa = c.codEmpresa
        INNER JOIN CIUDAD d ON b.codCiudad = d.codCiudad
        INNER JOIN MONEDA e ON a.codMonedaBase = e.codMoneda
        INNER JOIN MONEDA f ON a.codMonedaRelacion = f.codMoneda
        WHERE a.codCotizacion = '$var01'

        ORDER BY c.nomEmpresa, b.nomSucursal, d.nomCiudad";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "moneda_relacionada_codigo" => $row00['moneda_relacionada_codigo'],
                    "moneda_relacionada_nombre" => $row00['moneda_relacionada_nombre'],
                    "moneda_relacionada_bcp"    => $row00['moneda_relacionada_bcp'],
                    "moneda_relacionada_path"   => $row00['moneda_relacionada_path'],
                    "moneda_base_codigo"        => $row00['moneda_base_codigo'],
                    "moneda_base_nombre"        => $row00['moneda_base_nombre'],
                    "moneda_base_bcp"           => $row00['moneda_base_bcp'],
                    "moneda_base_path"          => $row00['moneda_base_path'],
                    "ciudad_codigo"             => $row00['ciudad_codigo'],
                    "ciudad_nombre"             => $row00['ciudad_nombre'],
                    "empresa_codigo"            => $row00['empresa_codigo'],
                    "empresa_nombre"            => $row00['empresa_nombre'],
                    "empresa_url"               => $row00['empresa_url'],
                    "sucursal_codigo"           => $row00['sucursal_codigo'],
                    "sucursal_nombre"           => $row00['sucursal_nombre'],
                    "cotizacion_codigo"         => $row00['cotizacion_codigo'],
                    "estado_codigo"             => $row00['estado_codigo'],
                    "estado_nombre"             => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getCotizacionId2($var01, $var02, $var03){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        f.codMoneda         AS      moneda_relacionada_codigo,
        f.nomMoneda         AS      moneda_relacionada_nombre,
        f.bcpMoneda         AS      moneda_relacionada_bcp,
        f.patMoneda         AS      moneda_relacionada_path,
        e.codMoneda         AS      moneda_base_codigo,
        e.nomMoneda         AS      moneda_base_nombre,
        e.bcpMoneda         AS      moneda_base_bcp,
        e.patMoneda         AS      moneda_base_path,
        d.codCiudad         AS      ciudad_codigo,
        d.nomCiudad         AS      ciudad_nombre,
        c.codEmpresa        AS      empresa_codigo,
        c.nomEmpresa        AS      empresa_nombre,
        c.urlEmpresa        AS      empresa_url,
        b.codSucursal       AS      sucursal_codigo,
        b.nomSucursal       AS      sucursal_nombre,
        a.codEstado         AS      estado_codigo,
        a.codCotizacion     AS      cotizacion_codigo

        FROM COTIZACION a
        INNER JOIN SUCURSAL b ON a.codSucursal = b.codSucursal
        INNER JOIN EMPRESA c ON b.codEmpresa = c.codEmpresa
        INNER JOIN CIUDAD d ON b.codCiudad = d.codCiudad
        INNER JOIN MONEDA e ON a.codMonedaBase = e.codMoneda
        INNER JOIN MONEDA f ON a.codMonedaRelacion = f.codMoneda
        WHERE a.codSucursal = '$var01' AND a.codMonedaBase = '$var02' AND a.codMonedaRelacion = '$var03'

        ORDER BY c.nomEmpresa, b.nomSucursal, d.nomCiudad";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "moneda_relacionada_codigo" => $row00['moneda_relacionada_codigo'],
                    "moneda_relacionada_nombre" => $row00['moneda_relacionada_nombre'],
                    "moneda_relacionada_bcp"    => $row00['moneda_relacionada_bcp'],
                    "moneda_relacionada_path"   => $row00['moneda_relacionada_path'],
                    "moneda_base_codigo"        => $row00['moneda_base_codigo'],
                    "moneda_base_nombre"        => $row00['moneda_base_nombre'],
                    "moneda_base_bcp"           => $row00['moneda_base_bcp'],
                    "moneda_base_path"          => $row00['moneda_base_path'],
                    "ciudad_codigo"             => $row00['ciudad_codigo'],
                    "ciudad_nombre"             => $row00['ciudad_nombre'],
                    "empresa_codigo"            => $row00['empresa_codigo'],
                    "empresa_nombre"            => $row00['empresa_nombre'],
                    "empresa_url"               => $row00['empresa_url'],
                    "sucursal_codigo"           => $row00['sucursal_codigo'],
                    "sucursal_nombre"           => $row00['sucursal_nombre'],
                    "cotizacion_codigo"         => $row00['cotizacion_codigo'],
                    "estado_codigo"             => $row00['estado_codigo'],
                    "estado_nombre"             => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function setCotizacionDetalle($var00, $var01, $var02, $var03, $var04, $var05, $var06, $var07, $sysUse){
        $str_conn       = getConexion();
        $var07_1        = strtotime('Y-m-d H:i', $var07);
        $var08          = date('Y-m-d');
        $var09          = date('H:i:s');

        switch ($var00) {
            case 'CA':
                $str_qry = "UPDATE COTIZACIONDETALLE SET codEstado = 'H' WHERE codCotizacion = '$var03' AND codCotizacionTipo = '$var04'";
                if ($str_conn->query($str_qry) === TRUE) {
                    $str_qry = "INSERT INTO COTIZACIONDETALLE(codEstado, codCotizacion, codCotizacionTipo, impCompra, impVenta, fecPizarra, fecAlta, horAlta, usuAlta) VALUES ('".$var02."', '$var03', '$var04', '$var05', '$var06', '".$var07."', '".$var08."', '".$var09."', '".$sysUse."')";
                    if ($str_conn->query($str_qry) === TRUE) {
                        $result = $str_conn->insert_id;
                        $result = 'Se inserto el registro de forma correcta';
                    }
                }
                break;
        }
        
        $str_conn->close();

        return $result;
    }

    function getCotizacionDetalleId($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        h.codCotizacionTipo     AS      cotizacion_tipo_codigo,
        h.nomCotizacionTipo     AS      cotizacion_tipo_nombre,
        g.codMoneda             AS      moneda_relacionada_codigo,
        g.nomMoneda             AS      moneda_relacionada_nombre,
        g.bcpMoneda             AS      moneda_relacionada_bcp,
        g.patMoneda             AS      moneda_relacionada_path,
        f.codMoneda             AS      moneda_base_codigo,
        f.nomMoneda             AS      moneda_base_nombre,
        f.bcpMoneda             AS      moneda_base_bcp,
        f.patMoneda             AS      moneda_base_path,
        e.codCiudad             AS      ciudad_codigo,
        e.nomCiudad             AS      ciudad_nombre,
        d.codEmpresa            AS      empresa_codigo,
        d.nomEmpresa            AS      empresa_nombre,
        d.urlEmpresa            AS      empresa_url,
        c.codSucursal           AS      sucursal_codigo,
        c.nomSucursal           AS      sucursal_nombre,
        b.codCotizacion         AS      cotizacion_codigo,
        a.codCotizacionDetalle  AS      cotizacion_detalle_codigo,
        a.impCompra             AS      cotizacion_detalle_compra,
        a.impVenta              AS      cotizacion_detalle_venta,
        a.fecPizarra            AS      cotizacion_detalle_fecha_pizarra,
        a.fecAlta               AS      cotizacion_detalle_alta_fecha,
        a.horAlta               AS      cotizacion_detalle_alta_hora,
        a.codEstado             AS      estado_codigo

        FROM COTIZACIONDETALLE a
        INNER JOIN COTIZACION b ON a.codCotizacion = b.codCotizacion
        INNER JOIN SUCURSAL c ON b.codSucursal = c.codSucursal
        INNER JOIN EMPRESA d ON c.codEmpresa = d.codEmpresa
        INNER JOIN CIUDAD e ON c.codCiudad = e.codCiudad
        INNER JOIN MONEDA f ON b.codMonedaBase = f.codMoneda
        INNER JOIN MONEDA g ON b.codMonedaRelacion = g.codMoneda
        INNER JOIN COTIZACIONTIPO h ON a.codCotizacionTipo = h.codCotizacionTipo
        WHERE a.codCotizacion = '$var01'

        ORDER BY h.nomCotizacionTipo, a.fecAlta DESC, a.horAlta DESC";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "moneda_relacionada_codigo"         => $row00['moneda_relacionada_codigo'],
                    "moneda_relacionada_nombre"         => $row00['moneda_relacionada_nombre'],
                    "moneda_relacionada_bcp"            => $row00['moneda_relacionada_bcp'],
                    "moneda_relacionada_path"           => $row00['moneda_relacionada_path'],
                    "moneda_base_codigo"                => $row00['moneda_base_codigo'],
                    "moneda_base_nombre"                => $row00['moneda_base_nombre'],
                    "moneda_base_bcp"                   => $row00['moneda_base_bcp'],
                    "moneda_base_path"                  => $row00['moneda_base_path'],
                    "ciudad_codigo"                     => $row00['ciudad_codigo'],
                    "ciudad_nombre"                     => $row00['ciudad_nombre'],
                    "empresa_codigo"                    => $row00['empresa_codigo'],
                    "empresa_nombre"                    => $row00['empresa_nombre'],
                    "empresa_url"                       => $row00['empresa_url'],
                    "sucursal_codigo"                   => $row00['sucursal_codigo'],
                    "sucursal_nombre"                   => $row00['sucursal_nombre'],
                    "cotizacion_codigo"                 => $row00['cotizacion_codigo'],
                    "cotizacion_detalle_codigo"         => $row00['cotizacion_detalle_codigo'],
                    "cotizacion_detalle_compra"         => $row00['cotizacion_detalle_compra'],
                    "cotizacion_detalle_venta"          => $row00['cotizacion_detalle_venta'],
                    "cotizacion_detalle_fecha_pizarra"  => $row00['cotizacion_detalle_fecha_pizarra'],
                    "cotizacion_detalle_alta_fecha"     => $row00['cotizacion_detalle_alta_fecha'],
                    "cotizacion_detalle_alta_hora"      => $row00['cotizacion_detalle_alta_hora'],
                    "cotizacion_tipo_codigo"            => $row00['cotizacion_tipo_codigo'],
                    "cotizacion_tipo_nombre"            => $row00['cotizacion_tipo_nombre'],
                    "estado_codigo"                     => $row00['estado_codigo'],
                    "estado_nombre"                     => $estado
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }

    function getPizarra($var01){
        $str_conn       = getConexion();
        $str_qry        = "SELECT
        i7.codCotizacionDetalle AS      cotizacion_detalle_codigo_eur_usd,
        i7.impCompra            AS      cotizacion_detalle_compra_eur_usd,
        i7.impVenta             AS      cotizacion_detalle_venta_eur_usd,
        i7.fecPizarra           AS      cotizacion_detalle_fecha_pizarra_eur_usd,
        i7.fecAlta              AS      cotizacion_detalle_alta_fecha_eur_usd,
        i7.horAlta              AS      cotizacion_detalle_alta_hora_eur_usd,
        i7.usuAlta              AS      cotizacion_detalle_alta_usuario_eur_usd,

        h7.codMoneda            AS      moneda_relacionada_codigo_eur_usd,
        h7.nomMoneda            AS      moneda_relacionada_nombre_eur_usd,
        h7.bcpMoneda            AS      moneda_relacionada_bcp_eur_usd,
        h7.patMoneda            AS      moneda_relacionada_path_eur_usd,

        g7.codMoneda            AS      moneda_base_codigo_eur_usd,
        g7.nomMoneda            AS      moneda_base_nombre_eur_usd,
        g7.bcpMoneda            AS      moneda_base_bcp_eur_usd,
        g7.patMoneda            AS      moneda_base_path_eur_usd,
        
        f7.codCotizacion        AS      cotizacion_codigo_eur_usd,

        i6.codCotizacionDetalle AS      cotizacion_detalle_codigo_usd_ars,
        i6.impCompra            AS      cotizacion_detalle_compra_usd_ars,
        i6.impVenta             AS      cotizacion_detalle_venta_usd_ars,
        i6.fecPizarra           AS      cotizacion_detalle_fecha_pizarra_usd_ars,
        i6.fecAlta              AS      cotizacion_detalle_alta_fecha_usd_ars,
        i6.horAlta              AS      cotizacion_detalle_alta_hora_usd_ars,
        i6.usuAlta              AS      cotizacion_detalle_alta_usuario_usd_ars,

        h6.codMoneda            AS      moneda_relacionada_codigo_usd_ars,
        h6.nomMoneda            AS      moneda_relacionada_nombre_usd_ars,
        h6.bcpMoneda            AS      moneda_relacionada_bcp_usd_ars,
        h6.patMoneda            AS      moneda_relacionada_path_usd_ars,

        g6.codMoneda            AS      moneda_base_codigo_usd_ars,
        g6.nomMoneda            AS      moneda_base_nombre_usd_ars,
        g6.bcpMoneda            AS      moneda_base_bcp_usd_ars,
        g6.patMoneda            AS      moneda_base_path_usd_ars,
        
        f6.codCotizacion        AS      cotizacion_codigo_usd_ars,

        i5.codCotizacionDetalle AS      cotizacion_detalle_codigo_usd_brl,
        i5.impCompra            AS      cotizacion_detalle_compra_usd_brl,
        i5.impVenta             AS      cotizacion_detalle_venta_usd_brl,
        i5.fecPizarra           AS      cotizacion_detalle_fecha_pizarra_usd_brl,
        i5.fecAlta              AS      cotizacion_detalle_alta_fecha_usd_brl,
        i5.horAlta              AS      cotizacion_detalle_alta_hora_usd_brl,
        i5.usuAlta              AS      cotizacion_detalle_alta_usuario_usd_brl,

        h5.codMoneda            AS      moneda_relacionada_codigo_usd_brl,
        h5.nomMoneda            AS      moneda_relacionada_nombre_usd_brl,
        h5.bcpMoneda            AS      moneda_relacionada_bcp_usd_brl,
        h5.patMoneda            AS      moneda_relacionada_path_usd_brl,

        g5.codMoneda            AS      moneda_base_codigo_usd_brl,
        g5.nomMoneda            AS      moneda_base_nombre_usd_brl,
        g5.bcpMoneda            AS      moneda_base_bcp_usd_brl,
        g5.patMoneda            AS      moneda_base_path_usd_brl,
        
        f5.codCotizacion        AS      cotizacion_codigo_usd_brl,

        i4.codCotizacionDetalle AS      cotizacion_detalle_codigo_eur_pyg,
        i4.impCompra            AS      cotizacion_detalle_compra_eur_pyg,
        i4.impVenta             AS      cotizacion_detalle_venta_eur_pyg,
        i4.fecPizarra           AS      cotizacion_detalle_fecha_pizarra_eur_pyg,
        i4.fecAlta              AS      cotizacion_detalle_alta_fecha_eur_pyg,
        i4.horAlta              AS      cotizacion_detalle_alta_hora_eur_pyg,
        i4.usuAlta              AS      cotizacion_detalle_alta_usuario_eur_pyg,

        h4.codMoneda            AS      moneda_relacionada_codigo_eur_pyg,
        h4.nomMoneda            AS      moneda_relacionada_nombre_eur_pyg,
        h4.bcpMoneda            AS      moneda_relacionada_bcp_eur_pyg,
        h4.patMoneda            AS      moneda_relacionada_path_eur_pyg,

        g4.codMoneda            AS      moneda_base_codigo_eur_pyg,
        g4.nomMoneda            AS      moneda_base_nombre_eur_pyg,
        g4.bcpMoneda            AS      moneda_base_bcp_eur_pyg,
        g4.patMoneda            AS      moneda_base_path_eur_pyg,
        
        f4.codCotizacion        AS      cotizacion_codigo_eur_pyg,

        i3.codCotizacionDetalle AS      cotizacion_detalle_codigo_ars_pyg,
        i3.impCompra            AS      cotizacion_detalle_compra_ars_pyg,
        i3.impVenta             AS      cotizacion_detalle_venta_ars_pyg,
        i3.fecPizarra           AS      cotizacion_detalle_fecha_pizarra_ars_pyg,
        i3.fecAlta              AS      cotizacion_detalle_alta_fecha_ars_pyg,
        i3.horAlta              AS      cotizacion_detalle_alta_hora_ars_pyg,
        i3.usuAlta              AS      cotizacion_detalle_alta_usuario_ars_pyg,

        h3.codMoneda            AS      moneda_relacionada_codigo_ars_pyg,
        h3.nomMoneda            AS      moneda_relacionada_nombre_ars_pyg,
        h3.bcpMoneda            AS      moneda_relacionada_bcp_ars_pyg,
        h3.patMoneda            AS      moneda_relacionada_path_ars_pyg,

        g3.codMoneda            AS      moneda_base_codigo_ars_pyg,
        g3.nomMoneda            AS      moneda_base_nombre_ars_pyg,
        g3.bcpMoneda            AS      moneda_base_bcp_ars_pyg,
        g3.patMoneda            AS      moneda_base_path_ars_pyg,
        
        f3.codCotizacion        AS      cotizacion_codigo_ars_pyg,

        i2.codCotizacionDetalle AS      cotizacion_detalle_codigo_brl_pyg,
        i2.impCompra            AS      cotizacion_detalle_compra_brl_pyg,
        i2.impVenta             AS      cotizacion_detalle_venta_brl_pyg,
        i2.fecPizarra           AS      cotizacion_detalle_fecha_pizarra_brl_pyg,
        i2.fecAlta              AS      cotizacion_detalle_alta_fecha_brl_pyg,
        i2.horAlta              AS      cotizacion_detalle_alta_hora_brl_pyg,
        i2.usuAlta              AS      cotizacion_detalle_alta_usuario_brl_pyg,

        h2.codMoneda            AS      moneda_relacionada_codigo_brl_pyg,
        h2.nomMoneda            AS      moneda_relacionada_nombre_brl_pyg,
        h2.bcpMoneda            AS      moneda_relacionada_bcp_brl_pyg,
        h2.patMoneda            AS      moneda_relacionada_path_brl_pyg,

        g2.codMoneda            AS      moneda_base_codigo_brl_pyg,
        g2.nomMoneda            AS      moneda_base_nombre_brl_pyg,
        g2.bcpMoneda            AS      moneda_base_bcp_brl_pyg,
        g2.patMoneda            AS      moneda_base_path_brl_pyg,
        
        f2.codCotizacion        AS      cotizacion_codigo_brl_pyg,

        i1.codCotizacionDetalle AS      cotizacion_detalle_codigo_usd_pyg,
        i1.impCompra            AS      cotizacion_detalle_compra_usd_pyg,
        i1.impVenta             AS      cotizacion_detalle_venta_usd_pyg,
        i1.fecPizarra           AS      cotizacion_detalle_fecha_pizarra_usd_pyg,
        i1.fecAlta              AS      cotizacion_detalle_alta_fecha_usd_pyg,
        i1.horAlta              AS      cotizacion_detalle_alta_hora_usd_pyg,
        i1.usuAlta              AS      cotizacion_detalle_alta_usuario_usd_pyg,

        h1.codMoneda            AS      moneda_relacionada_codigo_usd_pyg,
        h1.nomMoneda            AS      moneda_relacionada_nombre_usd_pyg,
        h1.bcpMoneda            AS      moneda_relacionada_bcp_usd_pyg,
        h1.patMoneda            AS      moneda_relacionada_path_usd_pyg,

        g1.codMoneda            AS      moneda_base_codigo_usd_pyg,
        g1.nomMoneda            AS      moneda_base_nombre_usd_pyg,
        g1.bcpMoneda            AS      moneda_base_bcp_usd_pyg,
        g1.patMoneda            AS      moneda_base_path_usd_pyg,
        
        f1.codCotizacion        AS      cotizacion_codigo_usd_pyg,

        e.codCiudad             AS      ciudad_codigo,
        e.nomCiudad             AS      ciudad_nombre,
        d.codEmpresa            AS      empresa_codigo,
        d.nomEmpresa            AS      empresa_nombre,
        d.urlEmpresa            AS      empresa_url,
        c.codSucursal           AS      sucursal_codigo,
        c.nomSucursal           AS      sucursal_nombre,
        
        b.codTableroDetalle     AS      tablero_detalle_codigo,

        a.codEstado             AS      estado_codigo,
        a.codTablero            AS      tablero_codigo,
        a.nomTablero            AS      tablero_nombre

        FROM TABLERO a
        INNER JOIN TABLERODETALLE b ON a.codTablero = b.codTablero
        INNER JOIN SUCURSAL c ON b.codSucursal = c.codSucursal
        INNER JOIN EMPRESA d ON c.codEmpresa = d.codEmpresa
        INNER JOIN CIUDAD e ON c.codCiudad = e.codCiudad

        INNER JOIN COTIZACION f1 ON c.codSucursal = f1.codSucursal
        INNER JOIN MONEDA g1 ON f1.codMonedaBase = g1.codMoneda
        INNER JOIN MONEDA h1 ON f1.codMonedaRelacion = h1.codMoneda
        INNER JOIN COTIZACIONDETALLE i1 ON f1.codCotizacion = i1.codCotizacion

        INNER JOIN COTIZACION f2 ON c.codSucursal = f2.codSucursal
        INNER JOIN MONEDA g2 ON f2.codMonedaBase = g2.codMoneda
        INNER JOIN MONEDA h2 ON f2.codMonedaRelacion = h2.codMoneda
        INNER JOIN COTIZACIONDETALLE i2 ON f2.codCotizacion = i2.codCotizacion

        INNER JOIN COTIZACION f3 ON c.codSucursal = f3.codSucursal
        INNER JOIN MONEDA g3 ON f3.codMonedaBase = g3.codMoneda
        INNER JOIN MONEDA h3 ON f3.codMonedaRelacion = h3.codMoneda
        INNER JOIN COTIZACIONDETALLE i3 ON f3.codCotizacion = i3.codCotizacion

        INNER JOIN COTIZACION f4 ON c.codSucursal = f4.codSucursal
        INNER JOIN MONEDA g4 ON f4.codMonedaBase = g4.codMoneda
        INNER JOIN MONEDA h4 ON f4.codMonedaRelacion = h4.codMoneda
        INNER JOIN COTIZACIONDETALLE i4 ON f4.codCotizacion = i4.codCotizacion

        INNER JOIN COTIZACION f5 ON c.codSucursal = f5.codSucursal
        INNER JOIN MONEDA g5 ON f5.codMonedaBase = g5.codMoneda
        INNER JOIN MONEDA h5 ON f5.codMonedaRelacion = h5.codMoneda
        INNER JOIN COTIZACIONDETALLE i5 ON f5.codCotizacion = i5.codCotizacion

        INNER JOIN COTIZACION f6 ON c.codSucursal = f6.codSucursal
        INNER JOIN MONEDA g6 ON f6.codMonedaBase = g6.codMoneda
        INNER JOIN MONEDA h6 ON f6.codMonedaRelacion = h6.codMoneda
        INNER JOIN COTIZACIONDETALLE i6 ON f6.codCotizacion = i6.codCotizacion

        INNER JOIN COTIZACION f7 ON c.codSucursal = f7.codSucursal
        INNER JOIN MONEDA g7 ON f7.codMonedaBase = g7.codMoneda
        INNER JOIN MONEDA h7 ON f7.codMonedaRelacion = h7.codMoneda
        INNER JOIN COTIZACIONDETALLE i7 ON f7.codCotizacion = i7.codCotizacion

        WHERE a.codTablero = '$var01' AND b.codEstado = 'A' AND (i1.CodEstado = 'A' AND f1.codMonedaBase = 2 AND f1.codMonedaRelacion = 1) AND (i2.CodEstado = 'A' AND f2.codMonedaBase = 3 AND f2.codMonedaRelacion = 1) AND 
        (i3.CodEstado = 'A' AND f3.codMonedaBase = 5 AND f3.codMonedaRelacion = 1)  AND (i4.CodEstado = 'A' AND f4.codMonedaBase = 4 AND f4.codMonedaRelacion = 1) AND (i5.CodEstado = 'A' AND f5.codMonedaBase = 2 AND f5.codMonedaRelacion = 3) 
        AND (i6.CodEstado = 'A' AND f6.codMonedaBase = 2 AND f6.codMonedaRelacion = 5) AND (i7.CodEstado = 'A' AND f7.codMonedaBase = 4 AND f7.codMonedaRelacion = 2)

        ORDER BY d.nomEmpresa, c.nomSucursal, e.nomCiudad";

        if ($query = $str_conn->query($str_qry)) {
            while($row00 = $query->fetch_assoc()) {
                if ($row00['estado_codigo'] == 'A'){
                    $estado = 'ACTIVO';
                } else {
                    $estado = 'INACTIVO';
                }

                $result[]  = array(
                    "estado_codigo"                             => $row00['estado_codigo'],
                    "estado_nombre"                             => $estado,
                    "tablero_codigo"                            => $row00['tablero_codigo'],
                    "tablero_nombre"                            => $row00['tablero_nombre'],

                    "tablero_detalle_codigo"                    => $row00['tablero_detalle_codigo'],

                    "ciudad_codigo"                             => $row00['ciudad_codigo'],
                    "ciudad_nombre"                             => $row00['ciudad_nombre'],
                    "empresa_codigo"                            => $row00['empresa_codigo'],
                    "empresa_nombre"                            => $row00['empresa_nombre'],
                    "empresa_url"                               => $row00['empresa_url'],
                    "sucursal_codigo"                           => $row00['sucursal_codigo'],
                    "sucursal_nombre"                           => $row00['sucursal_nombre'],

                    "cotizacion_codigo_usd_pyg"                 => $row00['cotizacion_codigo_usd_pyg'],
                    "moneda_base_codigo_usd_pyg"                => $row00['moneda_base_codigo_usd_pyg'],
                    "moneda_base_nombre_usd_pyg"                => $row00['moneda_base_nombre_usd_pyg'],
                    "moneda_base_bcp_usd_pyg"                   => $row00['moneda_base_bcp_usd_pyg'],
                    "moneda_base_path_usd_pyg"                  => $row00['moneda_base_path_usd_pyg'],
                    "moneda_relacionada_codigo_usd_pyg"         => $row00['moneda_relacionada_codigo_usd_pyg'],
                    "moneda_relacionada_nombre_usd_pyg"         => $row00['moneda_relacionada_nombre_usd_pyg'],
                    "moneda_relacionada_bcp_usd_pyg"            => $row00['moneda_relacionada_bcp_usd_pyg'],
                    "moneda_relacionada_path_usd_pyg"           => $row00['moneda_relacionada_path_usd_pyg'],
                    "cotizacion_detalle_codigo_usd_pyg"         => $row00['cotizacion_detalle_codigo_usd_pyg'],
                    "cotizacion_detalle_compra_usd_pyg"         => $row00['cotizacion_detalle_compra_usd_pyg'],
                    "cotizacion_detalle_venta_usd_pyg"          => $row00['cotizacion_detalle_venta_usd_pyg'],
                    "cotizacion_detalle_fecha_pizarra_usd_pyg"  => $row00['cotizacion_detalle_fecha_pizarra_usd_pyg'],
                    "cotizacion_detalle_alta_fecha_usd_pyg"     => $row00['cotizacion_detalle_alta_fecha_usd_pyg'],
                    "cotizacion_detalle_alta_hora_usd_pyg"      => $row00['cotizacion_detalle_alta_hora_usd_pyg'],
                    "cotizacion_detalle_alta_usuario_usd_pyg"   => $row00['cotizacion_detalle_alta_usuario_usd_pyg'],

                    "cotizacion_codigo_brl_pyg"                 => $row00['cotizacion_codigo_brl_pyg'],
                    "moneda_base_codigo_brl_pyg"                => $row00['moneda_base_codigo_brl_pyg'],
                    "moneda_base_nombre_brl_pyg"                => $row00['moneda_base_nombre_brl_pyg'],
                    "moneda_base_bcp_brl_pyg"                   => $row00['moneda_base_bcp_brl_pyg'],
                    "moneda_base_path_brl_pyg"                  => $row00['moneda_base_path_brl_pyg'],
                    "moneda_relacionada_codigo_brl_pyg"         => $row00['moneda_relacionada_codigo_brl_pyg'],
                    "moneda_relacionada_nombre_brl_pyg"         => $row00['moneda_relacionada_nombre_brl_pyg'],
                    "moneda_relacionada_bcp_brl_pyg"            => $row00['moneda_relacionada_bcp_brl_pyg'],
                    "moneda_relacionada_path_brl_pyg"           => $row00['moneda_relacionada_path_brl_pyg'],
                    "cotizacion_detalle_codigo_brl_pyg"         => $row00['cotizacion_detalle_codigo_brl_pyg'],
                    "cotizacion_detalle_compra_brl_pyg"         => $row00['cotizacion_detalle_compra_brl_pyg'],
                    "cotizacion_detalle_venta_brl_pyg"          => $row00['cotizacion_detalle_venta_brl_pyg'],
                    "cotizacion_detalle_fecha_pizarra_brl_pyg"  => $row00['cotizacion_detalle_fecha_pizarra_brl_pyg'],
                    "cotizacion_detalle_alta_fecha_brl_pyg"     => $row00['cotizacion_detalle_alta_fecha_brl_pyg'],
                    "cotizacion_detalle_alta_hora_brl_pyg"      => $row00['cotizacion_detalle_alta_hora_brl_pyg'],
                    "cotizacion_detalle_alta_usuario_brl_pyg"   => $row00['cotizacion_detalle_alta_usuario_brl_pyg'],

                    "cotizacion_codigo_ars_pyg"                 => $row00['cotizacion_codigo_ars_pyg'],
                    "moneda_base_codigo_ars_pyg"                => $row00['moneda_base_codigo_ars_pyg'],
                    "moneda_base_nombre_ars_pyg"                => $row00['moneda_base_nombre_ars_pyg'],
                    "moneda_base_bcp_ars_pyg"                   => $row00['moneda_base_bcp_ars_pyg'],
                    "moneda_base_path_ars_pyg"                  => $row00['moneda_base_path_ars_pyg'],
                    "moneda_relacionada_codigo_ars_pyg"         => $row00['moneda_relacionada_codigo_ars_pyg'],
                    "moneda_relacionada_nombre_ars_pyg"         => $row00['moneda_relacionada_nombre_ars_pyg'],
                    "moneda_relacionada_bcp_ars_pyg"            => $row00['moneda_relacionada_bcp_ars_pyg'],
                    "moneda_relacionada_path_ars_pyg"           => $row00['moneda_relacionada_path_ars_pyg'],
                    "cotizacion_detalle_codigo_ars_pyg"         => $row00['cotizacion_detalle_codigo_ars_pyg'],
                    "cotizacion_detalle_compra_ars_pyg"         => $row00['cotizacion_detalle_compra_ars_pyg'],
                    "cotizacion_detalle_venta_ars_pyg"          => $row00['cotizacion_detalle_venta_ars_pyg'],
                    "cotizacion_detalle_fecha_pizarra_ars_pyg"  => $row00['cotizacion_detalle_fecha_pizarra_ars_pyg'],
                    "cotizacion_detalle_alta_fecha_ars_pyg"     => $row00['cotizacion_detalle_alta_fecha_ars_pyg'],
                    "cotizacion_detalle_alta_hora_ars_pyg"      => $row00['cotizacion_detalle_alta_hora_ars_pyg'],
                    "cotizacion_detalle_alta_usuario_ars_pyg"   => $row00['cotizacion_detalle_alta_usuario_ars_pyg'],

                    "cotizacion_codigo_eur_pyg"                 => $row00['cotizacion_codigo_eur_pyg'],
                    "moneda_base_codigo_eur_pyg"                => $row00['moneda_base_codigo_eur_pyg'],
                    "moneda_base_nombre_eur_pyg"                => $row00['moneda_base_nombre_eur_pyg'],
                    "moneda_base_bcp_eur_pyg"                   => $row00['moneda_base_bcp_eur_pyg'],
                    "moneda_base_path_eur_pyg"                  => $row00['moneda_base_path_eur_pyg'],
                    "moneda_relacionada_codigo_eur_pyg"         => $row00['moneda_relacionada_codigo_eur_pyg'],
                    "moneda_relacionada_nombre_eur_pyg"         => $row00['moneda_relacionada_nombre_eur_pyg'],
                    "moneda_relacionada_bcp_eur_pyg"            => $row00['moneda_relacionada_bcp_eur_pyg'],
                    "moneda_relacionada_path_eur_pyg"           => $row00['moneda_relacionada_path_eur_pyg'],
                    "cotizacion_detalle_codigo_eur_pyg"         => $row00['cotizacion_detalle_codigo_eur_pyg'],
                    "cotizacion_detalle_compra_eur_pyg"         => $row00['cotizacion_detalle_compra_eur_pyg'],
                    "cotizacion_detalle_venta_eur_pyg"          => $row00['cotizacion_detalle_venta_eur_pyg'],
                    "cotizacion_detalle_fecha_pizarra_eur_pyg"  => $row00['cotizacion_detalle_fecha_pizarra_eur_pyg'],
                    "cotizacion_detalle_alta_fecha_eur_pyg"     => $row00['cotizacion_detalle_alta_fecha_eur_pyg'],
                    "cotizacion_detalle_alta_hora_eur_pyg"      => $row00['cotizacion_detalle_alta_hora_eur_pyg'],
                    "cotizacion_detalle_alta_usuario_eur_pyg"   => $row00['cotizacion_detalle_alta_usuario_eur_pyg'],

                    "cotizacion_codigo_usd_brl"                 => $row00['cotizacion_codigo_usd_brl'],
                    "moneda_base_codigo_usd_brl"                => $row00['moneda_base_codigo_usd_brl'],
                    "moneda_base_nombre_usd_brl"                => $row00['moneda_base_nombre_usd_brl'],
                    "moneda_base_bcp_usd_brl"                   => $row00['moneda_base_bcp_usd_brl'],
                    "moneda_base_path_usd_brl"                  => $row00['moneda_base_path_usd_brl'],
                    "moneda_relacionada_codigo_usd_brl"         => $row00['moneda_relacionada_codigo_usd_brl'],
                    "moneda_relacionada_nombre_usd_brl"         => $row00['moneda_relacionada_nombre_usd_brl'],
                    "moneda_relacionada_bcp_usd_brl"            => $row00['moneda_relacionada_bcp_usd_brl'],
                    "moneda_relacionada_path_usd_brl"           => $row00['moneda_relacionada_path_usd_brl'],
                    "cotizacion_detalle_codigo_usd_brl"         => $row00['cotizacion_detalle_codigo_usd_brl'],
                    "cotizacion_detalle_compra_usd_brl"         => $row00['cotizacion_detalle_compra_usd_brl'],
                    "cotizacion_detalle_venta_usd_brl"          => $row00['cotizacion_detalle_venta_usd_brl'],
                    "cotizacion_detalle_fecha_pizarra_usd_brl"  => $row00['cotizacion_detalle_fecha_pizarra_usd_brl'],
                    "cotizacion_detalle_alta_fecha_usd_brl"     => $row00['cotizacion_detalle_alta_fecha_usd_brl'],
                    "cotizacion_detalle_alta_hora_usd_brl"      => $row00['cotizacion_detalle_alta_hora_usd_brl'],
                    "cotizacion_detalle_alta_usuario_usd_brl"   => $row00['cotizacion_detalle_alta_usuario_usd_brl'],

                    "cotizacion_codigo_usd_ars"                 => $row00['cotizacion_codigo_usd_ars'],
                    "moneda_base_codigo_usd_ars"                => $row00['moneda_base_codigo_usd_ars'],
                    "moneda_base_nombre_usd_ars"                => $row00['moneda_base_nombre_usd_ars'],
                    "moneda_base_bcp_usd_ars"                   => $row00['moneda_base_bcp_usd_ars'],
                    "moneda_base_path_usd_ars"                  => $row00['moneda_base_path_usd_ars'],
                    "moneda_relacionada_codigo_usd_ars"         => $row00['moneda_relacionada_codigo_usd_ars'],
                    "moneda_relacionada_nombre_usd_ars"         => $row00['moneda_relacionada_nombre_usd_ars'],
                    "moneda_relacionada_bcp_usd_ars"            => $row00['moneda_relacionada_bcp_usd_ars'],
                    "moneda_relacionada_path_usd_ars"           => $row00['moneda_relacionada_path_usd_ars'],
                    "cotizacion_detalle_codigo_usd_ars"         => $row00['cotizacion_detalle_codigo_usd_ars'],
                    "cotizacion_detalle_compra_usd_ars"         => $row00['cotizacion_detalle_compra_usd_ars'],
                    "cotizacion_detalle_venta_usd_ars"          => $row00['cotizacion_detalle_venta_usd_ars'],
                    "cotizacion_detalle_fecha_pizarra_usd_ars"  => $row00['cotizacion_detalle_fecha_pizarra_usd_ars'],
                    "cotizacion_detalle_alta_fecha_usd_ars"     => $row00['cotizacion_detalle_alta_fecha_usd_ars'],
                    "cotizacion_detalle_alta_hora_usd_ars"      => $row00['cotizacion_detalle_alta_hora_usd_ars'],
                    "cotizacion_detalle_alta_usuario_usd_ars"   => $row00['cotizacion_detalle_alta_usuario_usd_ars'],

                    "cotizacion_codigo_eur_usd"                 => $row00['cotizacion_codigo_eur_usd'],
                    "moneda_base_codigo_eur_usd"                => $row00['moneda_base_codigo_eur_usd'],
                    "moneda_base_nombre_eur_usd"                => $row00['moneda_base_nombre_eur_usd'],
                    "moneda_base_bcp_eur_usd"                   => $row00['moneda_base_bcp_eur_usd'],
                    "moneda_base_path_eur_usd"                  => $row00['moneda_base_path_eur_usd'],
                    "moneda_relacionada_codigo_eur_usd"         => $row00['moneda_relacionada_codigo_eur_usd'],
                    "moneda_relacionada_nombre_eur_usd"         => $row00['moneda_relacionada_nombre_eur_usd'],
                    "moneda_relacionada_bcp_eur_usd"            => $row00['moneda_relacionada_bcp_eur_usd'],
                    "moneda_relacionada_path_eur_usd"           => $row00['moneda_relacionada_path_eur_usd'],
                    "cotizacion_detalle_codigo_eur_usd"         => $row00['cotizacion_detalle_codigo_eur_usd'],
                    "cotizacion_detalle_compra_eur_usd"         => $row00['cotizacion_detalle_compra_eur_usd'],
                    "cotizacion_detalle_venta_eur_usd"          => $row00['cotizacion_detalle_venta_eur_usd'],
                    "cotizacion_detalle_fecha_pizarra_eur_usd"  => $row00['cotizacion_detalle_fecha_pizarra_eur_usd'],
                    "cotizacion_detalle_alta_fecha_eur_usd"     => $row00['cotizacion_detalle_alta_fecha_eur_usd'],
                    "cotizacion_detalle_alta_hora_eur_usd"      => $row00['cotizacion_detalle_alta_hora_eur_usd'],
                    "cotizacion_detalle_alta_usuario_eur_usd"   => $row00['cotizacion_detalle_alta_usuario_eur_usd']
                );
            }

            $query->free();
        }        

        $str_conn->close();

        return $result;
    }
?>