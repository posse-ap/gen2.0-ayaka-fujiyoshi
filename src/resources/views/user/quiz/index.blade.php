@extends('layout.app')
@section('content')
    <div class="max-w-2xl mx-auto">
        <ul>
            @foreach ($questions as $question)
                <li><img src="{{ asset('img/' . $question->image) }}" /></li>
            @endforeach
        </ul>
    </div>
@endsection
