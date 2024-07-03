@foreach ($reviewOrderDetail as $key => $item)
    @php
        $getProductSingle = App\Models\Product::getProductSingle($item->product_id);
        $getProductImage = App\Models\Product::singleImage($getProductSingle->id);
    @endphp

    <div class="row mt-2">
        <div class="col-2">
            <img src="{{ $getProductImage->checkImage() }}" alt="">
        </div>

        <div class="col-10">
            <p>{{ $getProductSingle->title }}</p>
            <p>Phân loại: {{ $item->color_name }}, Size: {{ $item->size_name }}</p>
        </div>
    </div>
@endforeach

<hr>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="row">
    <div class="col-2">
        <img style="border-radius: 50%; height: 60px;" class="w-100" src="{{ $review->avatar }}"
            alt="{{ $review->user_name }}">
    </div>

    <div class="col-10">
        <b> {{ $review->user_name }}</b>
        <p>{{ $review->comment }}</p>
        <div class="d-flex py-3">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fa fa-star" style="color: {{ $i <= $review->rating ? 'orange' : '' }};"></i>
            @endfor
        </div>
        <p>{{ $review->created_at }}</p>
    </div>
</div>
