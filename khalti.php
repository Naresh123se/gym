<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $price = $data['price'];
    $email = $data['email'];
    $name = $data['name'];

    // Initiate payment
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(array(
            "return_url" => "http://localhost/gym/complete_order.php", // Update to your actual return URL
            "website_url" => "http://localhost/gym/",
            "amount" => $price * 100, // Khalti expects amount in smallest unit
            "purchase_order_id" => "Order01",
            "purchase_order_name" => "test",
            "customer_info" => array(
                "name" => $name,
                "email" => $email,
                "phone" => "9800000001" // Update with actual phone number if needed
            )
        )),
        CURLOPT_HTTPHEADER => array(
            'Authorization: key live_secret_key_68791341fdd94846a146f0457ff7b455',
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if (curl_errno($curl)) {
        echo json_encode(['error' => 'Error: ' . curl_error($curl)]);
    } elseif ($http_code == 200) {
        $response_data = json_decode($response, true);
        if (isset($response_data['payment_url'])) {
            echo json_encode(['payment_url' => $response_data['payment_url']]);
        } else {
            echo json_encode(['error' => 'Payment URL not found in response.']);
        }
    } else {
        echo json_encode(['error' => 'Failed to initiate payment. HTTP Status Code: ' . $http_code]);
    }

    curl_close($curl);
} else {
    echo json_encode(['error' => 'Invalid input data.']);
}
?>
