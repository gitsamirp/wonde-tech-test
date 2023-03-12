<template>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>Class</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="classes.length === 0" style="background-color: lightsalmon">
                <td colspan="3">No Classes Found</td>
            </tr>
            <tr v-for="staffClass in classes" :key="staffClass.id">
                <td>{{ staffClass.name }}</td>
                <td><button class="btn btn-primary" @click="selectClass(staffClass.id)">View</button></td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import { mapActions, mapState } from "vuex";

    export default {
        name: 'ClassesTable',
        computed: {
            ...mapState([
                'classes',
                'classSelected',
            ]),
        },
        methods: {
            ...mapActions([
                'getClassData'
            ]),
            async selectClass(classId) {
                await this.getClassData(classId);
            },
        },
    }
</script>
