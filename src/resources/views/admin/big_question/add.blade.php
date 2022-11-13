@extends('layouts.app')
@section('content')
    <h2>大問追加</h2>
    <form action="/{{ request()->path() }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title">
        <button type="submit">追加</button>
    </form>
@endsection