<?

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://tumblr.superfeedr.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);

$data = array(
	'hub.mode' => 'subscribe',
	'hub.verify' => 'sync',
	'hub.callback' => 'http://sameenjalal.com/Tumbling/pennapps/Tumbling/pubsubhubbub_response.php',
	'hub.topic' => 'http://tumblr.superfeedr.com/'
);

curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

print_r("\n$output\n");
print_r("\n$info\n");

?>
