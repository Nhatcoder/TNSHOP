@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('main')
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
                <h4 class="card-title">Thêm admin</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label class="control-label" for="fname">Họ tên</label>
                    <div class="mb-2">
                        <input type="text" class="form-control " name="name" value ="{{ old('name') }}"
                            placeholder="Điền ..." />
                        @error('name')
                            {{-- <em class="text-danger" style="">{{ $errors->first('name') }}</em> --}}
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="lname">Email</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="email" placeholder="Điền ..."
                            value ="{{ old('email') }}" />
                        @error('email')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">Password</label>
                    <div class="mb-2">
                        <input type="password" class="form-control" name="password" placeholder="Điền ..."
                            value ="{{ old('password') }}" />
                        @error('password')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">Trạng thái</label>
                    <div class="mb-2">
                        <select name="status" class="form-control">
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                    <a href="{{ route('user.index') }}" class="btn btn-info ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
