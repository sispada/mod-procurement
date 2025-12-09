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
            ProcurementAuction::forCurrentUser($request->user())
                ->applyMode($request->trashed)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy)
                ->paginate($request->itemsPerPage)
        );
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
     * Undocumented function
     *
     * @param Request $request
     * @param ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function qualified(Request $request, ProcurementAuction $procurementAuction)
    {
        Gate::authorize('qualified', $procurementAuction);

        $request->validate([]);

        return ProcurementAuction::qualifiedRecord($request, $procurementAuction);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function rejected(Request $request, ProcurementAuction $procurementAuction)
    {
        Gate::authorize('qualified', $procurementAuction);

        $request->validate([]);

        return ProcurementAuction::rejectedRecord($request, $procurementAuction);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function verified(Request $request, ProcurementAuction $procurementAuction)
    {
        Gate::authorize('verified', $procurementAuction);

        $request->validate([]);

        return ProcurementAuction::verifiedRecord($request, $procurementAuction);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function aborted(Request $request, ProcurementAuction $procurementAuction)
    {
        Gate::authorize('verified', $procurementAuction);

        $request->validate([]);

        return ProcurementAuction::abortedRecord($request, $procurementAuction);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function avaluated(Request $request, ProcurementAuction $procurementAuction)
    {
        Gate::authorize('avaluated', $procurementAuction);

        $request->validate([]);

        return ProcurementAuction::avaluatedRecord($request, $procurementAuction);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param ProcurementAuction $procurementAuction
     * @return \Illuminate\Http\Response
     */
    public function completed(Request $request, ProcurementAuction $procurementAuction)
    {
        Gate::authorize('completed', $procurementAuction);

        $request->validate([]);

        return ProcurementAuction::completedRecord($request, $procurementAuction);
    }
}
