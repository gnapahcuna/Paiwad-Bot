<?php
$access_token = '3ioj1l5ixd12Au2TjN/fpKhKk4SK0t0+vCYw2sDklEtoAe8incfpdNVtdGRSj+5Z+xodHybAudekwT0enLdvdwfN960kc+lAYxNxWBshgyeOZS9PJYNyuxKmUWYKbDb7hPOpD+YPg0m4CfP4hykpvwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			//test
			
			
			// Build message to reply back
			if($text=='สวัสดี'||$text=='สวัสดีค่ะ'||$text=='สวัสดีครับ'){
				$messages = [
				'type' => 'text',
				'text' => 'สวัสดีครับ คุณกินข้าวรึยังนุ้งฝน'
				];	
			}elseif($text=='กินแล้ว'){
				$messages = [
				'type' => 'text',
				'text' => 'ดีใจด้วย คุณจะได้อ้วงๆ '
				];
			}elseif($text=='ตลก'){
				$messages = [
				'type' => 'text',
				'text' => 'พ่องงง'
				];
			}
			else{
				$messages = [
				'type' => 'text',
				'text' => 'ไม่เข้าใจคำถาม'
				];
			}
			

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
