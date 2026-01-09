@extends('admin.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<style>
    .last-child-no-border:last-child { border-bottom: none !important; }
    .text-muted-extra { color: #a0aec0; font-size: 0.75rem; }
    .card { transition: transform 0.2s; border-radius: 12px; }
    .card:hover { transform: translateY(-3px); }
</style>

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
                        <div class="h4 mb-0 text-primary">{{ $total_rooms }}</div>
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
                        <div class="h4 mb-0 text-danger">{{ $occupied_rooms }}</div>
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
                        <div class="h4 mb-0 text-success">{{ $available_rooms }}</div>
                    </div>
                    <div class="icon-circle text-success"><i class="bi bi-door-open-fill"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="metric-card p-3 bg-white shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Total Maintenance</div>
                        <div class="h4 mb-0 text-warning">{{ $maintenance_rooms }}</div>
                    </div>
                    <div class="icon-circle text-warning"><i class="bi bi-tools"></i></div>
                </div>
            </div>
        </div>
         <div class="col-md-3">
            <div class="metric-card p-3 bg-white shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Total Amenities</div>
                        <div class="h4 mb-0 text-info">{{ $total_amenities }}</div>
                    </div>
                    <div class="icon-circle text-info"><i class="bi bi-list-stars"></i></div>
                </div>
            </div>
        </div>

         <div class="col-md-3">
            <div class="metric-card p-3 bg-white shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Total Guest</div>
                        <div class="h4 mb-0 text-primary">{{ $total_guests }}</div>
                    </div>
                    <div class="icon-circle text-primary"><i class="bi bi-people-fill"></i></div>
                </div>
            </div>
        </div>

         <div class="col-md-3">
            <div class="metric-card p-3 bg-white shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Total Testimonials</div>
                        <div class="h4 mb-0 text-success">{{ $total_reviews }}</div>
                    </div>
                    <div class="icon-circle text-success"><i class="bi bi-star-fill"></i></div>
                </div>
            </div>
        </div>
         
         <div class="col-md-3">
            <div class="metric-card p-3 bg-white shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Total Messages</div>
                        <div class="h4 mb-0 text-warning">{{ $total_messages }}</div>
                    </div>
                    <div class="icon-circle text-warning"><i class="bi bi-envelope-fill"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm p-4 h-100 border-0" style="border-radius: 15px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-star-fill me-2"></i>Recent Guest Reviews</h5>
                    <a href="{{ route('testimonials.index') }}" class="btn btn-sm btn-link text-decoration-none p-0">View All</a>
                </div>
                <div class="reviews-list">
                    @forelse($latestReviews as $review)
                        <div class="mb-3 pb-3 border-bottom last-child-no-border">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="mb-0 fw-bold">{{ $review->user->name ?? 'Anonymous' }}</h6>
                                <div class="text-warning small">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-muted small mb-0">{{ Str::limit($review->message, 80) }}</p>
                            <small class="text-xs text-muted-extra">{{ $review->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <p class="text-muted text-center py-4">No reviews yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-4 h-100 border-0" style="border-radius: 15px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-info"><i class="bi bi-chat-dots-fill me-2"></i>Latest Inquiries</h5>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-link text-decoration-none p-0">View All</a>
                </div>
                <div class="messages-list">
                    @forelse($latestMessages as $msg)
                        <div class="mb-3 pb-3 border-bottom last-child-no-border">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="mb-0 fw-bold">{{ $msg->name }}</h6>
                                <small class="text-xs text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="text-info small fw-semibold mb-1">{{ $msg->subject }}</div>
                            <p class="text-muted small mb-0">{{ Str::limit($msg->message, 80) }}</p>
                        </div>
                    @empty
                        <p class="text-muted text-center py-4">No messages yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-4">Bookings Overview (Last 7 Days)</h5>
                <canvas id="bookingsChart" height="150"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-4">Room Status Distribution</h5>
                <canvas id="statusDoughnutChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-7">
            <div class="card shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-4">Monthly Revenue Overview</h5>
                <canvas id="revenueBarChart" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-4">Recent Activity</h5>
                <div class="activity-feed">
                    @foreach($recentActivities as $activity)
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom last-child-no-border">
                            <div class="activity-icon me-3 bg-light-primary text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-calendar-check-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold">{{ $activity->Guest }}</h6>
                                    <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                </div>
                                <small class="text-muted">Booked Room #{{ $activity->RoomNo }} ({{ $activity->RoomType }})</small>
                                <div class="mt-1">
                                    <span class="badge bg-{{ $activity->status == 'booked' ? 'success' : 'warning' }} text-white small" style="font-size: 0.7rem;">{{ ucfirst($activity->status) }}</span>
                                    <span class="text-primary fw-bold ms-2" style="font-size: 0.85rem;">${{ number_format($activity->total_price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($recentActivities->isEmpty())
                        <div class="text-center py-4">
                            <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2">No recent activity found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Room Status -->
    <div class="card shadow-sm p-3">
        <h5 class="fw-bold mb-3">Quick Room Status</h5>
        <p class="small text-muted mb-2">Green: Available | Red: Occupied | Blue: Cleaning | Yellow: Maintenance</p>

        <div class="d-grid gap-2" style="grid-template-columns: repeat(10, 1fr);">
            @foreach($all_rooms as $room)
                @php
                    $btnClass = 'btn-success';
                    if($room->status == 'occupied') $btnClass = 'btn-danger';
                    elseif($room->status == 'cleaning') $btnClass = 'btn-info';
                    elseif($room->status == 'maintenance') $btnClass = 'btn-warning';
                @endphp
                <button class="btn btn-sm {{ $btnClass }}">{{ $room->room_number }}</button>
            @endforeach
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('bookingsChart').getContext('2d');
    const bookingsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Number of Bookings',
                data: {!! json_encode($chartValues) !!},
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#0d6efd',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Room Status Doughnut Chart
    const statusCtx = document.getElementById('statusDoughnutChart').getContext('2d');
    const statusDoughnutChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Occupied', 'Maintenance', 'Cleaning'],
            datasets: [{
                data: [
                    {{ $available_rooms }},
                    {{ $occupied_rooms }},
                    {{ $maintenance_rooms }},
                    {{ $cleaning_rooms }}
                ],
                backgroundColor: [
                    '#198754', // success - green
                    '#dc3545', // danger - red
                    '#ffc107', // warning - yellow
                    '#0dcaf0'  // info - blue
                ],
                hoverOffset: 10,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            }
        }
    });

    // Monthly Revenue Bar Chart
    const revCtx = document.getElementById('revenueBarChart').getContext('2d');
    
    // Create gradient
    const gradient = revCtx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#0d6efd');
    gradient.addColorStop(1, '#6610f2');

    const revenueBarChart = new Chart(revCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($revenueLabels) !!},
            datasets: [{
                label: 'Monthly Revenue ($)',
                data: {!! json_encode($revenueValues) !!},
                backgroundColor: gradient,
                borderRadius: 8,
                borderSkipped: false,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Revenue: $' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    });
</script>
@endsection
