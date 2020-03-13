<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Token;

class PaymentController extends Controller
{
    public function paymentProcess(Request $request)
    {
        try {
            $cardDate = Carbon::createFromFormat('m/y', $request->get('card-date'));
            $token = Token::create([
                'card' => [
                    'number' => $request->get('card-number'),
                    'exp_month' => $cardDate->month,
                    'exp_year' => $cardDate->year,
                    'cvc' => $request->get('card-cvv'),
                ],
            ]);
            $charge = Charge::create([
                'amount' => intval($request->amount . '00'),
                'currency' => 'usd',
                'description' => $request->comment ?? '',
                'source' => $token->id,
            ]);
        } catch (ApiErrorException $exception) {
            return response()->json($exception->getMessage(), 505);
        }
        return response()->json($charge, 200);
    }
}
