<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class SSORepository
{
    /**
     * Check token validity to main sso server
     *
     * @param string $token
     */
    public function checkTokenValidityToServer(string $token)
    {
        $response = Http::withHeaders([
            'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36',
            'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,/;q=0.8,application/signed-exchange;v=b3;q=0.9'
        ])->post(config('services.sso_pln_nd.check_token_url'), [
            'website_id' => config('services.sso_pln_nd.client_id'),
            'token' => $token
        ]);

        return $response->json();
    }
}
