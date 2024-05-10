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
          <h4 class="card-title">Student Exam List</h4>
          <form id="student_search_form" method="" action="#">

            @csrf

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
                <label for="exam" class="form-label">Select Exam:</label>
                <select class="form-control" id="exam" name="exam_id" required disabled>
                    <option value="" selected disabled>-- Select Exam --</option>
                    @foreach($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3" id="student-dropdown">
                <label for="student" class="form-label">Select Student:</label>
                <select class="form-control" id="student" name="student_id" required disabled>
                    <option value="" selected disabled>-- Select Student --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const questionCategorySelect = document.getElementById('question_category');
    const examSelect = document.getElementById('exam');
    const studentDropdown = document.getElementById('student-dropdown');

    questionCategorySelect.addEventListener('change', function () {
        const selectedCategory = questionCategorySelect.value;

        // Clear exam and student options before populating
        examSelect.innerHTML = '<option value="" selected disabled>-- Select Exam --</option>';
        examSelect.disabled = true;
        studentDropdown.innerHTML = '<option value="" selected disabled>-- Select Student --</option>';
        studentDropdown.disabled = true;

        // Enable the exam dropdown if a category is selected
        if (selectedCategory !== '') {
            examSelect.disabled = false;
        }

        // Populate exam options based on the selected category
        if (selectedCategory === '{{ $mcqCategoryId }}') {
            @foreach($mcqExams as $exam)
                const option = document.createElement('option');
                option.value = '{{ $exam->id }}';
                option.text = '{{ $exam->name }}';
                examSelect.appendChild(option);
            @endforeach
        } else if (selectedCategory === '{{ $bloomsCategoryId }}') {
            @foreach($bloomsExams as $exam)
                const option = document.createElement('option');
                option.value = '{{ $exam->id }}';
                option.text = '{{ $exam->name }}';
                examSelect.appendChild(option);
            @endforeach
        }

        // Enable the exam dropdown
        examSelect.disabled = false;
    });

    // Show student dropdown when an exam is selected
    examSelect.addEventListener('change', function () {
        const selectedExamId = examSelect.value;

        // Clear student options before populating
        studentDropdown.innerHTML = '<option value="" selected disabled>-- Select Student --</option>';
        studentDropdown.disabled = true;

        // Enable the student dropdown if an exam is selected
        if (selectedExamId !== '') {
            studentDropdown.disabled = false;
        }

        // Fetch students who have taken the selected exam using AJAX
        // You can remove this part if you don't want to use AJAX
        fetch(`/api/exams/${selectedExamId}/students`)
            .then(response => response.json())
            .then(data => {
                // Populate student options
                data.forEach(student => {
                    const option = document.createElement('option');
                    option.value = student.id;
                    option.text = student.name;
                    studentDropdown.appendChild(option);
                });

                // Enable the student dropdown
                studentDropdown.disabled = false;
            })
            .catch(error => console.error('Error fetching students:', error));
    });

    // Validate the form before submitting
    document.getElementById('student_search_form').addEventListener('submit', function(event) {
        const selectedStudentId = document.getElementById('student').value;
        if (!selectedStudentId) {
            alert('Please select a Student.');
            event.preventDefault(); // Prevent form submission
        }
    });
});

</script>

@endsection
