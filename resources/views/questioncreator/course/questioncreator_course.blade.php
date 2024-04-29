@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

<nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Course</a></li>
            <li class="breadcrumb-item active" aria-current="page">Course Name</li>
        </ol>
    </nav>


<div class=" mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{ route('admin.course.create') }}" class="btn btn-primary">Create Course</a>

</div>



<div class="row row-cols-2 row-cols-md-4">
  @foreach($courses as $course)
    <div class="col mb-3">
      <a href="#" class="card h-100 text-decoration-none">
        <div class="card-body d-flex flex-column justify-content-between">
          <div class="text-center align-self-center mt-3"> <!-- Center the content horizontally and vertically -->
            <h5 class="card-title" style="font-size: 22px;">{{ $course->name }}</h5>
          </div>
          <div>
            <!-- You can optionally place content or buttons here -->
          </div>
        </div>
      </a>
    </div>
  @endforeach
</div>




</div>



@endsection