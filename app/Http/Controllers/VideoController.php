<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;

use DB;
use Auth;

class VideoController extends Controller
{

    public function home()
    {
        return view('video.all');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->role_id == 3 ? $where_array = ['users.id' => Auth::user()->id] : $where_array = [];

        $videos = Video::join('users', 'videos.user_id', '=', 'users.id')
                    ->select('videos.id', 'title', 'users.name as user', 'description', 'link')
                    ->where($where_array)
                    ->get();
                    
        return response()->json(array("data" => $videos))->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();  
        try 
        {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $extention = $file->getClientOriginalExtension();
            $name = uniqid()."-".$name;
            $file->move(public_path().'/uploads/videos/', $name );
            $url = url('/').'/uploads/videos/' . $name;

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->getClientOriginalName();
            $thumbnail_name = uniqid()."-".$thumbnail_name;
            $thumbnail->move(public_path().'/uploads/videos/thumbnail/', $thumbnail_name );
            $thumbnail_url = url('/').'/uploads/videos/thumbnail/' . $thumbnail_name;            

            $video = new Video;
            $video->user_id = Auth::user()->id;
            $video->title = $request->title;
            $video->description = $request->description;
            $video->thumbnail_file_name = $thumbnail_name;
            $video->thumbnail_link = $thumbnail_url;
            $video->file_name = $name;
            $video->link = $url;
            $video->save();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json([ "error" => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
        DB::commit();

        $request->session()->flash('success', 'New video successfully submitted!');

        return "Success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::join('users', 'videos.user_id', '=', 'users.id')->select('videos.id', 'title', 'file_name','users.name as user', 'description', 'link', 'thumbnail_file_name', 'thumbnail_link')
                    ->where('videos.id', $id)->first();

        $video->file_name = substr($video->file_name, 14);
        $video->thumbnail_file_name = substr($video->thumbnail_file_name, 14);

        return view('video.edit', compact('video'));
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
        $video = Video::find($id);
        $video->title = $request->title;
        $video->description = $request->description;

        if(!is_null($request->file('thumbnail'))){

            $previous = Video::select('videos.thumbnail_file_name')
            ->where('videos.id', $id)
            ->first();

            unlink(public_path().'/uploads/videos/thumbnail/' . $previous->thumbnail_file_name);

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->getClientOriginalName();
            $thumbnail_name = uniqid()."-".$thumbnail_name;
            $thumbnail->move(public_path().'/uploads/videos/thumbnail/', $thumbnail_name );
            $thumbnail_url = url('/').'/uploads/videos/thumbnail/' . $thumbnail_name;  

            $video->thumbnail_file_name       = $thumbnail_name;
            $video->thumbnail_link            = $thumbnail_url;
        }

        $video->save();

        $request->session()->flash('success', 'Video details successfully edited!');

        return "Success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $previous = Video::select('file_name')
                ->where('id', $request->id)
                ->first();

                unlink(public_path().'/uploads/videos/' . $previous->file_name);

        Video::where('id', $request->id)->delete();

        $request->session()->flash('warning', 'Video successfully deleted!');

        return "Success";
    }
}
