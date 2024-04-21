<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
//    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Exam\Database\factories\CertificateFactory::new();
    }
}
