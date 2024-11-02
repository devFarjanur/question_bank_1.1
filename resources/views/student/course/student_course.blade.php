@extends('student.student_dashboard')
@section('student')


<div class="page-content">

  <div class="d-flex align-items-right justify-content-end flex-wrap text-nowrap">
    <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
      <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle>
        <i data-feather="calendar" class="text-primary"></i>
      </span>
      <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
    </div>
  </div>


  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Course</a></li>
      <li class="breadcrumb-item active" aria-current="page">Course Name</li>
    </ol>
  </nav>


  <div class="row">
    @if($assignedCourse)
    <div class="col-12 mb-3">
      <a href="#" class="card h-100 text-decoration-none">
      <div class="card-body d-flex flex-column justify-content-between">
        <div class="text-center align-self-center mt-3"> <!-- Center the content horizontally and vertically -->
        <h5 class="card-title" style="font-size: 22px;">{{ $assignedCourse->name }}</h5>
        </div>
        <div>
        <!-- You can optionally place content or buttons here -->
        </div>
      </div>
      </a>
    </div>
  @endif <!-- Add this line to close the if condition -->
  </div> <!-- This closing div is already present, no need to change -->

</div>

@endsection