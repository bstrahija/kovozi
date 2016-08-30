<template>
    <div class="bs-callout bs-callout-success">
        <form method="post" action="{{ route('schedule.notes.update', $this_week->id) }}">
            <input type="hidden" name="_method" value="put">

            @if ($this_week->user->id == $current_user->id)
                <h1>Ovaj tjedan ti voziš!</h1>
            @else
                <h4>Ovaj tjedan vozi:</h4>
                <h1>{{ $this_week->user->nickname }}</h1>
            @endif

            <input type="text" class="form-control" name="notes" value="{{ $this_week->notes }}" placeholder="Ovdje možeš unijeti napomenu...">
        </form>
    </div>
</template>

<script>
    export default {
        ready() {
            console.log('THIS WEEK Component ready.')
        }
    }
</script>
