<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UserAlreadySubscribedException;
use App\Http\Controllers\Controller;
use App\Repositories\Newsletter\NewsletterRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiNewsletterController extends Controller
{
    public function __invoke(Request $request, NewsletterRepository $newsletterRepository): JsonResponse
    {
        $request->validate([
            'email' => [
                'required', 'email', 'max:255',
            ],
        ]);

        try {
            $newsletterRepository->save($request->get('email'));

            return response()->json([
                'type' => 'Succès',
                'message' => 'Vous êtes bien inscrit à la newsletter de Beehemiam !
                    Merci, nous vous enverrons des nouvelles très vite.',
            ]);
        } catch (UserAlreadySubscribedException $e) {
            logger($e->getMessage());

            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        } catch (\Exception $e) {
            logger($e->getMessage());

            return response()->json([
                'message' => 'Erreur du serveur',
            ], 500);
        }
    }
}
