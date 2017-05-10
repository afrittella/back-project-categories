<?php namespace Afrittella\BackProjectCategories\Console\Commands;

use Afrittella\BackProjectCategories\Domain\Models\Category;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class SeedDefaultCategories extends Command
{
    protected $signature = 'back-project:seed-default-categories';

    protected $description = 'Seed default categories';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $exists = Category::where('slug', '=', 'root')->first();

        if (empty($exists)) {
            $nodes = [
                'name' => 'Root',
                'slug' => 'root',
                'description' => 'Base category. Please don\'t delete it',
                'children' => [
                    [
                        'name' => 'Example category',
                        'slug' => 'example-category',
                        'description' => 'Try to edit this category, clicking on "modify" button"'
                    ]
                ]
            ];

            Category::create($nodes);
        }

        $this->info('Seeding admin-categories' . '...');
    }
}
