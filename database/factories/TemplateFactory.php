<?php
namespace Database\Factories;

use App\Models\Template;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateFactory extends Factory
{
    protected $model = Template::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'content' => '<h2>'.$this->faker->sentence(4).'</h2><p>'.$this->faker->paragraph(2).'</p>',
        ];
    }
}
