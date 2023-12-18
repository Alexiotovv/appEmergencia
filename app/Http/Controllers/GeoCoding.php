<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class GeoCoding extends Controller
{
    public function getAddress($lat, $lng)
    {
        $loop = true;
        do {
            try {
                $response = Http::withHeaders([
                    'User-Agent' => 'AppEmergencia/1.0 (gparedes@regionloreto.gob.pe)'
                ])->timeout(10000)
                    ->get("https://nominatim.openstreetmap.org/reverse", [
                        'format' => 'jsonv2',
                        'lat' => $lat,
                        'lon' => $lng
                    ]);
                $loop = false; 
            } catch (\Exception $e) {
                continue; 
            }
        } while ($loop);

        $data = json_decode($response, true);
        if ($data) {
            return  $data;
        } else {
            $data  = '';
            return $data;
        }
    }
}
