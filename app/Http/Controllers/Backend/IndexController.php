<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Product;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Yajra\Datatables\Datatables;

class IndexController extends Controller
{
    public function index(){
        
        return view('backend.product.index');
    }

    public function list(){

        $product = Product::with('currency')->orderBy('id','DESC');

        return Datatables::of($product)
        
        ->addColumn('currency',function($product){
            if(!empty($product->currency->name)){
                return $product->currency->name;
            }else{
                return 'N/A';
            }
        })
        ->addColumn('action', function ($product) {
            // return '--';
            return '<a href="'. route('seller.product.edit', $product->slug) .'"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Product"></i></a>';
        })
        ->make(true);
    }

    public function create(){
        
        $currencies = Currency::get();
        
        return view('backend.product.add',compact('currencies'));
    }

    public function store(Request $request){
        
        try {
            $this->validate($request, [
                    'name'                  => 'required',
                    'unit_price'            => 'required',
                    'available_quantity'    => 'required',
                    'currency'              => 'required',
               ]);
              
            $contact =  Product::create([
                'name'                  => $request->name,
                'unit_price'            => $request->unit_price,
                'available_quantity'    => $request->available_quantity,
                'currency_id'           => $request->currency,
                'slug'                  => SlugService::createSlug(Product::class, 'slug', $request->name),

              ]);

            return redirect()->route('seller.dashboard')->with('success', 'Product added successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(validator)->withInput();
        }
    }

    public function edit(Request $request, $slug){
        $currencies = Currency::get();
        $product = Product::where('slug', $slug)->with('currency')->first();
        return view('backend.product.edit', compact('product','currencies'));
    }

    public function update(Request $request){
        
        try {
            $this->validate($request, [
                    'name'                  => 'required',
                    'unit_price'            => 'required',
                    'available_quantity'    => 'required',
                    'currency'              => 'required',
               ]);
              
            $contact =  Product::where('id',$request->product_id)->Update([
                'name'                  => $request->name,
                'unit_price'            => $request->unit_price,
                'available_quantity'    => $request->available_quantity,
                'currency_id'           => $request->currency,
                'slug'                  => SlugService::createSlug(Product::class, 'slug', $request->name),
              ]);

            return redirect()->route('seller.dashboard')->with('success', 'Product added successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(validator)->withInput();
        }
    }

    
}
