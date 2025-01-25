<div id="alert-container" style="position: fixed; top: 10px; right: 10px; z-index: 9999;"></div>

<!-- Jquery JS-->
<script src="{{asset('asset/vendor/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap JS-->
<script src="{{asset('asset/vendor/bootstrap-4.1/popper.min.js')}}"></script>
<script src="{{asset('asset/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
<!-- Vendor JS       -->
<script src="{{asset('asset/vendor/slick/slick.min.js')}}">
</script>
<script src="{{asset('asset/vendor/wow/wow.min.js')}}"></script>
<script src="{{asset('asset/vendor/animsition/animsition.min.js')}}"></script>
<script src="{{asset('asset/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
</script>
<script src="{{asset('asset/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('asset/vendor/counter-up/jquery.counterup.min.js')}}">
</script>
<script src="{{asset('asset/vendor/circle-progress/circle-progress.min.js')}}"></script>
<script src="{{asset('asset/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('asset/vendor/chartjs/Chart.bundle.min.js')}}"></script>
<script src="{{asset('asset/vendor/select2/select2.min.js')}}"></script>

<!-- Main JS-->
<script src="{{asset('asset/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function showAlert(message, type) {
        let alertDiv = document.createElement('div');
        alertDiv.classList.add('sufee-alert', 'alert', 'with-close', 'alert-dismissible', 'fade', 'show');
        
        if (type === 'success') {
            alertDiv.classList.add('alert-primary');
            alertDiv.innerHTML = `${message}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
        } else if (type === 'error') {
            alertDiv.classList.add('alert-danger');
            alertDiv.innerHTML = `${message}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
        }

        document.getElementById('alert-container').appendChild(alertDiv);

        setTimeout(function () {
            alertDiv.classList.remove('show');
            alertDiv.classList.add('fade');
            setTimeout(function () {
                alertDiv.remove();
            }, 300);
        }, 5000);
    }
</script>