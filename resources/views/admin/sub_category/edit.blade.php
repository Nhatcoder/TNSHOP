@extends('admin.layout.app')
@section('title', 'Danh mục phụ')

@section('main')
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
                <h4 class="card-title">Thêm danh mục phụ</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('sub_category.update',$sub_category->sub_id) }}" method="post" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="control-label">Danh mục</label>
                    <div class="mb-2">
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id"
                            id="">
                            <option value="">Chọn danh mục</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $sub_category->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            {{-- <em class="text-danger" style="">{{ $errors->first('name') }}</em> --}}
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="fname">Tên danh mục phụ</label>
                    <div class="mb-2">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            oninput="ChangeToSlug()" id="name" name="name"
                            value ="{{ old('name', $sub_category->sub_name) }}" placeholder="Điền ..." />
                        @error('name')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Slug</label>
                    <div class="mb-2">
                        <input type="text" id="convert_slug" class="form-control @error('slug') is-invalid @enderror"
                            name="slug" placeholder="Điền ..." value ="{{ old('slug', $sub_category->slug) }}"
                            readonly />
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
                            <option {{ $sub_category->status == 0 ? 'selected' : '' }} value="0">Ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('sub_category.index') }}" class="btn btn-info ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
