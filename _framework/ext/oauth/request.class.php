<?php
/**
 * OAuth Request类
 **/

class Ext_OAuth_Request
{
    
    const POST = 'POST';

    const GET = 'GET';

    const PUT = 'PUT';

    const DELETE = 'DELETE';

    public function  __construct()
    {
        if(!function_exists('curl_init'))
        {
            throw new Exception('curl is not available');
        }
    }

    static public function request($url, $method = self::GET, $headers = array(), $data = null)
    {
        /*if(!Ext_OAuth_Util::isUrl($url))
        {
            throw new Exception('invalid url : ' . $url);
        }*/
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $scheme = parse_url($url, PHP_URL_SCHEME);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, ($scheme == 'https'));
        switch($method)
        {
            case 'POST':
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case 'PUT':
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case 'DELETE':
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                break;
            default :
            //GET is the default
                if (count($headers))
                {
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                }
        }
        $response = curl_exec($curl);
        if (!$response)
        {
            $response = curl_error($curl);
            curl_close($curl);
            throw new Exception("curl error : $response");
        }
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return array(
                'content' => $response,
                'http_code' => $http_code,
        );
    }
    
    public function requestByOAuthClient(Ext_OAuth_Client $oc, $data, $headers = array(), $realm = null)
    {
        array_push($headers,$oc->getOAuthHeaders($realm));
        return $this->request($oc->url, $oc->http_method, $headers, $data);
    }

}
?>