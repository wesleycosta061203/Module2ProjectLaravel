<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SignatureController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), rules: [
            'drink' => 'required|string'
        ]);
        $params = $validator->fails() ? $validator->messages() : $validator->validated()['drink'];
        $user = auth()->user();

        $nome = $user->name;
        $document = $user->client->document;
        $status = $user->client->signatures->first()->status->name;
        return view('test', [
            'name' => $nome,
            'document' => $document,
            'status' => $status,
            'params' => $params
        ]);
    }
}