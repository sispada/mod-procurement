<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementOfficer;
use Module\Procurement\Models\ProcurementWorkunit;
use Module\Procurement\Http\Resources\OfficerCollection;
use Module\Procurement\Http\Resources\OfficerShowResource;

class ProcurementOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkunit $procurementWorkunit
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProcurementWorkunit $procurementWorkunit)
    {
        Gate::authorize('view', ProcurementOfficer::class);

        return new OfficerCollection(
            $procurementWorkunit
                ->officers()
                ->applyMode($request->mode)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy, $request->sortDesc)
                ->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementWorkunit $procurementWorkunit
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProcurementWorkunit $procurementWorkunit)
    {
        Gate::authorize('create', ProcurementOfficer::class);

        $request->validate([]);

        return ProcurementOfficer::storeRecord($request, $procurementWorkunit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkunit $procurementWorkunit
     * @param  \Module\Procurement\Models\ProcurementOfficer $procurementOfficer
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementWorkunit $procurementWorkunit, ProcurementOfficer $procurementOfficer)
    {
        Gate::authorize('show', $procurementOfficer);

        return new OfficerShowResource($procurementOfficer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementWorkunit $procurementWorkunit
     * @param  \Module\Procurement\Models\ProcurementOfficer $procurementOfficer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementWorkunit $procurementWorkunit, ProcurementOfficer $procurementOfficer)
    {
        Gate::authorize('update', $procurementOfficer);

        $request->validate([]);

        return ProcurementOfficer::updateRecord($request, $procurementOfficer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkunit $procurementWorkunit
     * @param  \Module\Procurement\Models\ProcurementOfficer $procurementOfficer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementWorkunit $procurementWorkunit, ProcurementOfficer $procurementOfficer)
    {
        Gate::authorize('delete', $procurementOfficer);

        return ProcurementOfficer::deleteRecord($procurementOfficer);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementOfficer $procurementOfficer
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementWorkunit $procurementWorkunit, ProcurementOfficer $procurementOfficer)
    {
        Gate::authorize('restore', $procurementOfficer);

        return ProcurementOfficer::restoreRecord($procurementOfficer);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementOfficer $procurementOfficer
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementWorkunit $procurementWorkunit, ProcurementOfficer $procurementOfficer)
    {
        Gate::authorize('destroy', $procurementOfficer);

        return ProcurementOfficer::destroyRecord($procurementOfficer);
    }
}