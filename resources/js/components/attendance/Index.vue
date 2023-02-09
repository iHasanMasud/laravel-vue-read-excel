<template>
    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="text-center">Attendance Report</h2>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-info mb-3" @click="generatePDF" :disabled="loading">
                            <span v-if="!loading">Print</span>
                            <span v-else>
                                <b-spinner small type="grow"></b-spinner>
                                Loading...
                            </span>
                        </button>
                    </div>
                    <div class="col">
                        <b-input-group>
                            <b-form-input v-model="searchTerm" placeholder="Type to Search" @keyup="fetchData(null)">
                            </b-form-input>
                            <b-input-group-append>
                                <b-button :disabled="!searchTerm" @click="searchTerm = ''">Clear</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </div>
                    <div class="col">
                        <div class="float-end">
                            <button class="btn btn-success mb-3" :disabled="loading" @click="importExcel">
                                <span v-if="!loading">Import</span>
                                <span v-else>
                                <b-spinner small type="grow"></b-spinner>
                                Loading...
                            </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="overflow-auto">
                            <b-table
                                show-empty
                                striped
                                :items="items"
                                :fields="fields"
                                :current-page="currentPage"
                                :per-page="0">
                                <template #cell(first_in)="{ item }">
                                    <p :class="item.late_entry ? 'bg-warning' : ''">{{ item.first_in }}</p>
                                </template>
                                <template #cell(last_out)="{ item }">
                                    <span :class="item.early_exit ? 'bg-warning' : ''">{{ item.last_out }}</span>
                                </template>
                            </b-table>
                            <b-pagination
                                size="md"
                                :total-rows="totalRows"
                                v-model="currentPage"
                                :per-page="perPage"
                                @change="fetchData"
                            ></b-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    components: {},
    data() {
        return {
            loading: false,
            searchTerm: '',
            items: [],
            fields: [
                {key: 'month', label: 'Month'},
                {key: 'date', label: 'Date'},
                {key: 'day', label: 'Day'},
                {key: 'employee_id', label: 'ID'},
                {key: 'employee_name', label: 'Employee Name'},
                {key: 'department', label: 'Department'},
                {key: 'first_in', label: 'First-in Time'},
                {key: 'last_out', label: 'Last-in Time'},
                /*{key: 'last_out', label: 'Last-in Time', tdClass: (value) => value < this.officialOutTime ? '' : 'bg-danger'},*/
                {key: 'hours_of_work', label: 'Hours of Work'},
            ],
            currentPage: 1,
            perPage: 0,
            totalRows: 0,
            totalItems: 0,
        }
    },
    created() {
        this.fetchData(this.currentPage);
    },
    mounted() {
    },
    methods: {

        /**
         * @description: This method is used to get the attendance report.
         * */
        async fetchData(currentPage) {
            const response = await fetch(`/api/attendance/report?page=${currentPage}&searchTerm=${this.searchTerm}`).then(resp => resp.json())
            this.perPage = response.meta.per_page;
            this.items = response.data;
            this.totalRows = response.meta.total;
        },

        /**
         * @description: This method is used to import Excel file.
         * */
        async importExcel() {
            this.loading = true;
            await axios.post('/api/attendance/import').then(response => {
                this.loading = false;
                this.fetchData(this.currentPage);
            }).catch(error => {
                this.loading = false;
            });
        },

        /**
         * @description: This method is used to generate the pdf.
         * */
        async generatePDF() {
            this.loading = true;
            axios.get(`/api/attendance/report/generate-pdf`, {responseType: 'blob'}).then(response => {

                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'attendance_report.pdf');
                document.body.appendChild(link);
                link.click();
                this.loading = false;
            })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    computed: {},

    watch: {}
}
</script>
