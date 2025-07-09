<?php
namespace PayPalCheckoutSdk\Core;

class PayPalHttpClient
{
    private SandboxEnvironment $environment;
    private ?string $accessToken = null;

    public function __construct(SandboxEnvironment $environment)
    {
        $this->environment = $environment;
    }

    private function getAccessToken(): string
    {
        if ($this->accessToken !== null) {
            return $this->accessToken;
        }

        $url = $this->environment->baseUrl() . '/v1/oauth2/token';
        $credentials = base64_encode($this->environment->getClientId() . ':' . $this->environment->getClientSecret());
        $headers = [
            'Authorization: Basic ' . $credentials,
            'Content-Type: application/x-www-form-urlencoded'
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        $response = curl_exec($ch);
        if ($response === false) {
            throw new \RuntimeException('Curl error: ' . curl_error($ch));
        }
        $data = json_decode($response, true);
        $this->accessToken = $data['access_token'] ?? '';
        return $this->accessToken;
    }

    public function execute(object $request)
    {
        $token = $this->getAccessToken();
        $headers = array_merge([
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ], $request->headers());

        $ch = curl_init($this->environment->baseUrl() . $request->path);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request->method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($request->body !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request->body));
        }
        $response = curl_exec($ch);
        if ($response === false) {
            throw new \RuntimeException('Curl error: ' . curl_error($ch));
        }
        $data = json_decode($response);
        return (object)['result' => $data];
    }
}
