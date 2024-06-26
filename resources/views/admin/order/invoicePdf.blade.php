<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .right-align {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title" style="width: 50%;">
                                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgy-cUEDviNnT4bhveW_EBZUFQqUEEZoF5sGi_EnMlqmG5HFAqFchZknt16L2BKJ7ZBzmERHjiap1SXbtSPmrXZRHig3gRQ2prQdytwHfFJDRhvoVfLJfko92R8DwoXoJXS6awoD0yu-pU06fOLOJbFSk0B5DoFr3HVcQAapBgqgwc3d_iW3Nd1-wM-xek/s320/logo_tn.png"
                                    alt="logo" style="width:100%; max-width:300px;">
                            </td>
                            <td></td>
                            <td class="right-align" style="width: 50%;">
                                Hóa đơn #: {{ $order->code_order }}<br>
                                Ngày tạo: {{ $order->created_at }}<br>
                                Hạn thanh toán: {{ $order->updated_at }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                TN SHOP Việt Nam<br>
                                123 Đường Shopee<br>
                                Thành phố Hà Nội, Việt Nam
                            </td>
                            <td></td>
                            <td class="right-align" style="width: 50%;">
                                Người nhận: {{ $order->name }}<br>
                                Số điện thoại: {{ $order->phone }}<br>
                                Địa chỉ: {{ $order->home_address }}<br>
                                {{ $order->city }}, {{ $order->district }}, {{ $order->ward }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td style="width: 50%;">Phương thức thanh toán</td>
                <td></td>
                @if ($order->payment == 'cash')
                    <td style="width: 50%;">Tiền mặt</td>
                @elseif($order->payment == 'momo')
                    <td style="width: 50%;">Momo</td>
                @elseif($order->payment == 'vnpay')
                    <td style="width: 50%;">Vnpay</td>
                @endif
            </tr>
           
            <tr class="heading">
                <td style="width: 33%;">Sản phẩm</td>
                <td style="width: 33%;">Loại</td>
                <td style="width: 33%;">Giá</td>
            </tr>

            @foreach ($orderDetail as $item)
                @php
                    $getProductSingle = App\Models\Product::getProductSingle($item->product_id);
                @endphp
                <tr class="item">
                    <td>{{ $getProductSingle->title }}</td>
                    <td>{{ $item->size_name }}_{{ $item->color_name }} x {{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 0, '', '.') }}₫</td>
                </tr>
            @endforeach

            <tr class="total">
                <td></td>
                <td>Tổng cộng:</td>
                <td><b> {{ number_format($order->total_price, 0, '', '.') }}₫</b></td>
            </tr>
        </table>
    </div>
</body>

</html>
