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
                            <h2 class="title-1">Server Regions</h2>
                        </div>
                    </div>
                </div>

                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3 table-region">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
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

    async function fetchRegions() {
        try {
            const response = await fetch(`${BASE_URL}/vps/regions`, requestOptions);
            if (response.ok) {
                const { items } = await response.json(); 
                populateTable(items);
            } else {
                console.error("Error:", response.statusText);
            }
        } catch (error) {
            console.error("Fetch error:", error);
        }
    }

    function populateTable(data) {
        const tableBody = document.querySelector(".table-region tbody");
        tableBody.innerHTML = ""; 

        data.forEach((item) => {
            const enabledBadge = item.enabled === true
            ? '<span class="badge badge-success">Enabled</span>'
            : item.enabled === false
            ? '<span class="badge badge-danger">Disabled</span>'
            : ''; 
            const row = `
                <tr>
                    <td>${i++}</td>
                    <td>${item.id ?? ''}</td>
                    <td>${item.name ?? ''}</td>
                    <td>${enabledBadge}</td>
                </tr>
            `;
            tableBody.insertAdjacentHTML("beforeend", row);
        });
    }

    fetchRegions();
</script>

@endsection