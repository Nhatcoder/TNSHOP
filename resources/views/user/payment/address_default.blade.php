@if ($addressDefault)
    <input type="hidden" name="address_id" value="{{ $addressDefault->id }}">
    <ul class="list-group">
        <li class="list-group-item"><b>Họ tên: {{ $addressDefault->name }}</b>
            <a href="#list_address" data-toggle="modal" class="btn_address float-right text-primary">Thay đổi</a>
        </li>
        <li class="list-group-item">Liên hệ: {{ $addressDefault->phone }}</li>
        <li class="list-group-item">Địa chỉ:
            {{ $addressDefault->city }} -
            {{ $addressDefault->district }} - {{ $addressDefault->ward }} -
            {{ $addressDefault->home_address }}
        </li>
    </ul>
@else
    <a href="#add-address" id="auto_new_address" data-toggle="modal"></a>
@endif
