<!DOCTYPE html>
<html lang="en">
<head>
    @include('component.head')
    <script>
        const token = localStorage.getItem('token');
        if(token) window.location = '/dashboard';
    </script>
</head>
<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{asset('asset/images/icon/logo.png')}}" alt="CoolAdmin">
                            </a>
                        </div>

                        <!-- Start Password Reset Form -->
                        <form id="start-form">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="au-input au-input--full" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <button type="button" class="au-btn au-btn--block au-btn--green m-b-20" id="start-button">Start Password Reset</button>
                            <div class="register-link">
                                <p>
                                    Have an account?
                                    <a href="{{url('/login')}}">Sign In Here</a>
                                </p>
                            </div>
                        </form>

                        <!-- OTP Verification Form -->
                        <form id="otp-form" class="mt-4 d-none">
                            <div class="mb-3">
                                <label for="otp" class="form-label">OTP</label>
                                <input type="text" class="au-input au-input--full" id="otp" name="otp" placeholder="Enter OTP" required>
                            </div>
                            <button type="button" class="au-btn au-btn--block au-btn--green m-b-20" id="verify-button">Verify OTP</button>
                        </form>

                        <!-- Reset Password Form -->
                        <form id="complete-form" class="mt-4 d-none">
                            <div class="mb-3">
                                <label for="new-password" class="form-label">New Password</label>
                                <input type="password" class="au-input au-input--full" id="new-password" name="new-password" placeholder="Enter new password" required>
                            </div>
                            <button type="button" class="au-btn au-btn--block au-btn--green m-b-20" id="reset-button">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('component.script')
    <script>
        let sessionToken = '';
        const base_url = 'https://vps-api.readyservervps.com';
    
        // Start Password Reset (Request Reset Password)
        document.getElementById('start-button').addEventListener('click', function () {
            var email = document.getElementById('email').value;
            
            axios.post(`${base_url}/apv/auth/request-reset-password`, { 
                email, 
                userType: 'USER', 
                authType: 'EMAIL_PASSWORD' 
            })
            .then(response => {
                sessionToken = response.data.sessionToken;
                showAlert('OTP sent to your email!' , 'success');
                document.getElementById('start-form').classList.add('d-none');
                document.getElementById('otp-form').classList.remove('d-none');
            })
            .catch(error => {
                showAlert('Error starting password reset: ' + error.response.data.message , 'error');
            });
        });
    
        // Verify OTP
        document.getElementById('verify-button').addEventListener('click', function () {
            const otp = document.getElementById('otp').value;
    
            axios.post(`${base_url}/apv/auth/verify-reset-password`, { 
                email: document.getElementById('email').value, 
                otp 
            })
            .then(response => {
                if (response.data.status === 'OTP_Verified') {
                    showAlert('OTP Verified!' , 'success');
                    document.getElementById('otp-form').classList.add('d-none');
                    document.getElementById('complete-form').classList.remove('d-none');
                }
            })
            .catch(error => {
                showAlert('Error verifying OTP: ' + error.response.data.message , 'error');
            });
        });
    
        // Reset Password (Complete Password Reset)
        document.getElementById('reset-button').addEventListener('click', function () {
            var email = document.getElementById('email').value;
            var newPassword = document.getElementById('new-password').value;
    
            axios.post(`${base_url}/apv/auth/reset-password`, { 
                email, 
                newPassword 
            })
            .then(response => {
                showAlert('Password reset successfully!' , 'success');
                window.location = '/login';
            })
            .catch(error => {
                showAlert('Error resetting password: ' + error.response.data.message , 'error');
            });
        });
    </script>
</body>
</html>