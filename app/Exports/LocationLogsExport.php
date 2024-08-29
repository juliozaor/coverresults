<?php

namespace App\Exports;

use App\Models\LocationLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LocationLogsExport implements FromCollection, WithHeadings
{
    protected $search;
    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {

        $query = LocationLog::with('suspect', 'device');

        if ($this->search) {
            $query->whereHas('suspect', function($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('lastname', 'like', "%{$this->search}%");
            })->orWhereHas('device', function($q) {
                $q->where('serial', 'like', "%{$this->search}%");
            });
        }

        return $query->get()->map(function ($log) {
            return [
                'Suspect Name' => $log->suspect->name . ' ' . $log->suspect->lastname,
                'Device Serial' => $log->device->serial,
                'Date' => $log->date,
                'Locations' => json_encode($log->locations),
            ];
        });

      
    } 

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
