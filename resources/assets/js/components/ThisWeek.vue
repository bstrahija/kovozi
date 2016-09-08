<template>
    <div class="bs-callout bs-callout-success" v-if="assignment.user">
        <form method="post" action="#">
            <input type="hidden" name="_method" value="put">

            <h4>Ovaj tjedan vozi:</h4>
            <h1>{{ assignment.user.nickname }}</h1>
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
