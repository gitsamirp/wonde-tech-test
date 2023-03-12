
import '../../bootstrap';
import { createApp } from 'vue';
import { createStore } from 'vuex';
import '../../../sass/app.scss'
import SchoolCalendar from './components/SchoolCalendar.vue';

/** Create a Vuex store */
const store = createStore({

    state: {
        employees: [],
        employeeSelected: null,
        classes: [],
        classSelected: null,
        classCalendar: [],
        classStudents: [],
        classLessons: [],
    },
    mutations: {
        setEmployees(state, payload) {
            state.employees = payload;
        },
        setClasses(state, payload) {
            state.employeeSelected = payload.employee;
            state.classes = payload.employee.classes.data;
        },
        setClassSelected(state, payload) {
            state.classSelected = payload.class;
            state.classStudents = payload.class.students.data;
            state.classLessons = payload.class.lessons.data;
        },
        resetSelections(state) {
            state.employeeSelected = null;
            state.classSelected = null;
        },
        resetClassSelected(state) {
            state.classSelected = null;
        },
    },
    actions: {
        async getEmployees({ commit }, currentPage = 1) {
            const params = new URLSearchParams(window.location.search);
            params.set('currentPage', currentPage.toString());
            await fetch(`/api/v1/employees?${params}`)
                .then((res) => res.json())
                .then((body) => {
                    const { employees } = body;
                    commit('setEmployees', employees);
                }).catch(err => {
                    console.error(err)
                });
        },
        async getEmployeesClasses({ commit }, employeeId) {
            await fetch(`/api/v1/employee/${employeeId}/classes`)
                .then((res) => res.json())
                .then((body) => {
                    commit('setClasses', body);
                }).catch(err => {
                    console.error(err)
                });
        },
        async getClassData({ commit }, classId) {
            await fetch(`/api/v1/class/${classId}`)
                .then((res) => res.json())
                .then((body) => {
                    commit('setClassSelected', body);
                }).catch(err => {
                    console.error(err);
                });
        },
    },
});

createApp(SchoolCalendar)
    .use(store)
    .mount('#app');
