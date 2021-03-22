<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Slider;

use Auth;
use Hash;
use DB;

class SettingController extends Controller
{
    public function home()
    {
        return view('settings.password');
    }

    public function change(Request $request)
    {
        $this->validate($request, [
            'oldPass'   => 'required',
            'newPass'   => 'required',
            'newPassA'  => 'required'
        ]);

        $user = new User;

        if(Hash::check($request->oldPass, Auth::user()->password )){

            $user->where('id', Auth::user()->id )
                ->update([ 'password' => Hash::make($request->newPass)  ]);

            $request->session()->flash('success', 'Password Updated!');
            return response()->json(array( "data" => "Success" ))->header('Content-Type', 'application/json');

        }
        else{
            return response()->json(["data" => "Old password doesn't match" ])->header('Content-Type', 'application/json');
        }
    }

    public function slider()
    {
        return view('settings.slider');
    }

    public function slider_list()
    {
        $sliders = Slider::select('id', 'title', 'description', 'link')->orderBy('id', 'desc')->get();

        return response()->json(array("data" => $sliders))->header('Content-Type', 'application/json');
    }

    public function slider_store(Request $request)
    {
        DB::beginTransaction();  
        try 
        {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $extention = $file->getClientOriginalExtension();

            $name = uniqid()."-".$name;
            $file->move(public_path().'/uploads/sliders/', $name );

            $url = url('/').'/uploads/sliders/' . $name;

            $slider = new Slider;
            $slider->title          = $request->title;
            $slider->description    = $request->description;
            $slider->file_name      = $name;
            $slider->link           = $url;
            $slider->save();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json([ "error" => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
        DB::commit();

        $request->session()->flash('success', 'New slider successfully added!');

        return "Success";
    }

    public function slider_delete(Request $request)
    {
        $previous = Slider::select('file_name')
                ->where('id', $request->id)
                ->first();
        
        unlink(public_path().'/uploads/sliders/' . $previous->file_name);
        
        Slider::where('id', $request->id)->delete();

        $request->session()->flash('warning', 'Slider successfully deleted!');

        return "Success";
    }

}
