<div class="row">
    <div class="col-sm-12">
        {!! Form::open(['route' => ['categories.store'], 'method' => 'post', 'class' => 'form-inline ajax-handled']) !!}
        {!! Form::hidden('parent_id', $category->id) !!}
        <div class="form-group {{ $errors->categoryChildren->has('name') ? ' has-error' : '' }}">
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => trans('back-project-categories::categories.name').' (*)']) !!}
        </div>
        <div class="form-group {{ $errors->categoryChildren->has('description') ? ' has-error' : '' }}">
            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => trans('back-project-categories::categories.description')]) !!}
        </div>
        @component('back-project::components.generic-button', [
            'submit' => 'submit',
            'color' => 'success',
            'icon' => 'add'
        ])
        @endcomponent

        {!! Form::close() !!}
    </div>
</div>

@include('back-project::inc.ajax-action-add')