<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use DB;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
//		if ($this->auth->guest())
//		{
//			if ($request->ajax())
//			{
//				return response('Unauthorized.', 401);
//			}
//			else
//			{
//				return redirect()->guest('auth/login');
//			}
//		}

//		if(empty($_SERVER['AUTH_USER']) || empty($_SERVER['AUTH_PASSWORD']))
//		{
//			return response('Unauthorized.', 401);
//		}

//		$realm = 'acs_iis.local/';
//		if(empty($_SERVER['LOGON_USER']))
//		{
//			//They haven't given us a username and password yet
//			header('HTTP/1.1 401 Access Denied');
//			header('WWW-Authenticate: Negotiate');
//			header('WWW-Authenticate: NTLM ');
//			die(); //if they hit cancel
//		}
//
//
//
//		echo "<pre>";
//		print_r($_SERVER);exit;

		if(empty($_SERVER['AUTH_USER']))
		{
			return response('Unauthorized.', 401);
			//$username = 'RETHUSO-NT8004\IUSR_RETHUSO-NT8004';
		}
		else{
			$username = $_SERVER['AUTH_USER'];
		}

		$user = DB::table('User')->where('UserName', $username)->first();
		if(!$user){
			return response('Unauthorized.', 401);
		}
		return $next($request);

	}

}
