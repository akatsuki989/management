@extends('layout')
@section('title', '商品編集')
@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>商品情報編集</h2>
        @if (Session::has('flash_message'))
            <p>{{ session('flash_message') }}</p>
        @endif
        @foreach($product_edit as $product_edit)
        <p>商品情報ID:{{ $product_edit->id }}</p>
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()">
        @csrf
        <input type="hidden" name="id" value="{{ $product_edit->id }}" >
            <div class="form-group">
                <label for="product">
                    商品名　　:
                </label>
                <input
                    id="product_name"
                    name="product_name"
                    class="form-control"
                    value="{{ $product_edit->product_name }}"
                    type="text"
                >
                @if ($errors->has('product_name'))
                    <div class="text-danger">
                        {{ $errors->first('product_name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
            <p>メーカー　:<select name="company_name" id="manufacturer" >
                @foreach($company as $company)
                @if($product_edit->company_id == $company['id'])
                    <option selected>{{ $company['company_name'] }}</option> 
                 @else
                    <option>{{ $company['company_name'] }}</option> 
                @endif
                @endforeach
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
                    value="{{ $product_edit->price }}"
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
                    value="{{ $product_edit->stock }}"
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
                >{{ $product_edit->comment }}</textarea>
                @if ($errors->has('comment'))
                    <div class="text-danger">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                
            <form action="{{ route('edit','id') }}" method="post" enctype="multipart/form-data">         
            <div class="form-group">
                <p>商品画像　: <input id="img_upload" type="file" name="product_img"></input></p>
                <p><img id="img_prv" src="/img/{{ $product_edit->product_img }}"></p>
                @if ($errors->has('product_img'))
                    <div class="text-danger">
                        {{ $errors->first('product_img') }}
                    </div>
                @endif
            </div>
            </form>
            <div class="mt-5">
            <p><button type="submit" class="btn btn-primary" > 更新</button></p>
            </div>
        </form>
        <p><button type="button" onclick="location.href='/product/detail/{{ $product_edit->id }}'">戻る</button></p>
        @endforeach
    </div>   
</div>
<script>
        //画像が選択される度に、この中の処理が走る
        $('#img_upload').on('change', function (ev) {

            //コンソールタブで適切に処理が動いているか確認
            console.log("image is changed");

            //このFileReaderが画像を読み込む上で大切
            const reader = new FileReader();
            //--ファイル名を取得
            const fileName = ev.target.files[0].name;

            //--画像が読み込まれた時の動作を記述
            reader.onload = function (ev) {
                $('#img_prv').attr('src', ev.target.result).css('width', '100px').css('height', '100px');
            }
            reader.readAsDataURL(this.files[0]);
        })
</script>
@endsection