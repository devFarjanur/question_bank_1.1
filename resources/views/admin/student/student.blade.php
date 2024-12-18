@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Course</a></li>
            <li class="breadcrumb-item active" aria-current="page">Course Teacher</li>
        </ol>
    </nav>


    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Student</h6>
                <div class="table-responsive">
                    @if ($pendingStudentRequests->isEmpty())
                        <p>No pending requests found.</p>
                    @else
                        <table class="table table-hover text-center"> <!-- Added text-center class -->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Course</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingStudentRequests as $request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $request->name }}</td>
                                        <td>{{ $request->email }}</td>
                                        <td>{{ $request->course->name }}</td> <!-- Assuming this is how you access the course name -->
                                        <td>{{ $request->role }}</td> <!-- Assuming this is how you access the role -->
                                        
                                        <td>
                                            <div class="d-grid gap-2 d-md-flex justify-content-center">
                                                <form method="POST" action="{{ route('admin.approve.course.student', $request->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-primary me-md-2 btn-lg">Approve</button>
                                                </form>
                                                <form method="post" action="{{ route('admin.reject.course.student', $request->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-lg">Reject</button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>


</div>


@endsection
