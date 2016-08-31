<template>
    <div class="bs-callout bs-callout-warning" v-if="assignment.user">
        <form method="post" action="#" v-on:submit="updateAssignment">
            <input type="hidden" name="_method" value="put">

            <h6>Slijedeći tjedan vozi:</h6>
            <h3>{{ assignment.user.nickname }}</h3>

            <!-- <input type="text" class="form-control" name="notes" v-model="assignment.notes" placeholder="Ovdje možeš unijeti napomenu..."> -->
        </form>
    </div>
</template>

<script>
module.exports = {
    created: function() {
        this.fetchNextWeek();
    },

    methods: {
        fetchNextWeek: function() {
            $.getJSON('/api/schedule/next-week', function(assignment) {
                this.assignment = assignment;
                this.listen();
            }.bind(this));
        },
        updateAssignment: function(event) {
            this.$http.post('/api/schedule/'+this.assignment.id, { '_method': 'put', 'notes': this.assignment.notes }).then(
                function(data) {
                    Alertify.log.success("Dodana napomena");
                }, function(data) {
                    swal("Oops...", "Nešto je pošlo po zlu!", "error");
                }
            );

            event.preventDefault();
        },
        listen: function() {
            Echo.channel('assignments.'+this.assignment.id+'.notes')
                .listen('AssignmentNoteUpdated', function(e) {
                    this.assignment.notes = e.assignment.notes;
                }.bind(this));
        }
    },

    data: function() {
        return {
            assignment: { user: {} }
        }
    }
}
</script>
