@extends('courseteacher.courseteacher_dashboard')

@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Blooms Response</a></li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-primary text-center mb-4 mt-2" style="font-size: 22px;">{{ $questionchapter->name }}</h5>
                    
                    @php $prevQuestionDescription = null; @endphp

                    @foreach($responses as $response)
                        @if($response->bloomsQuestion->question_description !== $prevQuestionDescription)
                            <h3 class="mt-4">{{ $response->bloomsQuestion->question_description }}</h3>
                            @php $prevQuestionDescription = $response->bloomsQuestion->question_description; @endphp
                        @endif

                        <div class="border rounded p-3 mt-3">
                            <p class="mb-2 mt-2"><strong>{{ chr(96 + $loop->iteration) }})</strong> {{ $response->bloomsQuestion->question_text }} [{{ $response->bloomsQuestion->question_mark }}]</p>
                            <p class="mb-2"><strong>Response Answer:</strong> {{ $response->response_answer }}</p>
                            <form action="{{ route('course.teacher.blooms.mark.update', ['response_id' => $response->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Give Mark:</label>
                                        <input class="form-control" name="marks" type="text" value="{{ $response->marks }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg mt-2">Update Mark</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

@endsection