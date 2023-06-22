<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Simple Store";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $request->validate($request);

        $newProduct = new Product();
        $newProduct->setName($request->input('name'));
        $newProduct->setDescription($request->input('description'));
        $newProduct->setPrice($request->input('price'));
        $newProduct->setImage("game.png");
        $newProduct->save();

        if ($request->hasFile('image')) {
            $ImageName = $newProduct->getId() . "." . $request->file('image')->extension();
            Storage::disk('public')->put(
                $ImageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $newProduct->setImage($ImageName);
            $newProduct->save();
        }

        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Edit Product - Simple Store";
        $viewData["product"] = Product::findOrFail($id);
        return view("admin.product.edit")->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        $request->validate($request);

        $product = Product::findOrFail($id);
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));

        if ($request->hasFile('image')) {
            $ImageName = $product->getId() . "." . $request->file('image')->extension();
            Storage::disk('public')->put(
                $ImageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($ImageName);
        }

        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function delete($id)
    {
        Product::destroy($id);
        return back();
    }
}
