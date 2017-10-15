<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportDistricts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'district:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import districts data from storage/districts.json';

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
     * @return mixed
     */
    public function handle()
    {
        $json = file_get_contents(storage_path('districts.json'));
        $data = json_decode($json);

        foreach($data->eldistricts as $district)  {
            $entity = new \App\Models\District;
            $entity->name = 'Округ №' . $district->num;
            $entity->polygon = $district->geom;   
            if ($entity->save()) {
                $this->info("Create {$entity->name}");
            } else {
                $this->error('Cant create district');
                return;
            }    
        }
    }
}
