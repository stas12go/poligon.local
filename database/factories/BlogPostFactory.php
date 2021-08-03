<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText(rand(40, 60));
        $txt = $this->faker->realText(rand(1000, 3000));
        $isPublished = rand(1, 5) > 1;
        $createdAt = $this->faker->dateTimeBetween('-7 months', '-2 months');

        return [
            'category_id' => rand(1, 11),
            'user_id' => (rand(1, 5) === 5) ? 1 : 2,
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->realText(rand(40, 100)),
            'content_raw' => $txt,
            'content_html' => $txt,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? $this->faker->dateTimeBetween('-2 months', 'now') : null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
