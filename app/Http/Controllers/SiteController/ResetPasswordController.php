<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\SiteModels\User;
use App\SiteModels\Encrypt;
use Illuminate\Support\Facades\Mail;
use App\SiteModels\ResetPassword;
class ResetPasswordController extends Controller
{
	protected $email;
	public function reset(Request $request){
		$this->email = $request->input('email');
		$user = new User;
		$user = $user->where('email',$this->email)->first();
		if(count($user)<=0){
			return redirect('reset')
			->withFlashMessage('Invalid email given!')
			->withType('danger');
		}
		$token = $this->randomGenerator();
		$url = url('resetPasswordVerification/'.$token);
		$reset = new ResetPassword;
		$reset->user_id = $user->id;
		$reset->token = $token;

		Mail::send('email.resetToken', ['url' => $url],  function ($message)
      {
          $message->from('sms@mail.com', 'SMS - Password Reset');
          $message->to($this->email);
         
      });

		$reset->save();
		return redirect('reset')
			->withFlashMessage('Link to reset your password has been Mailed!')
			->withType('success');

	}

	protected function randomGenerator($length=20){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_#@$*()[]';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
	public function verify($token){
		$reset = new ResetPassword;
		$reset = $reset->where(['token'=>$token,'status'=>0])->first();
		if(count($reset)<=0){
			return redirect('/')
			->withFlashMessage('Invalid Token!')
			->withType('danger');
		}
		$id = Encrypt::encrypt($reset->user_id);
		return view('auth.passwords.verified',['id'=>$id]);
	}

	public function change(Request $request){
		$id = $request->input('id');
		$id = Encrypt::decrypt($id);
		if(is_numeric($id)){
			$user = new User;
			$user = $user->find($id);
			if(count($user)<=0){
				return redirect('/')
				->withFlashMessage('Invalid User or Token Expired!')
				->withType('danger');
			}
			$user->password = \Hash::make($request->input('password'));
			$user->save();
			$reset = new ResetPassword;
			$reset = $reset->where(['user_id'=>$id,'status'=>0])->first();
			if(count($reset)<=0){
				return redirect('/reset')
				->withFlashMessage('Token Used Up. Try again.')
				->withType('danger');
			}
			$reset->status = 1;
			$reset->save();
			return redirect('/login')
			->withFlashMessage('Password Changed Succesfully!')
			->withType('success');
		}
        return redirect('/reset')
            ->withFlashMessage('Invalid Token!')
            ->withType('success');
	}
}