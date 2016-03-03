<?php

use CodeDelivery\Models\OAuthClient;
use Illuminate\Database\Seeder;

class OauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CodeDelivery\Models\OauthClient::class,1)->create([
            'id'=>'1',
            'secret'=>'1234',
            'name'=>'Meu app'
        ]);
    }
}
