<?php

namespace App\Console\Commands;

use App\AutoCatalog;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class autodrive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autodrive:xml {repository=foo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run XML parser';

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
        if (!empty($this->argument('repository'))){
            $xmlFile = public_path($this->argument('repository') . '/data.xml');
        }else{
            $xmlFile = public_path('data.xml');
        }

        $xmlObject = simplexml_load_file($xmlFile);
        $jsonFormatData = json_encode($xmlObject);
        $result = json_decode($jsonFormatData, true);
        

        if (count($result['offers']) > 0) {

            $dataArray = array();

            foreach ($result['offers']['offer'] as $index => $data) {

                $auto = AutoCatalog::find($data['id']);

                if (!empty($auto)){

                    /*Если есть запись, обновляем.*/
                    $catalog = AutoCatalog::find($data['id']);

                }else{

                    /*Если нет записи, добавляем.*/
                    $catalog = new AutoCatalog;

                }

                $catalog->id = $data['id'];
                $catalog->mark = $data['mark'] == [] ? null : $data['mark'];
                $catalog->model = $data['model'] == [] ? null : $data['model'];
                $catalog->generation = $data['generation'] == [] ? null : $data['generation'];
                $catalog->year = $data['year'] == [] ? null : $data['year'];
                $catalog->run = $data['run'] == [] ? null : $data['run'];
                $catalog->color = $data['color'] == [] ? null : $data['color'];
                $catalog->body_type = $data['body-type'] == [] ? null : $data['body-type'];
                $catalog->engine_type = $data['engine-type'] == [] ? null : $data['engine-type'];
                $catalog->transmission = $data['transmission'] == [] ? null : $data['transmission'];
                $catalog->gear_type = $data['gear-type'] == [] ? null : $data['gear-type'];
                $catalog->generation_id = $data['generation_id'] == [] ? null : $data['generation_id'];
                $catalog->save();

                /*Собираем id XML данных в массив*/
                $dataArray[] = [
                    "id" => $data['id'],
                ];

            }

            /*удаляем записи из базы, которых нет в XML*/
            AutoCatalog::whereNotIn('id',$dataArray)->delete();

        }
    }
}
