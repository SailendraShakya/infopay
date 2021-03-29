<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Services\Product\ProductApi;
use App\Services\Product\ProductScraping;

use URL;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scarping(ProductScraping $scraping)
    {
        $url = 'https://www.apple.com/shop/buy-mac/macbook-pro/13-inch';
        $scraping->insertProducts($url);
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function api(ProductApi $api)
    {
        $url = 'https://www.apple.com/shop/updateSEO?m=%7B%22tabKey%22%3A%2213-inch%22%2C%22refererUrl%22%3A%22https%3A%2F%2Fwww.apple.com%2Fshop%2Fbuy-mac%2Fmacbook-pro%2F16-inch%22%7D';
        $api->insertProducts($url);
        return redirect('products-api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_api()
    {
        $data['products'] = Product::where('status', 'api')->get();
        return view('backend.api.index', $data);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::where('status', 'manual')->get();
        return view('backend.products.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scraping_listing()
    {
        $data['products'] = Product::where('status', 'scraping')->get();
        return view('backend.scraping.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'price' => 'required',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);

        $data['image'] = URL::to('/uploads/' . $imageName);
        $data['price'] = '$'.$request->price;
        $data['status'] = 'manual';
        $product = Product::create($data);
        return redirect('/products')->with('message', 'Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['product'] = Product::find($id);
        return view('backend.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if(isset($request->image)){ 
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $data['image'] = URL::to('/uploads/' . $imageName);
        }

       

        $data['status'] = 'manual';
        $data['price'] = '$'.$request->price;

        $product = Product::find($id);

        $product->update($data);
        return redirect('/products')->with('message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Deleted!');
    }
}
