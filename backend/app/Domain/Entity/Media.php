<?php

namespace App\Domain\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media  extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'media';
    protected $guarded = [];

    public function uploadedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'id');
    }
    public function model()
    {
        return $this->morphTo();
    }
}