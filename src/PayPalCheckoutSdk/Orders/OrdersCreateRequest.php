<?php
namespace PayPalCheckoutSdk\Orders;

class OrdersCreateRequest
{
    public string $path = '/v2/checkout/orders';
    public string $method = 'POST';
    public $body = null;
    private array $headers = [];

    public function prefer(string $value): void
    {
        $this->headers['Prefer'] = $value;
    }

    public function headers(): array
    {
        $result = [];
        foreach ($this->headers as $key => $value) {
            $result[] = $key . ': ' . $value;
        }
        return $result;
    }
}
