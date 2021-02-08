<?php

namespace FuxionLogistic\Models;

use function foo\func;
use Illuminate\Database\Eloquent\Model;

class ReporteSoporteEmpresario extends Model
{
    protected $table = "reporte_soporte_empresario";

    protected $fillable = [
        'fecha','orden','accion','no_factura','usuario'
    ];
}