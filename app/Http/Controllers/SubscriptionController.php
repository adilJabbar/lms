<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SubscriptionController extends Controller {

    public function membershipPlans() {
        $data = \App\Models\Subscription::getSubscriptions();
        return view('membership-plan', compact('data'));
    }

    public function paymentDetails($user_id, $subscription_id) {
        $data['user_id'] = Crypt::decrypt($user_id);
        $data['subscription_id'] = Crypt::decrypt($subscription_id);
        $subscription = \App\Models\Subscription::getSubscription($data['subscription_id']);
        $data['price'] = !empty($subscription['price']) ? $subscription['price'] : null;
//        echo "<pre>";
//        print_r($decrypted_user_id);
//        echo "<pre>";
//        print_r($decrypted_subscription_id);
//        exit;
        return view('payment-details', compact('data'));
    }

    public function savePaymentDetails(Request $request) {
        $data['user_id'] = Crypt::decrypt($request->user_id);
        $data['subscription_id'] = Crypt::decrypt($request->subscription_id);
        $data['subscription'] = \App\Models\Subscription::getSubscription($data['subscription_id']);

        $prepareData = self::prepareData($request->toArray());

        echo "<pre>";
        print_r($subscription);
        exit;
        return view('payment-details', compact('data'));
    }

    public static function prepareData($request) {
        $data = [];
        if (!empty($request)) {
            $data['']
        }
    }

}
