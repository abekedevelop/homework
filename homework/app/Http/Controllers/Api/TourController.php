<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class TourController extends Controller
{
    public function searchTour ( Request $request ) {

        $departureCityId = $request['searchForm']['departureCity'];
        $destinationId = $request['searchForm']['destination'];
        $departureDate = $request['searchForm']['departureDate'];
        $nights = $request['searchForm']['nights'];

        $response = [
            'status' => 'error',
            'message' => ''
        ];

        $error = false;

        if ( self::checkValue( $departureCityId ) ) {
            $response['message'] = 'Пожалуйста, выберите город вылета';
            $error = true;
            return $response;
        }
        if ( self::checkValue( $destinationId ) ) {
            $response['message'] = 'Пожалуйста, выберите страну прилета';
            $error = true;
            return $response;
        }
        if ( self::checkValue( $departureDate ) ) {
            $response['message'] = 'Пожалуйста, выберите дату вылета';
            $error = true;
            return $response;
        }
        if ( self::checkValue( $nights ) ) {
            $response['message'] = 'Пожалуйста, выберите количество ночей';
            $error = true;
            return $response;
        }
        if ( $error === false ) {
            try {
                $dateFormatted = $this->formatDate( $departureDate );

                $GETUrl = 'https://poedem.kz/test/search/partner1';
                $GETUrl .= '?departCity=' . $departureCityId;
                $GETUrl .= '&country=' . $destinationId;
                $GETUrl .= '&date=' . $dateFormatted;
                $GETUrl .= '&nights=' . $nights;

                $GETTours = self::sendGETCurl ( $GETUrl );

                $GETParsedTours = self::parseToursArray ( $GETTours );

                $POSTUrl = 'https://poedem.kz/test/search/partner2';
                $curlPOSTParams = [
                    'cityId' => $departureCityId,
                    'countryId' => $destinationId,
                    'dateFrom' => $dateFormatted,
                    'nights' => $nights
                ];

                $POSTResponse = self::sendPOSTUrl( $POSTUrl, $curlPOSTParams );

                $xml = new \SimpleXMLElement( $POSTResponse );

                $POSTParsedTours = self::parseToursArray ( $xml );


                return [
                    'getResponse' => $GETParsedTours,
                    'postResponse' => $POSTParsedTours
                ];
            } catch ( \Exception $e ) {
                Log::error( $e->getMessage() );
                return [
                    'status' => 'error',
                    'message' => 'Произошла ошибка. Попробуйте позднее.'
                ];
            }
        }
    }

    private static function checkValue ( $input ) {
        if ( trim( $input ) === '' ) {
            return true;
        }
        return false;
    }

    private function formatDate ( $date ) {
        return implode('-', array_reverse(explode('-', $date )));
    }

    private function parseToursArray ( $tours ) {
        $toursParsed = [];
        foreach ( $tours as $key => $tourArray ) {
            foreach ( $tourArray as $tour ) {
                $toursParsed[] = $tour;
            }
        }
        return $toursParsed;
    }

    private function sendGETCurl ( $url ) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));

        $curlTours = json_decode(curl_exec($curl), true);

        curl_close($curl);

        return $curlTours;
    }

    private function sendPOSTUrl ( $url, $params ) {

        $postCurl = curl_init();

        curl_setopt_array( $postCurl, array (
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => http_build_query( $params ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));


        $response = curl_exec( $postCurl );

        curl_close( $postCurl );

        return $response;
    }

}
