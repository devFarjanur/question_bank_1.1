@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

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
      </div>

      <div class="row mt-3">
      <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
        <div class="col-2 grid-margin stretch-card">
          <div class="card" style="height: 120px;"> <!-- Add your desired height here -->
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
            <h6 class="card-title mb-0">Total Students</h6>
            </div>
            <div class="row">
            <div class="col-6 col-md-12 col-xl-5">
              <h3 class="mb-2">{{ $totalStudents }}</h3>
            </div>
            </div>
          </div>
          </div>
        </div>
        @if($students->isNotEmpty())
      <div class="col-10 stretch-card">
        <div class="card">
        <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
        <h4 class="mb-3">Students Registered to {{ $assignedCourse->name }}</h4>
        </div>
        <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead>
          <tr>
          <th class="pt-0">#</th>
          <th class="pt-0">Student Name</th>
          <th class="pt-0">Email</th>
          <th class="pt-0">Phone</th>
          <th class="pt-0">Registered Course</th>
          <th class="pt-0">Status</th>
          </tr>
          </thead>
          <tbody>
          @foreach($students as $student)
        <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->phone }}</td>
        <td>{{ $student->course->name }}</td>
        <td>{{ $student->status }}</td>
        </tr>
      @endforeach
          </tbody>
        </table>
        </div>
        </div>
        </div>
      </div>
    @else
    <p>No students assigned to this course.</p>
  @endif
        </div>
      </div>
      </div>
    @else
      <p>No course assigned.</p>
    @endif

</div>

@endsection