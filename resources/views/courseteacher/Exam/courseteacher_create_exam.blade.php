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
          <form id="exam_form" method="POST" action="{{ route('course.teacher.exam.store') }}">

            @csrf
            <!-- Include a hidden input field for course_id -->
            <input type="hidden" name="course_id" value="{{ $courseId }}">
            <!-- Hidden input field to store the selected question chapter ID -->
            <input type="hidden" id="questionchapter_id" name="questionchapter_id" value="{{ $questionChapterId }}">



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
              <label for="question_chapter" class="form-label">Select Question Lesson:</label>
              <select class="form-control" id="question_chapter" required>
                  <option value="" selected disabled>-- Select Question Lesson --</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mt-3">Create Exam</button>
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

        // Add the default option with an empty value
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = '-- Select Question Chapter --';
        questionChapterSelect.appendChild(defaultOption);

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

    // Add event listener to update the hidden input with selected question chapter ID
    questionChapterSelect.addEventListener('change', function () {
        const selectedChapterId = questionChapterSelect.value;
        document.getElementById('questionchapter_id').value = selectedChapterId;
    });
});

// Validate the form before submitting
document.getElementById('exam_form').addEventListener('submit', function(event) {
    const selectedChapterId = document.getElementById('questionchapter_id').value;
    if (!selectedChapterId) {
        alert('Please select a question chapter.');
        event.preventDefault(); // Prevent form submission
    }
});

</script>


@endsection