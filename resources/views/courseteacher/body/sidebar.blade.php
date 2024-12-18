<nav class="sidebar">
  <div class="sidebar-header">
    <a href="{{ route('course.teacher.course') }}" class="sidebar-brand">
      p<span>Learning</span>
    </a>

  </div>
  <div class="sidebar-body">
    <ul class="nav">


      <li class="nav-item">
        <a class="nav-link" href="{{ route('course.teacher.course') }}">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{ route('course.teacher.lesson') }}">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Course Content</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('course.teacher.question.category') }}">
          <i class="link-icon" data-feather="help-circle"></i>
          <span class="link-title">Question</span>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{ isset($examId) ? route('course.teacher.exam', ['examId' => $examId]) : route('course.teacher.exam') }}"
          class="nav-link">
          <i class="link-icon" data-feather="clipboard"></i>
          <span class="link-title">Exam</span>
        </a>
      </li>



      <li class="nav-item">
        <a href="{{ route('course.teacher.exam.category') }}" class="nav-link">
          <i class="link-icon" data-feather="bookmark"></i>
          <span class="link-title">Student Exam</span>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{ route('course.teacher.exam.results') }}" class="nav-link">
          <i class="link-icon" data-feather="bookmark"></i>
          <span class="link-title">Student Result</span>
        </a>
      </li>





    </ul>
  </div>
</nav>