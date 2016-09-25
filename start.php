<?php

        $username = substr(md5(uniqid(rand(1,6))), 0, 13);
        $password = substr(md5(uniqid(rand(1,6))), 0, 13);
        $database = substr(md5(uniqid(rand(1,6))), 0, 13);
        $output= file_get_contents("http://45.33.95.89:9090/service/ASSIGN_DB/view/index?username=$username&db=$database&password=$password");
        set_dbDetails($database, $username, $password);
        \Config::set('database.connections.cc', array(
                'driver'    => 'mysql',
                'host'      => '45.33.95.89',
                'database'  => $database,
                'username'  => $username,
                'password'  => $password,
                    'charset'   => 'utf8',
                'collation' => 'utf8_general_ci',
                'prefix'    => '',
        ));
        \Config::set('database.default', 'cc');
        
        \Artisan::call('migrate');
        
        
        
        function set_dbDetails($database, $username, $password)
        {
            //add code here
             $content = [
                48 => "'default' => 'mysql',", 
                89 => "'database'  => '$database',",
                90 => "'username'  => '$username',",
                91 =>  "'password'  => '$password',",

            ];
            function edit($content){
                $filename = base_path().'/config/database.php';
                //chmod($filename, 0777); 
                foreach($content as $line => $modifiedContent ) {
                    $line_i_am_looking_for = $line-1;
                    $lines = file( $filename , FILE_IGNORE_NEW_LINES );
                    $lines[$line_i_am_looking_for] = $modifiedContent;
                    file_put_contents( $filename , implode( "\n", $lines ) );//check token and keys

                }


            }
            edit($content);
        }