@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

<nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Question</a></li>
            <li class="breadcrumb-item active" aria-current="page">Question Category List</li>
        </ol>
    </nav>


<div class=" mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{ route('admin.question.category.create') }}" class="btn btn-primary">Create Question Category</a>

</div>



<div class="row row-cols-2 row-cols-md-4">
  @foreach($categories as $category)
    <div class="col mb-3">
      <a href="#" class="card h-100 text-decoration-none">
        <div class="card-body d-flex flex-column justify-content-between">
          <div class="text-center align-self-center mt-3"> <!-- Center the content horizontally and vertically -->
            <h5 class="card-title" style="font-size: 22px;">{{ $category->name }}</h5>
          </div>
          <div>
            <!-- You can optionally place content or buttons here -->
          </div>
        </div>
      </a>
    </div>
  @endforeach
</div>




</div>



@endsection