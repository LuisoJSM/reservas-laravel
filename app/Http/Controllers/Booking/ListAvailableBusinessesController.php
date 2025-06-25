<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Business;


class ListAvailableBusinessesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $businesses = Business::with('schedules')->get();
        return view('business.list', compact('businesses'));
    }
}
