@extends('layouts.app')

@section('main')
    <div class="centered">
        <div class="bs-callout bs-callout-success">
            <form method="post" action="{{ route('schedule.notes.update', $this_week->id) }}">
                <input type="hidden" name="_method" value="put">
                {!! csrf_field() !!}

                @if ($this_week->user->id == $current_user->id)
                    <h1>Ovaj tjedan ti voziš!</h1>
                @else
                    <h4>Ovaj tjedan vozi:</h4>
                    <h1>{{ $this_week->user->nickname }}</h1>
                @endif

                <input type="text" class="form-control" name="notes" value="{{ $this_week->notes }}" placeholder="Ovdje možeš unijeti napomenu...">
            </form>
        </div>

        <hr>

        <div class="bs-callout bs-callout-warning">
            <form method="post" action="{{ route('schedule.notes.update', $next_week->id) }}">
                <input type="hidden" name="_method" value="put">
                {!! csrf_field() !!}

                @if ($next_week->user->id == $current_user->id)
                    <h3>Slijedeći tjedan si ti na redu!</h3>
                @else
                    <h6>Slijedeći tjedan vozi:</h6>
                    <h3>{{ $next_week->user->nickname }}</h3>
                @endif

                <input type="text" class="form-control" name="notes" value="{{ $next_week->notes }}" placeholder="Ovdje možeš unijeti napomenu...">
            </form>
        </div>
    </div>
@stop
