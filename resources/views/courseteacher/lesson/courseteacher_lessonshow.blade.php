@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Course Content</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $lesson->title }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mt-3 mb-3">{{ $lesson->title }}</h2>
                        <a href="{{ route('course.teacher.lesson') }}" class="btn btn-primary btn-lg">Back to Lessons</a>
                    </div>
                    @if($lesson->video_url)
                        <div class="embed-responsive" style="height: 500px;">
                            <iframe class="embed-responsive-item" src="{{ $lesson->video_url }}" allowfullscreen style="width: 100%; height: 100%;"></iframe>
                        </div>
                    @else
                        <p class="text-muted">No video available for this lesson.</p>
                    @endif
                    <div class="content">
                        <h4 class="mt-5 mb-3">{{ $lesson->content }}</h4>
                    </div>
                    <!-- <div class="mt-4">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#markCompletedModal">Mark as Completed</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade custom-modal" id="markCompletedModal" tabindex="-1" aria-labelledby="markCompletedModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="markCompletedModalLabel">Confirm Completion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to mark this lesson as completed?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="confirmCompletion()">Yes, Mark as Completed</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmCompletion() {
        // Your logic to mark the lesson as completed
        alert('Lesson marked as completed!');
        var modal = bootstrap.Modal.getInstance(document.getElementById('markCompletedModal'));
        modal.hide();
    }
</script>

@endsection
