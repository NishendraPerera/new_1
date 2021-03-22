<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = ['Cash on Delivery', 'Card', 'Cheque'];

        foreach($payments AS $data){
            $payment = new \App\PaymentMethod;
            $payment->name = $data;
            $payment-> save();
        }

        $deliveries = ['Courier', 'Pickup'];

        foreach($deliveries AS $data){
            $delivery = new \App\DeliveryMethod;
            $delivery->name = $data;
            $delivery-> save();
        }
    }
}
