<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .receipt {
            max-width: 750px;
            max-height: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .invoice-heading {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .customer-info p {
            margin: 5px 0;
        }

        .subjects-heading {
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0 10px;
        }

        .subjects ul {
            list-style: none;
            padding: 0;
        }

        .subjects li {
            margin: 5px 0;
        }

        /* Styles for the table and its cells */
        .custom-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .custom-table th, .custom-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        /* Optional: You can add some styles to the table header (th) cells */
        .custom-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

 /* Hide the content when not printing */
 #printContent {
        display: none;
    }

    /* Define styles for printing media */
    @media print {
        #printContent {
            display: block; /* Make the content visible when printing */
        }
    }
    </style>
</head>
<body  id="printContent" style="zoom:1.2;">

    <div class="receipt" >
<h1><img style="width: 23%;" src="data:image/png;base64,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" alt="Logo">
        </h1>
        <p class="invoice-heading"><b>Frobel Learning</b></p>
        <span>
            67 -73 Longbridge Road <br>
            Barking <br>
            London <br>
            IG11 8TG <br>
            accounts@frobel.co.uk <br>
            www.frobeleducation.co.uk <br>
            <br>
        </span>
        <p class="invoice-heading"><b>INVOICE</b></p>

        <div class="customer-info">
            <p class="invoice-heading" style="font-size: 13px;">INVOICE TO: <span style="font-weight: normal;">{{$invoiceData['name']}}</span> </p>
            <p class="" style="font-size: 13px;">{{$invoiceData['secondName']}}</p>
        </div>

        @php
        // Import Carbon in the Blade template
        use Carbon\Carbon;

        // Get the current date and time using Carbon
        $currentDate = Carbon::now();

        // Format the date as "dd/mm/YYYY"
        $formattedDate = $currentDate->format('d/m/Y');
    @endphp

        <div style="position: relative;">
            <div style="position: absolute; top: -2px; left: 67%; width:100%; transform: translate(-50%, 0);">
                <div style="position: relative;">
                    <div style="position: absolute; top: -80px; left: 70%; transform: translate(-50%, 0);">
                        <p class="" style="font-size: 13px;"> <b>INVOICE:  &nbsp;</b>{{ mt_rand(1000, 9999);}}</p>
                        <p class="" style="font-size: 13px;"> <b> DATE: &nbsp;</b>{{@$formattedDate}}</p>
                        <p class="" style="font-size: 13px;"> <b>Exam Session:</b>  {{ $invoiceData['exam_session'] }}</p>
                        <p class="" style="font-size: 13px;"> <b>Date of Birth:</b>  {{ $invoiceData['dob'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <table class="custom-table" style="text-align: center; margin-top: 90px;">
            <tr>
                <th style="width: 20%;">Access Arrangements</th>
                <th style="width: 20%;">Other:</th>
                <th style="width: 20%;">Subject</th>
                <th style="width: 20%;">Amount</th>
            </tr>
            <tr>
                <td style="vertical-align: top; width: 20%;"><?php echo wordwrap($invoiceData['accessArrangements'], 95, "<br>"); ?></td>
                <td style="vertical-align: top; width: 20%;"><?php echo wordwrap($invoiceData['other'], 95, "<br>"); ?></td>
                <td style="vertical-align: top; width: 20%;">
                    @foreach ($invoiceData['subjects'] as $subject)
                    {{ $subject['subject'] }} <br>
                    @endforeach
                </td>
                <td style="vertical-align: top; width: 20%;">
                    @foreach ($invoiceData['subjects'] as $subject)
                    {{ $subject['price'] }} <br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;margin-right:20px;">
                    <strong>Total: £&nbsp;{{ array_sum(array_column($invoiceData['subjects'], 'price')) }} &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                </td>
            </tr>
            <!-- Add more rows here -->
        </table>
    </div>
</body>

<script>
    function closePrintWindow() {
        window.close();
    }

    // Add an event listener to the onafterprint event
    window.addEventListener("afterprint", function(event) {
        // Perform the window closing when the print popup is closed
        closePrintWindow();
    });
</script>
<script>
    // Wait for the page to load
    window.addEventListener('load', function() {
        // Show the hidden printContent div
        document.getElementById('printContent').style.display = 'block';

        // Print the content
        window.print();
    });
</script>

</html>

