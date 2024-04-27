@extends('admin.layout.app')
@section('title', 'Danh mục')

@section('main')
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
                <h4 class="card-title">Cập nhật danh mục</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('brand.update', $brand->id) }}" method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="form-group">
                    <label class="control-label" for="fname">Tên</label>
                    <div class="mb-2">
                        {{-- <input type="text" class="form-control " name="name"
                            value ="{{ isset($brand) ? $brand->name : old('name') }}" placeholder="Điền ..." /> --}}
                        <input type="text" class="form-control " oninput="ChangeToSlug()" id="name" name="name"
                            value ="{{ old('name', $brand->name) }}" placeholder="Điền ..." />
                        @error('name')
                            {{-- <em class="text-danger" style="">{{ $errors->first('name') }}</em> --}}
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="lname">Slug</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="convert_slug" name="slug" placeholder="Điền ..."
                            value ="{{ old('slug', $brand->slug) }}" readonly />
                        @error('slug')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="">Trạng thái</label>
                    <div class="mb-2">
                        @php
                            $selected = $brand->status == 0 ? 'selected' : '';
                        @endphp
                        <select name="status" class="form-control">
                            <option {{ $selected }} value="1">Hiện</option>
                            <option {{ $selected }} value="0">Ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('brand.index') }}" class="btn btn-info ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>

@endsection
