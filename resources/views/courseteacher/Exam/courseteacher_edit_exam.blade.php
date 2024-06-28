@extends('courseteacher.courseteacher_dashboard')

@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Exams</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Exam</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Exam</h4>

                    <form method="POST" action="{{ route('course.teacher.exam.update', $exam->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="exam_name" class="form-label">Exam Name:</label>
                            <input id="exam_name" class="form-control" name="exam_name" type="text" value="{{ $exam->exam_name }}">
                        </div>

                        <div class="mb-3">
                            <label for="questioncategory_id" class="form-label">Question Category:</label>
                            <select id="questioncategory_id" class="form-control" name="questioncategory_id">
                                @foreach($questioncategories as $category)
                                    <option value="{{ $category->id }}" {{ $exam->questioncategory_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="questionchapter_id" class="form-label">Question Chapter:</label>
                            <select id="questionchapter_id" class="form-control" name="questionchapter_id">
                                <optgroup label="MCQ Chapters">
                                    @foreach($mcqQuestionChapters as $chapter)
                                        <option value="{{ $chapter->id }}" {{ $exam->questionchapter_id == $chapter->id ? 'selected' : '' }}>{{ $chapter->name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="BLOOMS Chapters">
                                    @foreach($bloomsQuestionChapters as $chapter)
                                        <option value="{{ $chapter->id }}" {{ $exam->questionchapter_id == $chapter->id ? 'selected' : '' }}>{{ $chapter->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <input class="btn btn-primary" type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
