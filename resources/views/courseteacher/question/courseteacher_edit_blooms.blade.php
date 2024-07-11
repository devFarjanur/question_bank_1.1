@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Question</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Blooms Question</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit BLOOMS Question</h4>
                    <form method="POST" action="{{ route('course.teacher.blooms.update', $question->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="question_description" class="form-label">Question Description:</label>
                            <textarea id="question_description" class="form-control" name="question_description"
                                rows="4" required>{{ $question->question_description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="question_text" class="form-label">Question Text:</label>
                            <input id="question_text" class="form-control" name="question_text" type="text"
                                value="{{ $question->question_text }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="bloom_taxonomy" class="form-label">Bloom's Taxonomy Level:</label>
                            <select id="bloom_taxonomy" class="form-control" name="bloom_taxonomy" required>
                                <option value="" disabled>-- Select Category --</option>
                                <option value="Remembering" {{ $question->bloom_taxonomy == 'Remembering' ? 'selected' : '' }}>Remembering</option>
                                <option value="Understanding" {{ $question->bloom_taxonomy == 'Understanding' ? 'selected' : '' }}>Understanding</option>
                                <option value="Applying" {{ $question->bloom_taxonomy == 'Applying' ? 'selected' : '' }}>
                                    Applying</option>
                                <option value="Analyzing" {{ $question->bloom_taxonomy == 'Analyzing' ? 'selected' : '' }}>Analyzing</option>
                                <option value="Evaluating" {{ $question->bloom_taxonomy == 'Evaluating' ? 'selected' : '' }}>Evaluating</option>
                                <option value="Creating" {{ $question->bloom_taxonomy == 'Creating' ? 'selected' : '' }}>
                                    Creating</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="question_mark" class="form-label">Question Mark:</label>
                            <input id="question_mark" class="form-control" name="question_mark" type="text"
                                value="{{ $question->question_mark }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Update Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection