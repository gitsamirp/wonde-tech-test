<template>
<div class="row g-0 button-bar">
    <div class="col-4">
        <button
            class="breadcrumb-button"
            :class="{ 'active' : currentView === 'home' }"
            @click="home"
        >
            <b>Select Employee</b>
        </button>
    </div>
    <div class="col-4">
        <button
            class="breadcrumb-button"
            :class="{ 'active' : currentView === 'classes' }"
            :disabled="employeeSelected === null"
            @click="goToSelectClasses"
        >
            <b>Select Classes</b>
        </button>
    </div>
    <div class="col-4">
        <button
            class="breadcrumb-button"
            :class="{ 'active' : currentView === 'lessons' }"
            :disabled="classSelected === null"
        >
            <span v-if="classSelected === null"><b>Calendar</b></span>
            <span v-else><b>Class:</b> {{ classSelected.name }}</span>
        </button>
    </div>
</div>
</template>

<script>
import { mapMutations, mapState } from 'vuex';

export default {
    name: 'Navigation',
    props: {
        currentView: {
            type: String,
            required: true,
        }
    },
    computed: {
        ...mapState([
            'employeeSelected',
            'classSelected',
        ]),
    },
    methods: {
        ...mapMutations([
            'resetSelections',
            'resetClassSelected',
        ]),
        home() {
            this.resetSelections();
        },
        goToSelectClasses() {
            this.resetClassSelected();
        }
    },
}
</script>

<style scoped lang="scss">
.button-bar > div {
    border: 1px solid grey;
    text-align: center;
}
.breadcrumb-button {
    padding: 8px;
    width: 100%;
    background: none;
    border: none;

    &.active {
        background-color: #b2ffff;
    }

    &:hover:enabled {
        background-color: lightcyan;
    }
}
</style>
