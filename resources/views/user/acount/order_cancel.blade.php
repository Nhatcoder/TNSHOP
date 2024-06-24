 <table class="table text-center table-mobile table-striped table-hover">
     <thead class="table-light">
         <tr>
             <th>Mã đơn hàng</th>
             <th>Số điện thoại</th>
             <th>Tổng giá</th>
             <th>Trạng thái</th>
             <th>Ngày mua</th>
             <th>Thao tác</th>
         </tr>
     </thead>

     <tbody>
         @foreach ($orders as $order)
             <tr>
                 <td>{{ $order->code_order }}</td>
                 <td>{{ $order->phone }}</td>
                 <td>{{ number_format($order->total_price, 0, '', '.') }}₫
                 </td>
                 <td>
                     @if ($order->status == 1)
                         <b class="badge badge-primary p-2">Chờ
                             xác
                             nhận</b>
                     @elseif($order->status == 2)
                         <b class="badge badge-info p-2">Vận
                             chuyển
                         </b>
                     @elseif($order->status == 3)
                         <b class="badge badge-secondary p-2">Chờ
                             giao
                             hàng
                         </b>
                     @elseif($order->status == 4)
                         <b class="badge badge-success p-2">Hoàn
                             thành
                         </b>
                     @elseif($order->status == 5)
                         <b class="badge badge-danger p-2">Đã
                             hủy
                         </b>
                     @else
                         <b class="badge badge-warning p-2">Trả
                             hàng/Hoàn
                             tiền
                         </b>
                     @endif
                 </td>
                 <td>{{ $order->created_at }}</td>

                 <td>
                     <a href="#order-detail-modal" data-toggle="modal" data-id="{{ $order->id }}"
                         class="btn btn-primary btn-order-detail">Xem
                         thêm</a>
                     @if ($order->status == 1)
                         <button class="btn btn-danger">Hủy
                             đơn</button>
                     @endif
                 </td>
             </tr>
         @endforeach
     </tbody>
 </table>
