@extends('layouts.admin')

@section('content')
<head>
    <title>DataTables Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
</head>

<style>
    /* Custom styles for the table */
    #example {
        background-color: #f5f5f5;
        border: 1px solid #ccc;
    }

    #example thead th {
        background-color: #319d6b;
        color: black;
        padding: 10px;
    }

    #example tbody td {
        background-color: #fff;
        color: #333;
        padding: 10px;
    }

    #example tbody tr:hover {
        background-color: #f8f8f8;
    }

    /* Interactive heading styles */
    .interactive-heading {
        position: relative;
        display: inline-block;
        cursor: pointer;
        margin-right: 20px;
    }

    .interactive-heading::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #007bff;
        transform: scaleX(0);
        transition: transform 0.3s ease-in-out;
    }

    .interactive-heading:hover::after {
        transform: scaleX(1);
    }
</style>

<div class="container mt-4">
    <div class="col-md-11 form-container offset-md-2"> <!-- Remove the "text-center" class -->
        <!-- Your table code -->
        @if (session('success'))
        <!-- Success message -->
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
        <div class="table-responsive">
            <h3 class="interactive-heading">List Exam Sessions</h3>
            <table id="example" class="table table-striped mt-4" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center"><b>#</b></th>
                        <th class="text-center"><b>Exam Session</b></th>
                        <th class="text-center"><b>Issued</b></th>
                        <th class="text-center"><b>Actions</b></th> <!-- New Actions column -->
                    </tr>
                </thead>
                <tbody>
                    @if(@$exams)
                    @foreach($exams as $exam)
                    <tr>
                        <td class="text-center">

                            {{ @$exam->id }}
                        </td>
                        <td class="text-center">
                            {{@$exam->exam_session}}
                        </td>
                        <td class="text-center">{{ @$exam->created_at->diffForHumans() }}</td>
                        <td class="text-center">
                            <!-- Edit button -->
                            <a href="{{url('editExamSession/'.@$exam->id)}}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                            <a href="{{url('deleteExamSession/'.@$exam->id)}}" class="btn btn-danger btn-sm">
                                Destroy
                            </a>

                            <!-- Delete button -->

                        </td>

                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
    </div>
</div>
@endsection
