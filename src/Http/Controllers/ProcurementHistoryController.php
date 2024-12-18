<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementHistory;
use Module\Procurement\Http\Resources\HistoryCollection;
use Module\Procurement\Http\Resources\HistoryShowResource;

class ProcurementHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', ProcurementHistory::class);

        return new HistoryCollection(
            ProcurementHistory::applyMode($request->mode)
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
        Gate::authorize('create', ProcurementHistory::class);

        $request->validate([]);

        return ProcurementHistory::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementHistory $procurementHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementHistory $procurementHistory)
    {
        Gate::authorize('show', $procurementHistory);

        return new HistoryShowResource($procurementHistory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementHistory $procurementHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementHistory $procurementHistory)
    {
        Gate::authorize('update', $procurementHistory);

        $request->validate([]);

        return ProcurementHistory::updateRecord($request, $procurementHistory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementHistory $procurementHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementHistory $procurementHistory)
    {
        Gate::authorize('delete', $procurementHistory);

        return ProcurementHistory::deleteRecord($procurementHistory);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementHistory $procurementHistory
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementHistory $procurementHistory)
    {
        Gate::authorize('restore', $procurementHistory);

        return ProcurementHistory::restoreRecord($procurementHistory);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementHistory $procurementHistory
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementHistory $procurementHistory)
    {
        Gate::authorize('destroy', $procurementHistory);

        return ProcurementHistory::destroyRecord($procurementHistory);
    }
}
