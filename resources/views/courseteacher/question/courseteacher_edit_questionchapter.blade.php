@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Question</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Question Chapter</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Question Chapter</h4>
                    <form method="POST" action="{{ route('course.teacher.question.chapter.update', $questionchapter->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="questionchapter" class="form-label">Chapter Name:</label>
                            <input id="questionchapter" class="form-control" name="questionchapter" type="text" value="{{ $questionchapter->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Update Chapter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
