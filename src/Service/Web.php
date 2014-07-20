<?php
namespace Omnimessage\Service;

class Web
{
    private $url;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function send($data)
    {
        if (empty($this->url)) {
            throw new Exception('Web dispatcher requires a url');
        }

        $response = $this->sendData(json_encode($data));

        if ($response != 200) {
            return false;
        }

        return true;
    }

    private function sendData($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getUrl());
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data),
        ));

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            throw new Exception('Web curl error: ' . curl_error($ch));
        }

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $status;

    }
}
