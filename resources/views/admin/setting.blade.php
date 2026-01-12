@extends('admin.app')

@section('title', 'Admin Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                <div class="card-body p-4" style="text-align: center;">
                    <h3 class="fw-bold mb-0 text-dark"><i class="bi bi-gear-fill me-2"></i> Account Settings</h3>
                    <p class="text-muted mb-0">Manage your profile information, security, and preferences.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column: Profile Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body text-center p-4">
                    <div class="position-relative d-inline-block mb-3">
                        <img id="profilePreview" 
                             src="{{ $user->image ? asset($user->image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0d6efd&color=fff&size=128' }}" 
                             alt="Profile" 
                             class="rounded-circle border border-4 border-light shadow-sm"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <label for="imageUpload" class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0 shadow-sm" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-camera-fill"></i>
                        </label>
                        <input type="file" id="imageUpload" name="image" form="profileForm" hidden accept="image/*">
                    </div>
                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    <p class="text-muted">{{ ucfirst($user->role) }} Account</p>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" form="profileForm" class="btn btn-grad py-2 rounded-3">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i> Save Changes
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats or Info Card -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-3">Quick Information</h6>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 text-primary">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Verified Email</small>
                            <span class="fw-medium">{{ $user->email }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3 text-success">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Member Since</small>
                            <span class="fw-medium">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Settings Forms -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold text-dark mb-0">Personal Information</h5>
                </div>
                <div class="card-body p-4">
                    <form id="profileForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control rounded-3" value="{{ $user->name }}" placeholder="Your Full Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-3" value="{{ $user->email }}" placeholder="admin@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" name="phone" class="form-control rounded-3" value="{{ $user->phone }}" placeholder="+1 234 567 890">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Address</label>
                                <input type="text" name="address" class="form-control rounded-3" value="{{ $user->address }}" placeholder="City, Country">
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <h5 class="fw-bold text-dark mb-4">Security Settings</h5>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="alert alert-info border-0 rounded-4 py-3">
                                    <i class="bi bi-info-circle-fill me-2"></i> Keep blank if you don't want to change your password.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Current Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-3"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="current_password" class="form-control border-start-0 rounded-end-3" placeholder="Enter current password to verify">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-3"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" name="new_password" class="form-control border-start-0 rounded-end-3" placeholder="New strong password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Confirm New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-3"><i class="bi bi-shield-check"></i></span>
                                    <input type="password" name="new_password_confirmation" class="form-control border-start-0 rounded-end-3" placeholder="Repeat new password">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-grad px-5 py-2 rounded-3 shadow-sm">
                                    <i class="bi bi-check2-circle me-2"></i> Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Image Preview
        $('#imageUpload').change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#profilePreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        // Form Submission via AJAX
        $('#profileForm').on('submit', function(e) {
            e.preventDefault();
            
            let formData = new FormData(this);
            
            // Basic Frontend validation for password matching
            let newPass = $('input[name="new_password"]').val();
            let confirmPass = $('input[name="new_password_confirmation"]').val();
            
            if(newPass && newPass !== confirmPass) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'New password and confirmation do not match!'
                });
                return;
            }

            $.ajax({
                url: "{{ route('profile.update') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    Swal.fire({
                        title: 'Updating Profile...',
                        text: 'Please wait while we save your changes.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            // Update values if needed or just clear password fields
                            $('input[type="password"]').val('');
                            
                            // Dynamically update parts of the UI if user data returned
                            if(response.user) {
                                $('.fw-bold.mb-1').first().text(response.user.name);
                                if(response.user.image) {
                                    $('#profilePreview').attr('src', '/' + response.user.image);
                                }
                            }
                        });
                    }
                },
                error: function(xhr) {
                    Swal.close();
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<ul class="text-start list-unstyled">';
                        $.each(errors, function(key, value) {
                            errorHtml += `<li class="text-danger"><i class="bi bi-exclamation-circle me-2"></i>${value}</li>`;
                        });
                        errorHtml += '</ul>';
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Failed',
                            html: errorHtml
                        });
                    } else if (xhr.status === 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again.'
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
