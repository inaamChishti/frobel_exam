<!DOCTYPE html>
<html lang="en">
    <head>
  <title>Bootstrap 5 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  *
{
    padding: 0px;
    margin:  0px;
}
body
{
    background-color:#ededed;/*#a5b3e4*/
    perspective: 1500px;
}
.card
{
    width: 380px;
    height: 510px;
    position: relative;
    margin: 50px auto;
    border-radius: 10px;
    font-family: tahoma;
    transform-style: preserve-3d;
    transition: all 1s ease-in-out;
}
/* .card:hover
{
    transform: rotateY(180deg);
} */
.card > div
{
    position: absolute;
    top: 0;
    left:0;
    width: 100%;
    height: 100%;
    border-radius: 10px;
    text-align: center;
    background-color:azure;
}
/*front card*/
.card .front
{
    z-index: 1;
    backface-visibility: hidden;
}

.card .front p
{
    text-align: center;
}

.card .front form button
{
    background-color:#86b7fe;
    padding: 12px 60px 12px 60px;
    margin-top:30px;
    cursor: pointer;
}

.f1
{
    padding: 13px 60px 13px 60px;
    border-radius: 4px;
    background-color:#f0f5f9;
    margin: 7px;
    border: none;
    text-align: center;
    font-size: 15px;
}
.card .front img
{
    width: 110px;
    height: 110px;
    margin: 20px 30px 50px 30px
}
.login_word
{
    margin:30px auto;
    border-bottom:2px solid black;
    width:60px;
    font-weight: bold;
}
.not_registered_word
{
    margin-top: 35px;
    font-size: 14px;
}

.card .front form p
{
    margin-top: 20px;
    font-size: 15px;
}

.card .front span
{
    cursor: pointer;
    color:rgb(24, 3, 3);
}
/*back card*/
.card .back
{
    z-index: 2;
    transform: rotateY(180deg);
    backface-visibility: hidden;
}
.signup_word
{
    margin:45px auto 15px auto;
    border-bottom:2px solid #FFB30E;
    width:70px;
    font-weight: bold;
}

#signUp button
{
    background-color:#FFB30E;
    padding: 12px 60px 12px 60px;
    margin-top:30px
}
  </style>
</head>
<body>

    <body onload="login_signUp()">
        <div class="card" id="card">
            <div class="front">
                <p class="login_word" style="width:30%">USER LOGIN</p>
                <img src="https://drive.google.com/uc?export=view&id=1K5_tAX_taOQQ0wwmFx3P--V05kjvg4cu" alt="person picture">
                <form method="post" action="" style=" margin-top: -20px;">
                    <input type="text" name="email" placeholder="Email" class="f1" maxlength="10" required autocomplete="off">
                    <input type="password" name="password" placeholder="password" class="f1" maxlength="10" required autocomplete="off">
                    <button class="f1" name="login" value="clicked">Log in</button>
                    <p>Not registered? <span onclick="flip()"><b>Create an account<b></span></p>
                </form>
            </div>
            <div class="back">
                <p class="signup_word">SIGN UP</p>
                <form method="post" action="" id="signUp">
                    <input type="text" name="first_name" placeholder="first name" class="f1" maxlength="10" required style="margin-top:35px;" autocomplete="off">
                    <input type="text" name="last_name" placeholder="last name" class="f1" maxlength="10" required autocomplete="off">
                    <input type="text" name="username" placeholder="username" class="f1" maxlength="10" required autocomplete="off">
                    <input type="email" name="email" placeholder="e-mail" class="f1" maxlength="30" required autocomplete="off">
                    <input type="password" name="password" placeholder="password" class="f1" maxlength="10" required autocomplete="off">
                    <button class="f1" name="signup" value="clicked">Sign up</button>
                </form>
            </div>
        </div>
        <script src="script.js"></script>
        <script>
        let card ;

function login_signUp()
{
    document.getElementById("signUp").addEventListener("submit", function(event){
        card.style.transform = 'rotateY(0deg)';
        event.preventDefault();
    });

    card = document.getElementById('card');
}


function flip()
{
    card.style.transform = 'rotateY(180deg)';
}

function openLogin()
{
    window.open('login.html','_self')
}


        </script>
    </body>


</body>
</html>
