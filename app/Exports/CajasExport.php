<?php

namespace App\Exports;
use App\Models\Caja;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;



class CajasExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($ingresos = null, $headings)
    {
        $this->products = $ingresos;
        $this->headings=$headings;
        
    }
    public function collection()
    {
        return $this->products;
    }
    public function headings(): array
    {
        return $this->headings;
    }


   
}
