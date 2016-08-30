<template>
    <div class="bs-callout bs-callout-warning" v-if="assignment.user">
        <form method="post" action="#" v-on:submit="updateAssignment">
            <input type="hidden" name="_method" value="put">

            <h6>Slijedeći tjedan vozi:</h6>
            <h3>{{ assignment.user.nickname }}</h3>

            <input type="text" class="form-control" name="notes" value="{{ assignment.notes }}" placeholder="Ovdje možeš unijeti napomenu...">
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
            $.getJSON('api/schedule/next-week', function(assignment) {
                this.assignment = assignment;
            }.bind(this));
        },
        updateAssignment: function(event) {
            this.$http.post('api/schedule/'+this.assignment.id, { '_method': 'put', 'notes': this.assignment.notes }).then(
                function(data) {
                    Alertify.log.success("Success notification");
                }, function(data) {
                    swal("Oops...", "Something went wrong!", "error");
                }
            );

            event.preventDefault();
        }
    },

    data: function() {
        return {
            assignment: { user: {} }
        }
    }
}
</script>
