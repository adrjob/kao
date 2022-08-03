<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {

        $data = new Images;

        $imageName = $request->type . '_' . rand(1,999) .  "." . $request->file->getClientOriginalExtension();
//        $request->file->storeAs('uploads/attachment', $imageName, ['disk' => 'public']);
        $request->file->storeAs('uploads/client' . $request->client_id . '', $imageName, ['disk' => 'public']);

        $data->name = $imageName;
        $data->href = 0;
        $data->type = $request->type;
        $data->typeName = $request->type;
        $data->client_id = $request->client_id;
        $data->doc_id = $request->doc_id;
        $data->status = 0;

        $data->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function show(Images $images)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function edit(Images $images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Images $images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Images $images)
    {
        if($request->file) {

            $my_id = $request->my_id;
            $data = Images::find($my_id);

            $imageName = $request->type . '_' . rand(1,999) .  "." . $request->file->getClientOriginalExtension();
//        $request->file->storeAs('uploads/attachment', $imageName, ['disk' => 'public']);
            $request->file->storeAs('uploads/client' . $request->client_id . '', $imageName, ['disk' => 'public']);

            $data->name = $imageName;
            $data->href = 0;
            $data->type = $request->type;
            $data->typeName = $request->type;
            $data->client_id = $request->client_id;
            $data->doc_id = $request->doc_id;
            $data->status = 0;

            $data->save();
        }
        else {
            $my_id = $request->my_id;
            $data = Images::find($my_id);
            if ($request->status == 1) { $data->status = 1; } else { $data->status = 2; }
            $data->save();
        }


        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function destroy(Images $images)
    {
        //
    }
}
