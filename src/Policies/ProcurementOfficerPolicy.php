<?php

namespace Module\Procurement\Policies;

use Module\System\Models\SystemUser;
use Module\Procurement\Models\ProcurementOfficer;
use Illuminate\Auth\Access\Response;

class ProcurementOfficerPolicy
{
    /**
    * Perform pre-authorization checks.
    */
    public function before(SystemUser $user, string $ability): bool|null
    {
        if ($user->hasLicenseAs('procurement-superadmin')) {
            return true;
        }
    
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function view(SystemUser $user): bool
    {
        return $user->hasPermission('view-procurement-officer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, ProcurementOfficer $procurementOfficer): bool
    {
        return $user->hasPermission('show-procurement-officer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-procurement-officer');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, ProcurementOfficer $procurementOfficer): bool
    {
        return $user->hasPermission('update-procurement-officer');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, ProcurementOfficer $procurementOfficer): bool
    {
        return $user->hasPermission('delete-procurement-officer');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, ProcurementOfficer $procurementOfficer): bool
    {
        return $user->hasPermission('restore-procurement-officer');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, ProcurementOfficer $procurementOfficer): bool
    {
        return $user->hasPermission('destroy-procurement-officer');
    }
}
