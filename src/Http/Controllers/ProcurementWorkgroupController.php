<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementWorkgroup;
use Module\Procurement\Http\Resources\WorkgroupCollection;
use Module\Procurement\Http\Resources\WorkgroupShowResource;

class ProcurementWorkgroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', ProcurementWorkgroup::class);

        return new WorkgroupCollection(
            ProcurementWorkgroup::applyMode($request->trashed)
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
        Gate::authorize('create', ProcurementWorkgroup::class);

        $request->validate([]);

        return ProcurementWorkgroup::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkgroup $procurementWorkgroup
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementWorkgroup $procurementWorkgroup)
    {
        Gate::authorize('show', $procurementWorkgroup);

        return new WorkgroupShowResource($procurementWorkgroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementWorkgroup $procurementWorkgroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementWorkgroup $procurementWorkgroup)
    {
        Gate::authorize('update', $procurementWorkgroup);

        $request->validate([]);

        return ProcurementWorkgroup::updateRecord($request, $procurementWorkgroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkgroup $procurementWorkgroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementWorkgroup $procurementWorkgroup)
    {
        Gate::authorize('delete', $procurementWorkgroup);

        return ProcurementWorkgroup::deleteRecord($procurementWorkgroup);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkgroup $procurementWorkgroup
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementWorkgroup $procurementWorkgroup)
    {
        Gate::authorize('restore', $procurementWorkgroup);

        return ProcurementWorkgroup::restoreRecord($procurementWorkgroup);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkgroup $procurementWorkgroup
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementWorkgroup $procurementWorkgroup)
    {
        Gate::authorize('destroy', $procurementWorkgroup);

        return ProcurementWorkgroup::destroyRecord($procurementWorkgroup);
    }
}
