<template>
    <div class="bs-callout bs-callout-default">
        <h6>Vozili su:</h6>

        <ul>
            @foreach ($history as $assignment)
                <li>{{ $assignment->year }}/{{ $assignment->week }} {{ $assignment->user->nickname }}</li>
            @endforeach
        </ul>
    </div>
</template>

<script>
    export default {
        ready() {
            console.log('HISTORY Component ready.')
        }
    }
</script>
