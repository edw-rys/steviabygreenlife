<?php
if (!function_exists('convertToCamelCase')) {
    /**
     * Convert to CamelCase
     *
     * @param $string
     * @param string $delimiter
     * @param bool $capitalizeFirstCharacter
     * @return string|string[]
     */
    function convertToCamelCase($string, string $delimiter = '_', bool $capitalizeFirstCharacter = true)
    {
        $str = str_replace($delimiter, '', ucwords($string, $delimiter));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }
}


if (!function_exists('getClientIp')) {

    function getClientIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }
}



if (!function_exists('getOS')) {
    function getOS($user_agent)
    {

        $os_platform  = "Unknown OS Platform";

        $os_array     = array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;

        return $os_platform;
    }
}

if (!function_exists('getBrowser')) {
    function getBrowser($user_agent)
    {

        $browser        = "Unknown Browser";

        $browser_array = array(
            '/msie/i'      => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Chrome',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/netscape/i'  => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i'    => 'Handheld Browser'
        );

        foreach ($browser_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $browser = $value;

        return $browser;
    }
}

if (!function_exists('getModesFormats')) {

    /**
     * @param $mode
     */
    function getModesFormats($mode)
    {
        $params = (object)[
            'format_sql'    => '%Y-%m-%d',
            'format_date'   => 'Y-m-d',
            'date_format'   => 'd/m/Y',
            'methodadd'     => 'addDay'
        ];
        switch ($mode) {
            case 'day':
                $params = (object)[
                    'format_sql'    =>  '%Y-%m-%d',
                    'format_date'   => 'Y-m-d',
                    'date_format'   => 'd/m/Y',
                    'methodadd'     => 'addDay'
                ];
                break;
            case 'month':
                $params = (object)[
                    'format_sql'    =>  '%Y-%m',
                    'format_date'   => 'Y-m',
                    'date_format'   => 'm/Y',
                    'methodadd'     => 'addMonth'
                ];
                break;
        }
        return $params;
    }
}

if (!function_exists('getFileImgByUrl')) {
    function getFileImgByUrl($url)
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $url = str_replace('"', "'", $url);
        $url = str_replace('\\', "", $url);
        $url = str_replace(' ', "", $url);
        // $url = '"'.$url.'"';
        // $url = "https://quickchart.io/chart?c={type:'line',data:{labels:['01/2022','02/2022','03/2022','04/2022','05/2022','06/2022','07/2022','08/2022','09/2022'],datasets:[{label:'01/01/2022-28/09/2022',data:[0,0,28.42,0,56.84,28.42,71.05,270,14.21]}]}}";
        // $url = "https://quickchart.io/chart?c={type:'line',data:{labels:['01/2022','02/2022','03/2022','04/2022','05/2022','06/2022','07/2022','08/2022','09/2022'],datasets:[{'label':'01/01/2022-28/09/2022','data':[0,0,28.42,0,56.84,28.42,71.05,270,14.21]}]}}";
        // echo $url;
        // die();
        return file_get_contents($url, false, stream_context_create($arrContextOptions));
    }
}

if (!function_exists('removeAccent')) {
    function removeAccent($string)
    {
        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );






        return $string;
    }
}


if (!function_exists('generateCodeProcess')) {
    function generateCodeProcess($sequential, $motive = 'PIN'){

        $sequential = str_pad(+$sequential, 9, "0", STR_PAD_LEFT);
        
        return $motive . $sequential;
    }
}
if (!function_exists('eliminarAcentos')) {
    function eliminarAcentos($cadena){
		
        //Reemplazamos la A y a
        $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
        );

        //Reemplazamos la E y e
        $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena );

        //Reemplazamos la I y i
        $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î', 'í'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i', 'i'),
        $cadena );

        //Reemplazamos la O y o
        $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô','ó'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o', 'o'),
        $cadena );

        //Reemplazamos la U y u
        $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena );

        //Reemplazamos la N, n, C y c
        $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç', '#', '?', '¿', '!', '¡', '&'),
        array('N', 'n', 'C', 'c', '_', '_', '_', '_', '_', '_'),
        $cadena
        );
        $cadena = htmlentities($cadena, ENT_NOQUOTES, 'utf-8');

        $cadena = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $cadena);
        $cadena = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $cadena); // pour les ligatures e.g. '&oelig;'
        $cadena = preg_replace('#&[^;]+;#', '', $cadena); // supprime les autres caractères

        return $cadena;
    }
}