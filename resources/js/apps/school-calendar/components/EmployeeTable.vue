<template>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>Employees</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="employees.length === 0">
                <td colspan="3">No Employees Found</td>
            </tr>

            <tr v-for="employee in employees" :key="employee.id">
                <td>{{ employee.forename }} {{ employee.surname }}</td>
                <td><button class="btn btn-primary" @click="selectEmployee(employee.id)">View</button></td>
            </tr>
        </tbody>
    </table>
    <nav aria-label="...">
        <ul class="pagination">
            <li
                class="page-item"
                :class="{ 'disabled' : currentPage === 1 }"
                @click="previousPage"
            >
                <a class="page-link">Previous</a>
            </li>
            <li class="page-item">
                <a
                    class="page-link"
                    href="#"
                    :class="{ 'disabled' : hasMorePages === false }"
                    @click="nextPage"
                >Next</a>
            </li>
        </ul>
    </nav>
</div>
</template>

<script>
import {mapActions, mapState} from "vuex";

export default {
    name: 'EmployeeTable',
    data() {
        return {
            currentPage: 1,
            perPage: 10,
        };
    },
    computed: {
        ...mapState([
            'employees',
        ]),
        hasMorePages() {
            return this.employees.length === this.perPage;
        },
    },
    methods: {
        ...mapActions([
            'getEmployees',
            'getEmployeesClasses'
        ]),
        async selectEmployee(employeeId) {
            await this.getEmployeesClasses(employeeId);
        },
        async previousPage() {
            if (this.currentPage === 1) {
                return false;
            }

            this.currentPage -= 1;
            await this.getEmployees(this.currentPage);
        },
        async nextPage() {
            if (this.hasMorePages === false) {
                return false;
            }

            this.currentPage += 1;
            await this.getEmployees(this.currentPage);
        },
    },
}
</script>
