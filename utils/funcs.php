<?php

    function get_connection_obj() {
        $link = mysqli_connect('localhost', 'root', '','mydb2');
        if(mysqli_connect_errno()) {
            return '';
        }
        return $link;
    }