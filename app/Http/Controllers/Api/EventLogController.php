<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventLogController extends Controller
{
    
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
        return response()->json([
            'status'    => 'ok'
        ]);
    }
}
