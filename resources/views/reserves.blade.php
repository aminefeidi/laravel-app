<script src="https://unpkg.com/alpinejs@3.1.x/dist/cdn.min.js" defer></script>
<style>
    td,
    th {
        padding: 5px;
    }

    th {
        cursor: pointer;
    }
</style>
<div x-data="reserveData">
    <table x-data="{
        headers: ['Matricule',
            'DEPARTURE_TIME',
            'ARRIVAL_TIME',
            'AIRPORT_C_IS_DEP	CREDIT',
            'CORPS',
            'SENIORITY',
            'ISSENIOR',
            'Date',
        ]
    }" id="reserveTable">
        <thead>
            <tr>
                <template x-for="h in headers">
                    <th @click="sort(h)" x-text="h"></th>
                </template>
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
                    <template x-for="h in headers">
                        <td x-text="reserve[h]"></td>
                    </template>
                </tr>
            </template>
        </tbody>
    </table>
    <button @click="previousPage">Previous</button> <button @click="nextPage">Next</button>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('reserveData', () => ({
            reserves: null,
            sortCol: null,
            sortAsc: false,
            pageSize: 4,
            curPage: 1,
            async init() {
                let resp = await fetch('/reserves/data');
                // Add an ID value
                let data = await resp.json();
                data.forEach((d, i) => d.id = i);
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
