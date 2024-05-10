@extends('student.student_dashboard')
@section('student')





<div class="page-content">

    @foreach($results as $result)
    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card px-5 pb-4">
                <div class="card-body py-5">
                    <h4 style="font-size: 28px;">{{ $result->exam->name }}</h4>
                    <h4 style="font-size: 22px;">Exam Score: {{ $result->score }}</h4>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>





@endsection