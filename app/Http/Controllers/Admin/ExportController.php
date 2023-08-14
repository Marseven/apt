<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MembersExport;
use App\Http\Controllers\BasicController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ExportController extends BasicController
{

    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    //
    public function index(Request $request)
    {
        $day = Carbon::now();
        return $this->excel->download(new MembersExport(), 'Partisans -' . $day . '.xlsx');
    }
}
