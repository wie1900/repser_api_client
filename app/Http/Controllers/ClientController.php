<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use App\Custom\ApiGuard;

class ClientController extends Controller
{
    public function index()
    {
        return view('/start');
    }

    public function getGlossary(Request $request)
    {
        $apiGuard = new ApiGuard('reps');
        $response = Http::withToken($apiGuard->getKey())->post(
                $apiGuard->getEndpoint(),
                [
                    'source' => $request->source,
                    'glossary' => $request->glossary
                ]);

        return ['glossary' => json_decode($response)->glossary];
    }

    public function getFile(Request $request)
    {

        if(strlen($request->glossarfile) > 0){
            $apiGuard = new ApiGuard('files');
            $api_response = Http::withToken($apiGuard->getKey())->post(
                    $apiGuard->getEndpoint(),
                    [
                        'glossarfile' => $request->glossarfile,
                        'filetype' => $request->filetype
                    ]);
    
            $fileName = "Glossary.".$request->filetype;
    
            $response = response($api_response, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Content-Disposition' => 'attachment; filename='.$fileName,
            ]);    
        }else{
            return redirect('/');
        }

        return $response;
    }

}
