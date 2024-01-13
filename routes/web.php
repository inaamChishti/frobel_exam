<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendTestEmail;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/run', function () {
    Artisan::call('migrate', ['--path' => 'database/migrations/2023_08_03_045331_add_user_id_to_invoices_table.php']);
    Artisan::call('migrate', ['--path' => 'database/migrations/2023_08_03_114926_rename_name_column_to_path_in_invoices_table.php']);

    // Optionally, you can provide a response message to show the user.
    return 'Migrations completed successfully!';
});

Route::get('/admin', function () {
    $user = User::where('email', 'admin@gmail.com')->first();

    if ($user) {
        $user->confirm = 1;
        $user->save();
    }

    return 'Confirmation updated successfully';
});


Route::get('/logoutCustom', function () {
    Auth::logout();
    return redirect('/');
})->name('logoutCustom');



Route::post('customSignup', [SocialController::class, 'customSignup'])->name('customSignup');
Route::post('customLogin', [SocialController::class, 'customLogin'])->name('customLogin');
Route::get('verifyUser/{id}', [SocialController::class, 'verifyUser'])->name('verifyUser');
Route::post('confirmVerify', [SocialController::class, 'confirmVerify'])->name('confirmVerify');



// Route::get('/migrate', function () {
//     try {
//         Artisan::call('migrate');
//         return "Migrations have been run successfully!";
//     } catch (\Exception $e) {
//         return "An error occurred while running migrations: " . $e->getMessage();
//     }
// });
Auth::routes();
Route::get('/', function () {
    return view('user.auth.login');
})->name('/');

Route::get('/page', function () {
    // dd('');
    return view('welcome');
});

Route::get('/adminLogin', function () {
    return view('admin.auth.login');
});



// user routes
Route::middleware(['auth'])->group(function () {

    Route::get('userDashboard', [HomeController::class, 'index'])->name('userDashboard');
    Route::get('submitForm', [HomeController::class, 'submitForm']);
    Route::post('storeExam', [HomeController::class, 'storeExam']);
    Route::get('getExam/{id}', [HomeController::class, 'getExam']);
    Route::delete('deleteExam/{id}', [HomeController::class, 'deleteExam']);
    Route::get('getSingleExam/{id}', [HomeController::class, 'getSingleExam']);
    Route::post('updateExam/{id}', [HomeController::class, 'updateExam']);
    Route::post('storeRegistration', [HomeController::class, 'storeRegistration']);
    Route::get('/markAsRead/{id}', [HomeController::class, 'markAsRead'])->name('markAsRead');
    Route::get('examDate', [HomeController::class, 'examDate']);
    Route::get('statementOfEntry', [HomeController::class, 'statementOfEntry'])->name('statementOfEntry');
    Route::get('submitPayment', [HomeController::class, 'submitPayment'])->name('submitPayment');
    Route::post('uploadChallan', [HomeController::class, 'uploadChallan'])->name('uploadChallan');
    Route::get('deletePayment/{id}', [HomeController::class, 'deletePayment'])->name('deletePayment');
    Route::get('downladInvoice/{id}', [HomeController::class, 'downladInvoice'])->name('downladInvoice');
    Route::get('deleteInvoices/{id}', [HomeController::class, 'deleteInvoices'])->name('deleteInvoices');
    Route::post('/images', [HomeController::class, 'downloadPdf'])->name('images');

    // Route::get('/downloadPdf/{file}', function ($file) {
    //     $filePath = public_path('images/' . $file);

    //     if (file_exists($filePath)) {
    //         return response()->download($filePath);
    //     } else {
    //         abort(404); // File not found
    //     }
    // });







});




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// admin routes
Route::middleware(['is_admin'])->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/modifyExamDate', [AdminController::class, 'modifyExamDate'])->name('modifyExamDate');
    Route::post('ExamDateStore', [AdminController::class, 'ExamDateStore'])->name('ExamDateStore');
    Route::get('modifyStatement', [AdminController::class, 'modifyStatement'])->name('modifyStatement');
    Route::post('storeStatement', [AdminController::class, 'storeStatement'])->name('storeStatement');
    Route::get('viewExam', [AdminController::class, 'viewExam'])->name('viewExam');
    Route::get('deleteExamRec/{id}', [AdminController::class, 'deleteExamRec'])->name('deleteExamRec');
    Route::get('editExamRec/{id}', [AdminController::class, 'editExamRec'])->name('editExamRec');
    Route::post('ExamDateUpdate', [AdminController::class, 'ExamDateUpdate'])->name('ExamDateUpdate');
    Route::get('viewStstement', [AdminController::class, 'viewStstement'])->name('viewStstement');
    Route::get('deleteSatement/{id}', [AdminController::class, 'deleteSatement'])->name('deleteSatement');
    Route::get('editStatement/{id}', [AdminController::class, 'editStatement'])->name('editStatement');
    Route::post('updateStatement', [AdminController::class, 'updateStatement'])->name('updateStatement');
    Route::get('viewPayments', [AdminController::class, 'viewPayments'])->name('viewPayments');
    Route::get('editPayment/{id}', [AdminController::class, 'editPayment'])->name('editPayment');
    Route::post('updatePayment', [AdminController::class, 'updatePayment'])->name('updatePayment');
    Route::get('examSession', [AdminController::class, 'examSession'])->name('examSession');
    Route::post('storeExamSession', [AdminController::class, 'storeExamSession'])->name('storeExamSession');
    Route::get('viewSession', [AdminController::class, 'viewSession'])->name('viewSession');
    Route::get('deleteExamSession/{id}', [AdminController::class, 'deleteExamSession'])->name('deleteExamSession');
    Route::get('editExamSession/{id}', [AdminController::class, 'editExamSession'])->name('editExamSession');
    Route::post('updateExamSession', [AdminController::class, 'updateExamSession'])->name('updateExamSession');
    Route::get('invoice', [AdminController::class, 'invoice'])->name('invoice');
    Route::get('getStudentInfo/{id}', [AdminController::class, 'getStudentInfo'])->name('getStudentInfo');
    Route::post('storeInvoice', [AdminController::class, 'storeInvoice'])->name('storeInvoice');
    Route::get('deleteInvoice/{id}', [AdminController::class, 'deleteInvoice'])->name('deleteInvoice');
});
