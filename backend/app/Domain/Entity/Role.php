<?php

namespace App\Domain\Entity;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public function createdByUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
