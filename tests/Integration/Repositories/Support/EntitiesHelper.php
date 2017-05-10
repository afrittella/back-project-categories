<?php
namespace Tests\Integration\Repositories\Support;

use Faker\Factory;

trait EntitiesHelper
{
    public function createCategories()
    {
        $faker = Factory::create();

        $root = $this->categories->create([
            'name' => 'Root',
            'slug' => 'root',
            'description' => 'Base category. Please don\'t delete it'
        ]);

        for ($i = 0; $i < 10; $i++) {

            $this->categories->create([
               'name' => $faker->text(100),
                'slug' => $faker->slug(),
                'description' => $faker->text(),
                'parent_id' => $root->id
            ]);
        }
    }
}