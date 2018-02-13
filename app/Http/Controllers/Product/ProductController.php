<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\ProductRequest;
use App\Models\productadmin;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function admin()//стартовая страница
    {

        return view("products.admin");
    }

    public function addAdminProduct(Request $request)//сохранение в базу заказа
    {
        $objProduct = new Product();
        $Products = $objProduct->get();
        foreach ($Products as $product) {
            if ($product->name == $request->input('p_name')) {      //Проверка есть ли данный товар в таблице 'products'
                $objadmin = new productadmin();
                $objadmin = $objadmin->create([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'mail' => $request->input('mail'),
                    'p_name' => $request->input('p_name')
                ]);
                return back();
            }
        }
        echo ("Данного товара нет в базе");
    }
    public function index()
    {
        $objProduct = new Product();
        $Products = $objProduct->get();
        return view("products.index", ['products' => $Products]);
    }

    public function addProduct() //Отображает все продукты
    {
        return view("products.add");
    }

    public function addRequestProduct(ProductRequest $request)//Обрабатывает добавление продукта
    {

        $objProduct = new Product();
        $objProduct = $objProduct->create([
            'name' => $request->input('name'),
            'descriptions' => $request->input('descriptions'),
            'price' => $request->input('price')
        ]);
        if ($objProduct) {

            return back();
        } else {
            dd($request->all());
        }
    }

    public function editProduct(int $id) //Отображает страницу изменения продукта, ищет по id в таблице
    {
        $product = Product::find($id);
        if (!$product) {
            return abort(404);
        }
        return view('products.edit', ['product' => $product]);

    }

    public function editRequestProduct(Request $request, int $id) // Сохраняет изменения продукта
    {
        $objProduct = Product::find($id);
        if (!$objProduct) {
            abort(404);
        }
        $objProduct->name = $request->input('name');
        $objProduct->descriptions = $request->input('descriptions');
        $objProduct->price = $request->input('price');
        if ($objProduct->save()) {
            return redirect(route('products'))->with('success');
        }else {
            return back()->with('error');
            dd($request->all());
        }
    }
    public function deleteProduct(Request $request){//Удаление продукта
        if($request->ajax()){
            $id = (int)$request-> input('id');
            $objProduct = new Product();
            $objProduct->where('id', $id)->delete();
        }
    }

}