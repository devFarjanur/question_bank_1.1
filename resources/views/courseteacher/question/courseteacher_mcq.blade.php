@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Question</a></li>
            <li class="breadcrumb-item active" aria-current="page">MCQ Question</li>
        </ol>
    </nav>


    <div class=" mb-3 d-grid gap-2 d-md-flex justify-content-md-end">

        <a href="{{ route('course.teacher.mcq.add', ['id' => $questionchapter->id]) }}" class="btn btn-primary">Add MCQ Question</a>

    </div>


    <div class="mt-3">
        
        <div class="row">
            
            <div class="col-md-12">
                
                <div class="card pb-5">

                    
                    <div class="card-body pt-5 px-5">
                        <h5 class="card-title text-primary text-center" style="font-size: 22px;">{{ $questionchapter->name }}</h5>
                    </div>





                </div>
            </div>
        </div>
    </div>

</div>




@endsection