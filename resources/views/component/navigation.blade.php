<script>
    const token = localStorage.getItem('token');
    const API_URL = '{{ env("API_BASE_URL") }}/apv';
    const BASE_URL = '{{ env("API_BASE_URL")}}';
    if(!token) window.location = '/login';
    
    async function getProfile() {
        try {
            if (!token) {
                console.error('Token is missing!');
                return;
            }

            const response = await fetch(`${API_URL}/profile`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                }
            });

            if (response.ok) {
                const data = await response.json();
                const profile = data.profile || {};

                const nameElement = document.querySelector('.name');
                const emailElement = document.querySelector('.email_address');
                const firstNameInput = document.getElementById('firstName');
                const genderInput = document.getElementById('gender');

                if (nameElement) nameElement.innerHTML = profile.firstName || '-';
                if (emailElement) emailElement.innerHTML = data.email || '-';
                if (firstNameInput) firstNameInput.value = profile.firstName || '';
                if (genderInput) {
                    let gender = 0;
                    if (profile.gender === 'FEMALE') gender = 1;
                    if (profile.gender === 'OTHER') gender = 2;
                    genderInput.value = gender;
                }
            } else {
                const error = await response.json();
                showAlert(`Error: ${error.message}`);
            }
        } catch (err) {
            console.error('Error fetching profile:', err);
        }
    }

    getProfile();
</script>

<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap justify-content-end">
                
                <div class="header-button">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{asset('asset/images/icon/avatar-01.jpg')}}" alt="John Doe" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn name" href="#">john doe</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{asset('asset/images/icon/avatar-01.jpg')}}" alt="John Doe" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <span class="email email_address"></span>
                                    </div>
                                </div>
                                
                                <div class="account-dropdown__footer">
                                    <a href="{{url('logout')}}">
                                        <i class="zmdi zmdi-power"></i>
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->