
@include('include/login/header')
<style>
    /* Style all input fields */
    input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top: 6px;
      margin-bottom: 16px;
    }

    /* Style the submit button */
    input[type=submit] {
      background-color: #04AA6D;
      color: white;
    }

    /* Style the container for inputs */
    .container {
      background-color: #f1f1f1;
      padding: 20px;
    }

    /* The message box is shown when the user clicks on the password field */
    #message {
      display:none;
      background: #000000;
      color: #000;
      position: relative;
      padding: 20px;
      margin-top: 10px;
    }

    #message p {
      padding: 10px 35px;
      font-size: 18px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
      color: green;
    }

    .valid:before {
      position: relative;
      left: -35px;
      content: "✔";
    }

    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
      color: red;
    }

    .invalid:before {
      position: relative;
      left: -35px;
      content: "✖";
    }
    </style>

    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="/" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>MM Groups</h3>
                            </a>
                            <h3>Sign Up</h3>
                        </div>
                        <form action="{{route('User-Register')}}" method="post">
                            @if (Session::has('success'))
                            <div class="alert alert-info" role="alert">
                               {{Session::get('success')}}
                            </div>
                            @elseif (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{Session::get('error')}}
                            </div>
                            @endif
                            @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingText" placeholder="Ram Kumar" name="name" value="{{old('name')}}">
                            <label for="floatingText">Name</label>
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="{{old('email')}}">
                            <label for="floatingInput">Email address</label>
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="{{old('password')}}">
                            <label for="floatingPassword">Password</label>
                            <span class="text-danger">@error('password') {{$message}} @enderror</span>
                        </div>
                        <div id="message">
                            <h3>Password must contain the following:</h3>
                            <p id="letter" class="invalid">A <small>lowercase</small> letter</p>
                            <p id="capital" class="invalid">A <small>capital (uppercase)</small> letter</p>
                            <p id="number" class="invalid">A <small>number</small></p>
                            <p id="length" class="invalid">Minimum <small>8 characters</small></p>
                          </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="confloatingPassword" placeholder="Confirm Password" name="conpassword" value="">
                            <label for="floatingPassword">Confirm Password</label>
                            <span class="text-danger">@error('conpassword') {{$message}} @enderror</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href="/Forgot-Password">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                    </form>
                        <p class="text-center mb-0">Already have an Account? <a href="/">Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>
    @include('include/login/footer')

    <script>
        var myInput = document.getElementById("floatingPassword");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
          document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
          document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
          // Validate lowercase letters
          var lowerCaseLetters = /[a-z]/g;
          if(myInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
          } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
          }

          // Validate capital letters
          var upperCaseLetters = /[A-Z]/g;
          if(myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
          } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
          }

          // Validate numbers
          var numbers = /[0-9]/g;
          if(myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
          } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
          }

          // Validate length
          if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
          } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
          }
        }
        </script>
