<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecordsRequest;
use App\Models\Records;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Records::all();
        return $records;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecordsRequest $request)
    {
        $post = Records::create($request->all());
        // return response()->json([
        //     "status"=>1,
        //     "message"=>"Record criado com sucesso",
        //     "post"=>$post
        // ],200);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function show(Records $record)
    {
        return view('records.edit')->with("records", $record);
    }

    public function view(Records $record){
        return view('records.view')->with("records", $record);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function edit(Records $records)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRecordsRequest $request, Records $record)
    {
        $record->update($request->all());
        // return response()->json([
        //     "status"=>1,
        //     "message"=>"Record atualizado com sucesso",
        //     "update"=>$record
        // ],200);
        return redirect('/');
    }

    public function search(Request $request){
        $search = $request->input('search');

        $records = Records::query()
        ->where('title', 'LIKE', "%{$search}%")
        ->orWhere('recordContent', 'LIKE', "%{$search}%")
        ->get();

        // Return the search view with the resluts compacted
        return view('search')->with("records",$records);
    }

    function filterNewst(){
       $records  = Records::all()->sortByDesc('created_at');
       return view('records.index')->with("records",$records);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function destroy(Records $record)
    {
        $record->delete();
        // return view("records.index")->with("records",Records::all());
        return redirect('/');
    }

    public function download(){
        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; database.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        $list = Records::all()->toArray();
        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));
        $callback = function() use ($list) {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }

}
