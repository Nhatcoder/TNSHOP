<div class="form-box">
    <div class="modal-header">
        <h4>Cập địa chỉ</h4>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <div class="form-group">
                <label for="">Họ và tên</label>
                <input type="text" class="form-control" placeholder="Họ tên" id="name_address_edit" name="name"
                    value="{{ $address->name }}">
                <p class="text-danger" id="error_edit_name_address"></p>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" class="form-control" placeholder="Số điện thoại" id="phone_address_edit" name="phone"
                    value="{{ $address->phone }}">
                <p class="text-danger" id="error_edit_phone_address"></p>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <label>Tỉnh/Thành phố <b class="text-danger">*</b></label>
            <select class="form-select m-0 " name="city" id="city_edit">
                <option value="{{ $address->city }}" selected readonly>{{ $address->city }}</option>
            </select>
            <p class="text-danger" id="error_edit_city"></p>

        </div>
        <div class="col-lg-6">
            <label>Quận/Huyện <b class="text-danger">*</b></label>
            <select class="form-select m-0" name="district" id="district_edit">
                <option value="{{ $address->district }}" selected readonly>{{ $address->district }}</option>
            </select>
            <p class="text-danger" id="error_edit_district"></p>

        </div>
    </div>
    <div class="form-group mt-2">
        <label>Phường/Xã <b class="text-danger">*</b></label>
        <select class="form-select m-0" name="ward" id="ward_edit">
            <option value="{{ $address->ward }}" selected readonly>{{ $address->ward }}</option>
        </select>
        <p class="text-danger" id="error_edit_ward"></p>
    </div>

    <div class="form-group">
        <label for="">Địa chỉ cụ thể</label>
        <textarea class="form-control" id="home_address_edit" name="home_address">{{ $address->home_address }}</textarea>
        <p class="text-danger" id="error_edit_home_address"></p>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-outline-info" class="close" data-dismiss="modal" aria-label="Close">Trở
            về</button>
        <button type="button" class="btn btn-primary" data-id="{{ $address->id }}" id="update_address">Cập nhật</button>
    </div>

</div>
