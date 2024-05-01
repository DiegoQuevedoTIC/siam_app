<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Solicitud extends Model
{

    public function tercero(): BelongsTo
    {
        return $this->belongsTo(Tercero::class);
    }

    public function documentos()
    {
        return $this->morphMany(Documento::class, 'llave_de_consulta');
    }

    public function documentoclase(): BelongsTo
    {
        return $this->belongsTo(Documentoclase::class);
    }

    public function solicitudes(): HasMany
    {
        return $this->hasMany(Solicitud::class);
    }


}
