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
                            <h2 class="title-1">Upcoming Charges</h2>
                        </div>
                    </div>

                    <div class="col-md-12 m-t-30">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3 table-upcoming">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Upcoming Charges</th>
                                        <th>Hourly Rate</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Credit Detail</h2>
                        </div>
                    </div>

                    <div class="col-md-12 m-t-30">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3 table-credit">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>App ID</th>
                                        <th>User ID</th>
                                        <th>Type</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    var i = 1;
    const myHeaders = new Headers();
    myHeaders.append(
        "Authorization", `Bearer ${token}`
    );

    const requestOptions = {
        method: "GET",
        headers: myHeaders,
        redirect: "follow",
    };

    async function fetchCredit() {
        try {
            const response = await fetch(`${BASE_URL}/apv/wallet?type=CREDIT`, requestOptions);
            if (response.ok) {
                const  items = await response.json(); 
                populateTable(items);
            } else {
                console.error("Error:", response.statusText);
            }
        } catch (error) {
            console.error("Fetch error:", error);
        }
    }

    function populateTable(data) {
        const tableBody = document.querySelector(".table-credit tbody");
        tableBody.innerHTML = "";

        const row = `
            <tr>
                <td>${data.id ?? ''}</td>
                <td>${data.appId ?? ''}</td>
                <td>${data.userId ?? ''}</td>
                <td>${data.type ?? ''}</td>
                <td>${data.balance ?? 0}</td>
            </tr>
        `;
        tableBody.insertAdjacentHTML("beforeend", row);
    }

    fetchCredit();

    async function fetchUpcoming() {
        try {
            const response = await fetch(`${BASE_URL}/bill/upcoming-charge`, requestOptions);
            if (response.ok) {
                const  items = await response.json(); 
                populateUpComingTable(items);
            } else {
                console.error("Error:", response.statusText);
            }
        } catch (error) {
            console.error("Fetch error:", error);
        }
    }

    function populateUpComingTable(data) {
        const tableBody = document.querySelector(".table-upcoming tbody");
        tableBody.innerHTML = "";

        const row = `
            <tr>
                <td>${i++}</td>
                <td>${data.upcomingCharge ?? ''}</td>
                <td>${data.hourlyRate ?? ''}</td>
            </tr>
        `;
        tableBody.insertAdjacentHTML("beforeend", row);
    }

    fetchUpcoming();
</script>

@endsection