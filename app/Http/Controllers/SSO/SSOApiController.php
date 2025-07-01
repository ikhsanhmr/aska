<?php

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\APIController;
use App\Repositories\SSORepository;
use App\User;
use Illuminate\Http\Request;

class SSOApiController extends APIController
{
    /**
     * Used to mark website that user have
     */
    public function checkUserExistsByNip(Request $request, SSORepository $ssoRepository)
    {
        $request->validate([
            'nip' => 'required',
            'token' => 'required'
        ]);
        $checkToken = $ssoRepository->checkTokenValidityToServer($request->token);
        if ($checkToken['status'] && $checkToken['data']) {
            $user = User::where('nip', $request->nip)->first();
            return $this->sendSuccess($user, 'Hasil pencarian user.');
        }
        return $this->sendError($checkToken['message']);
    }
    /**
     * Used to login the user
     */
    public function login(Request $request, SSORepository $ssoRepository)
    {
        $request->validate([
            'nip' => 'required',
            'token' => 'required'
        ]);
        $checkToken = $ssoRepository->checkTokenValidityToServer($request->token);
        try {
            if ($checkToken['status'] && $checkToken['data']) {
                $user = User::where('nip', $request->nip)->first();
                if ($user) {
                    auth()->login($user);
                    return redirect()->route('login');
                }
            }
        } catch (\Exception $e) {
            info('Exception: ' . $e->getMessage());
            // Handle exception
        }
        return redirect()->away(config('services.sso_pln_nd.redirect_url'));
    }
}
