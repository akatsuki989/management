@extends('layout')
@section('title', '商品詳細')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <h2>商品情報詳細</h2>
            <table class="table">
                <tr>
                    <th>商品情報ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>メーカー</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>コメント</th>
                    <th></th>
                </tr>
                <tr>
                @foreach($product_detail as $product_detail)
                    <td>{{ $product_detail->id }}</td>
                    <td><img src="/img/{{ $product->product_img }}"/></td>                    
                    <td>{{ $product_detail->product_name }}</td>
                    <td>{{ $product_detail->company_name }}</td>
                    <td>{{ $product_detail->price }}円</td>
                    <td>{{ $product_detail->stock }}</td>
                    <td class=comment >{{ $product_detail->comment }}</td>
                    <td><button onclick="location.href='/product/edit/{{ $product->id }}'">編集</td>      
                @endforeach
                </tr>
            </table>
            <button onclick="location.href='/product'">戻る</button>
        </div>
    </div>
@endsection
