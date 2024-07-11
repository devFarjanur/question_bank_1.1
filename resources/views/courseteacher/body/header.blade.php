<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <form class="search-form">
      <div class="input-group">
        <div class="input-group-text">
          <i data-feather="search"></i>
        </div>
        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
      </div>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="flag-icon flag-icon-bd mt-1" title="bd"></i> <span
            class="ms-1 me-1 d-none d-md-inline-block">English</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i data-feather="grid"></i>
        </a>

      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i data-feather="mail"></i>
        </a>
      </li>

      @php
    $profileData = null;
    if (Auth::check()) {
      $id = Auth::user()->id;
      $profileData = App\Models\Teacher::find($id);
    }
    @endphp

      @if ($profileData)
      <!-- Your navigation code accessing $profileData -->
    @else
      <!-- Handle the case where the user is not authenticated -->
    @endif



      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ?
  url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg')  
                    }}" alt="profile">
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
            <div class="mb-3">
              <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ?
  url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg')  
                    }}" alt="profile">
            </div>
            <div class="text-center">
              <p class="tx-16 fw-bolder">{{ isset($profileData) ? $profileData->name : '' }}</p>
              <p class="tx-12 text-muted">{{ isset($profileData) ? $profileData->email : '' }}</p>

            </div>
          </div>
          <ul class="list-unstyled p-1">
            <li class="dropdown-item py-2">
              <a href="{{ route('course.teacher.profile') }}" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="user"></i>
                <span>Profile</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="{{ route('course.teacher.change.password') }}" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="edit"></i>
                <span>Change Password</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="javascript:;" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="repeat"></i>
                <span>Switch User</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="{{ route('course.teacher.logout') }}" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="log-out"></i>
                <span>Log Out</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>