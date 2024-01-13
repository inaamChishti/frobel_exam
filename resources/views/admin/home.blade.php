@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div>
            <div class="col-md-4" style="margin-top: 20px;">
                <label for="additionalInput" style="display: inline; font-size: small; padding: 5px; color: #333;"> <b>Center Number: </b></label>
                 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="text" id="additionalInput" value="2423" style="width:20%;border: 1px solid gray; background-color: #b2e4edd6; font-size: small; padding: 5px; color: #333;">
            </div>
        </div>

    </div>
    <div class="row">
        <div>
            <div class="col-md-6" style="margin-top: 20px;">
                <label for="centerNumber" style="display: inline; font-size: small; padding: 5px; color: #333;"><b>Select Site:</b></label>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <select id="centerNumber" style=" border: 1px solid gray; background-color: #b2e4edd6; font-size: small; padding: 5px; color: #333;">
                    <option value="2423">76-79 LONGBRIDGE ROAD (3212 - NCN)</option>
                    <option value="1234">1234</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </div>
    </div>
    <h3 class="mt-4">Candidate Search</h3>

    <div class="row">
        <div>
            <div class="col-md-6" style="margin-top: 20px;">
                <label for="centerNumber" style="display: inline; font-size: small; padding: 5px; color: #333;"><b>Session:</b></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <select id="centerNumber" style=" border: 1px solid gray; background-color: #b2e4edd6; font-size: small; padding: 5px; color: #333;">
                    <option value="2423">November 2024</option>
                    <option value="1234">1234</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
            <div class="col-md-6" style="margin-top: 20px;">
                <label for="centerNumber" style="display: inline; font-size: small; padding: 5px; color: #333;"><b>Specifications:</b></label>
               &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select id="centerNumber" style=" border: 1px solid gray; background-color: #b2e4edd6; font-size: small; padding: 5px; color: #333;">
                    <option value="2423">Any Specifications</option>
                    <option value="1234">1234</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div>
            <div class="col-md-6" style="margin-top: 20px;">
                <label for="additionalInput" style="display: inline; font-size: small; padding: 5px; color: #333;"> <b>Candidate Number: </b></label>
                 &nbsp; &nbsp; <input type="text" id="additionalInput" value="APLS-2423" style="width:50%;border: 1px solid gray; background-color: #b2e4edd6; font-size: small; padding: 5px; color: #333;">
            </div>
        </div>

    </div>
    <div class="row">
        <div>
            <div class="col-md-6" style="margin-top: 20px;">
                <label for="additionalInput" style="display: inline; font-size: small; padding: 5px; color: #333;"> <b>UCI Number: </b></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="additionalInput" value="ACF-24/23" style="width:50%;border: 1px solid gray; background-color: #b2e4edd6; font-size: small; padding: 5px; color: #333;">
            </div>
        </div>

    </div>

    <div class="row">
        <div>
            <div class="col-md-6" style="margin-top: 20px;">
                <label for="additionalInput" style="display: inline; font-size: small; padding: 5px; color: #333;"> <b>First Name: </b></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="additionalInput" value="Inaam Ul Haq" style="width:50%;border: 1px solid gray; background-color: #b2e4edd6; font-size: small; padding: 5px; color: #333;">
            </div>
        </div>

    </div>

    <div class="row">
        <div>
            <div class="col-md-6" style="margin-top: 20px;">
                <label for="additionalInput" style="display: inline; font-size: small; padding: 5px; color: #333;"> <b>Last Name: </b></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="additionalInput" value="Chishti" style="width:50%;border: 1px solid gray; background-color: #b2e4edd6; font-size: small; padding: 5px; color: #333;">
            </div>
        </div>

    </div>

    <div class="row">
        <div>
            <div class="col-md-6" style="margin-top: 20px;">
                <label for="centerNumber" style="display: inline; font-size: small; padding: 5px; color: #333;"><b>Sex:</b></label>
               &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select id="centerNumber" style=" border: 1px solid gray; background-color: #b2e4edd6; font-size: small; padding: 5px; color: #333;">
                    <option value="2423">Any</option>
                    <option value="1234">1234</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
            <div class="col-md-6" style="margin-top: 20px;">
                <label for="additionalInput" style="display: inline; font-size: small; padding: 5px; color: #333;"> <b>Date of Birth: </b></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="additionalInput" value="27/12/1998" style="width:50%;border: 1px solid gray; background-color: #b2e4edd6; font-size: small; padding: 5px; color: #333;">

            </div>
        </div>

    </div>
</div>
@endsection
