<?php

use Illuminate\Database\Seeder;
use App\Discussion;
class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title1 = 'oAuth with package';
        $title2 = 'Auth with Socialite';
        $title3 = 'Building a CMS with Laravel Spark';
        $title4 = 'Free tour of Laravel Horizon';

        $discussion1 = [
        	'title' =>	$title1,
        		'content'	=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, rutrum a blandit vel, maximus sed nisi.',
        			'channel_id' =>	8,
        				'user_id'	=>	1,
        					'slug'	=> str_slug($title1)
        ];
        $discussion2 = [
        	'title' =>	$title2,
        		'content'	=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, rutrum a blandit vel, maximus sed nisi.',
        			'channel_id' =>	9,
        				'user_id'	=>	2,
        					'slug'	=> str_slug($title2)
        ];
        $discussion3 = [
        	'title' =>	$title3,
        		'content'	=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, rutrum a blandit vel, maximus sed nisi.',
        			'channel_id' =>	5,
        				'user_id'	=>	2,
        					'slug'	=> str_slug($title3)
        ];
        $discussion4 = [
        	'title' =>	$title4,
        		'content'	=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, rutrum a blandit vel, maximus sed nisi.',
        			'channel_id' =>	3,
        				'user_id'	=>	1,
        					'slug'	=> str_slug($title4)
        ];
        Discussion::create($discussion1);
        Discussion::create($discussion2);
        Discussion::create($discussion3);
        Discussion::create($discussion4);
    }
}
