@extends('layouts.user')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .no-backdrop {
  backdrop-filter: none;
  background-color: transparent;
    }
    /* Remove horizontal scrolling for the table */
    .table-responsive {
        overflow-x: auto;
    }

    /* Adjust the DataTable search box */
    div.dataTables_wrapper div.dataTables_filter {
        text-align: right;
        margin-bottom: 10px;
    }

    /* Adjust the table width to fit the content */
    table.dataTable {
        min-width: 100%;
    }

</style>

<div class="container mt-5 ">
    <div class="row justify-content-center offset-md-2">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">Upload Challan</h3>
                    <form action="{{ url('uploadChallan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-4">
                            <label for="challan" class="file-label btn btn-primary btn-lg">
                                <i class="fas fa-cloud-upload-alt mr-2"></i> Select Challan File
                                <input type="file" class="d-none" name="challan" id="challan" required>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-upload mr-2"></i> Upload Challan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 offset-md-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    @if (session('successs'))
                    <!-- Success message -->
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                    <h3 class="text-center mb-4">Invoices</h3>

                    <div>
                        <table id="example" class="table table-striped table-bordered" style="zoom: 0.9;">
                            <thead>
                                <tr style="background-color:#319d6b;">
                                    <th style="color:black; text-align: center;">#</th>
                                    <th style="color:black; text-align: center;">Invoice</th>
                                    <th style="color:black; text-align: center;">Issued</th>
                                    <th style="color:black; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($invoice)
                                @foreach($invoice as $invc)
                                <tr>
                                    <td style="text-align: center;">
                                        {{@$invc->id}}
                                    </td>
                                    <td style="text-align: center;">

                                        {{-- <a href="{{url('downladInvoice/'.@$invc->id)}}" style="display: inline-block; background-color: #dc3545; color: #FFFFFF; padding: 10px 20px; text-decoration: none; border-radius: 5px;">View</a> --}}
                                        <a href="{{ asset($invc->pdf_path) }}"
                                            style="display: inline-block; background-color: #dc3545; color: #FFFFFF; padding: 10px 20px; text-decoration: none; border-radius: 5px;"
                                            download="your_file_name.pdf">Download</a>
                                    </td>
                                    <td style="text-align: center;">
                                        {{@$invc->created_at->diffForHumans()}}
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="{{ url('deleteInvoices/' . $invc->id) }}" class="btn btn-danger btn-sm delete-button">Destroy</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">No payment history found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Payment History Table -->
    <div class="row mt-5 offset-md-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    @if (session('success'))
                    <!-- Success message -->
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                    @endif

                    <h3 class="text-center mb-4">Payment History</h3>

                    <div class="">
                        <table id="example" class="table table-striped table-bordered" style="zoom: 0.9;">
                            <thead>
                                <tr style="background-color:#319d6b;">
                                    <th style="color:black;text-align: center;">Name</th>
                                    <th style="color:black;text-align: center;">Payment</th>
                                    <th style="color:black;text-align: center;">Uploaded At</th>
                                    <th style="color:black;text-align: center;">Approved</th>
                                    <th style="color:black;text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($payments)
                                    @foreach($payments as $payment)
                                    <tr>
                                        <td class="text-center">
                                            <?php
                                                $user = App\Models\User::where('id', $payment->user_id)->first();
                                                echo $user ? $user->name : 'N/A';
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            @if($payment->payment)
                                            <a href="{{ asset('images/' . $payment->payment) }}" target="_blank">
                                                <img src="{{ asset('images/' . $payment->payment) }}" alt="Payment" width="50" height="50">
                                            </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($payment->uploaded_at)
                                            {{ \Carbon\Carbon::parse($payment->uploaded_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $payment->approved == 0 ? 'NO' : 'YES' }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('deletePayment/' . $payment->id) }}" class="btn btn-danger btn-sm delete-button">Destroy</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No payment history found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Add the required JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<!-- Initialize the DataTable -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
      // Listen for click events on elements with the "delete-button" class
      $(".delete-button").click(function(event) {
        // Prevent the default link behavior (preventing the link from being immediately followed)
        event.preventDefault();

        // Get the URL from the link's href attribute
        var url = $(this).attr("href");

        // Create the Bootstrap modal
        var modalHtml = `
          <div class="modal " tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Confirm Delete</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete this?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                  <a href="${url}" class="btn btn-success">OK</a>
                </div>
              </div>
            </div>
          </div>
        `;

        // Append the modal to the document
        $(modalHtml).appendTo("body");

        // Show the Bootstrap modal
        var modal = new bootstrap.Modal($(".modal")[0]);
        modal.show();
      });
    });
  </script>

@endsection
