<?php

namespace App\Http\Controllers\MovieController;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api'); //Exceptuamos las funciones login
    }

    /**
     * Display a listing of the resource.
     */
    public function index($id_page, Request $request)
    {
        $headers = $request->header();
        $tokenAcceso = $headers['token'][0];
        $client = new Client();
        try {
            $response = $client->get('https://api.themoviedb.org/3/discover/movie?page=' . $id_page, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $tokenAcceso,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
            $responseData = json_decode($response->getBody(), true);
            $data = array_slice($responseData['results'], 0, 15);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name, Request $request)
    {
        $headers = $request->header();
        $tokenAcceso = $headers['token'][0];
        $client = new Client();
        try {
            $response = $client->get('https://api.themoviedb.org/3/search/keyword?query=' . $name . '&page=1', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $tokenAcceso,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
            $jsonResponse = json_decode($response->getBody()->getContents(), true);
            return response()->json($jsonResponse);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function markFavorite(int $account_id, Request $request, int $movie_id)
    {
        $headers = $request->header();
        $tokenAcceso = $headers['token'][0];
        $client = new Client();

        try {
            $response = $client->post('https://api.themoviedb.org/3/account/' . $account_id . '/favorite', [
                'json' => [
                    'media_type' => 'movie',
                    'media_id' => $movie_id,
                    'favorite' => true,
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $tokenAcceso,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
            $jsonResponse = json_decode($response->getBody()->getContents(), true);
            return response()->json($jsonResponse);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function getFavorites(int $account_id, Request $request)
    {
        $headers = $request->header();
        $tokenAcceso = $headers['token'][0];
        $client = new Client();
        try {
            $response = $client->get('https://api.themoviedb.org/3/account/' . $account_id . '/favorite/movies?page=1&sort_by=created_at.asc', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $tokenAcceso,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
            $jsonResponse = json_decode($response->getBody()->getContents(), true);
            return response()->json($jsonResponse);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
