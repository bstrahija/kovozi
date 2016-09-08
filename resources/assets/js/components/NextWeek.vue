<template>
    <div class="bs-callout bs-callout-warning" v-if="assignment.user">
        <form method="post" action="#">
            <input type="hidden" name="_method" value="put">

            <h6>Slijedeći tjedan vozi:</h6>
            <h3>{{ assignment.user.nickname }}</h3>
        </form>
    </div>
</template>

<script>
module.exports = {
    props: [{
        name: 'assignment',
        default: () => { return { user: {} }}
    }]
}
</script>
