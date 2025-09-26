<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Procurement\Models\ProcurementMember;
use Module\Procurement\Models\ProcurementWorkgroup;
use Module\Procurement\Http\Resources\MemberCollection;
use Module\Procurement\Http\Resources\MemberShowResource;

class ProcurementMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkgroup $procurementWorkgroup
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProcurementWorkgroup $procurementWorkgroup)
    {
        Gate::authorize('view', ProcurementMember::class);

        return new MemberCollection(
            $procurementWorkgroup
                ->members()
                ->with(['biodata'])
                ->applyMode($request->trashed)
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
     * @param  \Module\Procurement\Models\ProcurementWorkgroup $procurementWorkgroup
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProcurementWorkgroup $procurementWorkgroup)
    {
        Gate::authorize('create', ProcurementMember::class);

        $request->validate([]);

        return ProcurementMember::storeRecord($request, $procurementWorkgroup);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkgroup $procurementWorkgroup
     * @param  \Module\Procurement\Models\ProcurementMember $procurementMember
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementWorkgroup $procurementWorkgroup, ProcurementMember $procurementMember)
    {
        Gate::authorize('show', $procurementMember);

        return new MemberShowResource($procurementMember);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Procurement\Models\ProcurementWorkgroup $procurementWorkgroup
     * @param  \Module\Procurement\Models\ProcurementMember $procurementMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementWorkgroup $procurementWorkgroup, ProcurementMember $procurementMember)
    {
        Gate::authorize('update', $procurementMember);

        $request->validate([]);

        return ProcurementMember::updateRecord($request, $procurementMember);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Procurement\Models\ProcurementWorkgroup $procurementWorkgroup
     * @param  \Module\Procurement\Models\ProcurementMember $procurementMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementWorkgroup $procurementWorkgroup, ProcurementMember $procurementMember)
    {
        Gate::authorize('delete', $procurementMember);

        return ProcurementMember::deleteRecord($procurementMember);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementMember $procurementMember
     * @return \Illuminate\Http\Response
     */
    public function restore(ProcurementWorkgroup $procurementWorkgroup, ProcurementMember $procurementMember)
    {
        Gate::authorize('restore', $procurementMember);

        return ProcurementMember::restoreRecord($procurementMember);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Procurement\Models\ProcurementMember $procurementMember
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(ProcurementWorkgroup $procurementWorkgroup, ProcurementMember $procurementMember)
    {
        Gate::authorize('destroy', $procurementMember);

        return ProcurementMember::destroyRecord($procurementMember);
    }
}
