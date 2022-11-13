@extends('layout.app')
@section('title', 'Detail')
@section('content')
    <div class="max-w-2xl mx-auto mt-4">
      <h1>{{ $bigQuestion->name }}</h1>
        <ul>
            @foreach ($bigQuestion->questions as $question)
                <li class="my-10">
                    <p>{{ $loop->iteration }}. この地名はなんて読む？</p>
                    <img src="{{ asset('img/' . $question->image) }}" />
                    <ul class="m-5">
                      @foreach ($question->choices as $choice)
                          <li class="my-3">{{ $choice->name }}</li>
                      @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
