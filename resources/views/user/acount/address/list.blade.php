@if (count($address) > 0)
    @foreach ($address as $ad)
        <div class="row mt-2">
            <div class="col-lg-10">
                <div class="card-body">
                    <h4 class="card-title">{{ $ad->name }}</h4>
                    <p>
                        {{ $ad->phone }} - {{ $ad->city }} - {{ $ad->district }} - {{ $ad->ward }} -
                        {{ $ad->home_address }}
                    </p>

                    @if ($ad->type == 1)
                        <button type="button" data-id="{{ $ad->id }}"
                            class="btn btn-warning btn_address_default">Mặc định</button>
                    @else
                        <button type="button" data-id="{{ $ad->id }}"
                            class="btn btn-outline-warning btn_address_default">Mặc định</button>
                    @endif
                </div>
            </div>

            <div class="col-lg-2 text-center pt-2">
                <a href="#edit-address" data-toggle="modal" data-id="{{ $ad->id }}"
                    class="btn_edit_address"><b>Sửa</b> <i class="icon-edit"></i>
                </a>
                
                <b class="text-danger btn_delete_address ps-2" style="cursor: pointer"
                    data-id="{{ $ad->id }}">Xóa<i class="fa-solid fa-trash"
                        style="font-size: 11px;position: relative;top: -1px; padding-left: 2px;"></i>
                </b>
            </div>
        </div>
    @endforeach
@else
    <p>Chưa có địa chỉ nào</p>

@endif
