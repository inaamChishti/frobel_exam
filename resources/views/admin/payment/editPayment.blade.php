@extends('layouts.admin')

@section('content')

<title>Exam Details</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

<div class="container mt-2 offset-md-2">
    <div class="row offset-md-10">
        <div class="col-md-12">
            <!-- Breadcrumb links -->
            <nav aria-label="breadcrumb">
                {{-- <a href="{{url('viewExam')}}" class="btn btn-primary btn-sm  offset-md-2" style="position: relative;background-color: #069d57; ">View Records</a> --}}
            </nav>
        </div>
    </div>

    <div class="row justify-content-center mt-2">
        <div class="col-md-6">
            @if (session('success'))
                    <!-- Success message -->
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if (@$errors->any())
                    <!-- Error messages -->
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="card">

                <div class="card-header text-white" style="background-color: #05a36e;">
                    <h4 class="mb-0" style="color: rgb(255, 255, 255);">Proceed Payment Record</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('updatePayment')}}">
                        <div class="mb-3">
                            <label for="subjectName" class="form-label">Name</label>
                            <input type="text" class="form-control" disabled name="user_id" id="user_id" value="{{ @$user['name'] }}" placeholder="Enter user ID">
                            <input type="hidden" class="form-control"  name="payment_id" id="id" value="{{ @$payments['id'] }}">
                        </div>

                        <div class="mb-3">
                            <label for="toDate" class="form-label">Uploaded At</label>
                            <input type="text" class="form-control" disabled name="uploaded_at" id="uploaded_at" value="{{ \Carbon\Carbon::parse(@$payments->uploaded_at)->diffForHumans() }}" placeholder="Enter uploaded_at">
                        </div>
                        <div class="mb-3">
                            <label for="approved">Approved</label>
                            <select class="form-control" name="approved" id="approved">
                                <option value="1" {{ @$payments['approved'] == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ @$payments['approved'] == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" style="width: 100%; background-color:#05a36e; color: rgb(255, 255, 255); border: 1px solid #d9dcdf;" class="btn btn-primary">
                                <b>Submit</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
