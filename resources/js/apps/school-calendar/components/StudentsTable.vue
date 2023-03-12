<template>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>Student Name</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="student in classStudents" :key="student.id">
                <td>{{ student.forename}} {{ student.surname }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import { mapState} from "vuex";

    export default {
        name: 'StudentsTable',
        computed: {
            ...mapState([
                'classStudents',
            ]),
        },
    }
</script>
