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
        if (isset($request->user_id) && isset($request->subscription_id)) {
            $data['user_id'] = Crypt::decrypt($request->user_id);
            $data['subscription_id'] = Crypt::decrypt($request->subscription_id);
            $data['subscription'] = \App\Models\Subscription::getSubscription($data['subscription_id']);

            $prepareData = self::prepareData($data);
            $save = \App\Models\UserSubscribedPlan::saveData($prepareData);
            if ($save) {
                return redirect()->route('dashboard')->with('Subscribed Successfully!');
            } else {
                return redirect()->back()->with('Error occurred! please try again');
            }
        } else {
            return redirect()->back()->with('Error occurred! please try again');
        }
    }

    public static function prepareData($subscriptionData) {
        $data['subscription_id'] = $subscriptionData['subscription']['id'];
        $data['price'] = $subscriptionData['subscription']['price'];
        $data['user_id'] = $subscriptionData['user_id'];
        $data['subscription_start_date'] = date('Y-m-d H:i:s');
        if (strtolower($subscriptionData['subscription']['plans']) == 'yearly' || strtolower($subscriptionData['subscription']['plans']) == 'anually') {
            $data['subscription_end_date'] = date('Y-m-d H:i:s', strtotime($data['subscription_start_date'] . ' + 1 years'));
        } elseif (strtolower($subscriptionData['subscription']['plans']) == 'monthly') {
            $data['subscription_end_date'] = date('Y-m-d H:i:s', strtotime($data['subscription_start_date'] . ' + 1 months'));
        } elseif (strtolower($subscriptionData['subscription']['plans']) == 'weekly') {
            $data['subscription_end_date'] = date('Y-m-d H:i:s', strtotime($data['subscription_start_date'] . ' + 1 weeks'));
        }
        return $data;
    }

}
