@extends('layouts.app')
@section('content')
    <img src="/img/{{ $question->image }}" alt="">
    <form action="/{{ request()->path() }}" method="POST">
        @csrf
        <table>
            <tr>
                <th>選択肢</th>
                <th>正解</th>
            </tr>
            @foreach($question->choices as $choice)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <input
                            type="text"
                            name="name{{ $loop->index }}"
                            value="{{ $choice->name }}"
                        >
                    </td>
                    <td>
                        <input
                            type="radio"
                            name="valid"
                            value="{{ $loop->index }}"
                            @if($choice->valid) checked @endif
                        >
                    </td>
                </tr>
            @endforeach
        </table>
        <button type="submit">更新</button>
    </form>
@endsection