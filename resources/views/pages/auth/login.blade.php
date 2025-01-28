<!DOCTYPE html>
<html lang="en">

<head>
    @include('component.head')
    <script>
        const token = localStorage.getItem('token');
        if (token) window.location = '/dashboard';
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
                                <img src="{{ asset('asset/images/icon/logo.png') }}" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form id="login-form">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" id="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password"
                                        id="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="{{ url('forget/password') }}">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" id="login-button"
                                    type="button">sign in</button>

                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="{{ url('/') }}">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('component.script')
    {{-- <script>
        const base_url = 'https://vps-api.readyservervps.com';

        // Login Functionality
        document.getElementById('login-button').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            axios.post(`${base_url}/apv/auth/login`, {
                    email,
                    password,
                    userType: 'USER',
                    authType: 'EMAIL_PASSWORD'
                })
                .then(response => {
                    showAlert('Login Successfully!', 'success');

                    localStorage.setItem('user', response.data);
                    localStorage.setItem('token', response.data.sessionToken);

                    window.location = '/dashboard';
                })
                .catch(error => {
                    showAlert('Error logging in: '+ error.response.data.message, 'error');
                });
        });
    </script> --}}

    <script>
        const base_url = `{{env('API_BASE_URL')}}`;
    
        // Helper function for fetch error handling
        const handleFetchErrors = async (response) => {
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'An error occurred');
            }
            return response.json();
        };
    
        // Login Functionality
        document.getElementById('login-button').addEventListener('click', function () {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
    
            fetch(`${base_url}/apv/auth/login`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    email,
                    password,
                    userType: 'USER',
                    authType: 'EMAIL_PASSWORD',
                }),
            })
            .then(handleFetchErrors)
            .then(response => {
                showAlert('Login Successfully!', 'success');
    
                localStorage.setItem('user', JSON.stringify(response));
                localStorage.setItem('token', response.sessionToken);
    
                window.location = '/dashboard';
            })
            .catch(error => {
                showAlert('Error logging in: ' + error.message, 'error');
            });
        });
    </script>
    
</body>

</html>
