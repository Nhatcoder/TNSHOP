@extends('admin.layout.app')
@section('title', 'Mã giảm giá')

@section('main')
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
                <h4 class="card-title">Thêm mã giảm giá</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('discount_code.store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label class="control-label" for="fname">Tên</label>
                    <div class="mb-2">
                        <input type="text" class="form-control " oninput="ChangeToSlug()" id="name" name="name"
                            value ="{{ old('name') }}" placeholder="Điền ..." />
                        @error('name')
                            {{-- <em class="text-danger" style="">{{ $errors->first('name') }}</em> --}}
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="type">Loại</label>
                    <div class="mb-2">
                        <select name="type" class="form-select" id="type">
                            <option {{ old('type') == 'amount' ? 'selected' : '' }} value="amount">Số lượng</option>
                            <option {{ old('type') == 'percent' ? 'selected' : '' }} value="percent">Phần trăm</option>
                        </select>
                        @error('type')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="percent_amount">Giảm phần trăm / số tiền</label>
                    <div class="mb-2">
                        <input type="text" id="percent_amount" class="form-control" name="percent_amount"
                            placeholder="Điền ..." value ="{{ old('percent_amount') }}" />
                        @error('percent_amount')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="expire_date">Ngày hết hạn</label>
                    <div class="mb-2">
                        <input type="date" id="expire_date" class="form-control" name="expire_date"
                            placeholder="Điền ..." value ="{{ old('expire_date') }}" />
                        @error('expire_date')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">Trạng thái</label>
                    <div class="mb-2">
                        <select name="status" class="form-control">
                            <option value="1" selected>Hiện</option>
                            <option value="0" disabled>Ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                    <a href="{{ route('discount_code.index') }}" class="btn btn-info ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
