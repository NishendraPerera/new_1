<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PreviousPaper;

use DB;

class PreviousPaperController extends Controller
{
    public function home()
    {
        return view('previous.all');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $previous_papers = PreviousPaper::select( 'id', DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as date"), 'link')
                            ->orderBy('date', 'desc')->get();

        return response()->json(array("data" => $previous_papers))->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('previous.new');
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
            $file->move(public_path().'/uploads/previous/', $name );

            $url = url('/').'/uploads/previous/' . $name;

            $previous = new PreviousPaper;
            $previous->date = $request->date;
            $previous->file_name = $name;
            $previous->link = $url;
            $previous->save();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json([ "error" => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
        DB::commit();

        $request->session()->flash('success', 'New advertisement successfully submitted!');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $previous = PreviousPaper::select('file_name')
                ->where('id', $request->id)
                ->first();

                unlink(public_path().'/uploads/previous/' . $previous->file_name);

        PreviousPaper::where('id', $request->id)->delete();

        $request->session()->flash('warning', 'Previous newspaper successfully deleted!');

        return "Success";
    }
}
