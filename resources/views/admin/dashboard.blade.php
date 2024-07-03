@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('main')
    <div class="row">
        <div class="col-md-12 m-b-30">
            <!-- begin page title -->
            <div class="d-block d-lg-flex flex-nowrap align-items-center">
                <div class="page-title mr-4 pr-4 border-right">
                    <h1>Thống kế</h1>
                </div>
                <div class="breadcrumb-bar align-items-center">
                    <nav>
                        <ol class="breadcrumb p-0 m-b-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('admin/dashboard') }}"><i class="ti ti-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                Thống kê
                            </li>
                            {{-- <li class="breadcrumb-item active text-primary" aria-current="page">
                                Default</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>

    @php
        $totalRevene = 0;
        $totalSucces = 0;
        $totalCanceled = 0;
        $totalReturn = 0;
        foreach ($orders as $key => $value) {
            if ($value->status == 4) {
                $totalRevene += $value->total_price;
                $totalSucces += 1;
            }
            if ($value->status == 5) {
                $totalCanceled += 1;
            }
            if ($value->status == 6) {
                $totalReturn += 1;
            }
        }
    @endphp

    <!-- begin row -->
    <div class="row">
        <div class="col-xs-6 col-xxl-3 m-b-30">
            <div class="card card-statistics h-100 m-b-0">
                <div class="card-body bg-primary">
                    <h2 class="text-white mb-0">{{ number_format($totalRevene, 0, ',', '.') }}₫</h2>
                    <p class="text-white">Tổng doanh thu</p>
                    <div class="fload-end">
                        <i class="fa-solid fa-check-to-slot fa-beat"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-xxl-3 m-b-30">
            <div class="card card-statistics h-100 m-b-0">
                <div class="card-body bg-success">
                    <h2 class="text-white mb-0">{{ $totalSucces }}</h2>
                    <p class="text-white">Đơn thành công </p>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-xxl-3 m-b-30">
            <div class="card card-statistics h-100 m-b-0">
                <div class="card-body bg-danger">
                    <h2 class="mb-0 text-white">{{ $totalCanceled }}</h2>
                    <p class="text-white">Đơn đã hủy </p>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-xxl-3 m-b-30">
            <div class="card card-statistics h-100 m-b-0">
                <div class="card-body bg-warning">
                    <h2 class="text-white mb-0">{{ $totalReturn }}</h2>
                    <p class="text-white">Đơn hoàn trả</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-8 m-b-30">
            <div class="card card-statistics h-100 mb-0 apexchart-tool-force-top">
                <div class="card-header ">
                    <div class="card-heading mb-2">
                        <h4 class="card-title">Thống kê doanh thu : <span class="text-date">365 ngày</span></h4>
                    </div>
                    <div class="d-flex justify-content-between">
                        <select style='width:380px' class="form-select" id="select_date_renvere">
                            <option value="7">7 Ngày</option>
                            <option value="14">14 Ngày</option>
                            <option value="28">28 ngày</option>
                            <option value="60">60 Ngày </option>
                            <option value="90">90 Ngày </option>
                            <option value="180">180 Ngày </option>
                            <option @selected(true) value="365">365 Ngày</option>
                        </select>

                        <div class="date_range">
                            <div class="input-group">
                                <input type="date" class="form-control" id="from_date" name="from">
                                <span class="input-group-addon">Đến</span>
                                <input class="form-control " type="date" id="to_date" name="to">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="apexchart-wrapper">
                        <div id="renderChartRevene"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4 m-b-30">
            <div class="card card-statistics h-100 mb-0">
                <div class="card-header">
                    <h4 class="card-title">Đánh giá</h4>
                </div>
                <div class="card-body">
                    <?php
                    $totalReviews = $totalPositive + $totalNegative;
                    $positivePercent = $totalReviews > 0 ? ($totalPositive / $totalReviews) * 100 : 0;
                    $negativePercent = $totalReviews > 0 ? ($totalNegative / $totalReviews) * 100 : 0;
                    ?>

                    <div class="mb-1">
                        <div class="d-flex">
                            <p>Tích cực</p>
                            <h5 class="text-muted ml-auto mb-0">{{ $totalPositive }}</h5>
                        </div>
                        <div class="progress progress-sm m-b-10" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{ $positivePercent }}"
                                aria-valuemin="0" aria-valuemax="100" style="width: {{ $positivePercent }}%;">
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="d-flex">
                            <p>Tiêu cực</p>
                            <h5 class="text-muted ml-auto mb-0">{{ $totalNegative }}</h5>
                        </div>
                        <div class="progress progress-sm m-b-10" style="height: 5px;">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="{{ $negativePercent }}"
                                aria-valuemin="0" aria-valuemax="100" style="width: {{ $negativePercent }}%;">
                            </div>
                        </div>
                    </div>

                    <div class="apexchart-wrapper">
                        <div id="feedback"></div>
                    </div>
                </div>
            </div>

        </div>

        @php

            $total = 0;
            foreach ($orderRevenue as $key => $value) {
                $total += $value->total_price;
            }
        @endphp


        <!-- end row -->


    @endsection

    @section('script')
        <script>
            // Biểu đồ doanh thu
            $(document).ready(function() {
                var $day = $("#select_date_renvere").val();
                sendAjaxRequest($day);

                $("#select_date_renvere").change(function() {
                    var $text = $(this).find("option:selected").text();
                    var $date = $(this).val();
                    $(".text-date").text($text);
                    // console.log($text + "-" + $date);

                    sendAjaxRequest($date);
                });

                function sendAjaxRequest(date) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('chartSelected') }}",
                        data: {
                            day: date,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            chartRenverse(data.doanhThu, data.soDonHang, data.soLuongBanRa, data.ngayMua);
                        }
                    });
                }

                // chart review
                $.ajax({
                    type: "POST",
                    url: "{{ route('chartReview') }}",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        renderChartReview(res.positive, res.negative, res.category, res.totalReview);
                    }
                })
            });

            $('#to_date').on('input', function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();

                var text = from_date + ' đến ' + to_date;

                if (from_date != null && to_date != null) {
                    $(".text-date").text(text);
                    // $("#select_date_renvere").append('<option selected>' + text + '</option>');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('chartFromDate') }}",
                        data: {
                            from_date,
                            to_date,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            chartRenverse(data.doanhThu, data.soDonHang, data.soLuongBanRa, data.ngayMua);
                        }
                    });
                }


            });

            function chartRenverse(data1, data2, data3, data4) {
                var renderChartRevene = jQuery('#renderChartRevene')
                if (renderChartRevene.length > 0) {
                    var options = {
                        chart: {
                            height: 350,
                            type: 'area',
                            stacked: true,
                        },
                        colors: ['#8E54E9', '#2bcbba', '#eceef3'],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth'
                        },


                        series: [{
                            name: 'Doanh thu',
                            data: data1
                        }, {
                            name: 'Đơn hàng',
                            data: data2

                        }, {
                            name: 'Số lượng bán ra',
                            data: data3
                        }],


                        fill: {
                            type: 'gradient',
                            gradient: {
                                opacityFrom: 0.6,
                                opacityTo: 0.8,
                            }
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'left'
                        },
                        xaxis: {
                            type: 'datetime',
                            categories: data4,
                        },

                        tooltip: {
                            x: {
                                formatter: function(val) {
                                    return new Date(val).toLocaleDateString('vi-VN', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    });
                                }
                            },
                            y: {
                                formatter: function(val) {
                                    return val.toLocaleString('vi-VN');
                                }
                            }
                        }
                    }


                    $("#renderChartRevene").empty();
                    var chart = new ApexCharts(document.querySelector("#renderChartRevene"), options);

                    chart.render();
                }
            }




            // Biểu đồ đánh giá
            function renderChartReview(positive, negative, category, totalReview) {
                var feedback = jQuery('#feedback')
                if (feedback.length > 0) {
                    var options = {
                        chart: {
                            height: 350,
                            type: 'line',
                            shadow: {
                                enabled: true,
                                color: '#000',
                                top: 18,
                                left: 7,
                                blur: 10,
                                opacity: 1
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        colors: ['#8E54E9', '#2bcbba'],
                        dataLabels: {
                            enabled: true,
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        series: [{
                                name: "Tích cực",
                                data: positive
                            },
                            {
                                name: "Tiêu cực",
                                data: negative
                            }
                        ],
                        grid: {
                            borderColor: '#e7e7e7',
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        markers: {

                            size: 6
                        },
                        xaxis: {
                            categories: category,
                        },
                        yaxis: {
                            title: {
                                text: 'Sao đánh giá'
                            },
                            min: 0,
                            max: totalReview
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            floating: true,
                            offsetY: -25,
                            offsetX: -5
                        }
                    }

                    var chart = new ApexCharts(
                        document.querySelector("#feedback"),
                        options
                    );

                    chart.render();
                }
            }
        </script>
    @endsection
