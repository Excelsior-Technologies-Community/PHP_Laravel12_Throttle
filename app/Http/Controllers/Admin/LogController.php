<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $query = ApiLog::query();

        if ($request->search) {
            $query->where('url', 'like', "%{$request->search}%");
        }

        $logs = $query->latest()->paginate(20);
        return view('admin.logs', compact('logs'));
    }
}