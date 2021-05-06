@extends('layout')
@section('title', 'ログイン画面')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>ログイン</h2>
        @if (Session::has('message'))
            <p>{{ session('message') }}</p>
        @endif
        <form method="POST" action="{{ route('signin') }}">
        @csrf
            <div class="form-group">
                <label for="email">
                    メールアドレス　　:
                </label>
                <input
                    id="email"
                    name="email"
                    class="form-control"
                    type="text"
                >
                @if ($errors->has('email'))
                    <div class="text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">
                    パスワード　　　　:
                </label>
                <input
                    id="password"
                    name="password"
                    class="form-control"
                    type="password"
                >
                @if ($errors->has('password'))
                    <div class="text-danger">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            <div class="mt-5">
            <p><button type="submit" class="btn btn-primary"> ログイン</button></p>
            </div>
        </form>
        <p><button type="button" onclick="location.href='/insert'">新規登録</button></p>
    </div>    
</div>
@endsection