@include('layouts/pre-css')
<link rel="stylesheet" type="text/css" href="scss/06-components/components-login.css">
@include('layouts/post-css')

@section('content')
<main class="content">
    <label class="switch">
        <input type="checkbox">
        <span class="slider round"></span>
        <span class="sign">Register</span>

        <div class="login">
            <form #loginForm="ngForm" (ngSubmit)="onSubmitLogin(loginForm)" class=""
                method="post" action="">

                <div *ngIf="incorrectEmailOrPasswordError" class="field__required">Incorrect
                    email or password</div>

                <p><label for="emailLogin">Email</label></p>
                <div *ngIf="emailInputLogin.touched && emailInputLogin.invalid" class="field__required">This field
                    is
                    required</div>
                <input #emailInputLogin="ngModel" ngModel id="emailLogin" type="text" name="email" required class="">
                <div *ngIf="emailFormatError" class="field__required">Please enter a valid email</div>


                <p><label for="passwordLogin">Password</label></p>
                <div *ngIf="passwordInputLogin.touched && passwordInputLogin.invalid" class="field__required">This
                    field is
                    required</div>
                <div *ngIf="passwordLengthError" class="field__required">Password must be 8 or more
                    characters</div>
                <input #passwordInputLogin="ngModel" ngModel id="passwordLogin" type="password" name="password" required class="">

                <p><button [disabled]="loginForm.invalid" class=""> Login</button></p>
            </form>
        </div>

        <div class="register">
            <form #registerForm="ngForm" (ngSubmit)="onSubmitRegister(registerForm)" class="">

                <div *ngIf="errorMessage" class="field__required">{{errorMessage}}</div>

                <p><label for="emailRegister">Email</label></p>
                <div *ngIf="emailFormatError" class="field__required">Please enter a valid email
                </div>
                <div *ngIf="emailInputRegister.touched && emailInputRegister.invalid" class="field__required">This
                    field is
                    required</div>
                <input #emailInputRegister="ngModel" ngModel id="emailRegister" type="text" name="email" required class="">

                <p><label for="username">Username</label></p>
                <div *ngIf="usernameLengthError" class="field__required">Username must be 5 or more
                    characters
                </div>
                <div *ngIf="usernameInput.touched && usernameInput.invalid" class="field__required">
                    This field is
                    required</div>
                <input #usernameInput="ngModel" ngModel id="username" type="text" name="username" required class="">

                <p><label for="passwordRegister">Password</label></p>
                <div *ngIf="passwordLengthError" class="field__required">Password must be 8 or more
                    characters
                </div>
                <div *ngIf="passwordInputRegister.touched && passwordInputRegister.invalid" class="field__required">
                    This field is
                    required</div>
                <input #passwordInputRegister="ngModel" ngModel id="passwordRegister" type="password" name="password" required class="">

                <p><button [disabled]="registerForm.invalid" class="">
                        Register
                    </button></p>
            </form>
        </div>
    </label>
</main>
@show