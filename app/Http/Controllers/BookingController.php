<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller {

    public function bookSlot() {

        $data = []; //fetch cards here
        $data['user_id'] = Auth::user()->id;
        return view('slotbooking', compact('data'));
    }

}
