<?php

namespace App\Http\Controllers;

use App\AutoCatalog;
use Illuminate\Http\Request;

class AutoCatalogController extends Controller
{
    public function index()
    {
        $xml = AutoCatalog::get();
        return view('welcome', compact('xml'));
    }
    public function upload(Request $request)
    {

        $xmlFile = $request->file;

        $xmlObject = simplexml_load_file($xmlFile);
        $jsonFormatData = json_encode($xmlObject);
        $result = json_decode($jsonFormatData, true);

        //dd($result);

        if (count($result['offers']) > 0) {

            $dataArray = array();

            foreach ($result['offers']['offer'] as $index => $data) {

                    /*Если есть запись, обновляем.*/
                    $catalog = AutoCatalog::find($data['id']);

                if (!empty($catalog)){
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

                }else{

                    /*Если нет записи, добавляем.*/
                    $catalog = new AutoCatalog;
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
                }

                /*Собираем id XML данных в массив*/
                $dataArray[] = [
                    "id" => $data['id'],
                ];

            }

            /*удаляем записи из базы, которых нет в XML*/
            AutoCatalog::whereNotIn('id',$dataArray)->delete();

            return redirect()->back()->with('message', 'Запись успешно добавлена!');

        }

    }

}
