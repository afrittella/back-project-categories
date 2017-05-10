<?php namespace Afrittella\BackProjectCategories\Console\Commands;

use Afrittella\BackProject\Models\Menu;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class SeedMenu extends Command
{
    protected $signature = 'back-project:seed-categories-menu';

    protected $description = 'Seed default admin categories';

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
        $root = Menu::where('name', '=', 'admin-menu')->first();

        $node = Menu::where('name', '=', 'admin-categories')->first();

        if (empty($node)) {
            Menu::create([
                'name' => 'admin-categories',
                'permission' => 'administration',
                'title' => 'Categories',
                'description' => 'Manage your categories',
                'route' => config('back-project.route_prefix') . '/categories',
                'icon' => 'fa fa-list',
                'is_active' => 1,
                'is_protected' => 0
            ], $root);
        }

        $this->info('Seeding admin-categories' . '...');
    }
}
