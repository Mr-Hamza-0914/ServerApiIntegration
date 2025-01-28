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
                            <h2 class="title-1">Server Templates</h2>
                        </div>
                    </div>
                </div>

                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3 table-st">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Setup Fee</th>
                                        <th>HourlyFee</th>
                                        <th>CPU</th>
                                        <th>RAM</th>
                                        <th>BandWidth</th>
                                        <th>HardDisk</th>
                                        <th>Description</th>
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
    myHeaders.append("Authorization", `Bearer ${token}`);

    const requestOptions = {
        method: "GET",
        headers: myHeaders,
        redirect: "follow",
    };

    async function fetchServerTemplate() {
        try {
            const response = await fetch(`${BASE_URL}/server/templates`, requestOptions);
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
        const tableBody = document.querySelector(".table-st tbody");
        tableBody.innerHTML = "";
        data.forEach((item, index) => {

            const row = `
                <tr>
                    <td>${item.id ?? ''}</td>
                    <td>${item.name ?? ''}</td>
                    <td>${item.setupFee ?? '-'}</td>
                    <td>${item.hourlyFee ?? '-'}</td>
                    <td>${item.description?.cpuCoreNo ?? '-'}</td>
                    <td>${item.description?.ram ?? '-'}</td>
                    <td>${item.description?.bandwidth ?? '-'}</td>
                    <td>${item.description?.hardDisk ?? '-'} (${item.description?.hardDiskType ?? ''})</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="toggleDetails(${index})">Details</button>
                    </td>
                </tr>
                <tr id="details-${index}" style="display: none;">
                    <td colspan="9">
                        <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
                            ${item.description?.details?.map(detail => `
                                <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 5px; border: 1px solid #ddd;">
                                    ${detail}
                                </span>
                            `).join("") ?? ''}
                        </div>
                    </td>
                </tr>

            `;
            tableBody.insertAdjacentHTML("beforeend", row);
        });
    }

    function toggleDetails(index) {
        const detailsRow = document.getElementById(`details-${index}`);
        if (detailsRow.style.display === "none") {
            detailsRow.style.display = "table-row";
        } else {
            detailsRow.style.display = "none";
        }
    }

    fetchServerTemplate();

</script>

@endsection