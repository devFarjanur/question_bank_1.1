@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">

<nav class="page-breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Question</a></li>
		<li class="breadcrumb-item active" aria-current="page">Question Chapter Name</li>
	</ol>
</nav>


    <div class="row">
		
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Add Question Chapter Name</h4>

                <form method="POST" action="{{ route('course.teacher.question.chapter.store', $category->id) }}" enctype="multipart/form-data">
                @csrf 

                    <div class="mb-3">
                        <label for="question" class="form-label">Chapter Name:</label>
                        <input id="question" class="form-control" name="questionchapter" type="text">
                    </div>

                    <input class="btn btn-primary" type="submit" value="Submit">
                </form>


                </div>
            </div>
        </div>
    
	</div>

</div>




@endsection