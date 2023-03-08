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
</div>
</template>

<script>
import {mapActions, mapState} from "vuex";

export default {
    name: 'EmployeeTable',
    computed: {
        ...mapState([
            'employees',
            'employeeSelected',
        ]),
    },
    methods: {
        ...mapActions([
            'getEmployees',
            'getEmployeesClasses'
        ]),
        selectEmployee(employeeId) {
            this.getEmployeesClasses(employeeId);
        },
    },
}
</script>
