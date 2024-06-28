@extends('admin.admin_dashboard')
@section('admin')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">

<nav class="page-breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Question</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create Question Category</li>
	</ol>
</nav>


    <div class="row">
		
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Update Question Category</h4>

                <form action="{{ route('admin.question.category.update', $category->id) }}" method="POST">
                @csrf 
                    <div class="mb-3">
                        <label for="question" class="form-label">Question Category:</label>
                        <input id="question" class="form-control" name="questionCategory" type="text" value="{{ $category->name }}">
                    </div>

                    <input class="btn btn-primary" type="submit" value="Update">
                </form>


                </div>
            </div>
        </div>
    
	</div>

</div>


@endsection