<?php

namespace Tests\Integration\Repositories;

use Afrittella\BackProjectCategories\Domain\Repositories\Categories;
use Tests\Integration\Repositories\Support\EntitiesHelper;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use EntitiesHelper;

    protected $categories;

    public function setUp()
    {
        parent::setUp();

        $this->categories = \App::make(Categories::class);
    }

    public function testCreate()
    {
        $this->createCategories();


        $this->assertTrue(count($this->categories->all()) > 0);
    }
}