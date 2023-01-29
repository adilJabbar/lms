<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller {

    public function bookSlot() {
        $inputs['invitee_url'] = 'https://api.calendly.com/scheduled_events/d3f2a08e-a978-4eb5-8e88-a3ad1d0d8ffd/invitees/db25e7ea-1f5e-4285-8320-f0b4f4d1a270';
        $urlArray = (explode("/", $inputs['invitee_url']));
        $firstKey = array_search('scheduled_events', $urlArray);
        $secondKey = array_search('invitees', $urlArray);
        $data = ['event_uuid' => $urlArray[$firstKey + 1], 'invitee_uuid' => $urlArray[$secondKey + 1]];

        echo "<pre>";
        print_r($data);
        exit;
        $data = []; //fetch cards here
        $data['user_id'] = Auth::user()->id;
        return view('slotbooking', compact('data'));
    }

    public function createBooking(Request $request) {
        $inputs = $request->toArray();
//        $uri = $inputs['invitee_url'];
        $urlArray = (explode("/", $inputs['invitee_url']));
        $firstKey = array_search('scheduled_events', $urlArray);
        $secondKey = array_search('invitees', $urlArray);
        $eventUuid = $urlArray[$firstKey + 1];
        $inviteeUuid = $urlArray[$secondKey + 1];
        echo "<pre>";
        print_r($eventUuid);
        echo "<pre>";
        print_r($inviteeUuid);
        exit;
        return view('slotbooking', compact('data'));
    }

}
