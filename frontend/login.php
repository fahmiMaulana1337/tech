
<?php
function doLogin() {
    $data = array(
        'param1' => 'value1',
        'param2' => 'value2'
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:3000/login');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    curl_close($ch);
    
    $data = json_decode($response, true);
}
?>