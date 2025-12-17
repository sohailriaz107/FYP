@extends('admin.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="" id="dashboard">
           <div class="dashboard" style="background-color: white;padding:10px;border-radius:10px;margin-bottom:10px;text-align:center">
           <h3>Dashboard</h3>
           </div>
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="metric-card p-3 bg-white shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Total Rooms</div>
                        <div class="h4 mb-0 text-primary">85</div>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> 5% vs last month</small>
                    </div>
                    <div class="icon-circle text-primary"><i class="bi bi-door-open"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="metric-card p-3 bg-white shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Occupied</div>
                        <div class="h4 mb-0 text-danger">45</div>
                    </div>
                    <div class="icon-circle text-danger"><i class="bi bi-person-fill"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="metric-card p-3 bg-white shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Available</div>
                        <div class="h4 mb-0 text-success">40</div>
                    </div>
                    <div class="icon-circle text-success"><i class="bi bi-door-open-fill"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="metric-card p-3 bg-white shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Revenue Today</div>
                        <div class="h4 mb-0 text-warning">$3,400</div>
                    </div>
                    <div class="icon-circle text-warning"><i class="bi bi-currency-dollar"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Room Status -->
    <div class="card shadow-sm p-3">
        <h5 class="fw-bold mb-3">Quick Room Status</h5>
        <p class="small text-muted mb-2">Green: Available | Red: Occupied | Blue: Cleaning | Yellow: Maintenance</p>

        <div class="d-grid gap-2" style="grid-template-columns: repeat(10, 1fr);">
            <button class="btn btn-sm btn-success">101</button>
            <button class="btn btn-sm btn-danger">102</button>
            <button class="btn btn-sm btn-info">103</button>
            <button class="btn btn-sm btn-warning">104</button>
            <button class="btn btn-sm btn-success">105</button>
            <button class="btn btn-sm btn-danger">201</button>
            <button class="btn btn-sm btn-info">202</button>
            <button class="btn btn-sm btn-warning">203</button>
        </div>
    </div>

</div>

@endsection
