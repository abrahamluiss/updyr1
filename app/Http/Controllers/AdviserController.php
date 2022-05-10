<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdviserRequest;
use App\Http\Requests\UpdateAdviserRequest;
use App\Models\Adviser;

class AdviserController extends Controller
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
     * @param  \App\Http\Requests\StoreAdviserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdviserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function show(Adviser $adviser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function edit(Adviser $adviser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdviserRequest  $request
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdviserRequest $request, Adviser $adviser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adviser $adviser)
    {
        //
    }
}
