@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('main')
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
                <h4 class="card-title">Cập nhật admin</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $admin->id) }}" method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="form-group">
                    <label class="control-label" for="fname">Họ tên</label>
                    <div class="mb-2">
                        {{-- <input type="text" class="form-control " name="name"
                            value ="{{ isset($admin) ? $admin->name : old('name') }}" placeholder="Điền ..." /> --}}
                        <input type="text" class="form-control " name="name" value ="{{ old('name', $admin->name) }}"
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
                            value ="{{ old('email', $admin->email) }}" />
                        @error('email')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">Password</label>
                    <div class="mb-2">
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu" />
                        @error('password')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                        <em>Nếu không cần thay đổi password, để nguyên.</em>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">Trạng thái</label>
                    <div class="mb-2">
                        @php
                            $selected = $admin->status == 0 ? 'selected' : '';
                        @endphp
                        <select name="status" class="form-control">
                            <option {{ $selected }} value="1">Hiện</option>
                            <option {{ $selected }} value="0">Ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('user.index') }}" class="btn btn-info ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
   
@endsection
