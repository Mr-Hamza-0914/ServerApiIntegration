@extends('layout.main')
@section('content')
<div class="page-container">
    @include('component.navigation')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Profile</h2>
                        </div>
                    </div>
                </div>

                <div class="row m-t-25">
                    <div class="col-lg-12" id="UpdateProfile">
                        <div class="card">
                            <div class="card-header">Update Profile</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Full Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" aria-required="true" aria-invalid="false" placeholder="Enter Full Name">
                                </div>
                                <div class="form-group">
                                    <label for="cc-number" class="control-label mb-1">Select Gender</label>
                                    <select id="gender" name="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                        <option value="2">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <button id="update-profile-button" onclick="updateProfile()" type="button" class="btn btn-lg btn-info btn-block">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>

<script>
    async function updateProfile() {
        const fdata = {
            firstName: document.getElementById('firstName').value,
            gender: document.getElementById('gender').value
        };

        try {
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
                showAlert(`Profile has been updated!` , 'success');
                getProfile();
            } else {
                const error = await response.json();
                showAlert(`Error updating profile: ${error.message}` , 'error');
            }
        } catch (err) {
            showAlert(`Error updating profile: ${err}` , 'error');
        }
    }
</script>
@endsection