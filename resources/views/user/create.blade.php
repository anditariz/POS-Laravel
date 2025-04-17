@extends('layouts.main')
@section('title', 'Add User')

@section('content')
<div class="container mt-4">
    <section class="section">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Add User</h5>

                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                            <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
