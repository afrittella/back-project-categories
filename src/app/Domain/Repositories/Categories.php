<?php

namespace Afrittella\BackProjectCategories\Domain\Repositories;

use Afrittella\BackProject\Repositories\Base;

// We extend Afrittella\BackProject repository pattern
class Categories extends Base
{
    function model()
    {
        return 'Afrittella\BackProjectCategories\Domain\Models\Category';
    }

    public function all($columns = ['*'])
    {
        return $this->model->withDepth()->defaultOrder()->whereIsRoot()->select($columns)->get();
    }

    public function children($id)
    {
        return $this->model->withDepth()->defaultOrder()->descendantsOf($id)->where('parent_id', '=', $id);
    }

    public function find($id, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->withDepth()->find($id, $columns);
    }

    public function moveUp($id)
    {
        $menu = $this->model->find($id);
        return $menu->up();
    }

    public function moveDown($id)
    {
        $menu = $this->model->find($id);
        return $menu->down();
    }

    public function tree($name)
    {
        $root = $this->findBy('name', $name);
        $tree = false;

        if (!empty($root)) {
            $tree = $this->model->withDepth()->defaultOrder()->descendantsOf($root->id)->toTree();
        }

        return $tree;
    }

    public function transform($data = [], $options = [])
    {
        if (empty($data)) {
            $data = $this->all();
        }

        // Table header
        $head = [
            'columns' => [
                trans('back-project-categories::categories.slug'),
                trans('back-project-categories::categories.name'),
                trans('back-project-categories::categories.description'),
                trans('back-project-categories::categories.actions'),
            ]
        ];

        $body = [];

        foreach ($data as $row):
            $actions = [
                'edit' => ['url' => route('categories.edit', [$row->id])]
            ];

            $actions['delete'] = ['url' => route('categories.delete', [$row->id])];

            $body[] = [
                'columns' => [
                    ['content' => $row->slug],
                    ['content' => $row->name],
                    ['content' => $row->description],
                    ['content' => false, 'actions' => $actions],
                ]
            ];
        endforeach;

        return [
            'head' => $head,
            'body' => $body
        ];
    }
}