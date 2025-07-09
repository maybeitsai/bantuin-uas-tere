<?php
class SupabaseClient {
    private $baseUrl;
    private $apiKey;
    private $headers;

    public function __construct($url, $key) {
        $this->baseUrl = rtrim($url, '/');
        $this->apiKey = $key;
        $this->headers = [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'Prefer: return=representation'
        ];
    }

    private function makeRequest($method, $endpoint, $data = null) {
        $url = $this->baseUrl . '/rest/v1/' . ltrim($endpoint, '/');
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        
        if ($data && in_array($method, ['POST', 'PATCH', 'PUT'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }

        $decodedResponse = json_decode($response, true);
        
        if ($httpCode >= 400) {
            throw new Exception('API Error: ' . ($decodedResponse['message'] ?? 'Unknown error'));
        }

        return $decodedResponse;
    }

    public function select($table, $columns = '*', $conditions = []) {
        $endpoint = $table . '?select=' . $columns;
        
        foreach ($conditions as $field => $value) {
            $endpoint .= '&' . $field . '=eq.' . urlencode($value);
        }
        
        return $this->makeRequest('GET', $endpoint);
    }

    public function insert($table, $data) {
        return $this->makeRequest('POST', $table, $data);
    }

    public function update($table, $data, $conditions) {
        $endpoint = $table;
        $queryParams = [];
        
        foreach ($conditions as $field => $value) {
            $queryParams[] = $field . '=eq.' . urlencode($value);
        }
        
        if (!empty($queryParams)) {
            $endpoint .= '?' . implode('&', $queryParams);
        }
        
        return $this->makeRequest('PATCH', $endpoint, $data);
    }

    public function delete($table, $conditions) {
        $endpoint = $table;
        $queryParams = [];
        
        foreach ($conditions as $field => $value) {
            $queryParams[] = $field . '=eq.' . urlencode($value);
        }
        
        if (!empty($queryParams)) {
            $endpoint .= '?' . implode('&', $queryParams);
        }
        
        return $this->makeRequest('DELETE', $endpoint);
    }

    public function count($table, $conditions = []) {
        $endpoint = $table . '?select=*';
        
        foreach ($conditions as $field => $value) {
            $endpoint .= '&' . $field . '=eq.' . urlencode($value);
        }
        
        $result = $this->makeRequest('GET', $endpoint);
        return count($result);
    }
}
?>
