<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller {

    public function membershipPlans() {
        $data = \App\Models\Subscription::getSubscriptions();
        return view('membership-plan', compact('data'));
    }

    public function paymentDetails($user_id, $subscription_id) {

        return view('payment-details');
    }

}
