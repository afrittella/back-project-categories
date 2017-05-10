<div class="row">
    <div class="col-sm-12">
        {!! Form::open(['route' => ['categories.store'], 'method' => 'post', 'class' => 'form-inline ajax-handled']) !!}
        {!! Form::hidden('parent_id', $category->id) !!}
        <div class="form-group {{ $errors->categoryChildren->has('slug') ? ' has-error' : '' }}">
            {!! Form::text('slug', null, ['class' => 'form-control', 'required' => true, 'placeholder' => trans('back-project-categories::categories.slug').' (*)']) !!}
        </div>
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

@push('bottom_scripts')
<script type="text/javascript">
$( document ) . ready( function () {
    var options = {
      success: onSuccess,
      error: onError,
      resetForm: true
    };
    $("form.ajax-handled").ajaxForm(options);

    function onSuccess(responseText, statusText, xhr, form) {
        location.reload();
    }

    function onError(response) {
        //console.log(response.responseJSON);
        if ("" !== response.responseText) {
            $.each(response.responseJSON, function(i, item) {
               var field = $("[name="+i+"]");
               field.parent("div.form-group").addClass('has-error');
            });
        }
    }
});
</script>
@endpush