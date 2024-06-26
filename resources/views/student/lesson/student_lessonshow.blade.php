@extends('student.student_dashboard')
@section('student')

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
                        <a href="{{ route('course.student.lesson', $lesson) }}" class="btn btn-primary">Back to Lessons</a>
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
                    <div class="mt-4">
                        <button class="btn btn-success" id="markCompletedButton" data-bs-toggle="modal" data-bs-target="#markCompletedModal">Mark as Completed</button>
                    </div>
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
        const lessonId = {{ $lesson->id }};
        const url = "{{ route('lesson.complete', ':lessonId') }}".replace(':lessonId', lessonId);

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ lesson_id: lessonId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                var modal = bootstrap.Modal.getInstance(document.getElementById('markCompletedModal'));
                modal.hide();
                // Change the button text to "Lesson Completed"
                document.getElementById('markCompletedButton').textContent = 'Lesson Completed';
                document.getElementById('markCompletedButton').classList.remove('btn-success');
                document.getElementById('markCompletedButton').classList.add('btn-secondary');
                document.getElementById('markCompletedButton').disabled = true;
            } else {
                alert('An error occurred. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
</script>

@endsection
