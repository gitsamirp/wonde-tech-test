<template>
    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-md-8">
                <Navigation :currentView="currentView"></Navigation>
            </div>
        </div>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-8">
                <EmployeeTable v-if="currentView === 'home'"></EmployeeTable>
                <ClassesTable v-if="currentView === 'classes'"></ClassesTable>
                <WeekCalendar v-if="currentView === 'lessons'"></WeekCalendar>
                <StudentsTable v-if="currentView === 'lessons'"></StudentsTable>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";
import EmployeeTable from "./EmployeeTable.vue";
import ClassesTable from "./ClassesTable.vue";
import Navigation from "./Navigation.vue";
import WeekCalendar from "./WeekCalendar.vue";
import StudentsTable from "./StudentsTable.vue";

export default {
    name: 'SchoolCalendar',
    components: {
        StudentsTable,
        WeekCalendar,
        Navigation,
        ClassesTable,
        EmployeeTable,
    },
    computed: {
        ...mapState([
            'employeeSelected',
            'classSelected',
        ]),
        currentView() {
            if (this.employeeSelected === null) {
                return "home";
            } else if (this.classSelected === null) {
                return "classes"
            }

            return 'lessons';
        }
    },
    methods: {
        ...mapActions([
            'getEmployees',
        ]),
    },
    async mounted() {
        await this.getEmployees();
    },
}
</script>
