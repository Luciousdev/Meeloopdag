<?php
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "http://monitor.keydev.nl:3002/metrics");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERPWD, ":uk2_qA0A4Ct3PvujWl24sss70-z0j7ZcU7t1Mm64kP-I");

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo 'cURL error: ' . curl_error($curl);
}

curl_close($curl);

$rows = explode("\n", $response);

echo '<table border="1">';
foreach ($rows as $row) {
    echo '<tr>';
    $columns = explode("\t", $row);
    foreach ($columns as $column) {
        echo '<td>' . $column . '</td>';
    }
    echo '</tr>';
}
echo '</table>';
?>
