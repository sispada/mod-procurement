<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementWorkunit;
use Module\Procurement\Http\Resources\WorkunitCollection;
use Module\Procurement\Http\Resources\WorkunitShowResource;

class ProcurementWorkunitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', ProcurementWorkunit::class);

        return new WorkunitCollection(
            ProcurementWorkunit::applyMode($request->mode)
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
        Gate::authorize('create', ProcurementWorkunit::class);

        $request->validate([]);

        return ProcurementWorkunit::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkunit $procurementWorkunit
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementWorkunit $procurementWorkunit)
    {
        Gate::authorize('show', $procurementWorkunit);

        return new WorkunitShowResource($procurementWorkunit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementWorkunit $procurementWorkunit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementWorkunit $procurementWorkunit)
    {
        Gate::authorize('update', $procurementWorkunit);

        $request->validate([]);

        return ProcurementWorkunit::updateRecord($request, $procurementWorkunit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkunit $procurementWorkunit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementWorkunit $procurementWorkunit)
    {
        Gate::authorize('delete', $procurementWorkunit);

        return ProcurementWorkunit::deleteRecord($procurementWorkunit);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkunit $procurementWorkunit
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementWorkunit $procurementWorkunit)
    {
        Gate::authorize('restore', $procurementWorkunit);

        return ProcurementWorkunit::restoreRecord($procurementWorkunit);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkunit $procurementWorkunit
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementWorkunit $procurementWorkunit)
    {
        Gate::authorize('destroy', $procurementWorkunit);

        return ProcurementWorkunit::destroyRecord($procurementWorkunit);
    }
}
