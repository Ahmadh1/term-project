<?php

use Illuminate\Database\Seeder;
use App\Channel;
class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title'	=>	'Laravel Eco system', 'slug' => str_slug('Laravel Eco system') ];
        $channel2 = ['title'	=>	'Laravel Envoyer', 'slug' => str_slug('Laravel Envoyer') ];
        $channel3 = ['title'	=>	'Laravel Horizon', 'slug' => str_slug('Laravel Horizon') ];
        $channel4 = ['title'	=>	'Laravel Lumen', 'slug' => str_slug('Laravel Lumen') ];
        $channel5 = ['title'	=>	'Laravel Spark', 'slug' => str_slug('Laravel Spark') ];
        $channel6 = ['title'	=>	'Laracasts', 'slug' => str_slug('Laracasts') ];
        $channel7 = ['title'	=>	'Laravel with vue.js', 'slug' => str_slug('Laravel with vue.js') ];
        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
        Channel::create($channel7);
    }
}
