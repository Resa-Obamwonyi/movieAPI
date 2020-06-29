<?php

namespace App\Http\Controllers;

use App\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MovieController extends Controller
{
    public function getOne($id){
    	$data = Movie::where('id', $id)->first();
        return $this->formatApiResponse('Movie data successfully generated.', 200, $data);
    }

    public function getAll(){
    	$data = Movie::all;
    	return $this->formatApiResponse('All Movies successfully generated.', 200, $data);
    }

    public function formatApiResponse($message, $status, $data = null, $errors = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ], $status);
    }

    public function save(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required | string',
                'genre' => 'required | string',
                'release_date' => 'required | string',
                'producer' => 'required | string',
                'synopsis' => 'required | string'
            ]);
            if ($validator->fails()) {
                return $this->formatApiResponse('Validation error occured', 422, null, $validator->errors());
            }
            $data = Movie::create([
                'title' => $request->title,
                'genre' => $request->genre,
                'release_date' => $request->release_date,
                'producer' => $request->producer,
                'synopsis' => $request->synopsis
            ]);
            return $this->formatApiResponse('New Movie Created Successfully', 201, $data);
        } catch (Exception $e) {
            return $this->formatApiResponse('Error while creating Movie', 500, null, $e);
        }
    }

}
