<?php

namespace App\Policies;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContractPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view lists
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Contract $contract): bool
    {
        return true; // All authenticated users can view a specific contract
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create contracts
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contract $contract): bool
    {
        // Admin can always update
        if ($user->role === 'admin') {
            return true;
        }

        // Legal and Marketing can update if the contract is new and pending approval
        if (in_array($user->role, ['legal', 'marketing'])) {
            // A contract is 'Pending' if it's a new contract and any of the required approvals are null
            $isPending = $contract->is_new_contract && (
                is_null($contract->admin_approved_at) ||
                is_null($contract->legal_approved_at) ||
                is_null($contract->marketing_approved_at)
            );

            return $isPending;
        }

        // Other roles cannot update
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contract $contract): bool
    {
        return $user->role === 'admin'; // Only admin can delete
    }

    /**
     * Determine whether the user can approve the model.
     */
    public function approve(User $user, Contract $contract): bool
    {
        return in_array($user->role, ['admin', 'legal', 'marketing']); // Admin, Legal, Marketing can approve
    }
}