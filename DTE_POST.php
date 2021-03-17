<?php


    require_once 'DTE_SoapService.php';   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Cliente = $_POST['FCliente'];   
        $Usuario = $_POST['FUsuario'];
        $Clave = $_POST['FClave'];
        $Nitemisor = $_POST['FNitemisor'];
        $Numautorizacionuuid = isset($_POST['FNumautorizacionuuid']) ? $_POST['FNumautorizacionuuid'] : 'NA';
        $Motivoanulacion = isset($_POST['FMotivoanulacion']) ? $_POST['FMotivoanulacion'] : '';
        $Xmldoc = isset($_POST['FXmldoc']) ? $_POST['FXmldoc'] : '';
        $URL_WSD = $_POST['FURL_WSD'];
        $OutputEDT = $_POST['FOutputEDT'];
        
        

        // Crea cliente y pasa parametros de conexión.
        $dteCliente = new FacturarlosWSDL( $Cliente,
                                            $Usuario,
                                            $Clave,
                                            $Nitemisor,
                                            $Numautorizacionuuid,
                                            $Motivoanulacion,
                                            ) ;

        try
        { 
            // Set la URL del servicio
            $dteCliente->setUrl($URL_WSD);

            // Set los datos de la factura a firmar
            $dteCliente->setXml($Xmldoc);

            // Set la ruta de salida de las facturas firmadas
            $dteCliente->setOutput($OutputEDT);

            
            /*************** LLamada a Web Service ***************/
            if ( $Numautorizacionuuid == 'NA') {
                $ResponsePAC =  $dteCliente->Execute_Firma();
            } else {
                $ResponsePAC =  $dteCliente->Execute_Anulacion();
            }

        }
        finally{
            echo $ResponsePAC->CodigoResp.'-'.$ResponsePAC->TextoResp;
            unset($ResponsePAC);
            unset($dteCliente);
        }
    
    }

?>