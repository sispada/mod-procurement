<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementDocument;
use Module\Procurement\Http\Resources\DocumentCollection;
use Module\Procurement\Http\Resources\DocumentShowResource;

class ProcurementDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', ProcurementDocument::class);

        return new DocumentCollection(
            ProcurementDocument::applyMode($request->trashed)
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
        Gate::authorize('create', ProcurementDocument::class);

        $request->validate([]);

        return ProcurementDocument::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementDocument $procurementDocument
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementDocument $procurementDocument)
    {
        Gate::authorize('show', $procurementDocument);

        return new DocumentShowResource($procurementDocument);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementDocument $procurementDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementDocument $procurementDocument)
    {
        Gate::authorize('update', $procurementDocument);

        $request->validate([]);

        return ProcurementDocument::updateRecord($request, $procurementDocument);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementDocument $procurementDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementDocument $procurementDocument)
    {
        Gate::authorize('delete', $procurementDocument);

        return ProcurementDocument::deleteRecord($procurementDocument);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementDocument $procurementDocument
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementDocument $procurementDocument)
    {
        Gate::authorize('restore', $procurementDocument);

        return ProcurementDocument::restoreRecord($procurementDocument);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementDocument $procurementDocument
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementDocument $procurementDocument)
    {
        Gate::authorize('destroy', $procurementDocument);

        return ProcurementDocument::destroyRecord($procurementDocument);
    }
}
