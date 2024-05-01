<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
       public function documentoclase()
    {
        return $this->belongsTo(Documentoclase::class);
    }

    public function documentotipo()
    {
        return $this->belongsTo(Documentotipo::class);
    }

    public function llaveDeConsulta()
    {
        return $this->belongsTo(Solicitud::class);
    }

        public function llaveDeConsultaContabilidad()
    {
        return $this->belongsTo(Comprobante::class);
    }
}

