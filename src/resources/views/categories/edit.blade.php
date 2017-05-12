@extends('back-project::layouts.admin')

@section('page-header')
    @component('back-project::components.page-title',
      [
        'breadcrumbs' => [
            [
                'url' => route('admin.dashboard'),
                'title' => trans('back-project::menu.Dashboard'),
                'icon' => 'dashboard'
            ],
            [
                'url' => route('categories.index'),
                'title' => trans('back-project::menu.Categories'),
                'icon' => 'list'
            ],
            [
                'active' => true,
                'title' => trans('back-project::crud.edit'),
            ]
        ]
      ])
        {{  ucfirst(trans('back-project::menu.Categories')) }}
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (!empty($category->parent_id))
                <a href="{{ route('categories.edit', [$category->parent_id]) }}">{!! icon('arrow-left') !!} {{ trans('back-project::crud.back') }}</a>

                @component('back-project::components.panel', ['box_title' => trans('back-project::crud.edit'), 'box_icon' => 'pencil'])
                    {!! Form::model($category, ['class' => 'form-horizontal', 'method' => 'post', 'route' => ['categories.update', $category->id]]) !!}
                    {{ method_field('PUT') }}

                    @include('back-project::components.forms.text', [
                        'name' => 'slug',
                        'title' => trans('back-project-categories::categories.slug'),
                        'attributes' => [
                            'required',
                            'autofocus'
                        ]
                    ])

                    @include('back-project::components.forms.text', [
                        'name' => 'name',
                        'title' => trans('back-project-categories::categories.name'),
                        'attributes' => [
                            'required'
                        ]
                    ])

                    @include('back-project::components.forms.text', [
                        'name' => 'description',
                        'title' => trans('back-project-categories::categories.description'),
                        'attributes' => [

                        ]
                    ])

                    @slot('box_footer')
                        <div class="pull-right">
                            @component('back-project::components.generic-button', [
                                'submit' => 'submit',
                                'color' => 'success',

                            ])
                                {{ trans('back-project::crud.save') }}
                            @endcomponent
                        </div>
                        {!! Form::close() !!}
                    @endslot
                @endcomponent
            @endif

            @if ($category->depth < 2)
                @component('back-project::components.panel', ['box_title' => (!empty($category->parent_id) ? ucfirst(trans('back-project-categories::categories.children')) : trans('back-project::crud.list')), 'box_icon' => 'sitemap', 'box_color' => 'info'])
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <small>Immagine</small>
                            </div>
                            <div class="col-md-2">
                                <small>Slug</small>
                            </div>
                            <div class="col-md-2">
                                <small>Nome/Titolo</small>
                            </div>
                            <div class="col-md-4">
                                <small>Descrizione</small>
                            </div>
                            <div class="col-md-2">
                                <small>Azioni</small>
                            </div>
                        </div>

                    </div>
                        <hr>

                        <div class="list-group">
                            @each('back-project-categories::categories.action', $children, 'category')
                        </div>

                    @slot('box_footer')
                            <h4><i class="fa fa-plus"></i> {{ trans('back-project::crud.new') }}</h4>
                        @component('back-project-categories::categories.action-add', ['category' => $category])
                        @endcomponent
                    @endslot

                @endcomponent
            @endif
        </div>
    </div>
@endsection

@include('back-project::components.upload-window', [
'title' => trans('back-project::media.upload_window_title'),
'url' => route('attachments.store')
])