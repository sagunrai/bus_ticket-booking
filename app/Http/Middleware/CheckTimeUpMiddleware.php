<?php

namespace App\Http\Middleware;

use App\Models\Booking;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckTimeUpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bookings = Booking::where('status','inactive')->whereNull('payment_time')->get();
        foreach($bookings as $booking){
            $inactive_time = Carbon::parse($booking->inactive_time);
            // add 10 minute
            $finish_time = $inactive_time->addMinutes(10);
            $current_time = now();
            $check = now()->gt($finish_time);
            // dd($check);
            if($check){
                $booking->delete();
            }
        }
        return $next($request);

    }
}
