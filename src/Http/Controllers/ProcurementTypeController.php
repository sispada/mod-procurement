<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementType;
use Module\Procurement\Http\Resources\TypeCollection;
use Module\Procurement\Http\Resources\TypeShowResource;

class ProcurementTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', ProcurementType::class);

        return new TypeCollection(
            ProcurementType::applyMode($request->mode)
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
        Gate::authorize('create', ProcurementType::class);

        $request->validate([]);

        return ProcurementType::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementType $procurementType
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementType $procurementType)
    {
        Gate::authorize('show', $procurementType);

        return new TypeShowResource($procurementType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementType $procurementType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementType $procurementType)
    {
        Gate::authorize('update', $procurementType);

        $request->validate([]);

        return ProcurementType::updateRecord($request, $procurementType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementType $procurementType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementType $procurementType)
    {
        Gate::authorize('delete', $procurementType);

        return ProcurementType::deleteRecord($procurementType);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementType $procurementType
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementType $procurementType)
    {
        Gate::authorize('restore', $procurementType);

        return ProcurementType::restoreRecord($procurementType);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementType $procurementType
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementType $procurementType)
    {
        Gate::authorize('destroy', $procurementType);

        return ProcurementType::destroyRecord($procurementType);
    }
}
