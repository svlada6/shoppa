<?php

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 10000;

        for ($i = 0; $i < $limit; $i++) {
            $seed = [
                'package' => '0',
                'user_id' => '5',
                'subscription_id' => '5',
                'name' => '48 Cups',
                'price' => '44.95',
                'shipping_first_name' => 'Atanas',
                'shipping_last_name' => 'Arizanov',
                'shipping_last_name' => 'Arizanov',
                'shipping_company' => 'Cosmic',
                'shipping_address_1' => 'ul. Skopje',
                'shipping_address_2' => '',
                'shipping_city' => 'Skopje',
                'shipping_state' => '1',
                'shipping_postal' => '1000',
                'billing_first_name' => 'Atanas',
                'billing_last_name' => 'Arizanov',
                'billing_last_name' => 'Arizanov',
                'billing_company' => 'Cosmic',
                'billing_address_1' => 'ul. Skopje',
                'billing_address_2' => '',
                'billing_city' => 'Skopje',
                'billing_state' => '1',
                'billing_postal' => '1000',
                'subtotal' => '89.9',
                'billing_state_id' => '1',
                'shipping_state_id' => '1',
            ];
            
            DB::table('orders')->insert($seed);   
        }
    }
}
