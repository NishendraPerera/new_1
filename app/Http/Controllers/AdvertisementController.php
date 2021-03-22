<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Advertisement;
use App\AdSize;
use App\AdColour;
use App\AdLanguage;
use App\AdCategory;
use App\AdPrice;

use DB;
use Exception;
use Auth;

class AdvertisementController extends Controller
{

    public function home()
    {
        return view('advertisement.all');
    }

    public function index()
    {
        Auth::user()->role_id == 3 ? $where_array = ['users.id' => Auth::user()->id] : $where_array = [];

        $advertisements = Advertisement::join('ad_sizes', 'advertisements.ad_size_id', '=', 'ad_sizes.id')
                            ->join('ad_colours', 'advertisements.ad_colour_id', '=', 'ad_colours.id')
                            ->join('users', 'advertisements.user_id', '=', 'users.id')
                            ->join('ad_languages', 'advertisements.ad_language_id', '=', 'ad_languages.id')
                            ->join('ad_categories', 'advertisements.ad_category_id', '=', 'ad_categories.id')
                            ->select('advertisements.id', 'users.name AS user', 'ad_colours.name AS colour', 'ad_sizes.name AS size', 'ad_languages.name AS language', 'ad_categories.name AS category', DB::raw("DATE_FORMAT(advertisements.date, '%Y-%m-%d') as date"), DB::raw('IF(advertisements.paid=1, "Yes", "No") AS paid'), 'advertisements.file_name', 'advertisements.link', DB::raw("FORMAT(price,0) as price"))
                            ->orderBy('date', 'desc')
                            ->where($where_array)
                            ->get();

        foreach($advertisements AS $advertisement){
            $advertisement->file_name = substr($advertisement->file_name, 14);
        }

        return response()->json(array("data" => $advertisements))->header('Content-Type', 'application/json');
    }

