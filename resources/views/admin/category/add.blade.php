@extends('admin.layout.app')
@section('title', 'Danh mục')

@section('main')
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
                <h4 class="card-title">Thêm danh mục</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="post" class="form-horizontal">
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
                    <label class="control-label" for="lname">Slug</label>
                    <div class="mb-2">
                        <input type="text" id="convert_slug" class="form-control" name="slug" placeholder="Điền ..."
                            value ="{{ old('slug') }}" readonly />
                        @error('slug')
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
                    <a href="{{ route('category.index') }}" class="btn btn-info ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
