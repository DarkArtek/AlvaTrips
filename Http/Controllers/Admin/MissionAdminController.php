<?php

namespace Modules\AlvaTrips\Http\Controllers\Admin;

use App\Contracts\Controller;
use Illuminate\Http\Request;

/**
 * Admin controller
 */
class MissionAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return view('alvatrips::admin.index');
    }

    /**
     * Form for creating a new resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        return view('alvatrips::admin.create');
    }

    /**
     * Store a new resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Show the edit form for the specified resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function edit(Request $request)
    {
        return view('alvatrips::admin.edit');
    }

    /**
     * Show the resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function show(Request $request)
    {
        return view('alvatrips::admin.show');
    }

    /**
     * Update the resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function remove(Request $request)
    {
        //
    }
}
