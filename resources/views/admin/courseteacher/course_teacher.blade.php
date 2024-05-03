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
                <h6 class="card-title">Course Teacher</h6>
                <div class="table-responsive">
                    @if ($pendingRequests->isEmpty())
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
                                @foreach ($pendingRequests as $request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $request->name }}</td>
                                        <td>{{ $request->email }}</td>
                                        <td>{{ $request->course->name }}</td> <!-- Assuming this is how you access the course name -->
                                        <td>{{ $request->role }}</td> <!-- Assuming this is how you access the role -->
                                        <td>
                                            <form method="POST" action="{{ route('admin.approve.course.teacher', $request->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary">Approve</button>
                                            </form>
                                            <a href="#" class="btn btn-danger">Reject</a>
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
