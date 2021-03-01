<?php

use Illuminate\Database\Seeder;
use Modules\Sender\Entities\Sender;
use Modules\Traveller\Entities\Traveller;
use Modules\Admin\Entities\Airport;
use Modules\Admin\Entities\Package;
use Modules\Traveller\Entities\Journey;
use Modules\Sender\Entities\Order;
use Modules\Sender\Entities\Item;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $senders = [
            ['name'=>'Sender 01', 'email'=>'sender01@yankit.com', 'phone'=>'5436556890', 'email_verified_at'=>now(), 'password'=>bcrypt('sender01'), 'user_type'=>'Sender'],
            ['name'=>'Sender 02', 'email'=>'sender02@yankit.com', 'phone'=>'7895345679', 'email_verified_at'=>now(), 'password'=>bcrypt('sender02'), 'user_type'=>'Sender'],
        ];
        Sender::insert($senders);

        $travellers = [
            ['name'=>'Traveller 01', 'email'=>'traveller01@yankit.com', 'phone'=>'4533465675', 'email_verified_at'=>now(), 'password'=>bcrypt('traveller01'), 'user_type'=>'Traveller'],
            ['name'=>'Traveller 02', 'email'=>'traveller02@yankit.com', 'phone'=>'6864567899', 'email_verified_at'=>now(), 'password'=>bcrypt('traveller02'), 'user_type'=>'Traveller'],
        ];
        Traveller::insert($travellers);

        $airports = [
            ['name'=>'Sydney Airport', 'address'=>'Sydney NSW 2020, Australia'],
            ['name'=>'Canberra Airport', 'address'=>'Terminal Cct, Australian Capital Territory 2609, Australia'],
            ['name'=>'Melbourne Airport', 'address'=>'Melbourne Airport VIC 3045, Australia'],
            ['name'=>'Brisbane Airport', 'address'=>'Airport Dr, Brisbane Airport QLD 4008, Australia'],
            ['name'=>'Adelaide Airport', 'address'=>'1 James Schofield Dr, Adelaide Airport SA 5950, Australia'],
            ['name'=>'Perth Airport', 'address'=>'Perth Airport WA 6105, Australia'],
        ];
        Airport::insert($airports);

        $packages = [
            ['weight'=>'0-5 KG', 'price'=>50, 'currency_symbol'=>'$', 'currency_code'=>'AUD'],
            ['weight'=>'06-10 KG', 'price'=>90, 'currency_symbol'=>'$', 'currency_code'=>'AUD'],
            ['weight'=>'11-15 KG', 'price'=>120, 'currency_symbol'=>'$', 'currency_code'=>'AUD'],
            ['weight'=>'16-20 KG', 'price'=>150, 'currency_symbol'=>'$', 'currency_code'=>'AUD'],
            ['weight'=>'21-25 KG', 'price'=>190, 'currency_symbol'=>'$', 'currency_code'=>'AUD'],
            ['weight'=>'26 KG', 'price'=>210, 'currency_symbol'=>'$', 'currency_code'=>'AUD'],
        ];
        Package::insert($packages);

        $journeys = [
            ['traveller_id'=>3, 'departure_airport_id'=>1, 'destination_airport_id'=>2, 'package_id'=>1, 'weight'=>'0-5 KG', 'currency_symbol'=>'$', 'currency_code'=>'AUD', 'price'=>35, 'title'=>'First Journey', 'pickup_date'=>now(), 'pickup_start_time'=>now(), 'pickup_end_time'=>now(), 'description'=>'First journey'],
            ['traveller_id'=>4, 'departure_airport_id'=>2, 'destination_airport_id'=>1, 'package_id'=>2, 'weight'=>'06-10 KG', 'currency_symbol'=>'$', 'currency_code'=>'AUD', 'price'=>63, 'title'=>'Second Journey', 'pickup_date'=>now(), 'pickup_start_time'=>now(), 'pickup_end_time'=>now(), 'description'=>'Second journey'],
        ];
        Journey::insert($journeys);

        $orders = [
            ['sender_id'=>1, 'departure_airport_id'=>1, 'destination_airport_id'=>2, 'title'=>'First Order', 'pickup_date'=>now(), 'pickup_start_time'=>now(), 'pickup_end_time'=>now(), 'description'=>'First order'],
            ['sender_id'=>2, 'departure_airport_id'=>2, 'destination_airport_id'=>1, 'title'=>'Second Order', 'pickup_date'=>now(), 'pickup_start_time'=>now(), 'pickup_end_time'=>now(), 'description'=>'Second order'],
        ];
        Order::insert($orders);

        $items = [
            ['order_id'=>1, 'package_id'=>1, 'weight'=>'0-5 KG', 'description'=>'First Item', 'currency_symbol'=>'$', 'currency_code'=>'USD', 'price'=>50],
            ['order_id'=>2, 'package_id'=>1, 'weight'=>'0-5 KG', 'currency_symbol'=>'$', 'currency_code'=>'USD', 'price'=>50, 'description'=>'Second Item'],
            ['order_id'=>2, 'package_id'=>2, 'weight'=>'5-15 KG', 'currency_symbol'=>'$', 'currency_code'=>'USD', 'price'=>60, 'description'=>'Third Item'],
        ];
        Item::insert($items);
    }
}
