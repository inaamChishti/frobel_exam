<html>
<head>
    <style>
        body {
  background-color: #393636;
  font-family: "Roboto", sans-serif;
}

.container {
  /*border:1px solid white;*/
  width: 600px;
  height: 350px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: inline-flex;
}
.backbox {
  background-color: #404040;
  width: 100%;
  height: 80%;
  position: absolute;
  transform: translate(0, -50%);
  top: 50%;
  display: inline-flex;
}

.frontbox {
  background-color: white;
  border-radius: 20px;
  height: 115%;
  width: 50%;
  z-index: 10;
  position: absolute;
  right: 0;
  margin-right: 30%;
  margin-left: 3%;
  transition: right 0.8s ease-in-out;
}

.moving {
  right: 45%;
}

.loginMsg,
.signupMsg {
  width: 50%;
  height: 100%;
  font-size: 15px;
  box-sizing: border-box;
}

.loginMsg .title,
.signupMsg .title {
  font-weight: 300;
  font-size: 23px;
}

.loginMsg p,
.signupMsg p {
  font-weight: 100;
}

.textcontent {
  color: white;
  margin-top: 65px;
  margin-left: 12%;
}

.loginMsg button,
.signupMsg button {
  background-color: #404040;
  border: 2px solid white;
  border-radius: 10px;
  color: white;
  font-size: 12px;
  box-sizing: content-box;
  font-weight: 300;
  padding: 10px;
  margin-top: 20px;
}

/* front box content*/
.login,
.signup {
  padding: 20px;
  text-align: center;
}

.login h2,
.signup h2 {
  color: #35b729;
  font-size: 22px;
}

.inputbox {
  margin-top: 30px;
}
.login input,
.signup input {
  display: block;
  width: 100%;
  height: 40px;
  background-color: #f2f2f2;
  border: none;
  margin-bottom: 20px;
  font-size: 12px;
}

.login button,
.signup button {
  background-color: #35b729;
  border: none;
  color: white;
  font-size: 12px;
  font-weight: 300;
  box-sizing: content-box;
  padding: 10px;
  border-radius: 10px;
  width: 60px;
  /* position: absolute; */
  right: 30px;
  bottom: 30px;
  cursor: pointer;
}

/* Fade In & Out*/
.login p {
  cursor: pointer;
  color: #404040;
  font-size: 15px;
}

.visibility {
  opacity: 0;
}

.hide {
  display: none;
}


    </style>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Nk8s1pNQzE0tovfE8yrExSW4/KkPGRrZzms4YCYzvFtQbRNe63GgZ6Xf7nhSPOx8zBqI7/FQo/OZS3Kq7g1aw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- jQuery (Replace the existing script tag) -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- Google Fonts - Roboto -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

  </head>
  <body>
    {{-- header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: #292222; color: white; width: 100%; position: fixed; left: 0; right: 0; top: 0;">
        <div style="display: flex; align-items: center;">
            <img src="https://frobelschoolsystemnew.frobel.co.uk/img/FrobelEducationWhite%20(1).png" alt="Logo" style="width: 150%; height: 30px; margin-right: 10px;">
            {{-- <div style="font-size: 24px; font-weight: bold;">Frobel Exam</div> --}}
        </div>
        <div style="display: flex;">
            <ul style="list-style: none; display: flex; align-items: center; margin: 0;">
                <li style="margin-right: 15px; color: white"><a href="#"></a></li>
                <a href="{{url('/')}}" style="text-decoration: none; font-size: 16px; font-weight: bold; margin-right: 20px; color: white;">Login as User</a>

                <li style="margin-right: 15px;"><a href="#"></a></li>
                <li>
                    <a href="#"></a>
                </li>
            </ul>
        </div>
    </div>
    {{-- header --}}
    <!-- Your HTML content here -->
    <div class="container">
        <div style="top: 80px; right: 60px;">
            <img src="https://frobelschoolsystemnew.frobel.co.uk/img/FrobelEducationWhite%20(1).png" alt="Logo" style="margin-top: -45%;margin-left: 120%;width: 160px; height: 50px;">
        </div>
        {{-- <div class="backbox"> --}}
            {{-- <div class="loginMsg">
                <div class="textcontent">
                    <p class="title">Don't have an account?</p>
                    <p>Sign up to save all your graph.</p>
                    <button id="switch1">Sign Up</button>
                </div>
            </div> --}}
            {{-- <div class="signupMsg visibility">
                <div class="textcontent">
                    <p class="title">Have an account?</p>
                    <p>Log in to see all your collection.</p>
                    <button id="switch2">LOG IN</button>
                </div>
            </div> --}}
        {{-- </div> --}}

        <div class="frontbox">
            <form method="POST" class="mt-5" style="    margin-top: 2em;" action="{{ route('customLogin') }}" style="">
                @csrf
            <div class="login">
                <h2>ADMIN LOGIN</h2>
                @if ($errors->any())
                        <div class="text-danger" style="color: red; margin-left: -10px;">
                            <ul style="padding-left: 15px;">
                                @foreach ($errors->all() as $error)
                                    <span style="font-size: 10px;">{{ $error }}</span>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="text-danger" style="color: red; margin-left: -10px;">
                        @if(session('error'))
                            <span style="font-size: 10px;">{{ session('error') }}</span>
                        @endif
                    </div>
                <div class="inputbox">
                    <input type="text" name="email" placeholder="  EMAIL">
                    <input type="password" name="password" placeholder="  PASSWORD">
                </div>
                <p>FORGET PASSWORD?</p>

                <button >LOG IN</button>
            </div>
        </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>
</html>

