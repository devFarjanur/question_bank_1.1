<nav class="sidebar">
  <div class="sidebar-header">
    <a href="{{ route('admin.course') }}" class="sidebar-brand">
      p<span>Learning</span>
    </a>

  </div>
  <div class="sidebar-body">
    <ul class="nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.course') }}">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Course</span>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{ route('admin.course.teacher') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Teacher Request</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.course.student') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Student Request</span>
        </a>
      </li>


      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="link-icon" data-feather="message-square"></i>
          <span class="link-title">Chat</span>
        </a>
      </li>


      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Calendar</span>
        </a>
      </li>

    </ul>
  </div>
</nav>