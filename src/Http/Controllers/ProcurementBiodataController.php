<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementBiodata;
use Module\Procurement\Http\Resources\BiodataCollection;
use Module\Procurement\Http\Resources\BiodataShowResource;

class ProcurementBiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', ProcurementBiodata::class);

        return new BiodataCollection(
            ProcurementBiodata::applyMode($request->trashed)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy)
                ->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create', ProcurementBiodata::class);

        $request->validate([]);

        return ProcurementBiodata::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementBiodata $procurementBiodata
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementBiodata $procurementBiodata)
    {
        Gate::authorize('show', $procurementBiodata);

        return new BiodataShowResource($procurementBiodata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementBiodata $procurementBiodata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementBiodata $procurementBiodata)
    {
        Gate::authorize('update', $procurementBiodata);

        $request->validate([]);

        return ProcurementBiodata::updateRecord($request, $procurementBiodata);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementBiodata $procurementBiodata
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementBiodata $procurementBiodata)
    {
        Gate::authorize('delete', $procurementBiodata);

        return ProcurementBiodata::deleteRecord($procurementBiodata);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementBiodata $procurementBiodata
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementBiodata $procurementBiodata)
    {
        Gate::authorize('restore', $procurementBiodata);

        return ProcurementBiodata::restoreRecord($procurementBiodata);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementBiodata $procurementBiodata
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementBiodata $procurementBiodata)
    {
        Gate::authorize('destroy', $procurementBiodata);

        return ProcurementBiodata::destroyRecord($procurementBiodata);
    }
}
