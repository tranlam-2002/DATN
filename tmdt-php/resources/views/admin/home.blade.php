@extends('admin.main')

@section('content')
<div class="container-fluid p-t-10">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $newCustomersCount }}</h3>
                    <p>Đơn Hàng Mới</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="/admin/customers" class="small-box-footer">Thêm thông tin <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $productsCount }}</h3>
                    <p>Sản Phẩm</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/admin/products/list" class="small-box-footer">Thêm thông tin <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $usersCount }}</h3>
                    <p>Tài Khoản</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="/admin/users" class="small-box-footer">Thông tin thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $contactsCount }}</h3>
                    <p>Khách Hàng Liên Hệ</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/admin/contact" class="small-box-footer">Thông tin thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- Form chọn năm -->
            <form method="GET" action="{{ route('dashboard') }}" class="form-inline float-right">
                <div class="form-group">
                    <label for="year" class="mr-2">Chọn năm:</label>
                    <select name="year" id="year" class="form-control">
                        @for($i = date('Y'); $i >= 2000; $i--)
                            <option value="{{ $i }}" {{ request('year', $year) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-primary ml-2">Xem</button>
            </form>
            <!-- Biểu đồ cột doanh thu hàng tháng -->
            <canvas id="monthlyRevenueChart"></canvas>
            <h4 class="p-t-20">Biểu đồ doanh thu đơn hàng thành công và đơn hàng khách đặt</h4>
        </div>
        <div class="col-md-12">
            <!-- Danh sách doanh thu hàng tháng -->
            <h3 class="mb-3 p-t-20">Doanh thu hàng tháng</h3>
            <div class="row">
                @foreach($monthlyCompletedRevenue as $month => $revenue)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                           <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tháng {{ $month }}
                        <span class="badge badge-primary badge-pill">{{ number_format($revenue, 0, ',', '.') }} VND</span>
                            </li>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
    var monthlyRevenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [
                {
                    label: 'Đơn hàng đã hoàn thành',
                    data: @json(array_values($monthlyCompletedRevenue)),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Đơn hàng chưa hoàn thành',
                    data: @json(array_values($monthlyPendingRevenue)),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        // Add VND as currency symbol
                        callback: function(value, index, values) {
                            return value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
