@extends('layout')
@section('title', '商品一覧')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <h2>商品情報一覧</h2>
            @if (Session::has('message'))
            <p>{{ session('message') }}</p>
            @endif
            <form class="form-inline my-2 my-lg-0 ml-2">
            <div class="form-group">
                <p>商品名　　：<input type="search" name="product_name" value="{{ $search }}" class="form-control"></p>
                <p>メーカー  ：<select name="company_name" id="manufacturer" >
                    <option disabled selected>選択してください</option>
                    @foreach($companies as $company)
                    <option>{{$company->company_name}}</option>
                    @endforeach
                    </select>
                </p>
                <button type="submit" class="btnbtn-primary" oneclick=>検索</button>
            </div>
            </form>
            <br>
            <button onclick="location.href='/create'">新規作成</button>

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="/img/{{ $product->product_img }}"/></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}円</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td><button onclick="location.href='/product/detail/{{ $product->id }}'">詳細</td>                    
                    <form method="POST" action="{{ route('delete', $product->id )}}" onSubmit="return checkDelete()">
                      @csrf
                      <td><button type="submit" class="btnbtn-primary" oneclick=>削除</td>
                    </form>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <script>
    function checkDelete(){
        if(window.confirm('削除してよろしいですか？')){
            return true;
        }else{
            return false;
        }
    }
    </script>
@endsection
