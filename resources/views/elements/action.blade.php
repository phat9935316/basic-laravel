@if(isset( $url_edit ))
    <a href="{{ $url_edit }}" class="btn btn-info waves-effect waves-light btn-sm btn-edit js-edit mr-xl-1" data-target="#editCategory" data-id="{{ $model->id }}" style="{{isset($disable) && $disable != '' ? 'pointer-events: none' : ''}}"><i class="fas fa-edit"></i></a>
@endif
@if(isset( $url_destroy ))
    <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light btn-sm btn-delete js-delete" data-url="{{ $url_destroy }}" data-id="{{ $model->id }}" title="{{ $model->title }}" style="{{isset($disable) && $disable != '' ? 'pointer-events: none' : ''}}"><i class="fas fa-trash-alt btn-delete"></i></a>
@endif



