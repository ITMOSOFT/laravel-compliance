<?php

namespace ITMOSOFT\Compliance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use InvalidArgumentException;

class ComplianceRecord extends Model
{
    protected $table = 'compliance_records';
    protected $guarded = [];

    protected function casts(): array
    {
        return ['effective_at' => 'date', 'expires_at' => 'date', 'reviewed_at' => 'datetime', 'metadata' => 'array',];
    }


    public function subject(): MorphTo { return $this->morphTo(); }
    public function reviewer(): MorphTo { return $this->morphTo(); }



    public function submit(): bool
    {
        if (! in_array($this->status, ['pending', 'rejected'], true)) return false;
        $this->status = 'submitted';
        $this->reviewed_at = null;
        $this->decision_notes = null;
        return $this->save();
    }

    public function approve(?Model $reviewer = null, ?string $notes = null): bool
    {
        if ($this->status !== 'submitted') return false;
        $this->status = 'approved';
        $this->reviewed_at = now();
        $this->decision_notes = $notes;
        if ($reviewer) {
            $this->reviewer_type = $reviewer->getMorphClass();
            $this->reviewer_id = $reviewer->getKey();
        }
        return $this->save();
    }

    public function reject(?Model $reviewer = null, ?string $notes = null): bool
    {
        if ($this->status !== 'submitted') return false;
        $this->status = 'rejected';
        $this->reviewed_at = now();
        $this->decision_notes = $notes;
        if ($reviewer) {
            $this->reviewer_type = $reviewer->getMorphClass();
            $this->reviewer_id = $reviewer->getKey();
        }
        return $this->save();
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

}
