@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
        <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle>
          <i data-feather="calendar" class="text-primary"></i>
        </span>
        <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow-1">
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Courses</h6>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h3 class="mb-2">{{ $totalCourse }}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Teachers</h6>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h3 class="mb-2">{{ $totalTeacher }}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Students</h6>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h3 class="mb-2">{{ $totalStudent }}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Question Category</h4>
    </div>
    <div class=" mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
      <a href="{{ route('admin.question.category.create') }}" class="btn btn-primary">Create Question Category</a>
    </div>
  </div>

  <div class="row row-cols-2 row-cols-md-4">
    @foreach($categories as $category)
    <div class="col mb-3">
      <a href="#" class="card h-100 text-decoration-none">
      <div class="card-body d-flex flex-column justify-content-between">
        <div class="text-center align-self-center mt-3"> <!-- Center the content horizontally and vertically -->
        <h5 class="card-title" style="font-size: 22px;">{{ $category->name }}</h5>
        </div>
        <div>
        <!-- You can optionally place content or buttons here -->
        </div>
      </div>
      </a>
    </div>
  @endforeach 
  </div>


  <div class="row mt-5">
    <div class="col-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-baseline mb-2">
            <h6 class="card-title mb-0">Teachers List</h6>
          </div>
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th class="pt-0">#</th>
                  <th class="pt-0">Teacher Name</th>
                  <th class="pt-0">Email</th>
                  <th class="pt-0">Phone</th>
                  <th class="pt-0">Assigned Course</th>
                  <th class="pt-0">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($teachers as $teacher)
                  <tr>
                    <td>{{ $teacher->id }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->phone }}</td>
                    <td>{{ $teacher->course->name }}</td>
                    <td>{{ $teacher->status }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-baseline mb-2">
            <h6 class="card-title mb-0">Student List</h6>
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
  </div>
</div>

@endsection