<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamDate;
use App\Models\User;
use App\Models\Exam;
use App\Models\Statement;
use App\Models\Payemnt;
use App\Models\ExamSession;
use App\Models\Registration;
use App\Models\Invoice;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use PDF;
use Illuminate\Support\Facades\URL;



class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function modifyExamDate()
    {
        return view('admin.exam.createDate');
    }

    public function ExamDateStore(Request $request)
    {
        $data = $request->validate([
            'subjectName' => 'required|string',
            'fromDate' => 'required|date',
            'toDate' => 'required|date',
        ]);

        ExamDate::create($data);

        return redirect()->back()->with('success', 'Exam Data saved successfully!');
    }

    public function modifyStatement()
    {
        $students = User::where('is_admin', '=', null)->get();

        return view('admin.exam.modifyStatement',compact('students'));
    }

    public function storeStatement(Request $request)
    {
        $request->validate([
            'studentId' => 'required|numeric',
            'statement' => 'required|mimes:pdf',
        ]);

        // Generate a random name for the file
        $randomName = Str::random(20); // You can adjust the length of the random string if needed
        $extension = $request->file('statement')->getClientOriginalExtension();
        $subjectName = $randomName . '.' . $extension;

        // Store the PDF file in the public/images folder
        $file = $request->file('statement');
        $file->move(public_path('images'), $subjectName);

        // Store the data in the database with the filename
        Statement::create([
            'studentId' => $request->input('studentId'),
            'statement' => $subjectName,
            // Add other fields if necessary
        ]);

        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function viewExam()
    {
        $exams = examDate::all();
        return view('admin.exam.viewExam',compact('exams'));
    }

    public function deleteExamRec($id)
    {
        $exams = examDate::where('id',$id)->delete();
        return back()->with('success', 'Record Deleted successfully!');

    }

    public function editExamRec($id)
    {
        $exam = examDate::where('id',$id)->first();
        return view('admin.exam.editExam',compact('exam'));
    }

    public function ExamDateUpdate(Request $request)
    {

        $examId = $request->input('id');
        $exam = ExamDate::findOrFail($examId);

        $exam->update([
            'subjectName' => $request->input('subjectName'),
            'fromDate' => $request->input('fromDate'),
            'toDate' => $request->input('toDate'),
        ]);

        return back()->with('success', 'Exam record updated successfully.');

    }
    public function viewStstement()
    {
       $statement = Statement::all();
       return view('admin.exam.viewStatement',compact('statement'));
    }

    public function deleteSatement($id)
    {
        $statement =  Statement::where('id',$id)->delete();
        return back()->with('success', 'Record Deleted successfully!');
    }

    public function editStatement($id)
    {
        $statement =  Statement::where('id',$id)->first();
        $students = User::where('is_admin', '=', null)->get();
        return view('admin.exam.editStatement',compact('statement','students'));
    }
    public function updateStatement(Request $request)
    {
        $request->validate([
            'studentId' => 'required|numeric',
            'statement' => 'file|mimes:pdf',
        ]);

        $statementId = $request->input('id');
        $studentId = $request->input('studentId');

        // Find the existing statement
        $statement = Statement::find($statementId);

        if (!$statement) {
            return response()->json(['error' => 'Statement not found'], 404);
        }

        // If "statement" exists in the request, update the file and path
        if ($request->hasFile('statement')) {
            // Remove the previous file, if any
            if ($statement->statement) {
                // Assuming the files are stored in public/images directory
                $oldFilePath = public_path('images/' . $statement->statement);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            // Generate a random name for the new file
            $randomName = Str::random(20); // You can adjust the length of the random string if needed
            $extension = $request->file('statement')->getClientOriginalExtension();
            $subjectName = $randomName . '.' . $extension;

            // Store the PDF file in the public/images folder
            $file = $request->file('statement');
            $file->move(public_path('images'), $subjectName);

            // Update the statement with the new file path (without the 'images/' prefix)
            $statement->statement = $subjectName;
        }

        // Update other data (e.g., studentId) regardless of whether "statement" exists in the request or not
        $statement->studentId = $studentId;
        $statement->save();

        return redirect()->back()->with('success', 'Record updated successfully!');
    }

    public function viewPayments()
    {
        $payments = Payemnt::all();
        return view('admin.payment.showPayment',compact('payments'));
    }
    public function editPayment($id)
    {
        $payments = Payemnt::where('id',$id)->first();
        $user = User::where('id',$payments->user_id)->first();
        return view('admin.payment.editPayment',compact('payments','user'));
    }

    public function updatePayment(Request $request)
    {
        $data = $request->all();
        // Add validation and other checks if needed
        Payemnt::find($data['payment_id'])->update(['approved' => $data['approved']]);
        return redirect()->back()->with('success', 'Payment approval updated successfully.');
    }

    public function examSession()
    {
       return view('admin.examSession.createSession');
    }

    public function storeExamSession(Request $request)
    {


        $check = ExamSession::where('exam_session',$request['examSession'])->count();
        if($check == 0)
        {
            ExamSession::create(['exam_session' => $request['examSession']]);
            return redirect()->back()->with('success', 'Exam session created successfully.');
        }
        else
        {
            return redirect()->back()->with('success', 'Exam session already exist.');
        }

    }
    public function viewSession()
    {
        $exams = ExamSession::all();
        return view('admin.examSession.viewSessions',compact('exams'));
    }

    public function deleteExamSession($id)
    {
        $exams = ExamSession::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Exam session deleted successfully.');
    }

    public function editExamSession($id)
    {
        $exams = ExamSession::where('id',$id)->first();
        return view('admin.examSession.editExamSession',compact('exams'));
    }

    public function updateExamSession(Request $request)
    {
        $check = ExamSession::where('id',$request['id'])->update(['exam_session' => $request['examSession']]);
         return redirect()->back()->with('success', 'Exam session updated successfully.');
    }

    public function invoice()
    {
        $students = Registration::all();
        $invoice = Invoice::all();
        return view('admin.invoice.invoice',compact('students','invoice'));
    }

    public function getStudentInfo($id)
    {
        $student = Registration::find($id);

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $exams = Exam::where('userId', $student->user_id)->get();


        return response()->json([
            'date_of_birth' => $student->date_of_birth,
            'gender' => $student->gender,
            'exam_session' => $student->exam_session,
            'subjects' => $exams,
            'user_id' => $student->user_id,
        ]);
    }

    public function storeInvoice(Request $request)
    {
        $data = $request->all();
        $subjectsAndPrices = [];
        foreach ($data['subject'] as $index => $subject) {
            $price = $data['price'][$index];
            $subjectsAndPrices[] = [
                'subject' => $subject,
                'price' => $price,
            ];
        }
        $jsonSubjectsAndPriceForDB = json_encode($subjectsAndPrices);

        $invoiceData = [
            'exam_session' => $data['exam_session'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'accessArrangements' => $data['accessArrangements'],
            'other' => $data['other'],
            'subjects' => $jsonSubjectsAndPriceForDB,
            'user_id' => $data['id'],
        ];

        $invoice = Invoice::create($invoiceData);
        // $invoiceData['subjects'] = json_decode(@$invoiceData['subjects'],true);
        // $invoiceData['subjects'] = json_decode($invoiceData['subjects'], true);
        // Generate PDF from the Blade layout
        $invoiceData['subjects'] = json_decode($invoiceData['subjects'], true);
        $name = Registration::where('user_id',$data['id'])->first();
        $invoiceData['name'] = $name->first_name;
        $invoiceData['secondName'] = $name->middle_name . ' ' . $name->last_name;
        $pdf = PDF::loadView('admin.invoice.receipt', compact('invoiceData'));

        // Store the PDF file in the public/docs directory
        $pdfPath = 'docs/' . uniqid() . '.pdf';
        $pdf->save(public_path($pdfPath));

        // Update the "pdf_path" column in the "invoices" table
        $invoice->update(['pdf_path' => $pdfPath]);

        // Decode the JSON string for the 'subjects' field before passing to the view
        // $invoiceData['subjects'] = json_decode($invoiceData['subjects'], true);

        return view('admin.invoice.receipt', compact('invoiceData'));
    }

    public function deleteInvoice($id)
    {
        Invoice::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Invoice deleted successfully.');
    }


}
