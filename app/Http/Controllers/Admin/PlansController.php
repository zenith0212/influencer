<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plans;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.plans.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Plans $plans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plans $plans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plans $plans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plans $plans)
    {
        //
    }
}
