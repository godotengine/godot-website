<?php namespace PaulVonZimmerman\Patreon\Components;

use Cms\Classes\ComponentBase;
use PaulVonZimmerman\Patreon\Models\Settings;

class Goal extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Goal Component',
            'description' => "Adds a small widget that displays the percentage complete of a patreon campaign."
        ];
    }
    private function patreonRequest()
    {
        $register_client = new \Patreon\API(Settings::get('access_token'));
        $campaign_response = $register_client->fetch_campaign();

        // Handle access_token expiring:
        if (isset($campaign_response['errors'])) {
            $oauth_client = new \Patreon\OAuth(Settings::get('client_id'), Settings::get('client_secret'));
            // Get a fresher access token
            $tokens = $oauth_client->refresh_token(Settings::get('refresh_token'), null);
            // echo Settings::get('refresh_token').'</br>';
            if (isset($tokens['access_token'])) {
                // Set new token
                $access_token = $tokens['access_token'];
                Settings::set('refresh_token', $tokens['refresh_token']);
                Settings::set('access_token', $access_token);
            } else {
                // print_r($tokens);
                $this->addCss('/plugins/paulvonzimmerman/patreon/assets/css/error.css');
                return false;
            }
        }
        $included = $campaign_response['included'];
        if ($included != null) {
            $patronCount = 0;
            foreach ($included as $obj) {
                if ($obj['type'] === 'reward') {
                    $reward = $obj;
                    // `patron_count` doesn't exist for the "Everyone" reward
                    // which seems to be included in every campaign response.
                    if (isset($reward['attributes']['patron_count'])) {
                        $patronCount += $reward['attributes']['patron_count'];
                    }
                }
            }
            Settings::set('patron_count', $patronCount);

            foreach ($included as $obj) {
                if ($obj['type'] === 'goal') {
                    $goal = $obj;
                    // Grab the first goal that is less than 100%
                    // If none are less than 100%, it'll pull latest entry from settings
                    if($goal['attributes']['completed_percentage'] < 100) {
                        // Set new goal amount (in case of update)
                        Settings::set('amount_cents', $goal['attributes']['amount_cents']);
                        Settings::set('completed_percentage', $goal['attributes']['completed_percentage']);
                        break;
                    }
                }
            }
        }
    }

    public function init()
    {
        $this->page['patreon_url'] = Settings::get('patreon_url');
        $refresh_time = Settings::get('refresh_time');
        // Make sure refresh time is never 0
        if ($refresh_time == '' || $refresh_time < 5) {
            $refresh_time = 5;
        }
        if ((Settings::get('time_since_last_update') + $refresh_time * 60) < time()) {
            $this->patreonRequest();
            Settings::set('time_since_last_update', time());
        }
        $this->page['amount_cents'] = Settings::get('amount_cents');
        $this->page['goalPercentage'] = Settings::get('completed_percentage');
        $this->page['patron_count'] = Settings::get('patron_count');
    }
    public function onRun()
    {
        $this->addCss('/plugins/paulvonzimmerman/patreon/assets/css/goal.css');
        $this->addJs('/plugins/paulvonzimmerman/patreon/assets/js/goal.js');
    }
    public function defineProperties()
    {
        return [];
    }
}
