<?php

    function get_access_token()
    {
        return md5(COMPANY . date("Ymd") . API_KEY);
    }

    function check_access_token($access_token)
    {
        return $access_token == md5(COMPANY . date("Ymd") . API_KEY);
    }

