<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Documentoscontable extends Model
{
    use HasFactory;

        public function documentotipos(): HasMany
    {
        return $this->hasMany(Documentotipo::class);
    }

        public function documentoclases(): HasMany
    {
        return $this->hasMany(Documentoclase::class);
    }
}
