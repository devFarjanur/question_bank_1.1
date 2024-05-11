@extends('student.student_dashboard')

@section('student')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Exam Result</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <h4>Exam Scores</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Exam Name</th>
                            <th class="text-center">Question Chapter</th>
                            <th class="text-center">Question Category</th>
                            <th class="text-center">Total Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bloomsScores as $examName => $chapters)
                            @foreach($chapters as $chapterName => $categories)
                                @foreach($categories as $categoryName => $totalScore)
                                    <tr>
                                        <td class="text-center">{{ $examName }}</td>
                                        <td class="text-center">{{ $chapterName }}</td>
                                        <td class="text-center">{{ $categoryName }}</td>
                                        <td class="text-center">{{ $totalScore }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
