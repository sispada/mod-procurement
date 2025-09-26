<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementMethod;
use Module\Procurement\Http\Resources\MethodCollection;
use Module\Procurement\Http\Resources\MethodShowResource;

class ProcurementMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', ProcurementMethod::class);

        return new MethodCollection(
            ProcurementMethod::applyMode($request->mode)
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
        Gate::authorize('create', ProcurementMethod::class);

        $request->validate([]);

        return ProcurementMethod::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementMethod $procurementMethod
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementMethod $procurementMethod)
    {
        Gate::authorize('show', $procurementMethod);

        return new MethodShowResource($procurementMethod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementMethod $procurementMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementMethod $procurementMethod)
    {
        Gate::authorize('update', $procurementMethod);

        $request->validate([]);

        return ProcurementMethod::updateRecord($request, $procurementMethod);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementMethod $procurementMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementMethod $procurementMethod)
    {
        Gate::authorize('delete', $procurementMethod);

        return ProcurementMethod::deleteRecord($procurementMethod);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementMethod $procurementMethod
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementMethod $procurementMethod)
    {
        Gate::authorize('restore', $procurementMethod);

        return ProcurementMethod::restoreRecord($procurementMethod);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementMethod $procurementMethod
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementMethod $procurementMethod)
    {
        Gate::authorize('destroy', $procurementMethod);

        return ProcurementMethod::destroyRecord($procurementMethod);
    }
}
