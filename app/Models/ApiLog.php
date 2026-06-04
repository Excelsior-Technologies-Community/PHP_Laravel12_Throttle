<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class ApiLog extends Model
{
    protected $fillable = [
        'user_id',
        'ip',
        'endpoint',
        'status_code',
        'method'
    ];

    protected static function booted()
    {
        static::created(function ($log) {
            if ($log->status_code == 429) {
                try {
                    Mail::raw("API Limit Exceeded! IP: {$log->ip} accessed {$log->endpoint}", function ($message) {
                        $message->to('admin@example.com')->subject('Alert: API Rate Limit Exceeded');
                    });
                } catch (\Exception $e) {
                    // Fail silently if mail service is not configured
                }
            }
        });
    }
}