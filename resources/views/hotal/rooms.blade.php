@extends('layout.app')
@section('title','rooms')
@section('content')

<div class="hero-wrap" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span>
                        <span>About</span>
                    </p>
                    <h1 class="mb-4 bread">Rooms</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container bg-dark p-4 rounded">
        <h3 class="text-center text-white mb-4">AI Room Recommendation For User</h3>
        <div class="text-center">
            <form id="ai-recommendation-form" method="POST" action="{{ route('ai.recommend') }}">
                @csrf

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="number" class="form-control" name="budget" placeholder="Your Budget (e.g. 5000)" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <select class="form-control" name="room_type">
                            <option value="">Select Preferred Room Type (Optional)</option>
                            @foreach($room_types as $type)
                            <option value="{{ $type->name }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <textarea name="preferences" class="form-control" rows="1"
                            placeholder="Preferences (e.g. WiFi, near university)"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-5">Get AI Recommendation</button>
            </form>
        </div>
    </div>
</section>


<section class="ftco-section bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="row" id="rooms-list">
                    @foreach ($rooms as $room )
                    @include('hotal.partials.room_card', ['room' => $room])
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 sidebar">
                <div class="sidebar-wrap bg-light ftco-animate">
                    <h3 class="heading mb-4">Advanced Search</h3>
                    <form action="{{ route('check.availability') }}" method="POST" id="rooms-search-form">
                        @csrf
                        <div class="fields">
                            <div class="form-group">
                                <input type="text" name="check_in" id="checkin_date" class="form-control checkin_date"
                                    placeholder="Check In Date" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="check_out" id="checkout_date" class="form-control checkout_date"
                                    placeholder="Check Out Date" required>
                            </div>
                            <div class="form-group">
                                <div class="select-wrap one-third">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="room_type" id="room_type" class="form-control" required>
                                        <option value="">Select Room Type</option>
                                        @foreach($room_types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <input type="submit" value="Search" class="btn btn-primary py-3 px-5">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // AI Recommendation Form
        $('#ai-recommendation-form').on('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Thinking...',
                text: 'AI is finding the best room for you',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'AI Recommendation',
                            text: response.message,
                            confirmButtonText: 'Great!'
                        });

                        $('#rooms-list').hide().html(response.html).fadeIn(500);
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    var message = 'Failed to get recommendation.';
                    if (xhr.status === 401) {
                        message = 'Unauthorized: Please check your OpenAI API key.';
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', message, 'error');
                }

            });
        });

        // Availability Search Form
        $('#rooms-search-form').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Found!',
                            text: response.message + ' (' + response.available_count + ' rooms found)',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Dynamic update of rooms list
                        $('#rooms-list').hide().html(response.html).fadeIn(500);

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Not Available',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    var message = 'Something went wrong. Please try again.';
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        message = Object.values(errors).flat().join('\n');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: message
                    });
                }
            });
        });
    });
</script>
@endsection

@endsection