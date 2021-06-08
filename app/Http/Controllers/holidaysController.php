<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class holidaysController extends Controller
{
    public function index(){
        //get holiday list for current year
        $holidays = $this->get_data();
        //get unique years for dropdownlist
        $years = Holiday::pluck('date')->map(function ($year) {
            return date('Y', strtotime($year));
        })->unique();

        return view('holidays', compact('holidays', 'years'));
    }

    public function get_public_holidays(Request $request){
        return $this->get_data($request->year)->toJson();
    }

    public function download_document(Request $request){
        $data['holidays'] = $this->get_data($request->year);

        view()->share('print.holidays_template', $data);
        $pdf = PDF::loadView('print.holidays_template', $data)
            ->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download($request->year . '_Holidays.pdf');
    }

    private function get_data($year = null){
        //if not given use current year
        $year = $year ?? Carbon::now()->year;
        //prepare filter dates
        $start_filter_date = Carbon::createFromFormat('d/m/Y H:i:s', '01/01/' . $year . ' 00:00:00');
        $end_filter_date = Carbon::createFromFormat('d/m/Y H:i:s', '31/12/' . $year . ' 23:59:59');

        return Holiday::whereBetween('date', [
            $start_filter_date,
            $end_filter_date])->get();
    }
}
