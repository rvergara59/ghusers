<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ghuser;
use Illuminate\Support\Facades\Http;

class GhuserController extends Controller
{

    public function fetchGitHubUsers($ghu = null)
    {

        if ($ghu) {
            $token = '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';
            $url = 'https://api.github.com/users/'. $ghu;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);

            // Set the HTTP Header for the GET request
            $headers = [
                'User-Agent: PHP-cURL', 
                'Authorization: token ' . $token
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Execute the cURL session
            $response = curl_exec($ch);
            $err_no = curl_errno($ch);
            $user  = json_decode($response, true);
            // Check for errors
            if (isset($user['status']) ) {
                    return response()->json(['error' => 'Failed to fetch GitHub users'], 500);
                } else {
 
                   $result = array (
                            'username' => $user['login'],
                            'followers_url' => $user['followers_url'],
                            'followers' => $user['followers'],
                          );
                   return json_encode($result);
                }
        } else {
            return response()->json(['error' => 'No user provided'], 500);
        }
    }

}
