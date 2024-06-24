 <h4 class="mb-2">Bạn đang xem đơn hàng : {{ $order_detail->code_order }}</h4>
 <table class="table text-center table-mobile ">
     <thead class="thead-light">
         <tr>
             <th>STT</th>
             <th>Ảnh</th>
             <th>Tên sản phẩm</th>
             <th>Phân loại</th>
             <th>Loại thanh toán</th>
             <th>Giá</th>
             <th>Số lượng</th>
             <th>Tổng Tiền</th>
         </tr>
     </thead>

     <tbody class="table-light">
         @foreach ($orders as $key => $item)
             @php
                 $getProductSingle = App\Models\Product::getProductSingle($item->product_id);
                 $getProductImage = App\Models\Product::singleImage($getProductSingle->id);
             @endphp
             <tr>
                 <td>{{ $key + 1 }}</td>
                 <td>
                     <img width="120px" src="{{ $getProductImage->checkImage() }}" alt="{{ $getProductSingle->title }}">
                 </td>
                 <td>
                     {{ Str::limit($getProductSingle->title, 60) }}
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
                 <td>{{ $item->price }}</td>
                 <td>{{ $item->quantity }}</td>
                 <td>{{ number_format($item->total_price, 0, '', '.') }}₫</td>
             </tr>
         @endforeach


     </tbody>
     <tfoot>
         <tr class="table-light">
             <th><b class="text-black">Tổng đơn hàng</b></th>
             <th colspan="6"></th>
             @php
                 $total = 0;
             @endphp
             @foreach ($orders as $item)
                 @php

                     $total += $item->total_price;
                 @endphp
             @endforeach
             <th colspan="2"><b class="text-danger">{{ number_format($total, 0, '', '.') }}₫</b></th>
         </tr>
     </tfoot>
 </table>


 {{-- address --}}
 <div class="row">
     <div class="col-lg-6">
         <div class="card card-dashboard">
             <div class="card-body">
                 <h3 class="card-title">Địa chỉ nhận hàng</h3>
                 <p><b>Họ tên: {{ $order_detail->name }}</b> <br>
                     Số điện thoại: {{ $order_detail->phone }}<br>
                     Địa chỉ: {{ $order_detail->city }}, {{ $order_detail->district }}, {{ $order_detail->ward }}<br>
                     Số nhà, đường: {{ $order_detail->home_address }}<br>
                 </p>
             </div>
         </div>
     </div>

     <div class="col-lg-6">
         <div class="card card-dashboard">
             <div class="card-body">
                 <h3 class="card-title">Ghi chú của bạn</h3>
                 <p>
                     @if ($order_detail->note)
                         {{ $order_detail->note }}
                     @else
                         ...
                     @endif
                     <br>
                 </p>
             </div>
         </div>
     </div>
 </div>
