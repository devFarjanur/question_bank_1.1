@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Exam Result</a></li>
        </ol>
    </nav>

    <!-- MCQ Exam Scores -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>MCQ Exam Scores</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Exam Name</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Question Chapter</th>
                            <th class="text-center">Question Category</th>
                            <th class="text-center">Total Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mcqScores as $examName => $students)
                            @foreach($students as $studentName => $chapters)
                                @foreach($chapters as $chapterName => $categories)
                                    @foreach($categories as $categoryName => $totalScore)
                                        <tr>
                                            <td class="text-center">{{ $examName }}</td>
                                            <td class="text-center">{{ $studentName }}</td>
                                            <td class="text-center">{{ $chapterName }}</td>
                                            <td class="text-center">{{ $categoryName }}</td>
                                            <td class="text-center">{{ $totalScore }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Blooms Exam Scores -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Blooms Exam Scores</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Exam Name</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Question Chapter</th>
                            <th class="text-center">Question Category</th>
                            <th class="text-center">Remembering</th>
                            <th class="text-center">Understanding</th>
                            <th class="text-center">Applying</th>
                            <th class="text-center">Analyzing</th>
                            <th class="text-center">Evaluating</th>
                            <th class="text-center">Creating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bloomsScores as $examName => $students)
                            @foreach($students as $studentName => $chapters)
                                @foreach($chapters as $chapterName => $categories)
                                    @foreach($categories as $categoryName => $levels)
                                        <tr>
                                            <td class="text-center">{{ $examName }}</td>
                                            <td class="text-center">{{ $studentName }}</td>
                                            <td class="text-center">{{ $chapterName }}</td>
                                            <td class="text-center">{{ $categoryName }}</td>
                                            <td class="text-center">{{ $levels['Remembering'] ?? 0 }}</td>
                                            <td class="text-center">{{ $levels['Understanding'] ?? 0 }}</td>
                                            <td class="text-center">{{ $levels['Applying'] ?? 0 }}</td>
                                            <td class="text-center">{{ $levels['Analyzing'] ?? 0 }}</td>
                                            <td class="text-center">{{ $levels['Evaluating'] ?? 0 }}</td>
                                            <td class="text-center">{{ $levels['Creating'] ?? 0 }}</td>
                                        </tr>
                                    @endforeach
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
