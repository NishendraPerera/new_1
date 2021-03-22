<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Advertisement;
use App\AdSize;
use App\AdColour;
use App\AdCategory;

use DB;

class ReportController extends Controller
{
    public function advertisement()
    {
        // $users = User::select('id', 'name')->where('role_id', 3)->get();
        $users = User::select('id', 'name')->get();

        $sizes = AdSize::select('id', 'name')->orderBy('name')->get();
        $colours = AdColour::select('id', 'name')->orderBy('name')->get();
        $categories = AdCategory::select('id', 'name')->orderBy('name')->get();
        
        return view('report.advertisement', compact('users', 'sizes', 'colours', 'categories'));
    }

    public function ad_list(Request $request)
    {
        $now = time();

        $starting = $request->starting;
        $ending = $request->ending;
        $month = $request->salesMonth;
        $user = $request->user;
        $category = $request->category;
        $size = $request->size;
        $colour = $request->colour;

        

        if($request->ending==""||$request->ending=="0"||is_null($request->ending)){
            $request->ending = date("Y-m-d");
        }

        if($request->starting==""||$request->starting=="0"||is_null($request->starting)){
            if($month=="0"||is_null($month)){

                $currentDay = date("Y-m-d", $now);
                $currentDayEpoch = strtotime($currentDay);

                $starting = strtotime("-1 month ", $currentDayEpoch);
                $starting = date('Y-m-d H:i:s', $starting);
                $ending = date('Y-m-d H:i:s', $now);

                $created_at = 'advertisements.created_at BETWEEN "'.$starting.'" AND "'.$ending.'"';
            } else {
                $year = date("Y");
                if($month=="LNovember"||$month=="LDecember"||$month=="LOctober"){
                    $month = str_replace( "L" , "", $month );
                    $year = date("Y")-1;
                }

                $start = strtotime("1 ".$month." ".$year." 00:00:00"); //epoch time
                $starting = date('Y-m-d H:i:s', $start); 

                $end = strtotime("+1 month -1 second", $start); // 31-03-2021 23:59:59
                $ending = date('Y-m-d H:i:s', $end);

                $created_at = 'advertisements.created_at BETWEEN "'.$starting.'" AND "'.$ending.'"';
            }            
        } else {
            $starting = $request->starting." 00:00:00"; 
            $ending = $request->ending." 23:59:59";

            $created_at = 'advertisements.created_at BETWEEN "'.$starting.'" AND "'.$ending.'"';
        }

        $user==0 ? $userQuery = 'advertisements.user_id IS NOT NULL' : $userQuery = 'advertisements.user_id = '.$user;
        $category==0 ? $categoryQuery = 'advertisements.ad_category_id IS NOT NULL' : $categoryQuery = 'advertisements.ad_category_id = '.$category;
        $size==0    ? $sizeQuery = 'advertisements.ad_size_id IS NOT NULL' : $sizeQuery = 'advertisements.ad_size_id = '.$size;
        $colour==0  ? $colourQuery = 'advertisements.ad_colour_id IS NOT NULL' : $colourQuery = 'advertisements.ad_colour_id = '.$colour;

        $advertisements = Advertisement::join('ad_sizes', 'advertisements.ad_size_id', '=', 'ad_sizes.id')
                            ->join('ad_colours', 'advertisements.ad_colour_id', '=', 'ad_colours.id')
                            ->join('users', 'advertisements.user_id', '=', 'users.id')
                            ->join('ad_languages', 'advertisements.ad_language_id', '=', 'ad_languages.id')
                            ->join('ad_categories', 'advertisements.ad_category_id', '=', 'ad_categories.id')
                            ->select('advertisements.id', 'users.name AS user', 'ad_categories.name AS category', 'ad_sizes.name AS size', 'ad_colours.name AS colour', DB::raw("DATE_FORMAT(advertisements.created_at, '%Y-%m-%d') as submitted_on"), DB::raw("FORMAT(price,0) as price"))
                            ->orderBy('submitted_on', 'desc')
                            ->whereRaw($created_at)
                            ->whereRaw($userQuery)
                            ->whereRaw($categoryQuery)
                            ->whereRaw($sizeQuery)
                            ->whereRaw($colourQuery)
                            // ->where('users.id', 2)
                            ->get();

        $amount = DB::table('advertisements')->join('ad_sizes', 'advertisements.ad_size_id', '=', 'ad_sizes.id')
                            ->join('ad_colours', 'advertisements.ad_colour_id', '=', 'ad_colours.id')
                            ->join('users', 'advertisements.user_id', '=', 'users.id')
                            ->join('ad_languages', 'advertisements.ad_language_id', '=', 'ad_languages.id')
                            ->join('ad_categories', 'advertisements.ad_category_id', '=', 'ad_categories.id')
                            ->whereRaw($created_at)
                            ->whereRaw($userQuery)
                            ->whereRaw($categoryQuery)
                            ->whereRaw($sizeQuery)
                            ->whereRaw($colourQuery)
                            ->sum('price');

        $amount = number_format($amount, 0, '.', ',');

        $user=="0"  ? $user="All Users" : $user = User::select('name')->where('id', $user)->first()->name; 
        $category=="0"  ? $category="All Categories" : $category = AdCategory::select('name')->where('id', $category)->first()->name;
        $size=="0"      ? $size="All Sizes" : $size = AdSize::select('name')->where('id', $size)->first()->name;
        $colour=="0"    ? $colour="All Colour Options" : $colour = AdColour::select('name')->where('id', $colour)->first()->name;

        return response()->json(array("data" => $advertisements, "user" => $user, "from" => $starting, "to" => $ending, "category" => $category, "size" => $size, "colour" => $colour, "amount" => $amount
        ))->header('Content-Type', 'application/json');
    }
}
