@extends('layouts.app')
@section('content')
    {{ $big_question->name }}
    <form action="/{{ request()->path() }}" method="POST">
        @csrf
        <button type="submit">削除</button>
    </form>
@endsection