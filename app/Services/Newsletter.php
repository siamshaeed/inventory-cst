<?php

namespace App\Services;


use MailchimpMarketing\ApiClient;

class Newsletter
{
    protected $mailchimp;

    protected $audience;

    protected $fields = ['id', 'email_address', 'contact_id', 'status', 'timestamp_opt', 'last_changed'];


    public function __construct()
    {
        $this->mailchimp = new ApiClient();

        $this->mailchimp->setConfig(
            [
                'apiKey' => config('services.mailchimp.api_key'),
                'server' => config('services.mailchimp.server_prefix')
            ]
        );


        $this->setAudience();

    }


    /**
     * Set audience dynamically from system
     *
     * @return void
     */
    public function setAudience()
    {
        $this->audience = current($this->mailchimp->lists->getAllLists()->lists);
    }


    /**
     * @param string $email
     * @return mixed
     */
    public function subscribe(string $email)
    {
        return $this->mailchimp->lists->addListMember($this->audience->id,
            [
                'email_address' => $email,
                'status' => 'subscribed',
            ]
        );

    }


    /**
     * @return mixed
     */
    public function subscribersList()
    {
        $prefix = ',members.';
        $fields = 'members' . implode($prefix, $this->fields);

        return $this->mailchimp->lists->getListMembersInfo($this->audience->id, $fields);
    }




    /**
     * @param string $email
     * @return mixed
     */
    public function unsubscribe(string $email)
    {
        $this->mailchimp->lists->deleteListMemberPermanent($this->audience->id, md5(strtolower($email)));
    }



    /**
     * @return mixed
     */
    public function attachUnsubscribeEvent()
    {
        return $this->mailchimp->lists->createListWebhook($this->audience->id,
            [
                'url' => 'http://api.reliablewebhook.com/h/jbkmwwpg6zroprcd',
                'events' => [
                    'unsubscribe' => true,
                    'cleaned' => true
                ]
            ]
        );
    }






}
