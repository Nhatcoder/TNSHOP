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
            <div class="card card-statistics h-100 mb-0 o-hidden">
                <div class="card-header">
                    <h4 class="card-title">Thống kê đánh giá</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-xxs-4 col-md-4 mb-3 mb-sm-0">
                            <h3 class="mb-1 mb-xxs-0">25,456</h3>
                            <span class="d-block"> <i class="fa fa-arrow-up text-success"></i>
                                <b class="text-success">+23%</b> Views </span>
                        </div>
                        <div class="col-6 col-xxs-4 col-md-4 mb-3 mb-sm-0">
                            <h3 class="mb-1 mb-xxs-0">45,541</h3>
                            <span class="d-block"> <i class="fa fa-arrow-up text-success"></i>
                                <b class="text-success">+15%</b> Likes </span>
                        </div>
                        <div class="col-12 col-xxs-4 col-md-4 mb-3 mb-sm-0">
                            <h3 class="mb-1 mb-xxs-0">78,462</h3>
                            <span class="d-block"> <i class="fa fa-arrow-up text-success"></i>
                                <b class="text-success">+32%</b> Comments </span>
                        </div>
                    </div>
                    <div class="mt-2 mt-xxs-4">
                        <p>You're scheduled earn <span class="badge  badge-success-inverse">$2,350
                                today</span></p>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="tab nav-border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link py-2 active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                    role="tab" aria-controls="home-02" aria-selected="true">Views</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-2" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                    role="tab" aria-controls="profile-02" aria-selected="false">Likes </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-2" id="portfolio-02-tab" data-toggle="tab" href="#portfolio-02"
                                    role="tab" aria-controls="portfolio-02" aria-selected="false">Comments
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mt-5">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                aria-labelledby="home-02-tab">
                                <div class="apexchart-wrapper">
                                    <div id="analytics4" class="chart-fit mb-minus"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                                <div class="apexchart-wrapper">
                                    <div id="analytics5" class="chart-fit mb-minus"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="portfolio-02" role="tabpanel"
                                aria-labelledby="portfolio-02-tab">
                                <div class="apexchart-wrapper">
                                    <div id="analytics6" class="chart-fit mb-minus"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        // select date 
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
        });

        $('#to_date').on('input', function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            var text = from_date + ' đến ' + to_date;

            if (from_date != null && to_date != null) {
                $(".text-date").text(text);

                $("#select_date_renvere").append('<option selected>' + text + '</option>');

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
    </script>
@endsection
