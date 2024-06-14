@extends('student.student_dashboard')
@section('student')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Course</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $assignedCourse->name }}</li>
        </ol>
    </nav>



    <div class="row">
        @if($assignedCourse)
            <div class="col-12 mb-3">
                <a href="#" class="card h-100 text-decoration-none">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center align-self-center mt-3">
                            <!-- Center the content horizontally and vertically -->
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


    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @if(isset($lessons) && $lessons->count() > 0)
            @foreach($lessons as $lesson)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <a href="{{ route('course.student.lesson', $lesson) }}" class="text-decoration-none">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="mt-3">
                                    <h4 class="card-title text-center">{{ $lesson->title }}</h4>
                                </div>
                            </div>
                        </a>
                        <div class="card-footer text-center">
                            <small class="text-muted">Lesson {{ $loop->iteration }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    No lessons found
                </div>
            </div>
        @endif
    </div>
</div>

@endsection