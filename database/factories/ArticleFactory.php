<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['draft', 'published', 'archived']);
        $publishedAt = $status === 'published' ? fake()->dateTimeBetween('-1 year') : null;

        return [
            'title' => fake()->sentence(),
            'summary' => fake()->paragraph(),
            'content' => fake()->paragraphs(3, true),
            'category' => fake()->randomElement(['tech', 'life', 'book-review']),
            'cover_image' => fake()->imageUrl(640, 480, 'article'),
            'status' => $status,
            'published_at' => $publishedAt,
        ];
    }

    /**
     * 已發布的文章
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
            'published_at' => fake()->dateTimeBetween('-1 year'),
        ]);
    }

    /**
     * 草稿文章
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}
