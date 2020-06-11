<?php namespace PaulVonZimmerman\Patreon\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use \Patreon\API;
use \Patreon\OAuth;
use PaulVonZimmerman\Patreon\Models\Settings;

class Register extends Controller
{
    public $client_id;
    public $client_secret;
    public $redirect_uri;
    public $creator_id;
    public $actual_link;

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('PaulVonZimmerman.Patreon', 'Patreon');
        $this->pageTitle = 'Patreon';
        $this->client_id = Settings::get('client_id');
        $this->client_secret = Settings::get('client_secret');
        $this->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $this->creator_id = 'test';
        $this->actual_link = $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]".'/backend/PaulVonZimmerman/patreon/register';
        $this->vars['redirect_uri'] = $this->actual_link;
        $this->vars['url'] = 'http://www.patreon.com/oauth2/authorize?response_type=code&client_id='.$this->client_id.'&redirect_uri='.$this->actual_link;
        $this->vars['status'] = 'Retrieving status... ';
        $this->vars['short_description'] = 'waiting..';
        $this->vars['detail'] = 'Shouldn’t take but a moment.';
        $this->vars['class'] = 'info';
        $this->vars['icon'] = 'info';
    }
    public function index()
    {
    }
    public function onLoad()
    {
        if (isset($_GET['code'])) {
            $oauth_client = new \Patreon\OAuth($this->client_id, $this->client_secret);
            $tokens = $oauth_client->get_tokens($_GET['code'], $this->actual_link);
            // Unset access_token could happen if they refresh right after
            // getting an access token (?code is still set);
            if (isset($tokens['access_token'])) {
                $access_token = $tokens['access_token'];
                $refresh_token = $tokens['refresh_token'];
                Settings::set('refresh_token', $refresh_token);
                Settings::set('access_token', $access_token);

                $register_client = new \Patreon\API(Settings::get('access_token'));
                $patron_response = $register_client->fetch_campaign();
                $patron = $patron_response['data'];
                $string = json_encode($patron);
                $included = $patron_response['included'];
                $goal = null;
                if ($included != null) {
                    foreach ($included as $obj) {
                        if ($obj["type"] == "goal") {
                            $pledge = $obj;
                            $amount_cents = $pledge['attributes']['amount_cents'];
                            $amount_dollars = $amount_cents / 100;
                            $amount_cents = $amount_cents % 100;
                            if ($amount_cents < 9) {
                                $amount_cents = '0'.$amount_cents;
                            }
                            Settings::set('amount_cents', '$'.$amount_dollars.'.'.$amount_cents);
                            break;
                        }
                    }
                }
            }
        } 
        if(Settings::get('access_token') != null) {
            $register_client = new \Patreon\API(Settings::get('access_token'));
            $campaign_response = $register_client->fetch_campaign();

            // Handle access_token expiring:
            if (isset($campaign_response['errors'])) {
                $oauth_client = new \Patreon\OAuth(Settings::get('client_id'), Settings::get('client_secret'));
                // Get a fresher access token
                $tokens = $oauth_client->refresh_token(Settings::get('refresh_token'), null);
                if (isset($tokens['access_token'])) {
                    // Set new token
                    $access_token = $tokens['access_token'];
                    Settings::set('refresh_token', $tokens['refresh_token']);
                    Settings::set('access_token', $access_token);
                } else {
                    $this->vars['status'] = 'Error';
                    $this->vars['short_description'] = $campaign_response['errors'][0]['code_name'];
                    $this->vars['detail'] = $campaign_response['errors'][0]['detail'];
                    $this->vars['class'] = 'danger';
                    $this->vars['icon'] = 'warning';
                }
            }
            if (isset($campaign_response['errors'])) {
                $this->vars['status'] = 'Error';
                $this->vars['short_description'] = $campaign_response['errors'][0]['code_name'];
                $this->vars['detail'] = $campaign_response['errors'][0]['detail'];
                $this->vars['class'] = 'danger';
                $this->vars['icon'] = 'warning';
            }
            elseif (isset($campaign_response['data'])) {
                $this->vars['status'] = 'Connection Successful';
                $this->vars['short_description'] = 'Successful response from Patreon!';
                $this->vars['detail'] = 'Now connected to: '.$campaign_response['data'][0]['attributes']['creation_name'].'<p>Goals:</p><ul>';
                $this->vars['class'] = 'success';
                $this->vars['icon'] = 'check';
                $included = $campaign_response['included'];
                $goal = null;
                if ($included != null) {
                    foreach ($included as $obj) {
                        if ($obj["type"] == "goal") {
                            $pledge = $obj;
                            $this->vars['detail'] = $this->vars['detail'].'<li>'.$pledge['attributes']['description'];
                        }
                    }
                }
                $this->vars['detail'] = $this->vars['detail'].'</ul>';
            }
        }
        else {
           $this->vars['status'] = 'Access token not set.';
           $this->vars['short_description'] = 'Did you complete step four?';
           $this->vars['detail'] = 'October Patreon couldn’t find an access token.';
           $this->vars['class'] = 'danger';
           $this->vars['icon'] = 'warning';
        }
    }
}
