<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementAuction;
use Module\Procurement\Http\Resources\AuctionCollection;
use Module\Procurement\Http\Resources\AuctionShowResource;

class ProcurementAuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', ProcurementAuction::class);

        return new AuctionCollection(
            ProcurementAuction::applyMode($request->mode)
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
        Gate::authorize('create', ProcurementAuction::class);

        $request->validate([]);

        return ProcurementAuction::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementAuction $procurementAuction)
    {
        Gate::authorize('show', $procurementAuction);

        return new AuctionShowResource($procurementAuction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementAuction $procurementAuction)
    {
        Gate::authorize('update', $procurementAuction);

        $request->validate([]);

        return ProcurementAuction::updateRecord($request, $procurementAuction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementAuction $procurementAuction)
    {
        Gate::authorize('delete', $procurementAuction);

        return ProcurementAuction::deleteRecord($procurementAuction);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementAuction $procurementAuction)
    {
        Gate::authorize('restore', $procurementAuction);

        return ProcurementAuction::restoreRecord($procurementAuction);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementAuction $procurementAuction)
    {
        Gate::authorize('destroy', $procurementAuction);

        return ProcurementAuction::destroyRecord($procurementAuction);
    }
}
