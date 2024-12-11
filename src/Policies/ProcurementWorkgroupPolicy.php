<?php

namespace Module\Procurement\Policies;

use Module\System\Models\SystemUser;
use Module\Procurement\Models\ProcurementWorkgroup;
use Illuminate\Auth\Access\Response;

class ProcurementWorkgroupPolicy
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
        return $user->hasPermission('view-procurement-workgroup');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, ProcurementWorkgroup $procurementWorkgroup): bool
    {
        return $user->hasPermission('show-procurement-workgroup');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-procurement-workgroup');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, ProcurementWorkgroup $procurementWorkgroup): bool
    {
        return $user->hasPermission('update-procurement-workgroup');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, ProcurementWorkgroup $procurementWorkgroup): bool
    {
        return $user->hasPermission('delete-procurement-workgroup');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, ProcurementWorkgroup $procurementWorkgroup): bool
    {
        return $user->hasPermission('restore-procurement-workgroup');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, ProcurementWorkgroup $procurementWorkgroup): bool
    {
        return $user->hasPermission('destroy-procurement-workgroup');
    }
}
