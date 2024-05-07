@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Exam</a></li>
            <li class="breadcrumb-item active" aria-current="page">Exam name</li>
        </ol>
    </nav>

    
<div class=" mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{ route('course.teacher.exam.create') }}" class="btn btn-primary">Create Exam</a>
</div>





</div>
@endsection