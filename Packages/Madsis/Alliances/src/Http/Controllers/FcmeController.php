<?php

namespace Madsis\Alliances\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp;
use Route;
use Exception;
use Carbon\Carbon;


class FcmeController extends Controller
{
    public function index()
    {
        $route =Route::currentRouteName();
        
        return view('fcme.index')
        ->with('route',$route)
        ;
    }

    public function getDocCredito(Request $request)
    {
        $url= 'https://siaf.fcme.com.ec:8084/BuroParticipe/api/SolicitudCredito/GetDocCredito';
        
        $data = array(
            'co_empr' => $request->input('co_empr'),
            'co_prvd' => $request->input('co_prvd'),
            'co_token' => $request->input('co_token'),
            'opcion' => $request->input('opcion'),
            'num_operacion' => $request->input('num_operacion'),
            'co_orig_ext' => $request->input('co_orig_ext'),
            'co_refe_ext' => $request->input('co_refe_ext')
        );/*
        $data = array(
            'co_empr' => 1,
            'co_prvd' => '2907',
            'co_token' => 't4JT-a__pmdcrUY*8lIL',
            'opcion' => 1,
            'num_operacion' => '028-018-011711145',
            'co_orig_ext' => '',
            'co_refe_ext' => ''
        );*/
        try {
            $client = new GuzzleHttp\Client();

            $response = $client->post($url, [
                GuzzleHttp\RequestOptions::JSON => $data
            ]);
            $datos= json_decode($response->getBody()->getContents());
        } 
        catch (Exception $e) {
            return response()->json(['Mensaje' => $e->getMessage()]);
        }
        

        return response()->json($datos);
        
    }

    public function getPermiteCredito(Request $request)
    {
        $url= 'https://siaf.fcme.com.ec:8084/BuroParticipe/api/SolicitudCredito/GetPermiteCredito';
        
        $data = array(
            'co_empr' => $request->input('co_empr'),
            'co_prvd' => $request->input('GetPermiteCreditoco_prvd'),
            'co_token' => $request->input('co_token'),
            'ci_cedula' => $request->input('ci_cedula'),
            'ti_cred' => $request->input('ti_cred'),
            'co_rol' => $request->input('co_rol')
        );
        try {
            $client = new GuzzleHttp\Client();

            $response = $client->post($url, [
                GuzzleHttp\RequestOptions::JSON => $data
            ]);
            $datos= json_decode($response->getBody()->getContents());
        } 
        catch (Exception $e) {
            return response()->json(['Mensaje' => $e->getMessage()]);
        }

        return response()->json($datos);
        
    }

    public function SetEliminaCredito(Request $request)
    {
        $url= 'https://siaf.fcme.com.ec:8084/BuroParticipe/api/SolicitudCredito/SetEliminaCredito';
        
        $data = array(
            'co_empr' => $request->input('co_empr'),
            'co_prvd' => $request->input('co_prvd'),
            'co_token' => $request->input('co_token'),
            'num_operacion' => $request->input('elimina_num_operacion'),
            'co_orig_ext' => $request->input('co_orig_ext'),
            'co_refe_ext' => $request->input('co_refe_ext')
        );

        try {
            $client = new GuzzleHttp\Client();

            $response = $client->post($url, [
                GuzzleHttp\RequestOptions::JSON => $data
            ]);
            $datos= json_decode($response->getBody()->getContents()); 
        } 
        catch (Exception $e) {
            return response()->json(['Mensaje' => $e->getMessage()]);
        }

        return response()->json($datos);
        
        
    }

}
