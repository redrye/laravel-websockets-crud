<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Redrye\LaravelWebSocketsCrud\app\Models\UserType;
use Redrye\LaravelWebSocketsCrud\app\Models\Blog;
use Redrye\LaravelWebSocketsCrud\app\Models\BlogTag;
use Redrye\LaravelWebSocketsCrud\app\Models\User;

class ExampleTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * A basic functional test example.
	 * @test
	 * @return void
	 */
	public function should_load_blog_posts_and_display_latest_news_on_homepage()
	{
		$usertype = factory(UserType::class)->create();
		$user = factory(User::class)->create([
			'user_type_id' => $usertype->id
		]);
		$blog = factory(Blog::class)->create([
			'users_id' => $user->id
		]);
		$tag = factory(BlogTag::class)->create([
			'name' => 'public'
		]);
		DB::table('blog_tag')->insert(
			[
				'blog_id' => $blog->id,
				'tag_id' => $tag->id
			]
		);

		$this->visit('/')->see('Latest News');
	}
}
