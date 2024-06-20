@extends('admin.layout.app')
@section('title', 'Mã giảm giá')

@section('main')
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
                <h4 class="card-title">Cập nhật mã giảm giá</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('discount_code.update', $discount_code->id) }}" method="post" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="control-label" for="fname">Tên</label>
                    <div class="mb-2">
                        <input type="text" class="form-control " oninput="ChangeToSlug()" id="name" name="name"
                            value ="{{ old('name', $discount_code->name) }}" placeholder="Điền ..." />
                        @error('name')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="type">Loại</label>
                    <div class="mb-2">
                        <select name="type" class="form-select" id="type">
                            <option {{ old('type', $discount_code->type) == 'amount' ? 'selected' : '' }} value="amount">Số
                                lượng</option>
                            <option {{ old('type', $discount_code->type) == 'percent' ? 'selected' : '' }} value="percent">
                                Phần trăm</option>
                        </select>
                        @error('type')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="percent_amount">Phần trăm số tiền</label>
                    <div class="mb-2">
                        <input type="text" id="percent_amount" class="form-control" name="percent_amount"
                            placeholder="Điền ..." value ="{{ old('percent_amount', $discount_code->percent_amount) }}" />
                        @error('percent_amount')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="expire_date">Ngày hết hạn</label>
                    <div class="mb-2">
                        <input type="date" id="expire_date" class="form-control" name="expire_date"
                            placeholder="Điền ..." value ="{{ old('expire_date', $discount_code->expire_date) }}" />
                        @error('expire_date')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">Trạng thái</label>
                    <div class="mb-2">
                        <select name="status" class="form-control">
                            <option {{ old('status', $discount_code->status) == 1 ? 'selected' : '' }} value="1">Hiện</option>
                            <option {{ old('status', $discount_code->status) == 0 ? 'selected' : '' }} value="0">Ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('discount_code.index') }}" class="btn btn-info ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>

@endsection
