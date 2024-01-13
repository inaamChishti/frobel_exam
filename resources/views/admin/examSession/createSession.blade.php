@extends('layouts.admin')

@section('content')

<title>Exam Details</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

<div class="container mt-2 offset-md-2">
    <div class="row offset-md-10">
        <div class="col-md-12">
            <!-- Breadcrumb links -->
            <a href="{{url('viewSession')}}" class="btn btn-primary btn-sm  offset-md-2" style="position: relative;background-color: #069d57; ">View Sessions</a>
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

                @if ($errors->any())
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
                    <h4 class="mb-0" style="color: rgb(255, 255, 255);">Create Exam Session</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('storeExamSession')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="examSession" class="form-label">Exam Session</label>
                            <input type="text" class="form-control" name="examSession" id="examSession" placeholder="Enter Exam Session">
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
