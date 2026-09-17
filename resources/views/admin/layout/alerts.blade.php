@if(session('success'))
<div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mx-3 mx-lg-4 mt-3 mb-0" style="background-color: #E2F4EA; color: #1C7C4C; border-radius: 12px; border-left: 4px solid #1C7C4C !important;" role="alert">
    <div class="d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <span>{{ session('success') }}</span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show mx-3 mx-lg-4 mt-3 mb-0" style="background-color: #FDE8E8; color: #DC3545; border-radius: 12px; border-left: 4px solid #DC3545 !important;" role="alert">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <span>{{ session('error') }}</span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(isset($errors) && $errors->any())
<div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show mx-3 mx-lg-4 mt-3 mb-0" style="background-color: #FDE8E8; color: #DC3545; border-radius: 12px; border-left: 4px solid #DC3545 !important;" role="alert">
    <div class="fw-bold mb-1 d-flex align-items-center"><i class="bi bi-exclamation-circle-fill me-2 fs-5"></i>Please resolve the following:</div>
    <ul class="mb-0 ps-4">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
