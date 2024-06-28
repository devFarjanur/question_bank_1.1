@extends('courseteacher.courseteacher_dashboard')

@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Student Exam List</a></li>
        </ol>
    </nav>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Exam</th>
                                <th>Question Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $exam->exam_name }}</td>
                                    <td>{{ $exam->questioncategory->name }}</td>
                                    <td>
                                        {{-- Response Button --}}
                                        <a href="{{ $exam->questioncategory->name === 'MCQ' ? route('course.teacher.mcq.response', ['student_id' => $student->id, 'exam_id' => $exam->id]) : route('course.teacher.blooms.response', ['student_id' => $student->id, 'exam_id' => $exam->id]) }}" class="btn btn-primary">View {{ $exam->questioncategory->name }} Response</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection