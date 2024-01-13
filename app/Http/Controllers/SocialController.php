<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function customSignup(Request $request)
    {
        // dd($request->all());
        // Validate the input data (you can add more validation rules as needed)
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // Assuming minimum password length is 8 characters
        ]);

        // Hash the password
        $hashedPassword = Hash::make($request->password);

        // Create and save the user record
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = $hashedPassword;
        $user->save();

        Auth::login($user);

        // Redirect or return response as needed
        return redirect()->route('verifyUser', ['id' => $user->id])->with('success', 'Account created successfully!');
    }

    public function customLogin(Request $request)
    {
        // Validate the input data (you can add more validation rules as needed)
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        // Get the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            // Log in the user
            Auth::login($user);

            // Check if the user is an admin (assuming you have an 'is_admin' column in your users table)
            if ($user->is_admin == 1) {
                // Redirect to the admin login URL (change 'adminLogin' to the actual route name for admin login)
                return redirect()->route('home')->with('success', 'Logged in as admin!');
            }

            // Redirect to the user dashboard or any other page you want for regular users
            return redirect()->route('userDashboard')->with('success', 'Logged in successfully!');
        } else {
            // If login fails, redirect back to the login page with an error message
            return redirect()->route('/')->with('error', 'Invalid email or password. Please try again.');
        }
    }

    public function verifyUser($id)
    {
        $check = User::where('id',$id)->first();

        if($check->confirm == 0)
        {
        // if()
        // Generate a random verification code (6 digits for example)
        $verificationCode = mt_rand(100000, 999999);

        // Update the user record with the generated verification code
        $user = User::find($id);
        if ($user) {
            $user->code = $verificationCode;
            $user->confirm = 0;
            $user->save();
        } else {
            // Handle the case where the user with the given ID is not found
            // You can redirect or return an error message as needed
            return redirect()->back()->with('error', 'User not found.');

        }

        // Send the verification code to the user's email
        Mail::raw("Your verification code is: {$verificationCode}", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Verification Code');
        });

        // Display the verification form to the user
        return view('user.verify', compact('user'));
    }
    else
    {
        return back();
    }

    }

    public function confirmVerify(Request $request)
    {
        // Validate the request data
        $request->validate([
            'verification_code' => 'required',
            'id' => 'required|integer',
        ]);

        // Retrieve the user using the provided 'id'
        $user = User::find($request->id);

        if ($user) {
            // Compare the verification code from the request with the user's 'code' field
            if ($user->code == $request->verification_code) {
                // If the codes match, update the 'confirm' field to 1
                $user->confirm = 1;
                $user->save();
                Auth::login($user);

                // Redirect to the user dashboard or any other page after successful verification
                return redirect()->route('userDashboard')->with('success', 'Email verification successful!');
            } else {
                // If the codes do not match, return back with an error message
                return back()->with('error', 'Invalid verification code. Please try again.');
            }
        } else {
            // If the user with the given ID is not found, return back with an error message
            return back()->with('error', 'User not found.');
        }
    }


}
