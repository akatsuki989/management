@extends('layout')
@section('title', '商品新規登録')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>商品情報新規登録</h2>
        @if (Session::has('flash_message'))
            <p>{{ session('flash_message') }}</p>
        @endif
        <form method="POST" action="{{ route('store') }}" onSubmit="return checkSubmit()">
        @csrf
            <div class="form-group">
                <label for="product_name">
                    商品名　　:
                </label>
                <input
                    id="product_name"
                    name="product_name"
                    class="form-control"
                    type="text"
                >
                @if ($errors->has('product'))
                    <div class="text-danger">
                        {{ $errors->first('product') }}
                    </div>
                @endif
            </div>
            <div class="form-group">

            <p>メーカー　:<select name="company_name" id="manufacturer" >
                @foreach($companies as $company)
                <option value="{{ $company->company_name }}" selected>{{ $company->company_name }}</option>
                @endforeach
                <option selected>選択してください</option>
               </select>
            </p>
            </div>

            <div class="form-group">
                <label for="price">
                    価格　　　:
                </label>
                <input
                    id="price"
                    name="price"
                    class="form-control"
                    type="text"
                >
                @if ($errors->has('price'))
                    <div class="text-danger">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="stock">
                    在庫数　　:
                </label>
                <input
                    id="stock"
                    name="stock"
                    class="form-control"
                    type="text"
                >
                @if ($errors->has('stock'))
                    <div class="text-danger">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="comment">
                    コメント　:
                </label>
                <textarea
                    id="comment"
                    name="comment"
                    class="form-control"
                    rows="10"
                    cols="50"	
                ></textarea>
                @if ($errors->has('comment'))
                    <div class="text-danger">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
            <div class="form-group">
                <p>商品画像　: <input type="file" name="product_img"></input></p>

                @if ($errors->has('product_img'))
                    <div class="text-danger">
                        {{ $errors->first('product_img') }}
                    </div>
                @endif
            </div>
            
            <div class="mt-5">
            <p><button type="submit" class="btn btn-primary"> 登録</button></p>
            </div>
        </form>
        <p><button type="button" onclick="location.href='/product'">戻る</button></p>
    </div>  
</div>
@endsection