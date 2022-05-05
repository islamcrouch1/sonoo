<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\Cart;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'superAdmin',
            'email' => 'admin@sonoo.online',
            'password' => bcrypt('123456789'),
            'phone' => '+201121184147',
            'country_id' => '1',
            'gender' => 'male',
            'profile' => 'avatarmale.png',
            'phone_verified_at' => '2021-10-25 22:43:41',
        ]);

        $user->attachRole('superadministrator');

        Cart::create([
            'user_id' => $user->id,
        ]);

        Balance::create([
            'user_id' => $user->id,
            'available_balance' => 0,
            'outstanding_balance' => 0,
            'pending_withdrawal_requests' => 0,
            'completed_withdrawal_requests' => 0,
            'bonus' => $user->hasRole('affiliate') ?  100 : 0,
        ]);

        $country = Country::create([
            'name_ar' => 'مصر',
            'name_en' => 'Egypt',
            'code' => '+20',
            'currency' => 'EGP',
            'image' => 'rR24VxxvUqZZYfg2PabsWAno3fXoov04dRGvupwZ.png',
        ]);
    }
}
