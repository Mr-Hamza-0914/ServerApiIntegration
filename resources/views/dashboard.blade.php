<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            /* max-width: 300px; */
            max-width: fit-content;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container h2 {
            text-align: center;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            /* background-color: #28a745; */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        /* .form-container button:hover {
            background-color: #218838;
        } */

        h3{
            color: gray;
        }
    </style>

    <script>
        const token = localStorage.getItem('token');
        if(!token) window.location = '/login';
    </script>
</head>
<body>

    <div class="form-container profile-container" id="home" style="margin-top: 20px;">
        <h1 style="text-align: center; text-decoration: underline;">Profile</h1>

        <h3 style="margin-top: 20px;">Name: <span class="name"></span></h3>
        <h3>Email: <span class="email"></span></h3>

        <button class="view-update-profile btn btn-primary" style="margin-top: 20px;" align='center'>Update Profile</button>
        <button style="margin-top: 20px; background: red;" align='center' onClick="logout()">Logout</button>
    </div>
    
    <div class="form-container update-profile" id="home" style="margin-top: 20px; display: none;">
        <h1 align='center'>Update Profile</h1>

        <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name..." required>
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name..." required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender ( 0 = Male, 1 = Female, 2 = Other)</label>
            <input type="number" class="form-control" id="gender" name="gender" placeholder="Enter your gender as 0, 1, or 2 ..." required>
        </div>

        <button type="button" class="btn btn-success" id="update-profile-button" onclick="updateProfile()">Update</button>
        
        <button style="margin-top: 20px; background: red;" align='center' onClick="logout()">Logout</button>
    </div>

    <script>
        const API_URL = '{{ env("API_BASE_URL") }}/apv';

        document.querySelector('.view-update-profile').addEventListener('click', function () {
            document.querySelector('.profile-container').style.display = 'none';
            document.querySelector('.update-profile').style.display = 'block';    
        });
        
        async function getProfile() {

            // try {
                const fdata = new FormData();
                const response = await fetch(`${API_URL}/profile`, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log('Data successful!', data);

                    const profile = data;
                    document.querySelector('.name').innerHTML = profile?.profile?.firstName + ' ' + (profile?.profile?.lastName ?? '');
                    document.querySelector('.email').innerHTML = profile?.email;

                    let gender = 0;
                    if(profile?.profile?.gender === 'FEMALE') gender = 1;
                    if(profile?.profile?.gender === 'OTHER') gender = 2;

                    document.querySelector('#firstName').value = profile?.profile?.firstName;
                    document.querySelector('#lastName').value = profile?.profile?.lastName;
                    document.querySelector('#gender').value = gender;

                } else {
                    const error = await response.json();
                    alert(`Not Found!: ${error.message}`);
                }
        }

        getProfile();

        async function updateProfile() {

            const fdata = {
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                gender: document.getElementById('gender').value
            };
            
            const response = await fetch(`${API_URL}/profile`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify(fdata),
            });

            if (response.ok) {
                const data = await response.json();
                console.log('Profile Update successful!', data);
                alert("Profile Update successful.");

                document.querySelector('.profile-container').style.display = 'block';
                document.querySelector('.update-profile').style.display = 'none';
                getProfile();

            } else {
                const error = await response.json();
                alert(`Profile Update False!: ${error.message}`);
            }
        }
        
        async function logout() {

            // try {
            const fdata = new FormData();
            const response = await fetch(`${API_URL}/auth/logout`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                body: fdata,
            });

            if (response.ok) {
                const data = await response.json();
                console.log('Logout successful!', data?.data);

                localStorage.removeItem('user');
                localStorage.removeItem('token');

                window.location = '/login';
            } else {
                const error = await response.json();
                alert(`Logout False!: ${error.message}`);
            }
        }
    </script>
</body>
</html>
