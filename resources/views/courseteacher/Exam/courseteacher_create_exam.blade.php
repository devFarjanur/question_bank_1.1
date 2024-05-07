@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Exam</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create Exam</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Exam</h4>
          <form method="POST" action="{{ route('course.teacher.exam.store') }}">
          @csrf
          <div class="form-group mb-3">
              <label for="exam_name" class="form-label">Exam Name:</label>
              <input type="text" class="form-control" id="exam_name" name="exam_name" required>
          </div>

          <div class="form-group mb-3">
              <label for="question_category" class="form-label">Select Question Category:</label>
              <select class="form-control" id="question_category" name="questioncategory_id" required>
                  <option value="" selected disabled>-- Select Question Category --</option>
                  @foreach($questioncategories as $questioncategory)
                      <option value="{{ $questioncategory->id }}">{{ $questioncategory->name }}</option>
                  @endforeach
              </select>
          </div>

          <div class="form-group mb-3">
              <label for="question_chapter" class="form-label">Select Question Chapter:</label>
              <select class="form-control" id="question_chapter" name="questionchapter_id" required>
                  <option value="" selected disabled>-- Select Question Chapter --</option>
              </select>
          </div>

          <button type="submit" class="btn btn-primary mt-3">Create Exam</button>
      </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const questionCategorySelect = document.getElementById('question_category');
    const questionChapterSelect = document.getElementById('question_chapter');
    const mcqQuestionChapters = @json($mcqQuestionChapters);
    const bloomsQuestionChapters = @json($bloomsQuestionChapters);

    questionCategorySelect.addEventListener('change', function () {
      const selectedCategory = questionCategorySelect.value;
      questionChapterSelect.innerHTML = ''; // Clear options before populating

      if (selectedCategory === '{{ $mcqCategoryId }}') {
        mcqQuestionChapters.forEach(question_chapters => {
          const option = document.createElement('option');
          option.value = question_chapters.id;
          option.text = question_chapters.name;
          questionChapterSelect.appendChild(option);
        });
      } else if (selectedCategory === '{{ $bloomsCategoryId }}') {
        bloomsQuestionChapters.forEach(question_chapters => {
          const option = document.createElement('option');
          option.value = question_chapters.id;
          option.text = question_chapters.name;
          questionChapterSelect.appendChild(option);
        });
      }
    });
  });
</script>

@endsection
