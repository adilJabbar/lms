<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Stripe;
use Illuminate\Support\Facades\Session;

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
    
    //stripe own page payment
//        public function paymentDetails($user_id, $subscription_id) {
//        $data['user_id'] = Crypt::decrypt($user_id);
//        $data['subscription_id'] = Crypt::decrypt($subscription_id);
//        $subscription = \App\Models\Subscription::getSubscription($data['subscription_id']);
//        $data['price'] = !empty($subscription['price']) ? $subscription['price'] : null;
//
//        $stripe = new \Stripe\StripeClient(config('paths.secret_key'));
//        $checkout_session = $stripe->checkout->sessions->create([
//            'line_items' => [[
//            'price_data' => [
//                'currency' => 'usd',
//                'product_data' => [
//                    'name' => 'T-shirt',
//                ],
//                'unit_amount' => 2000,
//            ],
//            'quantity' => 1,
//                ]],
//            'mode' => 'payment',
//            'success_url' => 'http://127.0.0.1:8000',
//            'cancel_url' => 'http://127.0.0.1:8000/membershipPlans',
//        ]);
//
//        header("HTTP/1.1 303 See Other");
//        header("Location: " . $checkout_session->url);
//
//        echo "<pre>";
//        print_r($checkout_session);
//        exit;
//
////        echo "<pre>";
////        print_r($decrypted_user_id);
////        echo "<pre>";
////        print_r($decrypted_subscription_id);
////        exit;
////        return view('payment-details', compact('data'));
//    }

    public function savePaymentDetails(Request $request) {
        if (isset($request->user_id) && isset($request->subscription_id)) {
            // check if customer already subscribed to any subscription
            $data['request_data'] = $request->toArray();
            $data['request_data']['user_id'] = Crypt::decrypt($request->user_id);
            $data['request_data']['subscription_id'] = Crypt::decrypt($request->subscription_id);
            $currentDate = date('Y-m-d H:i:s');
            $userSubscripitions = \App\Models\UserSubscribedPlan::where('user_id', '=', $data['request_data']['user_id'])
                    ->where('is_active', 1)
                    ->where('subscription_end_date', '>', $currentDate)
                    ->first();
            if (!empty($userSubscripitions)) {
                Session::flash('error', 'You have already subscribed a subscription plan!!');
                return redirect()->route('index')->with('You have already subscribed a subscription plan!');
            }
            $data['subscription'] = \App\Models\Subscription::getSubscription($data['request_data']['subscription_id']);
            $paymentMthod = self::createPaymentMethod($data);
            \Log::info('payment method');
            \Log::info($paymentMthod);
            if ($paymentMthod['success'] == false) {
                return redirect()->back()->with('Error occurred while adding payment method! please try again');
            }
            $data['payment_method_data'] = $paymentMthod['method_data'];
            $createIntnet = self::createPaymentIntentMethod($data);
            if ($createIntnet['success'] != true) {
                return redirect()->route('membershipPlans')->with('Error occurred while creating payment plan');
            }
            $data['intent_data'] = $createIntnet['data'];
            $capturePayment = self::capturePaymentIntentMethod($data);
            if ($capturePayment['success'] != true) {
                return redirect()->route('membershipPlans')->with('Error occurred while capturing payment');
            }
            $data['gateway_response'] = $capturePayment['capture_data'];
            $prepareSubscription = self::prepareData($data);
            $saveSubscription = \App\Models\UserSubscribedPlan::saveData($prepareSubscription);
            if (!$saveSubscription) {
                return redirect()->back()->with('Error occurred! please try again');
            }
            $paymentData = self::preparePaymentData($data);
            $savePayment = \App\Models\Payment::saveData($paymentData);
            if (!$savePayment) {
                return redirect()->back()->with('Error occurred! please try again');
            }
            Session::flash('success', 'Payment successful!');
            return redirect()->route('index')->with('Subscribed Successfully!');
        } else {
            return redirect()->back()->with('Error occurred! please try again');
        }
    }

    public static function prepareData($subscriptionData) {
        $data['subscription_id'] = $subscriptionData['subscription']['id'];
        $data['price'] = $subscriptionData['subscription']['price'];
        $data['user_id'] = $subscriptionData['request_data']['user_id'];
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

    public static function createPaymentIntentMethod($data = []) {
        $key = Stripe\Stripe::setApiKey(config('paths.secret_key'));
//        $stripe = new \Stripe\StripeClient(config('paths.secret_key'));
        $intent = Stripe\PaymentIntent::create([
                    "amount" => $data['subscription']['price'] * 100,
                    "currency" => "usd",
                    'payment_method' => $data['payment_method_data']->id,
                    'payment_method_types' => ['card'],
//                    "source" => $request->stripeToken,
//                    "description" => "Test payment from itsolutionstuff.com."
        ]);
        if ($intent) {
            return ['success' => true, 'data' => $intent];
        } else {
            return ['success' => false];
        }

//        Session::flash('success', 'Payment successful!');
//        return redirect()->route('membershipPlans')->with('Subscribed Successfully!');
    }

    public static function capturePaymentIntentMethod($data = []) {

//        $key = Stripe\Stripe::setApiKey(config('paths.secret_key'));
        $stripe = new \Stripe\StripeClient(config('paths.secret_key'));
        $capture = $stripe->paymentIntents->confirm(
                $data['intent_data']->id,
                [
                    'payment_method_types' => ['card'],
                ]
        );
//        Stripe\PaymentIntent::capture(
//                $data['data']->id,
//                [
//                    "amount" => 100 * 100,
//                    "currency" => "usd",
//                    'payment_method_types' => ['card'],
//                    "source" => $request->stripeToken,
//                    "description" => "Test payment from itsolutionstuff.com."
//        ]);
        if ($capture) {
            return ['success' => true, 'capture_data' => $capture];
        } else {
            return ['success' => false];
        }

//        Session::flash('success', 'Payment successful!');
//        return redirect()->route('membershipPlans')->with('Subscribed Successfully!');
    }

    public static function createPaymentMethod($data = []) {

        $stripe = new \Stripe\StripeClient(config('paths.secret_key'));

        $method = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => $data['request_data']['card_number'],
                'exp_month' => $data['request_data']['expiry_month'],
                'exp_year' => $data['request_data']['expiry_year'],
                'cvc' => $data['request_data']['cvc'],
            ],
        ]);
        if ($method) {
            return ['success' => true, 'method_data' => $method];
        } else {
            return ['success' => false];
        }
    }

    public static function preparePaymentData($data) {
        $paymentData['subscription_id'] = $data['subscription']['id'];
        $paymentData['price'] = $data['subscription']['price'];
        $paymentData['user_id'] = $data['request_data']['user_id'];
        $paymentData['exp_month'] = $data['request_data']['expiry_month'];
        $paymentData['exp_year'] = $data['request_data']['expiry_year'];
        $paymentData['card_name'] = $data['request_data']['card_name'];
        $paymentData['card_number'] = substr($data['request_data']['card_number'], 12, 16);
        $paymentData['card_type'] = !empty($data['payment_method_data']->card->brand) ? $data['payment_method_data']->card->brand : null;
        $paymentData['receipt_url'] = !isset($data['intent_data']->receipt_url) ? $data['intent_data']->receipt_url : null;
        $paymentData['payment_method_id'] = $data['payment_method_data']->id;
        $paymentData['intent_id'] = $data['intent_data']->id;
        $paymentData['gateway_response'] = !empty($data['gateway_response']) ? serialize($data['gateway_response']) : null;

        return $paymentData;
    }

}
