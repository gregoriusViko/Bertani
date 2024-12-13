<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportDetail extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = 'report_time';
    protected $guarded = ['id', 'report_time'];
    protected $with = ['report', 'responder'];
    public function responder(): BelongsTo{
        return $this->belongsTo(Admin::class);
    }
    public function report(): BelongsTo{
        return $this->belongsTo(Report::class);
    }
}
