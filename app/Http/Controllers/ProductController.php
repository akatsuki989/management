<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use App\Models\User;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\User_insertRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    /**
     * ログイン画面を表示する
     * 
     * @return view
     */
    public function showLogin(){

        return view('product.login');

    }

    /**
     * ログインする
     * @param array $request
     * @return unknown
     */

    public function postSignin(SigninRequest $request){

        $users = DB::table('users')
            ->select('password')
            ->where('email', '=', $request['email'])->get();

        $user_password = $users[0]->password;

        if (Hash::check( $request->password, $user_password)){
            return redirect()->route('Products'); 
        }else{

            return redirect(route('login'))->with('message', 'パスワードが異なっています。');

        }

    }

    /**
     * 新規登録画面を表示する
     * 
     * @return view
     */
    public function showInsert(){

        return view('product.user_insert');

    }

    /**
     * ユーザを新規登録する
     * 
     * @return view
     */
    public function postUser(User_insertRequest $request){
        // ユーザ情報を受け取る
        $inputs = $request->all();

        if($request->password !== $request->password_conf){
           return redirect(route('insert'))->with('flash_message', '確認用パスワード異なっています。');
        }

        \DB::beginTransaction();
        try{

            // ユーザ情報を登録
            $user = new User;
            $user->user_name     = $request['user_name'];
            $user->email         = $request['email'];
            $user->password      = Hash::make($request['password']);
            $user->save();

            \DB::commit();

        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        return redirect(route('insert'))->with('flash_message', '登録しました。');
           
    }

    /**
     * 商品情報一覧を表示する
     * 
     * @return view
     */
    public function showList(Request $request){
        $query = Product::query();
        $company = Company::query();
        $companies = Company::orderBy('company_name', 'asc')->get(['company_name']);
        
        // 検索機能
        $search = $request->input('product_name');
        $company_name = $request->input('company_name');

        //もしキーワードがあったら
        if(!empty($search)){
        
            $query->where('product_name', 'like', "%$search%");
        }

        if($request->has('company_name') && $company_name != ('選択してください')){
            $query->where('company_name', $company_name);
        }

        $products = $query->from('products')->select(

          'products.id as id',
          'products.product_name as product_name',
          'products.price as price',
          'products.stock as stock',
          'products.product_img as product_img',
          'companies.company_name as company_name'
   
        )
        ->orderby('id', 'asc')
        ->leftjoin('companies', 'products.company_id', '=', 'companies.id')
        ->get();
            
        return view('product.list', [

            'products' => $products,
            'companies' => $companies,
            'search' => $search,
            'company_name' => $company_name

        ]);

    }

    /**
     * 商品情報削除
     * @param int $id
     * @return view
     */

    public function exeDelete($id){

        if (empty($id)){

        return redirect(route('Products'))->with('message', 'データがありません。');
        }

        try {
            // 商品情報を削除
            Product::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        return redirect(route('Products'))->with('message', '削除しました。');
    }


    /**
     * 商品情報詳細を表示する
     * @param int $id
     * @return view
     */

    public function showDetail($id){

        $product  = Product::find($id);

        $product_detail = $product->query()->from('products')->select(

            'products.id as id',
            'sales.product_id as product_id',              
            'products.product_name as product_name',
            'products.price as price',
            'products.stock as stock',
            'products.comment as comment',
            'products.product_img as product_img',
            'companies.company_name as company_name'
            
        )
        ->orderby('id', 'asc')
        ->leftjoin('companies', 'products.company_id', '=', 'companies.id')
        ->leftjoin('sales', 'sales.product_id', '=', 'products.id')
        ->where('products.id','=', $id)
        ->get();

        return view('product.detail', [
            'product' => $product,
            'product_detail' => $product_detail
        ]);

    }

    /**
     * 商品情報新規登録を表示する
     * 
     * @return view
     */

    public function showCreate(){

        $companies  = Company::all();

        return view('product.form', [ 'companies' => $companies]);

    }

     /**
     * 商品情報を新規登録する
     * 
     * @return view
     */

    public function exeStore(ProductRequest $request){

        \DB::beginTransaction();
        try{

            $id = DB::table('products')
                ->select('company_id')
                ->leftjoin('companies', 'products.company_id', '=', 'companies.id')
                ->where('company_name', '=', $request['company_name'])
                ->get();

            $company_id = $id[0]->company_id;

            $product = new Product;
            $product->company_id = $company_id;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            $product->product_img = $request->product_img;
            $product->save();

            \DB::commit();

        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
   
        return redirect(route('create'))->with('flash_message', '登録しました。');

    }

    /**
     * 商品情報編集画面を表示する
     * @param int $id
     * @return view
     */

    public function showEdit($id){

        $product  = Product::find($id);
        $product_edit = $product->query()->from('products')->select(

            'products.id as id',
            'products.company_id as company_id',
            'sales.product_id as product_id',              
            'products.product_name as product_name',
            'products.price as price',
            'products.stock as stock',
            'products.comment as comment',
            'products.product_img as product_img',
            'companies.company_name as company_name'
        
        )
        ->orderby('id', 'asc')
        ->leftjoin('companies', 'products.company_id', '=', 'companies.id')
        ->leftjoin('sales', 'sales.product_id', '=', 'products.id')
        ->where('products.id','=', $id)
        ->get();

        $company = Company::orderBy('company_name', 'asc')->get(['company_name','id']);

        return view('product.edit', [

            'product_edit' => $product_edit,
            'company' => $company

        ]);
    }



    /**
     * 商品情報を編集する
     * 
     * @return view
     */

    public function exeUpdate(Request  $request){
               
      \DB::beginTransaction();
      try{
            // 商品情報のデータを受け取る
            $inputs = $request->all();
            $product = Product::find($inputs['id']);
            $id = DB::table('companies')
                ->select('companies.id')
                ->where('company_name', '=', $request['company_name'])
                ->get();

            $company_id = $id[0]->id;

            $product->company_id = $company_id ;
            $product->product_name = $inputs['product_name'];
            $product->price = $inputs['price'];
            $product->stock = $inputs['stock'];
            $product->comment = $inputs['comment'];   
            $product->company_id = $company_id ;
            $product->product_name = $inputs["product_name"];
            $product->price = $inputs["price"];
            $product->stock = $inputs["stock"];
            $product->comment = $inputs["comment"];
            if (empty($inputs['product_img'])){
                $product->product_img = $product["product_img"];
            }else{
                $product->product_img = $inputs["product_img"];
            };

            $id_return =   $product->id;

            $product->save();
            
            \DB::commit();

        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
 
        return redirect(route('edit',['id' => $id_return]))->with('flash_message', '更新しました。');

     }

}


