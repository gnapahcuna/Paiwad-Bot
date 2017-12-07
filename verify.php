<?php
$access_token = '3ioj1l5ixd12Au2TjN/fpKhKk4SK0t0+vCYw2sDklEtoAe8incfpdNVtdGRSj+5Z+xodHybAudekwT0enLdvdwfN960kc+lAYxNxWBshgyeOZS9PJYNyuxKmUWYKbDb7hPOpD+YPg0m4CfP4hykpvwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
