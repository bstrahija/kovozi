<style>
@-webkit-keyframes flash {
    0% {
        background-color: rgba(0,255,0,.1);
    } 100% {
        background-color: transparent;
    }
}

.flash {
    -webkit-animation-name: flash;
    -webkit-animation-duration: 600ms;
    -webkit-animation-iteration-count: 1;
    -webkit-animation-timing-function: ease-in-out;
}
</style>

<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th width="20%">Kada</th>
                    <th>Tko?</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="assignment in assignments" class="assignment-{{ assignment.id }}">
                    <td>{{ assignment.year }}/{{ assignment.week }}</td>
                    <td>
                        <select name="user_id" class="form-control" v-model="assignment.user_id" v-on:change="updateAssignment(assignment, $event)">
                            <option v-for="user in users" v-bind:value="user.id">{{ user.nickname }}</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
module.exports = {
    created: function() {
        this.fetchUsersAndUpcomingSchedule();
    },

    methods: {
        /**
         * Fetch the history from the API
         * @return {array}
         */
        fetchUsersAndUpcomingSchedule: function() {
            $.getJSON('/api/schedule/upcoming', function(assignments) {
                this.assignments = assignments;
                this.listen();
            }.bind(this));
            $.getJSON('/api/users', function(users) {
                this.users = users;
            }.bind(this));
        },
        updateAssignment: function(assignment, event) {
            this.$http.post('/api/schedule/'+assignment.id, { '_method': 'put', 'user_id': event.target.value }).then(
                function(data) {
                    Alertify.log.success("Izmijenjen raspored");
                }, function(data) {
                    swal("Oops...", "Nešto je pošlo po zlu!", "error");
                }
            );

            event.preventDefault();
        },
        listen: function() {
            Echo.channel('assignments.user')
                .listen('AssignmentUserUpdated', function(data) {
                    _.each(this.assignments, function(item, key) {
                        console.log(item.id, data.assignment.id);
                        if (item.id == data.assignment.id) {
                            item.user_id = data.assignment.user_id;
                            $(".assignment-"+data.assignment.id).removeClass("flash").addClass("flash");
                            // this.assignments[key].user_id = assignment.user_id;
                        }
                    }.bind(this));
                    // console.log(assignment);
                    // console.log(this.assignments[1].user_id);
                    // this.assignments[1].user_id = 5;
                    // this.assignment.user_id = e.assignment.user_id;
                }.bind(this));
        }

    },

    data: function() {
        return {
            assignments: [],
            users: []
        }
    }
}
</script>
