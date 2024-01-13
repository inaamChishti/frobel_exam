@extends('layouts.user')

@section('content')
    <!-- Latest version of jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <!-- Latest version of Bootstrap CSS -->

    <!-- Latest version of Bootstrap JS (requires jQuery) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <head>
        <!-- ... Other meta tags and CSS links ... -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <style>
        /*  */
        body {
            background-color: #fbf9f9;
        }


        .form-container {
            background-color: #d7d7d430;
            padding: 20px;
            border-radius: 5px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-group select,
        .form-group input[type="file"],
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 15px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group select:focus,
        .form-group input[type="file"]:focus,
        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #7770d2;
            box-shadow: 0 0 5px #7770d2;
        }

        .btn-submit {
            background-color: #7770d2;
            color: #fff;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #5e58a5;
        }

        body {
            overflow-x: hidden;
        }
    </style>

    <div class="container">
        <div class="col-md-9 form-container offset-md-1">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h2 class="form-title">Exam Registration Process</h2>

            <form id="main_form" method="post" action="{{ url('storeRegistration') }}" enctype="multipart/form-data"
                role="form">
                @csrf
                <div class="messages"></div>
                <div class="controls">

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="form_exam_session">Exam Session (Required)</label>
                                <select id="form_exam_session" name="exam_session" class="form-control" required>
                                    <option disabled selected>Choose Option</option>
                                   @foreach(@$exams as $exam)
                                   <option value="{{@$exam->exam_session}}" {{ @$reg->exam_session === @$exam->exam_session ? 'selected' : '' }}>{{@$exam->exam_session}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-inline">
                                <label for="form_passport_photo">Candidate Passport Size Photo</label>
                                <input id="form_passport_photo" type="file" name="passport_photo" class="form-control">
                            </div>
                            @if (@$reg->form_passport_photo)
                                <div style="margin-top: -13px;">
                                    <a href="{{ asset($reg->form_passport_photo) }}" target="_blank"
                                        style="display: inline-block;">
                                        <button type="button" class="btn btn-primary"
                                            style="height: 25px; width: 90px; display: flex; justify-content: center; align-items: center;">
                                            View
                                        </button>
                                    </a>
                                </div>
                            @endif
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="form_photographic_id">Photographic ID</label>
                                <input id="form_photographic_id" type="file" name="photographic_id" class="form-control">
                            </div>
                            @if (@$reg->photographic_id)
                                <div style="margin-top: -13px;">
                                    <a href="{{ asset($reg->photographic_id) }}" target="_blank"
                                        style="display: inline-block;">
                                        <button type="button" class="btn btn-primary"
                                            style="height: 25px; width: 90px; display: flex; justify-content: center; align-items: center;">
                                            View
                                        </button>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group form-inline">
                                <label for="form_first_name">First</label>
                                <input id="form_first_name" value="{{ @$reg->first_name }}" type="text" name="first_name"
                                    class="form-control" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-inline">
                                <label for="form_middle_name">Middle</label>
                                <input id="form_middle_name" value="{{ @$reg->middle_name }}" type="text"
                                    name="middle_name" class="form-control" placeholder="Middle Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-inline">
                                <label for="form_last_name">Last</label>
                                <input id="form_last_name" value="{{ @$reg->last_name }}" type="text" name="last_name"
                                    class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_date_of_birth">Date of Birth (Required)</label>
                            <input id="form_date_of_birth" type="date" value="{{ @$reg->date_of_birth }}"
                                name="date_of_birth" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label for="form_gender">Gender (Required)</label>
                            <select id="form_gender" name="gender" class="form-control" required>
                                <option disabled selected>Choose Option</option>
                                <option value="Male" {{ @$reg->gender === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ @$reg->gender === 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ @$reg->gender === 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_address_uk">Address in the UK (Required)</label>
                            <textarea id="form_address_uk" name="address_uk" class="form-control" placeholder="Enter your address in the UK"
                                rows="4" required>{{ @$reg->address_uk }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_address_uk">Street Address</label>
                            <textarea id="form_address_uk" name="street_address_uk" class="form-control"
                                placeholder="Enter your Street address in the UK" rows="4" required>{{ @$reg->street_address_uk }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_address_uk">Line Address</label>
                            <textarea id="form_address_uk" name="line_address_uk" class="form-control"
                                placeholder="Enter your Line address in the UK" rows="4" required>{{ @$reg->line_address_uk }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_city">City</label>
                            <input id="form_city" type="text" value="{{ @$reg->city }}" name="city"
                                class="form-control" placeholder="Enter your city" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_county">County / State / Region</label>
                            <input id="form_county" type="text" name="county" value="{{ @$reg->county }}"
                                class="form-control" placeholder="Enter your county / state / region" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_city">ZIP / Postal Code</label>
                            <input id="form_city" type="text" value="{{ @$reg->zip_code }}" name="zip_code"
                                class="form-control" placeholder="Enter your ZIP / Postal Code" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_county">Country</label>
                            <input id="form_county" type="text" value="{{ @$reg->country }}" name="country"
                                class="form-control" placeholder="Enter your county / state / region" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_city">UCI number</label>
                            <input id="form_city" type="text" value="{{ @$reg->UCI_number }}" name="UCI_number"
                                class="form-control" placeholder="Enter your UCI Number" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_city">Mobile Number(Required)</label>
                            <input id="form_city" value="{{ @$reg->mobile }}" type="text" name="mobile"
                                class="form-control" placeholder="Enter your Mobile Number" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_city">Email(Required)</label>
                            <input id="form_city" type="email" value="{{ @$reg->email }}" name="email"
                                class="form-control" placeholder="Enter your email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_city">Confirm Email</label>
                            <input id="form_city" type="email" value="{{ @$reg->confirm_email }}"
                                name="confirm_email" class="form-control" placeholder="Enter your Confim Email" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_emergency_contact">Emergency Contact Number (Required)</label>
                            <input id="form_emergency_contact" value="{{ @$reg->emergency_contact }}" type="text"
                                name="emergency_contact" class="form-control"
                                placeholder="Enter Emergency Contact Number" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_medical_conditions">Medical Conditions (Required)</label>
                            <textarea id="form_medical_conditions" value="{{ @$reg->medical_conditions }}" name="medical_conditions"
                                class="form-control" rows="4" placeholder="Enter any medical conditions" required>{{ @$reg->medical_conditions }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_medical_conditions">Access arrangements(Required)</label>
                            <textarea id="form_medical_conditions" value="" name="access_arrangements" class="form-control"
                                rows="4" placeholder="Enter any Access arrangements" required>{{ @$reg->access_arrangements }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- exam start --}}

                <div class="col-md-12">
                    <h3>Exams</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Exam Board</th>
                                    <th>Qualification</th>
                                    <th>Subject</th>
                                    <th>Exam Entry Code (if known)</th>
                                    <th>Level</th>
                                    <th>Optional Code</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="appendForm">
                                <!-- Sample row for demonstration purposes -->
                                <tr>
                                    <td>AQA</td>
                                    <td>GCSE</td>
                                    <td>1</td>
                                    <td>12</td>
                                    <td>Higher</td>
                                    <td>w</td>
                                    <td>
                                        <!-- Edit and Delete buttons (replace "#" with actual URLs for editing and deleting) -->
                                        <button type="button" class="btn btn-sm btn-primary">Edit</button>
                                        <button type="button" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                <!-- More rows can be added dynamically or fetched from a database -->
                            </tbody>
                        </table>
                    </div>

                    <button id="myBtn"
                        style="font-size: 16px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Add
                        Exam</button>




                </div>


                {{--  --}}


                {{-- exam end --}}


                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_medical_conditions">Practical Endorsement (For sciences
                                only)(Required)</label>
                            <textarea id="form_medical_conditions" name="practical_Endorsement" class="form-control" rows="4"
                                placeholder="Enter any Practical Endorsement" required>{{ @$reg->practical_endorsement }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_medical_conditions">Consent(Required)</label>
                            <br>
                            <label class="mt-2">
                                <input type="checkbox" name="consentCheckbox">
                                I have read and understand the terms and conditions and agree to be bound by them.
                            </label>

                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <h5>Parent/Guardian Details</h5>
                    <div class="col-md-4">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" value="{{ @$reg->guardian_firstName }}"
                            placeholder="Parent First Name" name="guarduanfirstName" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="middleName">Middle Name</label>
                        <input type="text" id="middleName" value="{{ @$reg->guardian_middleName }}"
                            placeholder="Parent middle Name" name="guarduanmiddleName" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" placeholder="Parent last Name"
                            value="{{ @$reg->guardian_lastName }}" name="guarduanlastName" class="form-control"
                            required>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <h2>Signature</h2>
                        <canvas id="signatureCanvas" width="300" height="150"
                            style="border: 1px solid #ccc;"></canvas>
                        <br>
                        <button type="button" onclick="clearCanvas()">Clear</button>
                        <!-- Remove the name attribute from the canvas element -->
                        <input type="hidden" id="signatureInput" value="{{ @$reg->signature }}" name="signature">
                        <br>
                        <!-- Display the image using an <img> tag -->
                        @if (@$reg->signature)
                            <img src="{{ @$reg->signature }}" alt="Signature">
                        @endif
                    </div>
                </div>




                <div class="row mt-2">
                    <div class="col-md-12">
                        <input type="submit" id="submitBtn" class="btn btn-success btn-send" value="Submit">
                        <input type="submit" onclick="enableEdit(event)" class="btn btn-danger " value="Edit">


                    </div>
                </div>

            </form>



            <!-- The Modal -->
            <div id="myModal" class="offset-md-3 col-md-6"
                style="display: none; position: fixed; z-index: 1; padding-top: 100px; left: 0; top: 0; width: 60%; height: 100%; overflow: auto; background-color: transparent;">
                <!-- Modal content -->
                <div style="background-color: #fefefe; margin: auto; padding: 20px; border: 1px solid #888; width: 80%;">
                    <span style="color: #aaaaaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;"
                        onclick="closeModal();">&times;</span>
                    <h4>Add Exam</h4>
                    <div class="">
                        <form id="examForm">
                            <div class="form-group">
                                <label for="examBoard">Exam Board</label>
                                <input type="text" class="form-control" id="examBoard" name="exam_board">
                                <input type="hidden" value="{{ $user->id }}" class="form-control" id="userId"
                                    name="userId">
                            </div>
                            <div class="form-group">
                                <label for="qualification">Qualification</label>
                                <input type="text" class="form-control" id="qualification" name="qualification">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="form-group">
                                <label for="entryCode">Exam Entry Code (if known)</label>
                                <input type="text" class="form-control" id="entryCode" name="exam_entry_code">
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <input type="text" class="form-control" id="level" name="level">
                            </div>
                            <div class="form-group">
                                <label for="optionalCode">Optional Code</label>
                                <input type="text" class="form-control" id="optionalCode" name="optional_code">
                            </div>
                        </form>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveExam()">Save</button>
                </div>
            </div>

            {{--  --}}
            {{-- edit modal --}}
            <div id="myModalEdit" class="offset-md-3 col-md-6"
                style="display: none; position: fixed; z-index: 1; padding-top: 100px; left: 0; top: 0; width: 60%; height: 100%; overflow: auto; background-color: transparent;">
                <!-- Modal content -->
                <div style="background-color: #fefefe; margin: auto; padding: 20px; border: 1px solid #888; width: 80%;">
                    <span style="color: #aaaaaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;"
                        onclick="closeModalEdit();">&times;</span>
                    <h4>Edit Exam</h4>
                    <div class="">
                        <form id="examFormedit">
                            <div class="form-group">
                                <label for="examBoard">Exam Board</label>
                                <input type="text" class="form-control" id="examBoardedit" name="exam_board">
                                <input type="hidden" value="" class="form-control" id="recId"
                                    name="recId">
                            </div>
                            <div class="form-group">
                                <label for="qualification">Qualification</label>
                                <input type="text" class="form-control" id="qualificationedit" name="qualification">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subjectedit" name="subject">
                            </div>
                            <div class="form-group">
                                <label for="entryCode">Exam Entry Code (if known)</label>
                                <input type="text" class="form-control" id="entryCodeedit" name="exam_entry_code">
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <input type="text" class="form-control" id="leveledit" name="level">
                            </div>
                            <div class="form-group">
                                <label for="optionalCode">Optional Code</label>
                                <input type="text" class="form-control" id="optionalCodeedit" name="optional_code">
                            </div>
                        </form>
                    </div>
                    <span class="btn btn-primary enable" onclick="editForm()">Update</span>
                </div>
            </div>


            {{-- edit modal end --}}



            {{-- below is js of modal --}}
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                // Function to close the edit modal
                function closeModalEdit() {
                    var modal = document.getElementById("myModalEdit");
                    modal.style.display = "none";
                    document.body.classList.remove("modal-open");

                    // Reset the scroll position to the original value
                    var scrollTop = parseInt(document.body.dataset.scrollY || "0", 10);
                    document.body.style.top = "";
                    window.scrollTo(0, scrollTop);
                }

                // Attach event handler for the close icon
                var closeIcon = document.querySelector("#myModalEdit span[onclick='closeModalEdit();']");
                if (closeIcon) {
                    closeIcon.addEventListener("click", closeModalEdit);
                }

                // Attach event handler for the "Escape" key press
                document.addEventListener("keydown", function(event) {
                    if (event.key === "Escape") {
                        closeModalEdit();
                    }
                });

                // Function to open the modal and fetch exam data using AJAX
                function editExam(examId) {
                    // Show the modal
                    var modal = document.getElementById("myModalEdit");
                    modal.style.display = "block";
                    document.body.classList.add("modal-open");

                    // Store the current scroll position
                    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    document.body.dataset.scrollY = scrollTop;
                    document.body.style.top = `-${scrollTop}px`;

                    // Fetch exam data using AJAX
                    $.ajax({
                        url: `/getSingleExam/${examId}`, // Replace with the appropriate URL for fetching exam data
                        method: 'GET',
                        success: function(data) {
                            console.log('Received exam data:', data); // Check the console for the received data
                            // Populate the form with the fetched exam data
                            document.getElementById("recId").value = data.Exam.id;
                            document.getElementById("examBoardedit").value = data.Exam.exam_board;
                            document.getElementById("qualificationedit").value = data.Exam.qualification;
                            document.getElementById("subjectedit").value = data.Exam.subject;
                            document.getElementById("entryCodeedit").value = data.Exam.exam_entry_code;
                            document.getElementById("leveledit").value = data.Exam.level;
                            document.getElementById("optionalCodeedit").value = data.Exam.optional_code;
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching exam data:', error);
                        }
                    });
                }

                // Rest of your closeModal and saveExam functions...
            </script>
            <script>
                // Function to open the modal
                function openModal() {
                    var modal = document.getElementById("myModal");
                    modal.style.display = "block";
                    document.body.classList.add("modal-open");

                    // Store the current scroll position
                    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    document.body.dataset.scrollY = scrollTop;
                    document.body.style.top = `-${scrollTop}px`;
                }

                // Function to close the modal
                function closeModal() {
                    var modal = document.getElementById("myModal");
                    modal.style.display = "none";
                    document.body.classList.remove("modal-open");

                    // Reset the scroll position to the original value
                    var scrollTop = parseInt(document.body.dataset.scrollY || "0", 10);
                    document.body.style.top = "";
                    window.scrollTo(0, scrollTop);

                    // Reset input fields
                    var inputs = document.getElementsByTagName("input");
                    for (var i = 0; i < inputs.length; i++) {
                        inputs[i].value = "";
                    }
                }


                // Function to handle the form submission
                function saveExam() {
                    // Get the CSRF token value from the meta tag in your HTML
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Get all form elements and handle form submission logic here
                    // ...

                    // Close the modal after saving the data
                    closeModal();
                }

                // When the document is ready, attach event handlers
                $(document).ready(function() {
                    // Get the button that opens the modal
                    var btn = document.getElementById("myBtn");

                    // When the user clicks the button, open the modal and prevent form submission
                    btn.onclick = function(event) {
                        openModal();
                        return false; // Prevent the form from submitting
                    };

                    // When the user clicks anywhere outside of the modal, close it
                    $(window).click(function(event) {
                        var modal = document.getElementById("myModal");
                        if (event.target == modal) {
                            closeModal();
                        }
                    });
                });
            </script>

            {{-- below is signature js --}}
            <script>
                const canvas = document.getElementById('signatureCanvas');
                const ctx = canvas.getContext('2d');
                let isDrawing = false;

                canvas.addEventListener('mousedown', startDrawing);
                canvas.addEventListener('mousemove', draw);
                canvas.addEventListener('mouseup', endDrawing);
                canvas.addEventListener('mouseleave', endDrawing);

                function startDrawing(event) {
                    isDrawing = true;
                    ctx.beginPath(); // Start a new drawing path
                    draw(event);
                }

                function draw(event) {
                    if (!isDrawing) return;
                    const x = event.offsetX;
                    const y = event.offsetY;
                    ctx.lineTo(x, y);
                    ctx.stroke();
                }

                function endDrawing() {
                    isDrawing = false;
                }

                function clearCanvas() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                }

                // Target the specific form by its ID
                document.getElementById('main_form').addEventListener('submit', function(event) {
                    const signatureData = canvas.toDataURL(); // Convert the canvas content to base64 image data
                    document.getElementById('signatureInput').value = signatureData;
                });
            </script>

            {{-- get exam results --}}
            <script>
                // Function to fetch exam data and append it to the table
                function getExamData() {
                    var userId = {{ auth()->user()->id }}; // Replace this with your own way of getting the current user ID

                    // Make a GET request to the "getExam" route with the user ID as a parameter
                    $.get(`/getExam/${userId}`, function(data) {
                        // Handle the response data
                        console.log(data); // The response data from the server

                        // Clear the existing content in the appendForm tbody
                        $(".appendForm").empty();

                        // Loop through the array of exams and create table rows for each exam
                        data.Exam.forEach(function(exam) {
                            var examRow = `
        <tr id="examRow-${exam.id}"> <!-- Add an "id" attribute to store the exam ID -->
          <td class="column-width" style="background-color: #e7eaf091;max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${exam.exam_board}</td>
          <td class="column-width" style="background-color: #e7eaf091;max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${exam.qualification}</td>
          <td class="column-width" style="background-color: #e7eaf091;max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${exam.subject}</td>
          <td class="column-width" style="background-color: #e7eaf091;max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${exam.exam_entry_code}</td>
          <td class="column-width" style="background-color: #e7eaf091;max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${exam.level}</td>
          <td class="column-width" style="background-color: #e7eaf091;max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${exam.optional_code}</td>
          <td style="background-color: #e7eaf091;">
            <!-- Edit and Delete buttons -->
            <button type="button"  class="btn btn-sm btn-primary myBtnEdit" id="myBtnEdit" onclick="editExam(${exam.id})">Edit</button>
            <button type="button"  class="btn btn-sm btn-danger" onclick="deleteExam(${exam.id})">Delete</button> <!-- Call the "deleteExam" function with the exam ID -->
          </td>
        </tr>
      `;

                            // Append the examRow to the appendForm tbody
                            $(".appendForm").append(examRow);
                        });
                    });
                }

                // Function to delete an exam
                function deleteExam(examId) {
                    // Get the CSRF token value from the page
                    var csrfToken = "{{ csrf_token() }}";

                    // Make a DELETE request to the "deleteExam" route with the exam ID as a parameter
                    $.ajax({
                        url: `/deleteExam/${examId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                        },
                        success: function(result) {
                            // Check if the deletion was successful
                            if (result.success === 200) {
                                // Remove the deleted row from the table
                                $("#examRow-" + examId).remove();
                            }
                        },
                        error: function(error) {
                            console.error('Error deleting exam:', error);
                            // Handle any errors that occur during the deletion process
                        }
                    });
                }

                getExamData();
            </script>
            {{-- store exam --}}
            <script>
                getExamData();

                function saveExam() {
                    // Get the CSRF token value from the meta tag in your HTML
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Get all form elements
                    var examBoardValue = document.getElementById("examBoard").value;
                    var qualificationValue = document.getElementById("qualification").value;
                    var subjectValue = document.getElementById("subject").value;
                    var entryCodeValue = document.getElementById("entryCode").value;
                    var levelValue = document.getElementById("level").value;
                    var optionalCodeValue = document.getElementById("optionalCode").value;
                    var userId = document.getElementById("userId").value;


                    // Check if any field is empty
                    if (!examBoardValue || !qualificationValue || !subjectValue || !entryCodeValue || !levelValue || !
                        optionalCodeValue) {
                        alert("Please fill out all fields.");
                        return;
                    }

                    // Create an object to hold the form data
                    var formData = {
                        exam_board: examBoardValue,
                        qualification: qualificationValue,
                        subject: subjectValue,
                        exam_entry_code: entryCodeValue,
                        level: levelValue,
                        optional_code: optionalCodeValue,
                        userId: userId,
                    };

                    // Send the form data as a POST request to the specified route
                    fetch("/storeExam", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrfToken // Include the CSRF token in the headers
                            },
                            body: JSON.stringify(formData)
                        })
                        .then(response => response.json())
                        .then(data => {

                            // Assuming the server returns a JSON response, you can handle the response here
                            console.log(data);
                            // You can also display a success message or perform any other actions as needed
                            getExamData();
                        })
                        .catch(error => {
                            console.error("Error sending the form data:", error);
                        });

                    // Close the modal after saving the data
                    closeModal();
                }
            </script>


            {{-- update exam --}}
            <script>
                function editForm() {
                    event.preventDefault();
                    // Get the CSRF token value from the meta tag in your HTML
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Get the exam ID from somewhere (you need to have it available)
                    var examId = 1; // Replace with the actual exam ID

                    // Get the form data
                    var formData = new FormData(document.getElementById("examFormedit"));

                    // Send the AJAX request to update the exam data
                    $.ajax({
                        url: `/updateExam/${examId}`, // Replace with the appropriate URL for updating exam data
                        method: 'POST', // Use 'POST' or 'PUT' depending on your backend implementation
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            // Handle the success response here (if needed)
                            console.log('Exam data updated successfully:', response);
                            closeModalEdit(); // Close the modal after updating the data (if needed)
                            getExamData();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating exam data:', error);
                        }
                    });
                }
            </script>

            {{-- submit js --}}

            <script>
                // Attach click event listener to the "Submit" button
                document.getElementById('submitBtn').addEventListener('click', function() {
                    // Get the form element
                    var form = document.getElementById('main_form');

                    // Submit the form forcefully
                    form.submit();
                });
            </script>


            <script>
                // Function to enable all form elements
                function enableAllInputs() {
                    var form = document.getElementById('main_form');
                    var elements = form.elements;

                    for (var i = 0; i < elements.length; i++) {
                        elements[i].disabled = false;
                    }
                }

                // Function to check inputs and disable the form if needed
                function checkInputsAndDisable() {
                    var form = document.getElementById('main_form');
                    var elements = form.elements;
                    var totalInputs = elements.length;
                    var inputsWithValue = 0;

                    for (var i = 0; i < elements.length; i++) {
                        var element = elements[i];
                        if (element.type !== 'submit' && element.value.trim() !== '') {
                            inputsWithValue++;
                        }
                    }

                    // Calculate the percentage of inputs with values
                    var percentageWithValue = (inputsWithValue / totalInputs) * 100;

                    // Set a threshold percentage (e.g., 70%) to determine whether to disable the form
                    var thresholdPercentage = 70;

                    // If the percentage of inputs with values is greater than or equal to the threshold, disable the form
                    if (percentageWithValue >= thresholdPercentage) {
                        for (var i = 0; i < elements.length; i++) {
                            var element = elements[i];
                            if (element.type !== 'submit') {
                                element.disabled = true;
                            }
                        }
                    }
                }

                // Function to enable edit mode
                function enableEdit(event) {
                    event.preventDefault(); // Prevent form submission
                    var form = document.getElementById('main_form');
                    var elements = form.elements;

                    for (var i = 0; i < elements.length; i++) {
                        elements[i].disabled = false;
                    }
                }

                // Call the function to check inputs and disable the form if needed on page load
                checkInputsAndDisable();
            </script>
        @endsection
