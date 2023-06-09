<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoapResponse;

class SoapController extends Controller
{
    public function getConvertTemperature(Request $request)
    {
        // Create a new SOAP wrapper instance
        $soapClient = new \SoapClient('https://www.w3schools.com/xml/tempconvert.asmx?WSDL');

        // Call the SOAP method
        $response = $soapClient->CelsiusToFahrenheit([
            'Celsius' => $request->input('celsius'),
        ]);

        // Extract the Fahrenheit value from the SOAP response
        $fahrenheit = $response->CelsiusToFahrenheitResult;

        // Return the SOAP response
        return response()->json([
            'fahrenheit' => $fahrenheit,
        ]);
    }

    /**
     * Handle the SOAP POST request.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postConvertTemperature(Request $request)
    {
        // Create a new SOAP wrapper instance
        $wsdl = 'https://www.w3schools.com/xml/tempconvert.asmx?WSDL';
        $soapClient = new \SoapClient($wsdl, ['trace' => true]);

        // Call the SOAP method
        $response = $soapClient->CelsiusToFahrenheit([
            'Celsius' => $request->input('celsius'),
        ]);

        // Extract the Fahrenheit value from the SOAP response
        $fahrenheit = $response->CelsiusToFahrenheitResult;

        $soapResponse = new SoapResponse();
        $soapResponse->fahrenheit = $fahrenheit;
        $soapResponse->celcius = $request->input('celsius');
        $soapResponse->save();

        // Return the SOAP response
        return response()->json([
            'fahrenheit' => $fahrenheit,
        ]);
    }

    public function convertTemperature(Request $request)
    {
        $wsdl = 'https://www.w3schools.com/xml/tempconvert.asmx?WSDL';
        $soapClient = new \SoapClient($wsdl, ['trace' => true]);

        // Call the SOAP method
        $response = $soapClient->CelsiusToFahrenheit([
            'Celsius' => $request->input('celsius'),
        ]);

        // Extract the Fahrenheit value from the SOAP response
       if(isset($response)){
        $fahrenheit = $response->CelsiusToFahrenheitResult;

        $soapResponse = new SoapResponse();
        $soapResponse->fahrenheit = $fahrenheit;
        $soapResponse->celcius = $request->input('celsius');
        $soapResponse->save();
       }

        $fahrenheitDatas = SoapResponse::all();

        // Pass the SOAP response data to the view
        return view('convert-temperature', compact('fahrenheit','fahrenheitDatas'));
    }
}
