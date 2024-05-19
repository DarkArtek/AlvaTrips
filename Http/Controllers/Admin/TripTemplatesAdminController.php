<?php

namespace Modules\AlvaTrips\Http\Controllers\Admin;

use App\Contracts\Controller;
use Illuminate\Http\Request;
use Modules\AlvaTrips\Models\TripTemplate;

/**
 * Admin controller
 */
class TripTemplatesAdminController extends Controller
{
    /**
     *  Display resource listing.
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
     * Show the form for creating a new resource.
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
     * Store a resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function edit(Request $request, TripTemplate $id)
    {
        return view('alvatrips::admin.edit');
    }

    /**
     * Show the specified resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function show(Request $request, TripTemplate $id)
    {
        return view('alvatrips::admin.show');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     */
    public function update(Request $request, TripTemplate $id)
    {

    }

    /**
     * Remove the resource from the storage
     *
     * @param Request $request
     */
    public function destroy(Request $request, TripTemplate $id)
    {
        $id->delete();
    }
}
