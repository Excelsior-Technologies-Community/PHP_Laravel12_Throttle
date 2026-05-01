<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiLog;

class LogController extends Controller
{
    public function index()
    {
        // 4 records per page + ascending order
        $logs = ApiLog::orderBy('id', 'asc')->paginate(4);

        return view('admin.logs', compact('logs'));
    }
}