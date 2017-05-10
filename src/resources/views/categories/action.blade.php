<div class="col-md-2">
    {{ $category->slug }}
</div>

<div class="col-md-4">
    {{ $category->name }}
</div>

<div class="col-md-4">
    {{ $category->description}}
</div>

<div class="col-md-2">
    @component('back-project::components.generic-button-link', [
        'icon' => 'edit',
        'url' => route('categories.edit', $category->id),
        'color' => 'default',
        'class' => 'xs'
    ])
    @endcomponent

    @component('back-project::components.generic-button-link', [
        'icon' => 'delete',
        'url' => route('categories.delete', $category->id),
        'color' => 'danger',
        'action' => 'delete',
        'class' => 'xs'
    ])
    @endcomponent

    @component('back-project::components.generic-button-link', [
        'icon' => 'up',
        'url' => route('categories.up', $category->id),
        'color' => 'primary',
        'class' => 'xs'
    ])
    @endcomponent

    @component('back-project::components.generic-button-link', [
        'icon' => 'down',
        'url' => route('categories.down', $category->id),
        'color' => 'primary',
        'class' => 'xs'
    ])
    @endcomponent
</div>

