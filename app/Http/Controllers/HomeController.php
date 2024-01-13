<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\FormSubmitNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\ExamDate;
use App\Models\Registration;
use App\Models\Statement;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Payemnt;
use App\Models\ExamSession;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\PDF;





class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user && $user->confirm == 1) {
            $exams = ExamSession::all();
            $reg = Registration::where('user_id',$user->id)->first();
            return view('user.userdashboard',compact('user','reg','exams'));
        } else {
            return redirect()->route('verifyUser', ['id' => $user->id])->with('success', 'Account created successfully!');
        }
    }

    public function submitForm()
    {
        $user = auth()->user();
        auth()->user()->notify(new FormSubmitNotification($user));
    }

    public function storeExam(Request $request)
    {
        $validatedData = $request->validate([
            'exam_board' => 'nullable|string',
            'qualification' => 'nullable|string',
            'subject' => 'nullable|string',
            'exam_entry_code' => 'nullable|string',
            'level' => 'nullable|string',
            'optional_code' => 'nullable|string',
            'userId' => 'nullable|integer',
        ]);
        $validatedData['userId'] = Auth::id();
        $exam = Exam::create($validatedData);
        return response()->json(['message' => 'Exam created successfully.', 'data' => $exam], 200);
    }

    public function getExam($id)
    {
        $exams = Exam::where('userId',$id)->get();
        return response()->json([
            'Exam' => $exams,
        ]);
    }

    public function deleteExam($id)
    {
        $exams = Exam::where('id',$id)->delete();
        return response()->json([
            'success' => 200,
        ]);
    }

    public function getSingleExam($id)
    {
        $exams = Exam::where('id',$id)->first();
        return response()->json([
            'Exam' => $exams,
        ]);
    }

    public function updateExam(Request $request, $id)
    {
        // Get the exam record from the database
        $exam = Exam::find($request->input('recId'));

        // Check if the exam record exists
        if (!$exam) {
            return response()->json(['error' => 'Exam not found'], 404);
        }

        // Update the exam record with the provided data
        $exam->exam_board = $request->input('exam_board');
        $exam->qualification = $request->input('qualification');
        $exam->subject = $request->input('subject');
        $exam->exam_entry_code = $request->input('exam_entry_code');
        $exam->level = $request->input('level');
        $exam->optional_code = $request->input('optional_code');

        // Save the updated exam record
        $exam->save();

        // Return a response to indicate the update was successful
        return response()->json([
            'message' => 'Exam updated successfully',
        ]);
    }

    public function storeRegistration(Request $request)
    {
        // Validate the form data (you can add your validation rules here)

        // Get the current user's ID
        $userId = Auth::id();

        // Check if a record already exists for the current user
        $registration = Registration::where('user_id', $userId)->first();

        // Check if new images are uploaded and handle the image paths
        $passportPhotoPath = $registration ? $registration->form_passport_photo : null;
        if ($request->hasFile('passport_photo')) {
            $extension = $request->file('passport_photo')->getClientOriginalExtension();
            $passportPhotoPath = $request->file('passport_photo')->move('images', 'passport_photo_' . uniqid() . '.' . $extension);
        }

        $photographicIdPath = $registration ? $registration->photographic_id : null;
        if ($request->hasFile('photographic_id')) {
            $extension = $request->file('photographic_id')->getClientOriginalExtension();
            $photographicIdPath = $request->file('photographic_id')->move('images', 'photographic_id_' . uniqid() . '.' . $extension);
        }

        // Create or update the registration record
        if (!$registration) {
            // If no record exists, create a new one
            $registration = new Registration();
            $registration->user_id = $userId;
        } else {
            // If a record exists, delete old images if new ones are uploaded
            if ($request->hasFile('passport_photo') && $registration->form_passport_photo) {
                if (file_exists(public_path($registration->form_passport_photo))) {
                    unlink(public_path($registration->form_passport_photo));
                }
            }
            if ($request->hasFile('photographic_id') && $registration->photographic_id) {
                if (file_exists(public_path($registration->photographic_id))) {
                    unlink(public_path($registration->photographic_id));
                }
            }
        }

        // Assign the form data to the model
        $registration->exam_session = $request->input('exam_session');
        $registration->first_name = $request->input('first_name');
        $registration->middle_name = $request->input('middle_name');
        $registration->last_name = $request->input('last_name');
        $registration->date_of_birth = $request->input('date_of_birth');
        $registration->gender = $request->input('gender');
        $registration->address_uk = $request->input('address_uk');
        $registration->street_address_uk = $request->input('street_address_uk');
        $registration->line_address_uk = $request->input('line_address_uk');
        $registration->city = $request->input('city');
        $registration->county = $request->input('county');
        $registration->zip_code = $request->input('zip_code');
        $registration->country = $request->input('country');
        $registration->UCI_number = $request->input('UCI_number');
        $registration->mobile = $request->input('mobile');
        $registration->email = $request->input('email');
        $registration->confirm_email = $request->input('confirm_email');
        $registration->emergency_contact = $request->input('emergency_contact');
        $registration->medical_conditions = $request->input('medical_conditions');
        $registration->access_arrangements = $request->input('access_arrangements');
        $registration->practical_endorsement = $request->input('practical_Endorsement');
        $registration->guardian_firstName = $request->input('guarduanfirstName');
        $registration->guardian_middleName = $request->input('guarduanmiddleName');
        $registration->guardian_lastName = $request->input('guarduanlastName');
        $registration->signature = $request->input('signature');
        $registration->form_passport_photo = $passportPhotoPath;
        $registration->photographic_id = $photographicIdPath;

        // Save the model to the database
        $registration->save();

        // Send notification (if you have the notification set up)
        $user = auth()->user();
        auth()->user()->notify(new FormSubmitNotification($user));

        // Redirect back with a success message
        return back()->with('success', 'Registration Modified successfully!');
    }

    public function markAsRead($id)
    {
        if($id)
        {
            auth()->user()->notifications->where('id',$id)->markAsRead();
        }
        return back();
    }

    public function examDate()
    {
        $exams = ExamDate::all();
       return view('user.exam.examDate',compact('exams'));
    }

    public function statementOfEntry()
    {
        $statements = Statement::where('studentId',Auth::id())->get();
        return view('user.exam.entrySlip',compact('statements'));
    }

    public function submitPayment()
    {
        $payments = Payemnt::where('user_id',Auth::id())->get();
        $invoice = Invoice::where('user_id',Auth::id())->get();
        return view('user.payment.createPayment',compact('payments','invoice'));
    }

    public function uploadChallan(Request $request)
    {
        $request->validate([
            'challan' => 'required|image|max:2048', // Allow only image files with a maximum size of 2MB
        ]);

        // Get the authenticated user's ID
        $user_id = Auth::id();

        // Get the file from the request
        $file = $request->file('challan');

        // Generate a unique filename for the image
        $filename = uniqid().'.'.$file->getClientOriginalExtension();

        // Move the image to the public/images folder
        $file->move(public_path('images'), $filename);

        // Save the image path and current timestamp in the Payment model
        Payemnt::create([
            'user_id' => $user_id,
            'payment' => $filename,
            'approved' => 0,
            'uploaded_at' => now(), // Use the `now()` function to get the current timestamp
        ]);

        return redirect()->back()->with('success', 'Challan uploaded successfully!');
    }

    public function deletePayment($id)
    {
        Payemnt::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Challan Deleted successfully!');

    }

    public function downladInvoice($id)
    {
        $invoice = Invoice::where('id',$id)->first();

        // dd( json_decode($invoice['subjects'], true));
        // $jsonSubjectsAndPrices = json_encode($subjectsAndPrices);
        $invoiceData = [
            'exam_session' => $invoice['exam_session'],
            'dob' => $invoice['dob'],
            'gender' => $invoice['gender'],
            'accessArrangements' => $invoice['accessArrangements'],
            'other' => $invoice['other'],
            'subjects' => $invoice['subjects'],
            'user_id'=> $invoice['id'],
        ];

        $invoiceData['subjects'] = json_decode($invoiceData['subjects'], true);

        return view('admin.invoice.receipt', compact('invoiceData'));
    }

    public function deleteInvoices($id)
    {
        Invoice::where('id',$id)->delete();
        return redirect()->back()->with('successs', 'Invoice Deleted successfully!');
    }

    public function downloadPdf()
    {
            dd('');
    //     $file = storage_path('app/pdf/' . $filename);

    // if (file_exists($file)) {
    //     return response()->download($file, $filename, [
    //         'Content-Type' => 'application/pdf',
    //     ]);
    // } else {
    //     abort(404); // File not found
    // }
    }


}
