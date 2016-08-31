<template>
    <div class="bs-callout bs-callout-default" v-if="assignments.length">
        <h6>Vozili su:</h6>

        <ul>
            <li v-for="assignment in assignments">
                {{ assignment.year }}/{{ assignment.week }} {{ assignment.user.nickname }}
            </li>
        </ul>
    </div>
</template>

<script>
module.exports = {
    created: function() {
        this.fetchHistory();
    },

    methods: {
        /**
         * Fetch the history from the API
         * @return {array}
         */
        fetchHistory: function() {
            $.getJSON('/api/schedule/history', function(assignments) {
                this.assignments = assignments;
            }.bind(this));
        }
    },

    data: function() {
        return {
            assignments: []
        }
    }
}
</script>
