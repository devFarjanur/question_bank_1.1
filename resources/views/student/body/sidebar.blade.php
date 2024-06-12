<nav class="sidebar">
      <div class="sidebar-header">
        <a href="{{ route('student.course') }}" class="sidebar-brand">
          p<span>Learning</span>
        </a>
   
      </div>
      <div class="sidebar-body">
        <ul class="nav">

        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.course') }}">
              <i class="link-icon" data-feather="book"></i>
              <span class="link-title">Course Content</span>
            </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('student.exam') }}">
            <i class="link-icon" data-feather="help-circle"></i>
            <span class="link-title">Exam</span>
          </a>
        </li>


        <li class="nav-item">
          <a href="{{ route('student.exam.result') }}" class="nav-link">
            <i class="link-icon" data-feather="clipboard"></i>
            <span class="link-title">Result</span>
          </a>
        </li>


        </ul>
      </div>
    </nav>