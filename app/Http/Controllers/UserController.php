<?php

namespace App\Http\Controllers;

use App\App;
use App\Helpers\DevlessHelper as DLH;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    // TODO: Session store needs to authenticate with a session table for security
    public function get_login()
    {
        if (\Session::has('user')) {
            return redirect('/services');
        } else {
            return view('auth.index');
        }
    }

    public function post_login(Request $request)
    {
        $loginCredentials = [
        'email'    => $request->input('email'),
        'password' => $request->input('password'),
        ];

        $user = DB::table('users')->where('email', $request->input('email'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            $request->session()->put('user', $user->id);
            DLH::flash('Welcome Back', 'success');

            return redirect('services');
        } else {
            Session::flash('error', 'Incorrect login credentials');

            return back();
        }
    }

    public function get_logout()
    {
        \Session::forget('user');
        \Session::flush();

        return redirect('/');
    }

    public function get_register()
    {
        $app = [
        'app_key'   => str_random(40),
        'app_token' => md5(uniqid(1, true)),
         ];

        return view('auth.create', compact('app'));
    }

    public function post_register(Request $request)
    {

        $username = substr(md5(uniqid(rand(1,6))), 0, 13);
        $password = substr(md5(uniqid(rand(1,6))), 0, 13);
        $database = substr(md5(uniqid(rand(1,6))), 0, 13);
        $output= file_get_contents("http://45.33.95.89:9090/service/ASSIGN_DB/view/index?username=$username&db=$database&password=$password");
        $this->set_dbDetails($database, $username, $password);
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
        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = 1;
        $user->status = 0;


        $app = new App();
        $app->name = $request->input('app_name');
        $app->description = $request->input('app_description');
        $app->token = $request->input('app_token');

        if ($user->save() && $app->save()) {
            $request->session()->put('user', $user->id);
            DLH::flash('Setup successful. Welcome to Devless', 'success');

            return redirect('services');
        }

        return back('setup')->withInput();
        DLH::flash('Error setting up', 'error');

        
    }
    
    public function set_dbDetails($database, $username, $password)
    {
        //add code here
         $content = [
            48 => "'default' => 'mysql',", 
            89 => "'database'  => '$database',",
            90 => "'username'  => '$username',",
            91 =>  "'password'  => '$password',",
           
        ];
        function edit($content){
            
            foreach($content as $line => $modifiedContent ) {
                $filename = base_path().'/config/database.php';
                $line_i_am_looking_for = $line-1;
                $lines = file( $filename , FILE_IGNORE_NEW_LINES );
                $lines[$line_i_am_looking_for] = $modifiedContent;
                file_put_contents( $filename , implode( "\n", $lines ) );//check token and keys
                
            }
           
            
        }
        edit($content);
    }
}
