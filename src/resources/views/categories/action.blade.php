<div class="list-group-item">
    <div class="row">
        <div class="col-md-2">
            @if (!empty($category->getAttachment()))
                <a href="#" data-toggle="modal" data-target="#media-manager-single-upload"
                   data-url=" {{ route('bp.categories.add-image', [$category->id]) }}">
                    {!! MediaManager::getCachedImageTag('categories_thumb', $category->getAttachment()) !!}
                </a>
            @else
                @component('back-project::components.generic-button-link', [
                                    'color' => 'default',
                                    'icon' => 'fa-file-image-o',
                                    'class' => 'sm',
                                    'attributes' => ' data-toggle="modal" data-target="#media-manager-single-upload" data-url="'.route('bp.categories.add-image', [$category->id]).'"'
                                    ])
                @endcomponent
            @endif
        </div>

        <div class="col-md-2">
            {{ $category->slug }}
        </div>

        <div class="col-md-2">
            {{ $category->name }}
        </div>

        <div class="col-md-4">
            {{ $category->description}}
        </div>

        <div class="col-md-2">
            @component('back-project::components.generic-button-link', [
                'icon' => 'edit',
                'url' => route('bp.categories.edit', $category->id),
                'color' => 'default',
                'class' => 'xs'
            ])
            @endcomponent

            @component('back-project::components.generic-button-link', [
                'icon' => 'delete',
                'url' => route('bp.categories.delete', $category->id),
                'color' => 'danger',
                'action' => 'delete',
                'class' => 'xs'
            ])
            @endcomponent

            @component('back-project::components.generic-button-link', [
                'icon' => 'up',
                'url' => route('bp.categories.up', $category->id),
                'color' => 'primary',
                'class' => 'xs'
            ])
            @endcomponent

            @component('back-project::components.generic-button-link', [
                'icon' => 'down',
                'url' => route('bp.categories.down', $category->id),
                'color' => 'primary',
                'class' => 'xs'
            ])
            @endcomponent
        </div>
    </div>
</div>
