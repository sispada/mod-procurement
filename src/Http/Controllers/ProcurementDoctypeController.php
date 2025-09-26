<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementDoctype;
use Module\Procurement\Http\Resources\DoctypeCollection;
use Module\Procurement\Http\Resources\DoctypeShowResource;

class ProcurementDoctypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', ProcurementDoctype::class);

        return new DoctypeCollection(
            ProcurementDoctype::applyMode($request->mode)
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
        Gate::authorize('create', ProcurementDoctype::class);

        $request->validate([]);

        return ProcurementDoctype::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementDoctype $procurementDoctype
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementDoctype $procurementDoctype)
    {
        Gate::authorize('show', $procurementDoctype);

        return new DoctypeShowResource($procurementDoctype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementDoctype $procurementDoctype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementDoctype $procurementDoctype)
    {
        Gate::authorize('update', $procurementDoctype);

        $request->validate([]);

        return ProcurementDoctype::updateRecord($request, $procurementDoctype);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementDoctype $procurementDoctype
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementDoctype $procurementDoctype)
    {
        Gate::authorize('delete', $procurementDoctype);

        return ProcurementDoctype::deleteRecord($procurementDoctype);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementDoctype $procurementDoctype
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementDoctype $procurementDoctype)
    {
        Gate::authorize('restore', $procurementDoctype);

        return ProcurementDoctype::restoreRecord($procurementDoctype);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementDoctype $procurementDoctype
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementDoctype $procurementDoctype)
    {
        Gate::authorize('destroy', $procurementDoctype);

        return ProcurementDoctype::destroyRecord($procurementDoctype);
    }
}
