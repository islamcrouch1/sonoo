<?php

use App\Models\Country;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;



// set localizaition in session
if (!function_exists('setLocaleBySession')) {
    function setLocaleBySession()
    {
        app()->isLocale('en') ? session(['lang' => 'ar']) : session(['lang' => 'en']);
    }
}


// send sms for verification
if (!function_exists('callToVerify')) {
    function callToVerify($user)
    {

        $code = random_int(100000, 999999);

        $user->forceFill([
            'verification_code' => $code
        ])->save();

        try {
            $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

            $client->messages->create(
                $user->phone, // to
                ["body" => "Your Sonoo Verification Code Is : {$code}", "from" => "Sonoo"]
            );
        } catch (TwilioException $e) {
            echo $e->getCode() . ' : ' . $e->getMessage() . "<br>";
        }
    }
}


// check phone verification
if (!function_exists('hasVerifiedPhone')) {
    function hasVerifiedPhone($user)
    {
        return !is_null($user->phone_verified_at);
    }
}


// make phone verified
if (!function_exists('markPhoneAsVerified')) {
    function markPhoneAsVerified($user)
    {
        return $user->forceFill([
            'phone_verified_at' => $user->freshTimestamp(),
        ])->save();
    }
}


// block user
if (!function_exists('markUserBlocked')) {
    function markUserBlocked($user)
    {
        return $user->forceFill([
            'status' => 'blocked',
        ])->save();
    }
}


// calculate date
if (!function_exists('interval')) {
    function interval($old)
    {
        $date = Carbon\Carbon::now();
        return $interval = $old->diffForHumans();
    }
}


// get phone with country code
if (!function_exists('getPhoneWithCode')) {
    function getPhoneWithCode($phone, $country)
    {
        if ($phone != null && $country != null) {
            $phone = str_replace(' ', '', $phone);
            if ($phone[0] == '0') {
                $phone[0] = ' ';
                $phone = str_replace(' ', '', $phone);
            }
            $country = Country::findOrFail($country);
            $phone = $country->code . $phone;
            return $phone;
        } else {
            return null;
        }
    }
}

// get phone without country code
if (!function_exists('getPhoneWithoutCode')) {
    function getPhoneWithoutCode($phone, $country)
    {
        if ($phone != null && $country != null) {
            $phone = str_replace(' ', '', $phone);
            $country = Country::findOrFail($country);
            $phone = str_replace($country->code, '', $phone);
            return $phone;
        } else {
            return null;
        }
    }
}


// alert success
if (!function_exists('alertSuccess')) {
    function alertSuccess($ar, $en)
    {
        app()->getLocale() == 'ar' ?
            session()->flash('success', $ar) :
            session()->flash('success', $en);
    }
}


// alert error
if (!function_exists('alertError')) {
    function alertError($ar, $en)
    {
        app()->getLocale() == 'ar' ?
            session()->flash('error', $ar) :
            session()->flash('error', $en);
    }
}


// add log
if (!function_exists('addLog')) {
    function addLog($userType, $logType, $ar, $en)
    {
        $log = Log::create([
            'user_id' => Auth::id(),
            'user_type' => 'admin',
            'log_type' => 'users',
            'description_ar' => $ar,
            'description_en' => $en,
        ]);
    }
}


// check user for trash

if (!function_exists('checkUserForTrash')) {
    function checkUserForTrash($user)
    {
        // if ($user->orders->count() > '0' || $user->messages->count() > '0' || $user->vorders->count() > '0') {
        //     return false;
        // } else {
        //     return true;
        // }

        return true;
    }
}


// check user for trash

if (!function_exists('checkCountryForTrash')) {
    function checkCountryForTrash($country)
    {
        if ($country->users()->withTrashed()->count() > '0') {
            return false;
        } else {
            return true;
        }
    }
}
