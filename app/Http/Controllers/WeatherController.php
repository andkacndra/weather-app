<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather');
    }

    public function getWeather(Request $request)
    {
        $kota = $request->kota;

        // Ambil koordinat kota
        $geo = Http::get("https://geocoding-api.open-meteo.com/v1/search?name=$kota");

        if (!$geo->successful() || empty($geo['results'])) {
            return back()->with('error', 'Kota tidak ditemukan');
        }

        $lat = $geo['results'][0]['latitude'];
        $lon = $geo['results'][0]['longitude'];
        $namaKota = $geo['results'][0]['name'];

        // Ambil data cuaca
        $weather = Http::get("https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current_weather=true");

        if (!$weather->successful()) {
            return back()->with('error', 'Gagal mengambil data cuaca');
        }

        $cuaca = $weather['current_weather'];

        return view('weather', [
            'kota' => $namaKota,
            'cuaca' => $cuaca
        ]);
    }
}
