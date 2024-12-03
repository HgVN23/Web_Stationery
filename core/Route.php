<?php
class Route
{

    function __construct() {}

    // don't use
    public  function handleRoute2($url)
    {
        global $routes;
        unset($routes['default_controller']);

        $url = trim($url, '/');

        $handelUrl = $url;

        if (!empty($routes)) {
            // foreach ($routes as $key => $value) {
            //     echo 'tes=' . $key . '<br />';
            //     if (preg_match('~' . $key . '~is', $url)) {
            //         $handelUrl = preg_replace('~' . $key . '~is', $value, $url);
            //     }
            // }
            foreach ($routes as $key => $value) {
                // Kiểm tra xem route có chứa ký tự đặc biệt của regex không
                if (preg_match('~[^\w/-]~', $key)) {
                    // Route này chứa ký tự đặc biệt, sử dụng regex để khớp
                    if (preg_match('~' . $key . '~is', $url)) {
                        $handelUrl = preg_replace('~' . $key . '~is', $value, $url);
                        break; // Tìm thấy route phù hợp thì dừng
                    }
                } else {
                    // Route này không chứa ký tự đặc biệt, khớp chính xác
                    if ($url === $key) {
                        $handelUrl = $value;
                        break; // Tìm thấy route phù hợp thì dừng
                    }
                }
            }
        }

        return $handelUrl;
    }

    public function handleRoute($url)
    {
        global $routes;
        unset($routes['default_controller']);

        $url = trim($url, '/');

        $handelUrl = $url;

        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                foreach ($routes as $key => $value) {
                    // Kiểm tra xem route có chứa ký tự đặc biệt của regex không (như $)
                    if (preg_match('~[^\w/-]~', $key)) {
                        // Route này chứa ký tự đặc biệt, sử dụng regex để khớp
                        if (preg_match('~^' . $key . '$~is', $url, $matches)) {

                            $handelUrl = $value;
                            if (isset($matches[1])) {
                                $handelUrl = str_replace('$1', $matches[1], $handelUrl);
                            }
                            if (isset($matches[2])) {
                                $handelUrl = str_replace('$2', $matches[2], $handelUrl);
                            }

                            break; // Tìm thấy route phù hợp thì dừng
                        }
                    } else {
                        // Route này không chứa ký tự đặc biệt, khớp chính xác
                        if ($url === $key) {
                            $handelUrl = $value;
                            break; // Tìm thấy route phù hợp thì dừng
                        }
                    }
                }
            }
        }
        return $handelUrl;
    }
}
