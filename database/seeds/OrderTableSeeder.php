<?php

use CodeDelivery\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CodeDelivery\Models\Order::class,10)->create()->each(function($o){
            for ($i=0;$i<=3;$i++){
                $o->items()->save(factory(OrderItem::class)->make([
                    'product_id'=> rand(1,5),
                    'qtd'=>rand(1,5),
                    'price'=>rand(10,50)
                ]));
            }
        });
    }
}
