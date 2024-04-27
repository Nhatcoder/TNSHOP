@if (!empty(session('error')))
    <div class="alert alert-icon alert-inverse-danger" role="alert">
        <i class="fa fa-info-circle"></i>
        {{ session('error') }}
    </div>
@endif
