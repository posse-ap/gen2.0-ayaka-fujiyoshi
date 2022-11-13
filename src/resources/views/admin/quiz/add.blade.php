@extends('layouts.app')
@section('content')
    <h2>{{ $big_question->name }}</h2>
    <form action="/{{ request()->path() }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <th>選択肢</th>
                <th>正解の場合チェック</th>
            </tr>
            <tr>
                <td><input type="text" name="name1"></td>
                <td><input type="radio" name="valid" value="1"></td>
            </tr>
            <tr>
                <td><input type="text" name="name2"></td>
                <td><input type="radio" name="valid" value="2"></td>
            </tr>
            <tr>
                <td><input type="text" name="name3"></td>
                <td><input type="radio" name="valid" value="3"></td>
            </tr>
        </table>
        <div style="margin-bottom: 20px">
            <h3 style="margin-bottom: 0; font-size: 16px;">問題の画像</h3>
            <input type="file" name="file">
        </div>

        <button type="submit">追加</button>
    </form>
@endsection