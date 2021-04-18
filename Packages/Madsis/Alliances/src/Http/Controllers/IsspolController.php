<?php

namespace Madsis\Alliances\Http\Controllers;

use Illuminate\Http\Request;
use SoapClient;
use Route;
use Exception;
use Carbon\Carbon;


class IsspolController extends Controller
{
    //
    private static $wsdl = 'http://www.isspol.org.ec:2320/WSISSPOLCC/WSCreditoAfiliadoCC?wsdl';
    private static $options = array('location' => 'http://www.isspol.org.ec:2320/WSISSPOLCC/WSCreditoAfiliadoCC');


    public function index()
    {
        $route =Route::currentRouteName();
        
        return view('isspol.index')
        ->with('route',$route)
        ;
    }
    public function getConsultarAfiliado(Request $request)
    {
        
            $parametros =array('Cedula'=>$request->input('Ndocumento'),'CodigoAlmacen'=>'11');

            //$parametros =array('FechaInicio'=>'01/01/2018','FechaFin'=>'22/09/2018','CodigoAlmacen'=>'11');
           
            try {
                $soap = new SoapClient(self::$wsdl, self::$options);
                $data = $soap->ConsultarAfiliadoCC($parametros);
            }
            catch(Exception $e) {
                die($e->getMessage());
            }
            
            return response()->json($data);
    }


    public function getConsultarCreditos(Request $request)
    {
  
            $parametros =array('FechaInicio'=>$request->input('FechaInicio'),'FechaFin'=>$request->input('FechaFin'),'CodigoAlmacen'=>'11');
            try {
                $soap = new SoapClient(self::$wsdl, self::$options);
                $data = $soap->ConsultarCreditosCC($parametros);
            }
            catch(Exception $e) {
                die($e->getMessage());
            }
            
            return response()->json($data);
    }

    public function getConsultarGarante(Request $request)
    {
        
            $parametros =array('Cedula'=>$request->input('Ndocumento'),'CodigoAlmacen'=>'11');

            try {
                $soap = new SoapClient(self::$wsdl, self::$options);
                $data = $soap->ConsultarGaranteCC($parametros);
                
            }
            catch(Exception $e) {
                die($e->getMessage());
            }
            
            return response()->json($data);
    }

    public function getVerificarCredito(Request $request)
    {

            $CedulaAfiliado= $request->input('CedulaAfiliado');
            $CedulaGarante= $request->input('CedulaGarante');
            $Factura = $request->input('Factura');
            $Fecha = Carbon::now()->format('d/m/Y');
            $Monto = $request->input('Monto');

            //Calculando el pago mensual basado en la función pago excel
            $SeguroDesg = 1;
            $GastosAdm = 0.15;
            $Interes = 7.0;
            $InteresTotal = $Interes + $SeguroDesg + $GastosAdm;
            
            $Plazo = 84;
            $InteresTotal = $InteresTotal / 12 / 100 ;
            $I2 = $InteresTotal + 1 ;
            $I2 = pow($I2,-$Plazo);
            $DivMensual = ($InteresTotal * $Monto) / (1 - $I2); 
            $DivMensual = number_format((float)$DivMensual, 2, '.', '');//round($DivMensual, 2); 
            
            
            $xml='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsc="http://isspol.org.ec/WSCreditoAfiliadoCC">
            <soapenv:Body>
               <wsc:VerificarCreditoCC>
                  <!--Optional:-->
                  <Credito>
                     <Cedula>'.$CedulaAfiliado.'</Cedula>
                     <CedulaGarante>'.$CedulaGarante.'</CedulaGarante>
                     <CodigoAlmacen>11</CodigoAlmacen>
                     <DivMensual>'.$DivMensual.'</DivMensual>
                     <FechaCredito>'.$Fecha.'</FechaCredito>
                     <GastosAdm>'.$GastosAdm.'</GastosAdm>
                     <Interes>'.$Interes.'</Interes>
                     <Monto>'.$Monto.'</Monto>
                     <Operacion>'.$Factura.'</Operacion>
                     <Plazo>'.$Plazo.'</Plazo>
                     <SeguroDesg>'.$SeguroDesg.'</SeguroDesg>
                  </Credito>
               </wsc:VerificarCreditoCC>
            </soapenv:Body>
         </soapenv:Envelope>';
            /*
            $options = array(
                
                'uri'=>'http://www.isspol.org.ec:2320/WSISSPOLCC/WSCreditoAfiliadoCC?wsdl',
                'exceptions'=>false, 
                'trace'=>1, 
                'style'=>SOAP_DOCUMENT,
                'soap_version'=>SOAP_1_1,
                'location' => 'http://www.isspol.org.ec:2320/WSISSPOLCC/WSCreditoAfiliadoCC'
                );
            */
            try 
            {
               
                $parametros =
                array( 
                    "VerificarCreditoCC" => array( 
                        'Cedula'=>$CedulaAfiliado,
                        'CedulaGarante'=>$CedulaGarante,
                        'CodigoAlmacen'=> '11',
                        'DivMensual'=>$DivMensual,
                        'FechaCredito'=>$Fecha,
                        'GastosAdm'=> $GastosAdm,
                        'Interes'=>$Interes,
                        'Monto'=>$Monto,
                        'Operacion'=> $Factura,
                        'Plazo'=> $Plazo,
                        'SeguroDesg'=> $SeguroDesg
                ) );
                
                $soap = new SoapClient(self::$wsdl, self::$options);
                //$result = $soap->VerificarCreditoCC($parametros);
                //$result = $soap->__soapCall("VerificarCreditoCC",$parametros, $options, null); 
                $result = $soap->__doRequest($xml, self::$wsdl, '', 1);
          

                
            }
            catch(Exception $e) {
                die($e->getMessage());
                /*var_dump($e->__getLastRequest());
                var_dump($e->__getLastResponse());*/
            }
            
            return response()->json($result);
    }
    public function getAnularCredito(Request $request)
    {     
            $parametros =array(
                'Cedula'=>$request->input('AnularCreditoCedula'),
                'NumeroOperacion'=>$request->input('AnularCreditoOperacion'),
                'CodigoAlmacen'=>'11'
            );

            try {
                $soap = new SoapClient(self::$wsdl, self::$options);
                $data = $soap->AnularCreditoCC($parametros);
                
            }
            catch(Exception $e) {
                die($e->getMessage());
            }
            
            return response()->json($data);
    }
}