    public function create()
    {
        $sizes = AdSize::select('id', 'name')->get();
        $categories = AdCategory::select('id', 'name')->get();
        $languages = AdLanguage::select('id', 'name')->get();
        $colours = AdColour::select('id', 'name')->get();

        return view('advertisement.new', compact('sizes', 'categories', 'languages', 'colours'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();  
        try 
        {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $extention = $file->getClientOriginalExtension();

            $name = uniqid()."-".$name;
            $file->move(public_path().'/uploads/advertisements/', $name );

            $url = url('/').'/uploads/advertisements/' . $name;

            $price = AdPrice::select('price')->where('size_id', $request->size)->where('colour_id', $request->colour)->first()->price;

            $advertisement = new Advertisement;
            $advertisement->user_id         = Auth::user()->id;
            $advertisement->ad_size_id      = $request->size;
            $advertisement->ad_colour_id    = $request->colour;
            $advertisement->ad_category_id  = $request->category;
            $advertisement->ad_language_id  = $request->language;
            $advertisement->file_name       = $name;
            $advertisement->date            = $request->date;
            $advertisement->link            = $url;
            $advertisement->price           = $price;
            $advertisement->paid            = 1;
            $advertisement->save();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json([ "error" => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
        DB::commit();

        $request->session()->flash('success', 'Payment received! New advertisement successfully submitted!');

        return "Success";
    }

    public function edit($id)
    {

        $sizes = AdSize::select('id', 'name')->get();
        $categories = AdCategory::select('id', 'name')->get();
        $languages = AdLanguage::select('id', 'name')->get();
        $colours = AdColour::select('id', 'name')->get();

        $advertisement = Advertisement::join('users', 'advertisements.user_id', '=', 'users.id')->select('advertisements.id', 'users.name AS user', 'ad_colour_id AS colour', 'advertisements.ad_size_id AS size', 'ad_language_id AS language', 'ad_category_id AS category', DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as date"), DB::raw('IF(paid=1, "Yes", "No") AS paid'), 'file_name', 'link', DB::raw("FORMAT(price,0) as price"))
                            ->where('advertisements.id', $id)
                            ->first();

        $advertisement->file_name = substr($advertisement->file_name, 14);
        
        return view('advertisement.edit', compact('sizes', 'categories', 'languages', 'colours', 'advertisement'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();  
        try 
        {
            $advertisement = Advertisement::find($id);
            $advertisement->ad_size_id      = $request->size;
            $advertisement->ad_colour_id    = $request->colour;
            $advertisement->ad_category_id  = $request->category;
            $advertisement->ad_language_id  = $request->language;
            $advertisement->date            = $request->date;

            if(!is_null($request->file('file'))){

                $previous = Advertisement::select('advertisements.file_name')
                ->where('advertisements.id', $id)
                ->first();

                unlink(public_path().'/uploads/advertisements/' . $previous->file_name);

                $file = $request->file('file');
                $name = $file->getClientOriginalName();
                $extention = $file->getClientOriginalExtension();

                $name = uniqid()."-".$name;
                $file->move(public_path().'/uploads/advertisements/', $name );

                $url = url('/').'/uploads/advertisements/' . $name;

                $advertisement->file_name       = $name;
                $advertisement->link            = $url;
            }

            $advertisement->save();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json([ "error" => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
        DB::commit();

        $request->session()->flash('success', 'Advertisement successfully edited!');

        return "Success";
    }

    public function destroy(Request $request){

        $previous = Advertisement::select('advertisements.file_name')
                ->where('advertisements.id', $request->id)
                ->first();

                unlink(public_path().'/uploads/advertisements/' . $previous->file_name);

        Advertisement::where('id', $request->id)->delete();

        $request->session()->flash('warning', 'Advertisement successfully deleted!');

        return "Success";
    }

    
    public function price(Request $request)
    {
        $sizes = AdSize::select('id', 'name')->get();
        $colours = AdColour::select('id', 'name')->get();

        return view('advertisement.price', compact('sizes', 'colours'));
    }

    public function price_list(Request $request)
    {
        $prices = AdPrice::join('ad_sizes', 'ad_prices.size_id', '=', 'ad_sizes.id')
                            ->join('ad_colours', 'ad_prices.colour_id', '=', 'ad_colours.id')
                            ->select('ad_prices.id', 'ad_colours.name AS colour', 'ad_sizes.name AS size', DB::raw("FORMAT(price,0) as price"), 'price')
                            ->orderBy('size', 'asc')
                            ->get();

        return response()->json(array("data" => $prices))->header('Content-Type', 'application/json');
    }

    public function price_store(Request $request)
    {
        $previous = AdPrice::where('size_id', $request->size)->where('colour_id', $request->colour)->exists();

        if($previous){
            return "The size and colour combination already exists";
        }

        $price = new AdPrice;
        $price->size_id = $request->size;
        $price->colour_id = $request->colour;
        $price->price = $request->price;
        $price->save();

        $request->session()->flash('success', 'New price successfully entered!');

        return "Success";
    }

    public function price_show(Request $request)
    {
        $price = AdPrice::where('id', $request->id)->first();

        return response()->json(array("data" => $price))->header('Content-Type', 'application/json');
    }

    public function price_edit(Request $request)
    {
        $previous = AdPrice::where('size_id', $request->size)->where('colour_id', $request->colour)->where('id', '!=', $request->id)->exists();

        if($previous)
            return "The size and colour combination already exists";

        $price              = AdPrice::find($request->id);
        $price->size_id     = $request->size;
        $price->colour_id   = $request->colour;
        $price->price       = $request->price;
        $price->save();

        $request->session()->flash('success', 'Price successfully edited!');

        return "Success";
    }

    public function price_ajax(Request $request)
    {
        $price = AdPrice::select('price')->where('size_id', $request->size)->where('colour_id', $request->colour)->first()->price;

        return $price;
    }            
}
