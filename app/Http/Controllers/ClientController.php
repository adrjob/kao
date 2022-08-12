<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Documents;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $clients = Client::where('code', 0)->get();
        return view("client.index", compact('clients'));
    }

    public function index2()
    {
        $clients = Client::where('code', 1)->get();
        return view("client.index", compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = new Client;

        $data->name = $request->main;
        $data->spouse = $request->spouse;
        $data->child1 = $request->child1;
        $data->child2 = $request->child2;
        $data->child3 = $request->child3;
        $data->child4 = $request->child4;
        $data->child5 = $request->child5;
        $data->child6 = $request->child6;
        $data->sub_id = $request->sub_id;
        $data->status = 0;
        $data->code = $request->code;

        $data->save();

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return Response
     */
    public function show($id)
    {
//        $documents = Documents::with('images')->get();


        $documents = Documents::with(['images' => function ($query) use ($id) {
            $query->where('client_id', 'like', $id);
        }])->get();




        $images = Images::where('client_id', $id)->get();
        $clients = Client::where('id', $id)->first();
        return view('client.show', compact('clients', 'documents', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return Response
     */
    public function edit(Client $client)
    {
        $clients = Client::where('code', 1)->get();
        return view("client.edit", compact('clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Client  $client
     * @return Response
     */
    public function update(Request $request, Client $client)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
