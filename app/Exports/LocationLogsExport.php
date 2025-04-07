<?php

namespace App\Exports;

use App\Models\LocationLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LocationLogsExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $startDate;
    protected $endDate;

    // El constructor acepta búsqueda, fecha de inicio y fecha de fin
    public function __construct($search = null, $startDate = null, $endDate = null)
    {
        $this->search = $search;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = LocationLog::with('suspect', 'device');

        // Filtro por búsqueda si está presente
        if ($this->search) {
            $query->whereHas('suspect', function($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('lastname', 'like', "%{$this->search}%");
            })->orWhereHas('device', function($q) {
                $q->where('serial', 'like', "%{$this->search}%");
            });
        }

        // Filtro por rango de fechas si ambas fechas están presentes
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }

        // Obtener la colección y mapearla para exportar solo los campos necesarios
        return $query->get()->map(function ($log) {
            return [
                'Suspect Name' => $log->suspect->name . ' ' . $log->suspect->lastname,
                'Device Serial' => $log->device->serial,
                'Date' => $log->date,
                'Locations' => json_encode($log->locations),
            ];
        });
    }

    // Definir los encabezados de la tabla exportada
    public function headings(): array
    {
        return [
            'Suspect Name',
            'Device Serial',
            'Date',
            'Locations',
        ];
    }
}
