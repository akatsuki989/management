@extends('layout')
@section('title', 'ユーザ新規登録画面')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>ユーザ新規登録</h2>
        @if (Session::has('flash_message'))
            <p>{{ session('flash_message') }}</p>
        @endif
        <form method="POST" action="{{ route('user') }}">
        @csrf
        <div class="form-group">
                <label for="user_name">
                    ユーザ名　　　　　:
                </label>
                <input
                    id="user_name"
                    name="user_name"
                    class="form-control"
                    type="text"
                >
                @if ($errors->has('user_name'))
                    <div class="text-danger">
                        {{ $errors->first('user_name') }}
                    </div>
                @endif
            </div>

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

            <div class="form-group">
                <label for="password_conf">
                    パスワード確認用　:
                </label>
                <input
                    id="password"
                    name="password_conf"
                    class="form-control"
                    type="password"
                >
                @if ($errors->has('password_conf'))
                    <div class="text-danger">
                        {{ $errors->first('passpassword_confword') }}
                    </div>
                @endif
            </div>
            
            <div class="mt-5">
            <p><button type="submit" class="btn btn-primary"> 登録</button></p>
            </div>
        </form>
        <p><button type="button" onclick="location.href='/'">戻る</button></p>
    </div>    
</div>
@endsection