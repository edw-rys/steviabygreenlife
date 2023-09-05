<?php

namespace App\Service;

use App\Models\LogsActivePines;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ApiRequestService
{
    /**
     * @vars
     */
    protected $client;

    /**
     * OTPService constructor.
     */
    public function __construct($url)
    {
        $this->client = new Client([
            'base_uri'      => $url,
            'timeout'       => 100,
            'http_errors'   => false,
            'verify'        => false
        ]);

        // Ejemplo de uso
        // $data = $this->connApi->validateToken($request->token, config('app_academic.liranka_api.get_user'));
    }

    /**
     * Validate Code
     *
     * @param $id
     * @param string $code
     * @return bool|object
     */
    public function validatrPayment($id, $client_id)
    {
        // Data for logs
        $data_for_log = [
            'url'       => request()->fullUrl(),
            'email'     => request()->get('email'),
            'IP'        => $_SERVER['REMOTE_ADDR'],
        ];

        try {

            $response = $this->client->post('', [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer '.config('app.custompay.token')
                ],
                'json'    => [
                    'id'            => $id,
                    'clientTxId'    => $client_id
                ]
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            Log::error('guzzle_connect_exception', $data_for_log + ['message' => $e->getMessage()]);
            return false;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::error('guzzle_connection_timeout', $data_for_log + ['message' => $e->getMessage()]);
            // return 'Petición OTP fallida.';
        } catch (\Exception $e) {
            Log::error('guzzle_error', $data_for_log + ['message' => $e->getMessage()]);
            // return 'Guzzle';
        }
        return false;
    }

    /**
     * Validate Code
     *
     * @param $id
     * @param string $code
     * @return mixed
     */
    public function requestForPost($id, $route, string $code)
    {
        // Data for logs
        $data_for_log = [
            'url'       => request()->fullUrl(),
            'email'     => request()->get('email'),
            'IP'        => $_SERVER['REMOTE_ADDR'],
            'message'   => '',
        ];

        try {
            $response = $this->client->post($route, [
                'headers' => [
                    'Content-Type'  => 'application/json'
                ],
                'json'    => [
                    'Usuario'    => config('app_buro.otp.user'),
                    'Contrasena' => config('app_buro.otp.password'),
                    'Entidad'    => config('app_buro.otp.entity'),
                    'Canal'      => config('app_buro.otp.chanel'),
                    'ID'         => $id,
                    'Clave'      => $code,
                ]
            ]);

            $response = json_decode($response->getBody()->getContents());
            return $response->CodigoRespuesta === '000';
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            Log::error('guzzle_connect_exception', $data_for_log + ['message' => $e->getMessage()]);
            // return 'Conexión OTP fallida.';
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::error('guzzle_connection_timeout', $data_for_log + ['message' => $e->getMessage()]);
            // return 'Petición OTP fallida.';
        } catch (\Exception $e) {
            Log::error('guzzle_error', $data_for_log + ['message' => $e->getMessage()]);
            // return 'Guzzle';
        }
        return false;
    }
}
