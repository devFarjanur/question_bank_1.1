@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Question</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit MCQ Question</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit MCQ Question</h4>
                    <form method="POST" action="{{ route('course.teacher.mcq.update', $mcq->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="question_text" class="form-label">Question Text:</label>
                            <input id="question_text" class="form-control" name="question_text" type="text"
                                value="{{ $mcq->question_text }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_a" class="form-label">Option A:</label>
                            <input id="option_a" class="form-control" name="option_a" type="text"
                                value="{{ $mcq->option_a }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_b" class="form-label">Option B:</label>
                            <input id="option_b" class="form-control" name="option_b" type="text"
                                value="{{ $mcq->option_b }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_c" class="form-label">Option C:</label>
                            <input id="option_c" class="form-control" name="option_c" type="text"
                                value="{{ $mcq->option_c }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_d" class="form-label">Option D:</label>
                            <input id="option_d" class="form-control" name="option_d" type="text"
                                value="{{ $mcq->option_d }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correct Option:</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="correct_option" value="a" {{ $mcq->correct_option == 'a' ? 'checked' : '' }}>
                                <label class="form-check-label" for="correctOptionA">Option A</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="correct_option" value="b" {{ $mcq->correct_option == 'b' ? 'checked' : '' }}>
                                <label class="form-check-label" for="correctOptionB">Option B</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="correct_option" value="c" {{ $mcq->correct_option == 'c' ? 'checked' : '' }}>
                                <label class="form-check-label" for="correctOptionC">Option C</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="correct_option" value="d" {{ $mcq->correct_option == 'd' ? 'checked' : '' }}>
                                <label class="form-check-label" for="correctOptionD">Option D</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection