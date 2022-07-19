<x-app-layout>
<style>
    td,
    th {
        padding: 5px;
    }

    th {
        cursor: pointer;
    }
</style>
<div class="card my-4">
        <div class="card-body" x-data="">
            <div class="row justify-content-between">

                <div class="col-4">
                    <h2>Suivi Reserves</h2>
                </div>
                <div class="col-6">
                    <x-auth-validation-errors class="mb-3" :errors="$errors" />
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col w-75">

                                <input class="form-control" type="file" id="spreadsheet" name="spreadsheet" />
                            </div>


                            <button type="submit" class="btn btn-primary text-light w-25">Import</button>
                        </div>
                    </form>


                </div>
            </div>
            <div class="table-responsive" x-data="reserveData">
                <table id="reserveTable" class="table table-responsive">
                    <thead>
                        <tr class="bg-light">
                            <th @click="sort('Matricule')">Matricule</th>
                            <th @click="sort('DEPARTURE_TIME')" >DEPARTURE_TIME</th>
                            <th @click="sort('ARRIVAL_TIME')" >ARRIVAL_TIME</th>
                            <th @click="sort('AIRPORT_C_IS_DEP')" >AIRPORT_C_IS_DEP</th>
                            <th @click="sort('CREDIT')" >CREDIT</th>
                            <th @click="sort('CORPS')" >CORPS</th>
                            <th @click="sort('SENIORITY')" >SENIORITY</th>
                            <th @click="sort('ISSENIOR')" >ISSENIOR</th>
                            <th @click="sort('Date')" >Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-if="!reserves">
                            <tr>
                                <td colspan="4"><i>Loading...</i></td>
                            </tr>
                        </template>
                        <template x-for="reserve in pagedreserves" :key="reserve.id">
                            <tr>
                                <td x-text="reserve.Matricule"></td>
                                <td x-text="reserve.DEPARTURE_TIME"></td>
                                <td x-text="reserve.ARRIVAL_TIME"></td>
                                <td x-text="reserve.AIRPORT_C_IS_DEP"></td>
                                <td x-text="reserve.CREDIT"></td>
                                <td x-text="reserve.CORPS"></td>
                                <td x-text="reserve.SENIORITY"></td>
                                <td x-text="reserve.ISSENIOR"></td>
                                <td x-text="reserve.Date"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <button class="btn btn-outline-primary" @click="previousPage">Previous</button> <button class="btn btn-outline-primary" @click="nextPage">Next</button>
            </div>
        </div>
    </div>


<script>
    document.addEventListener('alpine:init', () => {
        
        Alpine.data('reserveData', () => ({
            headers: ['Matricule',
                        'DEPARTURE_TIME',
                        'ARRIVAL_TIME',
                        'AIRPORT_C_IS_DEP',
                        'CREDIT',
                        'CORPS',
                        'SENIORITY',
                        'ISSENIOR',
                        'Date'],
            reserves: null,
            sortCol: null,
            sortAsc: false,
            pageSize: 10,
            curPage: 1,
            async init() {
                console.log(this.headers);
                let resp = await fetch('/reserves/data');
                // Add an ID value
                let data = await resp.json();
                this.reserves = data;
            },
            nextPage() {
                if ((this.curPage * this.pageSize) < this.reserves.length) this.curPage++;
            },
            previousPage() {
                if (this.curPage > 1) this.curPage--;
            },
            sort(col) {
                if (this.sortCol === col) this.sortAsc = !this.sortAsc;
                this.sortCol = col;
                this.reserves.sort((a, b) => {
                    if (a[this.sortCol] < b[this.sortCol]) return this.sortAsc ? 1 : -1;
                    if (a[this.sortCol] > b[this.sortCol]) return this.sortAsc ? -1 : 1;
                    return 0;
                });
            },
            get pagedreserves() {
                if (this.reserves) {
                    return this.reserves.filter((row, index) => {
                        let start = (this.curPage - 1) * this.pageSize;
                        let end = this.curPage * this.pageSize;
                        if (index >= start && index < end) return true;
                    })
                } else return [];
            }
        }))
    });
</script>
</x-app-layout>