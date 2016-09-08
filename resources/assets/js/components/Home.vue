<template>
    <this-week :assignment="schedule.this_week"></this-week>
    <next-week :assignment="schedule.next_week"></next-week>
    <history :history="schedule.history" :upcoming="schedule.upcoming"></history>
</template>

<script>
module.exports = {
    created: function() {
        this.fetchSchedule();
    },

    methods: {
        fetchSchedule: function() {
            $.getJSON('/api/schedule', function(schedule) {
                this.schedule = schedule;
                this.listen();
            }.bind(this));
        },
        listen: function() {
            // Listen when assignement has changed
            Echo.channel('assignments.user')
                .listen('AssignmentUserUpdated', function(e) {
                    // Simply refetch the schedule
                    this.fetchSchedule();
                }.bind(this));
        }
    },

    data: function() {
        return {
            schedule: {}
        }
    }
}
</script>
