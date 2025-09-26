<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementWorkbio;
use Module\Procurement\Http\Resources\WorkbioCollection;
use Module\Procurement\Http\Resources\WorkbioShowResource;

class ProcurementWorkbioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', ProcurementWorkbio::class);

        return new WorkbioCollection(
            ProcurementWorkbio::applyMode($request->mode)
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
        Gate::authorize('create', ProcurementWorkbio::class);

        $request->validate([]);

        return ProcurementWorkbio::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkbio $procurementWorkbio
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementWorkbio $procurementWorkbio)
    {
        Gate::authorize('show', $procurementWorkbio);

        return new WorkbioShowResource($procurementWorkbio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementWorkbio $procurementWorkbio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementWorkbio $procurementWorkbio)
    {
        Gate::authorize('update', $procurementWorkbio);

        $request->validate([]);

        return ProcurementWorkbio::updateRecord($request, $procurementWorkbio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkbio $procurementWorkbio
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementWorkbio $procurementWorkbio)
    {
        Gate::authorize('delete', $procurementWorkbio);

        return ProcurementWorkbio::deleteRecord($procurementWorkbio);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkbio $procurementWorkbio
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementWorkbio $procurementWorkbio)
    {
        Gate::authorize('restore', $procurementWorkbio);

        return ProcurementWorkbio::restoreRecord($procurementWorkbio);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkbio $procurementWorkbio
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementWorkbio $procurementWorkbio)
    {
        Gate::authorize('destroy', $procurementWorkbio);

        return ProcurementWorkbio::destroyRecord($procurementWorkbio);
    }
}
