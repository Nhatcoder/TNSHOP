@foreach ($order as $key => $item)
    @php
        $getProductSingle = App\Models\Product::getProductSingle($item->product_id);
        $getProductImage = App\Models\Product::singleImage($getProductSingle->id);
    @endphp

    <div class="row mt-2">
        <div class="col-2">
            <img  src="{{ $getProductImage->checkImage() }}" alt="">
        </div>

        <div class="col-10">
            <p>{{ $getProductSingle->title }}</p>
            <p>Phân loại: {{ $item->color_name }}, Size: {{ $item->size_name }}</p>
        </div>
    </div>
@endforeach

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<form class="rating" method="POST" id="form1">
    <input type="radio" id="rating1" name="rating" value="1">
    <label id="1" title="Poor" class="fa fa-star" for="rating1"></label>

    <input type="radio" id="rating2" name="rating" value="2">
    <label id="2" title="Average" class="fa fa-star" for="rating2"></label>


    <input type="radio" id="rating3" name="rating" value="3">
    <label id="3" title="Average" class="fa fa-star" for="rating3"></label>


    <input type="radio" id="rating4" name="rating" value="4">
    <label id="4" title="Good" class="fa fa-star" for="rating4"></label>


    <input type="radio" id="rating5" name="rating" value="5">
    <label id="5" title="Awesome" class="fa fa-star" for="rating5"></label>

    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" id="product_id" value="{{ $getProductSingle->id }}">
    <input type="hidden" id="order_id" value="{{ $item->id }}">
</form>

<div class="display_rating"></div>

<div class="form-group">
    <textarea class="form-control" id="comment" name="comment"
        placeholder="Hãy chia sẻ những điều bạn thích về sản phẩm này với những người mua khác nhé."></textarea>
    <p class="text-danger" id="error_comment"></p>

</div>
