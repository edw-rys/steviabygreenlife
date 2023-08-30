<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\ClientService;
use Illuminate\Http\Request;

class EventLogController extends Controller
{
    private ClientService $clientService;

    public function __construct(ClientService $clientService ) {
        $this->clientService = $clientService;
    }
    public function saveLog(Request $request) {
        $request->get('browser');
        $request->get('browserVersion');
        $request->get('funnelVar');
        $request->get('query');
        $request->get('referrer');
        $request->get('screenHeight');
        $request->get('screenWidth');
        $request->get('title');
        $request->get('type');
        $request->get('url');
        $request->get('_r');
        $request->merge([
            'action'    => 'home',
            'context'   => 'home'
        ]);
        $this->clientService->saveLogVisit($request);
        return response()->json([
            'status'    => 'ok'
        ]);
    }
}
