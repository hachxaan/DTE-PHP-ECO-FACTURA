
<html>
  <head>
    <title>Test DTE para Carlos Arce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .areaXML {
          height : 500px;
        }
    </style>
  </head>
  <body>
    <div class="container">
      <h2>Pruebas facturacion Carlos Arce</h2>
        <div class="panel panel-success">
          <div class="panel-heading"><h3>Firma</h3></div>
            <div class="panel-body pr-5">
              <form class="row" action="DTE_POST.php" method="post">
                <div class="form-group">
                  <input  class="btn btn-primary" type="submit" value="Envar">
                </div>
                <div class="form-group">
                  <label>Cliente</label>
                  <input class="form-control" name="FCliente" type="text" value="80000000114K">
                </div>

                <div class="form-group">
                  <label>Usuario</label>
                  <input class="form-control" name="FUsuario" type="text" value="ADMIN">
                </div>


                <div class="form-group">
                  <label>Clave</label>
                  <input class="form-control" name="FClave" type="text" value="123">
                </div>

                <div class="form-group">
                  <label>NIT Emisor</label>
                  <input class="form-control" name="FNitemisor" type="text" value="80000000114K">
                </div>


                <div class="form-group">
                  <label>Ruta de donde se crearán las facturas (XML, PDF)</label>
                  <input class="form-control" name="FOutputEDT" type="text" value="./OutputEDTFirmados/">
                </div>                
                
                <div class="form-group">
                  <label>URL Web Services</label>
                  <input class="form-control" name="FURL_WSD" type="text" value="http://pruebas.ecofactura.com.gt:8080/fel/adocumento?wsdl">
                </div>                      
                          

                
                <div class="form-group mt-5">
                  <label>XNL Datos de facturación</label>
                  <textarea type="input" class="col-12 areaXML" name="FXmldoc" type="textarea" ><stdTWS xmlns="FEL">
                              <TrnEstNum>1</TrnEstNum>
                              <TipTrnCod>FACT</TipTrnCod>
                              <TrnNum>198</TrnNum>
                              <TrnFec>2020-03-17</TrnFec>
                              <MonCod>GTQ</MonCod>
                              <TrnBenConNIT>CF</TrnBenConNIT>
                              <TrnExp>0</TrnExp>
                              <TrnExento>0</TrnExento>
                              <TrnFraseTipo>0</TrnFraseTipo>
                              <TrnEscCod>0</TrnEscCod>
                              <TrnEFACECliCod></TrnEFACECliCod>
                              <TrnEFACECliNom>Jorge Perez</TrnEFACECliNom>
                              <TrnEFACECliDir>Sanarate</TrnEFACECliDir>
                              <TrnObs>0</TrnObs>
                              <TrnEmail>ABCD@gmail.com;ABCD@hotmail.com</TrnEmail>
                              <TrnCampAd01>ABCD 01</TrnCampAd01>
                              <TrnCampAd02>ABCD 02</TrnCampAd02>
                              <TrnCampAd03>ABCD 03</TrnCampAd03>
                              <TrnCampAd04>ABCD 04</TrnCampAd04>
                              <TrnCampAd05>ABCD 05</TrnCampAd05>
                              <TrnCampAd06>ABCD 06</TrnCampAd06>
                              <TrnCampAd07>ABCD 07</TrnCampAd07>
                              <TrnCampAd08>ABCD 08</TrnCampAd08>
                              <TrnCampAd09>ABCD 09</TrnCampAd09>
                              <TrnCampAd10>ABCD 10</TrnCampAd10>
                              <TrnCampAd11>ABCD 11</TrnCampAd11>
                              <TrnCampAd12>ABCD 12</TrnCampAd12>
                              <TrnCampAd13>ABCD 13</TrnCampAd13>
                              <TrnCampAd14>ABCD 14</TrnCampAd14>
                              <TrnCampAd15>ABCD 15</TrnCampAd15>
                              <TrnCampAd16>ABCD 16</TrnCampAd16>
                              <TrnCampAd17>ABCD 17</TrnCampAd17>
                              <TrnCampAd18>ABCD 18</TrnCampAd18>
                              <TrnCampAd19>ABCD 19</TrnCampAd19>
                              <TrnCampAd20>ABCD 20</TrnCampAd20>
                              <TrnCampAd21>ABCD 21</TrnCampAd21>
                              <TrnCampAd22>ABCD 22</TrnCampAd22>
                              <TrnCampAd23>ABCD 23</TrnCampAd23>
                              <TrnCampAd24>ABCD 24</TrnCampAd24>
                              <TrnCampAd25>ABCD 25</TrnCampAd25>
                              <TrnCampAd26>ABCD 26</TrnCampAd26>
                              <TrnCampAd27>ABCD 27</TrnCampAd27>
                              <TrnCampAd28>ABCD 28</TrnCampAd28>
                              <TrnCampAd29>ABCD 29</TrnCampAd29>
                              <TrnCampAd30>ABCD 30</TrnCampAd30>
                              <stdTWSD>
                                <stdTWS.stdTWSCIt.stdTWSDIt>
                                  <TrnLiNum>1</TrnLiNum>
                                  <TrnArtCod>10101</TrnArtCod>
                                  <TrnArtNom>Producto rojo</TrnArtNom>
                                  <TrnCan>1</TrnCan>
                                  <TrnVUn>750</TrnVUn>
                                  <TrnUniMed>UNI</TrnUniMed>
                                  <TrnVDes>0</TrnVDes>
                                  <TrnArtBienSer>B</TrnArtBienSer>
                                  <TrnArtImpAdiCod>0</TrnArtImpAdiCod>
                                  <TrnArtImpAdiUniGrav>0</TrnArtImpAdiUniGrav>
                                  <TrnDetCampAdi01>ABCD 01</TrnDetCampAdi01>
                                  <TrnDetCampAdi02>ABCD 02</TrnDetCampAdi02>
                                  <TrnDetCampAdi03>ABCD 03</TrnDetCampAdi03>
                                  <TrnDetCampAdi04>ABCD 04</TrnDetCampAdi04>
                                  <TrnDetCampAdi05>ABCD 05</TrnDetCampAdi05>
                                </stdTWS.stdTWSCIt.stdTWSDIt>
                                <stdTWS.stdTWSCIt.stdTWSDIt>
                                  <TrnLiNum>2</TrnLiNum>
                                  <TrnArtCod>20202</TrnArtCod>
                                  <TrnArtNom>Producto Amarillo</TrnArtNom>
                                  <TrnCan>5</TrnCan>
                                  <TrnVUn>320.23</TrnVUn>
                                  <TrnUniMed>UNI</TrnUniMed>
                                  <TrnVDes>0</TrnVDes>
                                  <TrnArtBienSer>B</TrnArtBienSer>
                                  <TrnArtImpAdiCod>0</TrnArtImpAdiCod>
                                  <TrnArtImpAdiUniGrav>0</TrnArtImpAdiUniGrav>
                                </stdTWS.stdTWSCIt.stdTWSDIt>
                              </stdTWSD>
                            </stdTWS></textarea>
                </div>    
          
                
              </form>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>