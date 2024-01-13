@extends('layouts.admin')

@section('content')
<head>
    <title>DataTables Example</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

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

    <div class="container mt-2">
        <div class="row offset-md-10" >
            <div class="col-md-12">
                <!-- Breadcrumb links -->
                <button id="showModalBtn" class="btn btn-primary offset-md-4 float-right " style=" top: 20px; right: 20px;background-color: #279562">Open Modal</button>

            </div>
        </div>
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
                            <th class="text-center"><b>Exam Session</b></th>
                            <th class="text-center"><b>DOB</b></th>
                            <th class="text-center"><b>Gender</b></th>
                            <th class="text-center"><b>Access Arrangements</b></th>
                            <th class="text-center"><b>other</b></th>
                            <th class="text-center"><b>Action</b></th> <!-- New Actions column -->
                        </tr>
                    </thead>
                    <tbody>
                        @if(@$invoice)
                        @foreach($invoice as $inv)
                        <tr>
                            <td class="text-center">

                                {{ @$inv->exam_session }}
                            </td>
                            <td class="text-center">
                                {{@$inv->dob}}
                            </td>
                            <td class="text-center">{{ @$inv->gender }}</td>
                            <td class="text-center">{{ substr(@$inv->accessArrangements, 0, 20) }}</td>
                            <td class="text-center">{{ substr(@$inv->other, 0, 20) }}</td>
                            <td class="text-center">
                                <!-- Edit button -->
                                {{-- <a href="{{url('editExamSession/'.@$inv->id)}}" class="btn btn-primary btn-sm">
                                    Edit
                                </a> --}}
                                <a href="{{url('deleteInvoice/'.@$inv->id)}}" class="btn btn-danger btn-sm">
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
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal mt-5" tabindex="-1"  style="zoom:0.9;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #279562">
                    <h5 class="modal-title" style="color: white">Create Invoice</h5>
                    <button type="button" class="close" aria-label="Close"  style="background-color: #1e8f56">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="examForm" action="storeInvoice" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mt-2">

                                    <!-- Left Column of the Form -->
                                    <div class="form-group">
                                        <label for="student_name">Select student</label>
                                        <select class="form-control" id="student_name">
                                            <option disabled selected style="font-size: 14px;">choose option</option>
                                            @if(@$students)
                                                @foreach(@$students as $student)
                                                    <option value="{{ @$student->id }}" style="font-size: 14px;">{{ @$student->first_name.' '.@$student->middle_name.' '.@$student->last_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <!-- Add more form fields for the left column as needed -->

                            </div>

                            <div class="col-md-6 mt-2">
                                <!-- Right Column of the Form -->
                                <div class="form-group">
                                    <label for="exam_session">Exam Session</label>
                                    <input type="text" name="exam_session" disabled class="form-control" placeholder="Exam Session" id="exam_session">
                                </div>
                                <input type="hidden" name="id" disabled class="form-control"  id="id">
                                <!-- Add more form fields for the right column as needed -->
                        </div>
                            <div class="col-md-6 mt-2">
                                    <!-- Right Column of the Form -->
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="text" name="dob" disabled class="form-control" placeholder="Date of Birth" id="dob">
                                    </div>
                                    <!-- Add more form fields for the right column as needed -->
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <input type="text" name="gender" disabled class="form-control" placeholder="Gender" id="gender">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="gender">Exams</label>
                                    <select class="form-control" id="Exams">

                                    </select>
                                </div>
                            </div>

                            <div class=" appendExam mt-2">
                            </div>

                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="gender">Access arrangements</label>
                                    <textarea class="form-control" name="accessArrangements" id="accessArrangements">

                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="gender">Other</label>
                                    <textarea class="form-control" name="other" id="other">

                                    </textarea>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="saveChangesBtn">Save Changes</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to show and close the modal on button click -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#myModal").modal({
                backdrop: false,
                show: false // This prevents the modal from automatically opening when the page loads
            });

            $("#showModalBtn").on("click", function() {
                $("#myModal").modal("show");
            });

            // Add event listener to the close button to manually close the modal
            $("#myModal .close").on("click", function() {
                $("#myModal").modal("hide");
            });
        });
    </script>
    {{--  --}}
    <script>
        // Get the elements from the DOM
        const selectElement = document.getElementById('student_name');
        const dobInput = document.getElementById('dob');
        const genderInput = document.getElementById('gender');
        const examSessionInput = document.getElementById('exam_session');
        const examsSelect = document.getElementById('Exams');
        const appendExamContainer = document.querySelector('.appendExam');
        const appendedSubjects = new Set();

        // Function to make an AJAX request and populate the dropdown
        selectElement.addEventListener('change', function() {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const selectedId = selectedOption.value;



            // Create the URL with the selected student ID
            const url = `{{ url('getStudentInfo/') }}/${selectedId}`;

            // Make an AJAX request using the fetch API
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle the response data here
                    console.log(data);
                    // Set the value of the input element 'dob' to the date_of_birth from the response
                    dobInput.value = data.date_of_birth;

                    // Set the value of the input element 'gender' to the gender from the response
                    genderInput.value = data.gender;

                    // Set the value of the input element 'exam_session' to the exam_session from the response
                    examSessionInput.value = data.exam_session;
                    const idInput = document.getElementById('id');
                    idInput.value = data.user_id;

                    // Clear any existing options in the examsSelect dropdown
                    examsSelect.innerHTML = '';

                    // Create the "Choose an option" option and add it as the first option
                    const chooseOption = document.createElement('option');
                    chooseOption.value = '';
                    chooseOption.textContent = 'Choose an option';
                    chooseOption.disabled = true;
                    chooseOption.selected = true;
                    examsSelect.appendChild(chooseOption);

                    // Add exam names as options to the examsSelect dropdown
                    data.subjects.forEach(exam => {
                        const option = document.createElement('option');
                        option.value = exam.id;
                        option.textContent = exam.subject;
                        examsSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching student information:', error);
                });
        });

        // Function to handle appending new rows for selected exams
        examsSelect.addEventListener('change', function() {
            const selectedOption = examsSelect.options[examsSelect.selectedIndex];
            const selectedSubject = selectedOption.textContent;
            const selectedSubjectId = selectedOption.value;

            if (!appendedSubjects.has(selectedSubjectId)) {
                // Create a new row for the subject inputs
                const newRow = document.createElement('div');
                newRow.classList.add('row', 'mb-2');

                // Create the first column for the subject name input
                const col1 = document.createElement('div');
                col1.classList.add('col-md-6');
                // Create the input element for subject name
                const subjectNameInput = document.createElement('input');
                subjectNameInput.type = 'text';
                subjectNameInput.classList.add('form-control');
                subjectNameInput.value = selectedSubject;
                subjectNameInput.name = 'subject[]'; // Add the 'name' attribute
                col1.appendChild(subjectNameInput);

                // Create the second column for the subject price input
                const col2 = document.createElement('div');
                col2.classList.add('col-md-6');
                // Create the input element for subject price
                const subjectPriceInput = document.createElement('input');
                subjectPriceInput.type = 'text';
                subjectPriceInput.classList.add('form-control');
                // Set the default value for subject price if needed
                subjectPriceInput.placeholder = 'Price';
                subjectPriceInput.name = 'price[]'; // Add the 'name' attribute
                col2.appendChild(subjectPriceInput);

                // Append the columns to the new row
                newRow.appendChild(col1);
                newRow.appendChild(col2);

                // Append the new row to the appendExamContainer
                appendExamContainer.appendChild(newRow);

                // Add the subject ID to the set to prevent duplication
                appendedSubjects.add(selectedSubjectId);
            }
        });
    </script>


<script>
    // Your existing JavaScript code here

    // Get the "Save Changes" button element
    const saveChangesBtn = document.getElementById('saveChangesBtn');

    // Add a click event listener to the "Save Changes" button
    saveChangesBtn.addEventListener('click', function() {
        // Enable the disabled input elements before submitting the form
        document.getElementById('dob').removeAttribute('disabled');
        document.getElementById('gender').removeAttribute('disabled');
        document.getElementById('exam_session').removeAttribute('disabled');
        document.getElementById('id').removeAttribute('disabled');

        // Get the form element
        const examForm = document.getElementById('examForm');

        // Set the target attribute to "_blank" to open in a new tab
        examForm.setAttribute('target', '_blank');

        // Submit the form
        examForm.submit();
        // location.reload();
    });
</script>


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection
