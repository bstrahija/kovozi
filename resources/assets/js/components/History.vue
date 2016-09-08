<template>
    <div class="bs-callout bs-callout-default" v-if="history.length">
        <h6>Vozili su:</h6>

        <ul>
            <li v-for="assignment in history">
                {{ assignment.year }}/{{ assignment.week }} {{ assignment.user.nickname }}
            </li>
        </ul>
    </div>

    <div class="bs-callout bs-callout-default" v-if="upcoming.length">
        <h6>Raspored:</h6>

        <ul>
            <li v-for="assignment in upcoming">
                {{ assignment.year }}/{{ assignment.week }} {{ assignment.user.nickname }}
            </li>
        </ul>
    </div>
</template>

<script>
module.exports = {
    props: [{
        name: 'history',
        default: () => []
    }, {
        name: 'upcoming',
        default: () => []
    }]
}
</script>
