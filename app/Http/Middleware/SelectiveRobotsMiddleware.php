<?php
namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class SelectiveRobotsMiddleware extends RobotsMiddleware
{
    protected function shouldIndex(Request $request) : string
    {
        if ($request->segment(1) === 'admin' && $request->segment(1) === 'ajax') {
            return 'noindex';
        }
        return 'all';
    }
}