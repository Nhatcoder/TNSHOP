<div class="modal-header">
    <h5 class="modal-title" id="verticalCenterTitle">Bạn đang xem đơn hàng: <b
            class="text-danger">{{ $order->code_order }}</b>
    </h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="btn-print-order float-end mb-2">
        <a class="p-2 bg-warning text-white" href="{{ route('orderPdf', ['id' => $order->id]) }}">Xuất PDF</a>
    </div>
    <table class="table text-center table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Tên </th>
                <th>Phân loại</th>
                <th>Loại thanh toán</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody class="text-dark">
            @foreach ($orderDetail as $key => $item)
                @php
                    $getProductSingle = App\Models\Product::getProductSingle($item->product_id);
                    $getProductImage = App\Models\Product::singleImage($getProductSingle->id);
                @endphp
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <img width="120px" src="{{ $getProductImage->checkImage() }}"
                            alt="{{ $getProductSingle->title }}">
                    </td>
                    <td width="200px">
                        {{ $getProductSingle->title }}
                    </td>
                    <td>{{ $item->color_name }} - {{ $item->size_name }}</td>
                    <td>
                        @if ($item->payment == 'cash')
                            Tiền mặt
                        @elseif($item->payment == 'momo')
                            Momo
                        @elseif($item->payment == 'vnpay')
                            Vnpay
                        @endif
                    </td>
                    <td>{{ number_format($item->price, 0, '', '.') }}₫</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->total_price, 0, '', '.') }}₫</td>
                </tr>
            @endforeach

            @php
                $total = 0;
                foreach ($orderDetail as $key => $value) {
                    $total += $value->total_price;
                }
            @endphp
            <tr>
                <th class="text-left" colspan="7">Tổng đơn hàng</th>
                <th colspan="1"><b class="text-danger">{{ number_format($total, 0, '', '.') }}₫ </b></th>
            </tr>
        </tbody>
    </table>
</div>

@if ($order->note)
    <div class="card card-statistics mb-30 card-contant1">
        <div class="card-body">
            <div class="card border-dark text-center mb-0">
                <div class="card-body text-dark">
                    <h4 class="card-title">Ghi chú </h4>
                    <p class="card-text">{{ $order->note }}</p>
                </div>
            </div>
        </div>
    </div>
@endif
