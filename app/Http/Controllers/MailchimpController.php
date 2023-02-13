<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MailchimpMarketing\ApiClient;
use MailchimpMarketing\ApiException;

class MailchimpController extends Controller
{

    /**
     * @var Newsletter
     */
    private $newsletter;


    /**
     * @param Newsletter $newsletter
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }


    /**
     * Subscribe a new user
     * @param Request $request
     * @return mixed|string
     */
    public function subscribe(Request $request)
    {
        $request->validate([ 'email' => 'required|email']);
        try {
            $this->newsletter->subscribe($request->email);
            $this->addSubscriberToList($request->email);
            return response()->json(
                [
                    'message' => 'Subscribed successfully'
                ]
            );
        } catch (\Exception $exception) {
            Log::error('subscribe-error', [$exception->getMessage()]);

            return response()->json(
                [
                    'message' => 'User already subscribed',
                    'trace' => $exception->getMessage(),
                ], 400
            );
        }
    }


    public function addSubscriberToList($email)
    {
        $newsletter = \App\Models\Newsletter::firstOrNew(
            [
                'email' => $email
            ]
        );

        $newsletter->user_id = $newsletter->user_id ?: auth()->id();
        $newsletter->subscribed_date = $newsletter->subscribed_date ?: now();
        $newsletter->is_subscribed = 1;
        $newsletter->save();
    }


    /**
     * @param Request $request
     * @return mixed|string
     */
    public function subscribersList(Request $request)
    {
        try {
            return $this->newsletter->subscribersList();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function unsubscribe(Request $request)
    {
        $request->validate([ 'email' => 'required|email']);

        return $this->newsletter->unsubscribe($request->email);
    }



    /**
     * @return mixed
     */
    public function attachUnsubscribeEvent()
    {
        return $this->newsletter->attachUnsubscribeEvent();
    }



}
