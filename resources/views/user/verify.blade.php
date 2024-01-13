<!-- verification.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            <div class="card shadow" >
                <div class="card-header  text-white" style="background-color: #05a36e; color: #ffffff;">
                    <h4 style="background-color: #05a36e; color: #ffffff;">Account Verification</h4>
                </div>
                <div class="card-body">
                    <p class="lead mb-4">A verification code has been sent to your email. Please enter the code below to verify your email:</p>
                    <form method="POST" action="{{ route('confirmVerify') }}">
                        @csrf
                        <div class="form-group">
                            <label for="verification_code">Verification Code</label>
                            <input type="text" name="verification_code" id="verification_code" class="form-control" required>
                            <input type="hidden" name="id" value="{{ $user->id }}" required>
                        </div>
                        <button type="submit" class="btn mt-2" style="background-color: #05a36e; color: #ffffff;">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
