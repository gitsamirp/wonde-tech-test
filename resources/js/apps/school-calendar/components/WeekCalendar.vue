<template>
<div class="row mb-4">
    <div class="col-12">
        <div class="row calendar-title-row">
            <div class="col">Monday</div>
            <div class="col">Tuesday</div>
            <div class="col">Wednesday</div>
            <div class="col">Thursday</div>
            <div class="col">FriYay!</div>
        </div>

        <div class="row calendar-week">
            <div class="col">
                <div v-for="lesson in getLessonsForDayOfWeek(1)">
                    {{ lesson.startTime }} - {{ lesson.endTime }}
                </div>
            </div>
            <div class="col">
                <div v-for="lesson in getLessonsForDayOfWeek(2)">
                    {{ lesson.startTime }} - {{ lesson.endTime }}
                </div>
            </div>
            <div class="col">
                <div v-for="lesson in getLessonsForDayOfWeek(3)">
                    {{ lesson.startTime }} - {{ lesson.endTime }}
                </div>
            </div>
            <div class="col">
                <div v-for="lesson in getLessonsForDayOfWeek(4)">
                    {{ lesson.startTime }} - {{ lesson.endTime }}
                </div>
            </div>
            <div class="col">
                <div v-for="lesson in getLessonsForDayOfWeek(5)">
                    {{ lesson.startTime }} - {{ lesson.endTime }}
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {mapActions, mapState} from "vuex";
import moment from "moment";

    export default {
        name: 'WeekCalendar',
        computed: {
            ...mapState([
                'classLessons',
            ]),
        },
        methods: {
            ...mapActions([
            ]),
            getLessonsForDayOfWeek(day) {
                const weekStart = moment().startOf('week').startOf('day');
                weekStart.add(day, 'day');
                const dayArray = [];
                Object.values(this.classLessons).forEach((lesson) => {
                    const lessonStartDate = moment(lesson.start_at.date);
                    if (weekStart.isSame(lesson.start_at.date, 'day')) {
                        dayArray.push({
                            'startTime' : lessonStartDate.format('HH:mm'),
                            'endTime' : moment(lesson.end_at.date).format('HH:mm'),
                        })
                    }
                });
                return dayArray;
            }
        },
    }
</script>

<style lang="scss">
.calendar-title-row {
    background-color: #505050;
    color: white;
    text-align: center;

    .col {
        padding: 8px;
        border: 1px solid grey;
    }
}

.calendar-week > div > div {
    text-align: center;
    padding: 8px;
    border-bottom: 1px solid grey;
}
</style>
