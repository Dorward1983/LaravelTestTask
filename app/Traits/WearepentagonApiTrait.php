<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait WearepentagonApiTrait
{
    /**
     * @return string
     */
    private function getToken(): string
    {
        $response = Http::asForm()->post(env('API_URL') . '/devInterview/API/en/access-token', [
            'client_id' => env('API_USER'),
            'client_secret' => env('API_PASSWORD'),
        ]);

        return $response['access_token'] ?? '';
    }

    /**
     * @return string
     */
    private function getDataFromApi(): string
    {
        $token = $this->getToken();
        $data = '';

        if (!empty($token)) {
            $data = Http::withToken($token)->get(env('API_URL') . '/devInterview/API/en/get-random-test-feed');
            $data = json_decode($data->body())?? '';
        }

        return $data;
    }

    /**
     * @return array
     */
    private function prepareData(): array
    {
        $data = $this->getDataFromApi();
        $response = [];

        if (!empty($data)) {
            preg_match('/^order:|^product:/', $data, $matches);

            if (!empty($matches)) {
                $data = preg_replace('/^order:|^product:/', '', $data);
                $response['model'] = '\App\Models\\' . ucfirst(str_replace(':', '', $matches[0]));
            }

            $dataParts = explode('||', $data);
            $arrData = [];
            foreach ($dataParts as $part) {
                preg_match('/\{.+?\}/', $part, $matches);

                if (empty($matches)) {
                    continue;
                }

                $key = str_replace($matches[0], '', $part);
                $key = str_replace(['{', '}'], '', $key);
                $value = str_replace(['{', '}'], '', $matches[0]);
                if (preg_match('/(?P<field>^[a-z]+?)\\\(?P<encode>base64);(?P<extension>[a-z]+?)$/', $key, $matches)) {
                    // If base64 encoded image
                    $arrData[$matches['field']] = $this->base64ToImage($arrData['SKU'], $value, $matches['extension']);
                } else {
                    $arrData[$key] = $value;
                }
            }
            $response['success'] = 'ok';
            $response['data'] = $arrData;
        }

        return $response;
    }

    /**
     * @param string $sku
     * @param string $value
     * @param string $extension
     * @return string
     */
    private function base64ToImage(string $sku, string $value, string $extension): string
    {
        $fileName = "storage/img/{$sku}.{$extension}";
        $path = public_path($fileName);
        file_put_contents($path, base64_decode($value), LOCK_EX);

        return $fileName;
    }
}
