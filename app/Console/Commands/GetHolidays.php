<?php

namespace App\Console\Commands;

use App\Models\Holiday;
use Illuminate\Console\Command;

class GetHolidays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'country:holidays {country-code} {year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets holidays by country-code and year';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'https://kayaposoft.com/enrico/json/v2.0?action=getHolidaysForYear&year='.
            $this->argument('year').
            '&country='.$this->argument('country-code');

        $response = json_decode(file_get_contents($url),true);

        foreach($response as $holiday ) {
            Holiday::firstOrCreate([
                'date' => date('Y/m/d', strtotime($holiday["date"]["year"] ."/"
                    . $holiday["date"]["month"] ."/". $holiday["date"]["day"])),
                'day_of_week' => $holiday["date"]["dayOfWeek"],
                'name' => $holiday["name"][0]["text"],
                'holiday_type' => $holiday["holidayType"]
            ]);
        }

        return 0;
    }
}
