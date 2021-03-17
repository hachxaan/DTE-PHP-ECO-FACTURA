
<?php

class FacturarlosWSDL
{
    private static $Url = '';
    private static $Cliente = '';
    private static $Usuario = '';
    private static $Clave = '';
    private static $NitEmisor = '';
    private static $Xmldoc = '';
    private static $Numautorizacionuuid = ''; 
    private static $Motivoanulacion = '';
    private static $OutputFiles = '';
    private static $client;
    private static $params = [];


    // *********************************** F  I  R  M  A  ************************************* //
    public function Execute_Firma(){
        try {       
            // Inicializa parametros
            $this->init('FIRMA');
            /*************** LLamada a Web Service ***************/
            $Respuesta = $this->ExecuteServicio();
            return $this->procesaRespuesta($Respuesta, $this);;
        }
        catch(\Exception $e) {
            $ResultE = new \stdClass(); 
            $ResultE->CodigoResp = -1;
            $ResultE->TextoResp  = $e->getMessage();
            return $ResultE;
        }
    }

    // **************************** A  N  U  L  A  C  I  O  N  ******************************** //
    public function Execute_Anulacion(){
        try {       
            $this->init('ANULACION');
            /*************** LLamada a Web Service ***************/
            $Respuesta = $this->ExecuteServicio();
            return $this->procesaRespuesta($Respuesta, $this);;
        }
        catch(\Exception $e) {
            $ResultE = new \stdClass(); 
            $ResultE->CodigoResp = -1;
            $ResultE->TextoResp  = $e->getMessage();
            return $ResultE;
        }
    }
    /************************************************************************************************/
    private static function procesaRespuesta ( $Respuesta, $aOwner ) {
       
        $Result = new \stdClass();            
        $Result->TextoResp = "OK"; 
        // Revisa si hay error
        $Error = $Respuesta->Error;                                 
        if ($Error) {
            
            $CodeResp = $Error->xpath("//Error")[0]->attributes()->Codigo;
            $ErroresRespuesta = $Respuesta->xpath("//Errores");
            $Result->TextoResp = "";
            foreach ($Respuesta->Error as $NodoError) 
            {
                $Result->TextoResp .= "("."[".$NodoError[0]->attributes()->Codigo."] ".$NodoError[0] ."); ";
            }
        } else
        {
            $CodeResp = 0;           
        }
        if ( ($CodeResp == 0) || ($CodeResp == 2001) ){ 
            /* Si la Factura ha sido FIRMADA O ANULADA con 
                exito o si ya ha sido firmada anteriormente,
                el PAC envia los archivo de la factura en XML y PDF */
            
            // Decodifica XML y PDF de Base64 a String
            $XmlText   = base64_decode($Respuesta->Xml);
            $PdfText   = base64_decode($Respuesta->Pdf);
            
            // Obtiene el nodo de los atributos del XML de la respuesta del PAC
            $NameFile = $Respuesta->xpath("//DTE");
            
            // Genera el nombre de la factura.
            if ($aOwner::$Numautorizacionuuid == 'NA'){
                $NameFile = (string) $NameFile[0]->attributes()->NumeroAutorizacion."_".
                            (string) $NameFile[0]->attributes()->Numero."_".
                            (string) $NameFile[0]->attributes()->Serie;
            } else
            {
                $NameFile = "Anulado_".$aOwner::$Numautorizacionuuid;
                
            }
            // Guarda lor archivos en la ruta especificada en setOutput() 
            $aOwner->SaveFiles($NameFile, $XmlText, $PdfText );

        }
        $Result->CodigoResp = $CodeResp;
        return $Result;
    }
    /************************************************************************************************/
    private static function init( $ServicioTipo ){
        // Crea instancia del Cliente SOAP
        self::$client = new SoapClient(self::$Url); 
        
        if ($ServicioTipo == 'FIRMA'){
            self::$params = array(
                'Cliente'   => self::$Cliente,
                'Usuario'   => self::$Usuario,
                'Clave'     => self::$Clave,
                'Nitemisor' => self::$NitEmisor,
                'Xmldoc'    => self::$Xmldoc
            );
        }
        if ($ServicioTipo == 'ANULACION'){
            self::$params = array(
                'Cliente'             => self::$Cliente,
                'Usuario'             => self::$Usuario,
                'Clave'               => self::$Clave,
                'Nitemisor'           => self::$NitEmisor,
                'Numautorizacionuuid' => self::$Numautorizacionuuid,
                'Motivoanulacion'     => self::$Motivoanulacion,
            );
        }

    }
    /************************************************************************************************/
    private static function ExecuteServicio(){
        $response  = self::$client->__soapCall("Execute", array(self::$params));
        return simplexml_load_string($response->Respuesta);
    }
    /************************************************************************************************/
    private static function SaveFiles($aNameFile, $aXmlText, $aPdfText){
        
        $XmlFile = fopen(self::$OutputFiles.$aNameFile.".xml", "w");
        fwrite($XmlFile, $aXmlText);
        $PDFFile = fopen(self::$OutputFiles.$aNameFile.".pdf", "w");
        fwrite($PDFFile, $aPdfText);

    }
    /************************************************************************************************/    
    public static function setOutput($value){
        self::$OutputFiles = $value;
    }
    /************************************************************************************************/
    public static function setUrl($value){
        self::$Url = $value;
    }
    /************************************************************************************************/
    public static function setXml($value){
        self::$Xmldoc = $value;
    }    
    /************************************************************************************************/
    public function __construct(string $aCliente, 
                                string $aUsuario, 
                                string $aClave,
                                string $aNitEmisor,
                                string $aNumAutorizacionUUID,
                                string $aMotivoAnulacion,
                                ){
                                self::$Cliente = $aCliente;
                                self::$Usuario = $aUsuario;
                                self::$Clave = $aClave;
                                self::$NitEmisor = $aNitEmisor; 
                                self::$Numautorizacionuuid = $aNumAutorizacionUUID;
                                self::$Motivoanulacion = $aMotivoAnulacion; 

                                self::objectThis($this);    

    }
    /************************************************************************************************/
    public function objectThis($object = null) {
        if (!$object) {
            foreach ($this as $property_name => $property_values) {
                if (is_array($property_values)) {
                    $this->{$property_name} = $this->objectThis($property_values);
                }
            }
        } else {
            $object2 = new stdClass();
            foreach ($object as $index => $values) {
                if (is_array($values)) {
                    $object2->{$index} = $this->objectThis($values);
                } else {
                    $object2->{$index} = $values;
                }
            }
            return $object2;
        }
    }

    

}

?>