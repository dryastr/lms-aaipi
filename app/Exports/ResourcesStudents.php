<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResourcesStudents implements FromCollection, WithHeadings, WithMapping
{
    protected $resource;

    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    public function collection(): Collection
    {
        return $this->resource->downloads()->with('user')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Tanggal Download',
        ];
    }

    public function map($download): array
    {
        return [
            $download->user->id,
            $download->user->full_name,
            $download->user->email,
            $download->date->format('Y-m-d H:i:s'),
        ];
    }
}
