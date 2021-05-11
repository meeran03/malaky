<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckRequest;
use App\Http\Requests\CodeRequest;
use App\Http\Requests\ForgetRequest;
use App\Http\Requests\ImagesRequest;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\SittersRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Http\Requests\UpdatePhoneCheckRequest;
use App\Http\Requests\UpdatePhoneRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateApiRequest;
use App\Models\Distance;
use App\Models\Image;
use App\Http\Resources\UserProfile;
use App\Http\Resources\Sitter as SitterResource;
use App\Http\Resources\Image as ImageResource;
use App\Http\Resources\UserResource;
use App\Models\SendSms;
use App\Notifications\AccountNotification;
use App\Notifications\UserRegisterCode;
use App\Notifications\UserRegisterNotifyAdmin;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Notification as NotificationResource;
use Illuminate\Support\Facades\File;
use Notification;

class UserController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 400;

    public function register(UserRequest $request)
    {
        $data = $request->except( 'password');
        $data['password'] = bcrypt($request->password);
        $data['verification_code'] = random_int(1000, 9999);
        $msg = api_msg($request , 'تم التسجيل بنجاح برجاء تأكيد كود التفعيل' ,'Registration was successful. Please confirm the activation code');
        $user = User::updateOrCreate($data);
        $user->token=  $user->createToken('MyApp')->accessToken;
//        $phone = $user->phone_key . substr($user->phone, 1);
        $phone = $user->phone;
        SendSms::Send($phone, $msg. $user->verification_code);
        Notification::send(app_admins() , new UserRegisterNotifyAdmin($user));
        return response()->json(api_response( 1 , $msg , new UserResource($user)), $this-> successStatus);
    }

    public function login( UserLoginRequest $request)
    {
//        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
        if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){
            $user = Auth::user();
            $block = User::block($request , $user->id , $user->type_id);
            if(!empty($block)){ return $block;}
            $user->update(['ip' => request()->ip()]);
            $user->token=  $user->createToken('MyApp')->accessToken;
            return response()->json(api_response( 1 , '' , new UserResource($user)), $this-> successStatus);
        }
        else{
            $msg = api_msg($request , 'بيانات الدخول غير صحيحة' ,'The login information is incorrect');
            return response()->json(api_response( 0 , $msg ), 401);
        }
    }

    public function code(CodeRequest $request)
    {
        $user = User::wherePhone($request->phone)->firstOrFail();
        $user->update(['verification_code' => random_int(1000, 9999)]);
        $msg = api_msg($request , 'إعادة تأكيد كود التفعيل' ,'Reconfirm the activation code');
//        $phone = $user->phone_key . substr($user->phone, 1);
        $phone = $user->phone;
        SendSms::Send($phone, $msg. $user->verification_code);
        return response()->json(api_response( 1 , $msg), $this-> successStatus);
    }

    public function check(CheckRequest $request)
    {
        $user = User::wherePhone($request->phone)->firstOrFail();
        if($user->verification_code == $request->verification_code){
            $user ->update([
                'phone_verified_at' => Carbon::now() ,
                'is_active' => 1,
//                'verification_code' => null
                ]);
            $msg = api_msg($request , 'تم تأكيد كود التفعيل بنجاح' ,'The activation code has been confirmed successfully');
            return response()->json(api_response( 1 , $msg), $this-> successStatus);
        }
        else{
            $msg = api_msg($request , 'كود التفعيل غير صحيح' ,'invalid verification code');
            return response()->json(api_response( 0 , $msg), $this-> errorStatus);
        }

    }

    public function reset(ResetRequest $request)
    {
        $user = Auth::user();
        $user->update(['password' => bcrypt($request->password)]);
        $msg = api_msg($request , 'تم إعادة تعيين كلمة المرور بنجاح' ,'successfully Reset Password');
        return response()->json(api_response( 1 , $msg), $this-> successStatus);
    }

    public function forget(ForgetRequest $request)
    {
        $user = User::wherePhone($request->phone)->firstOrFail();
        if($user->verification_code == $request->verification_code){
            $user ->update([
                'email_verified_at' => Carbon::now() ,
                'is_active' => 1,
                'password' => bcrypt($request->password),
                'verification_code' => null
            ]);
            $msg = api_msg($request , 'تم إعادة تعيين كلمة المرور بنجاح' ,'successfully Reset Password');
            return response()->json(api_response( 1 , $msg), $this-> successStatus);
        }
        else{
            $msg = api_msg($request , 'كود التفعيل غير صحيح' ,'invalid verification code');
            return response()->json(api_response( 0 , $msg), $this-> errorStatus);
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return response()->json(api_response( 1 , '' , new UserProfile($user)), $this-> successStatus);
    }

    public function update(UserUpdateApiRequest $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $user->update($data);
        $msg = api_msg($request , 'تم تحديث البيانات بنجاح' ,'The data has been successfully updated');
        return response()->json(api_response( 1 , $msg , new UserProfile($user)), $this-> successStatus);
    }


    public function notifications()
    {
        $user = Auth::user();
        $notifications = $user  -> notifications->toArray();
        $user  -> notifications->markAsRead();
        return response()->json(api_response( 1 , '' , NotificationResource::collection($notifications)), $this-> successStatus);
    }


    public function deleteNotifications(Request $request , $id)
    {
        Auth::user()-> notifications()->where('data->notify_id', $id)->firstOrFail()->delete();
        $msg = api_msg($request , 'تم حذف الإشعار بنجاح' ,'The notification has been successfully deleted');
        return response()->json(api_response( 1 , $msg ), $this-> successStatus);
    }

    public function show( $id )
    {
        $user = User::where(['id'=>$id , 'is_active'=>1])->firstOrFail();
        $auth = Auth::user();
        $from_lat   = $auth->currentAddress->lat ?? 0;
        $from_long  = $auth->currentAddress->long ?? 0;
        $to_lat = $user->currentAddress->lat ?? 0;
        $to_long = $user->currentAddress->long ?? 0;
        $distance = Distance::calc($from_lat,$from_long,$to_lat,$to_long,"K") ?? 0 ;
        $user['distance'] = round( $distance , 2);
        return response()->json(api_response( 1 , '' , new UserProfile($user)), $this-> successStatus);
    }

    public function logoutApi(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user() ;
            $user->device_token = "";
            $user->device_type = "";
            $user->save();
            $user->AauthAcessToken()->delete();
            $msg = api_msg($request , 'تم تسجيل الخروج بنجاح' ,'successfully Logout');
            return response()->json(api_response( 1 , $msg), $this-> successStatus);
        }
    }

    public function sitters(SittersRequest $request)
    {
        $from_lat   = $request->lat;
        $from_long  = $request->long;
        $sitters = User::where(['type_id'=>2 , 'is_active'=>1])->get();
        if ($request->type == 'rate'){
            $sitters = $sitters->sortByDesc('rate');
        }else{
            $sitters->map(function($item) use($from_lat , $from_long) {
                $to_lat = $item->currentAddress->lat ?? 0;
                $to_long = $item->currentAddress->long ?? 0;
                $item['distance'] = Distance::calc($from_lat,$from_long,$to_lat,$to_long,"K") ;
                return $item;
            });
            $sitters = $sitters->sortBy('distance');
        }
        return response()->json(api_response( 1 , '' , SitterResource::collection($sitters)), $this-> successStatus);
    }

    public function sittersShow(SittersRequest $request , $id)
    {

        $user = User::where(['id'=>$id , 'is_active'=>1 ,'type_id'=>2])->firstOrFail();
        $from_lat   = $request->lat ?? 0;
        $from_long  = $request->long ?? 0;
        $to_lat = $user->currentAddress->lat ?? 0;
        $to_long = $user->currentAddress->long ?? 0;
        $distance = Distance::calc($from_lat,$from_long,$to_lat,$to_long,"K") ?? 0 ;
        $user['distance'] = round( $distance , 2);
        return response()->json(api_response( 1 , '' , [ 'sitter' => new UserProfile($user) , 'images' =>ImageResource::collection($user->images) ]), $this-> successStatus);

    }
    public function search(Request $request)
    {
        $sitters = User::where(['type_id'=>2 , 'is_active'=>1])->where('name' , 'LIKE' ,'%' . $request->name . '%')->get();
        return response()->json(api_response( 1 , '' , SitterResource::collection($sitters)), $this-> successStatus);
    }
    public function storeImg($request)
    {
        $file = $request->file('image');
        $filepath = 'images/users/'.date('Y').'/'.date('m').'/';
        $filename = $filepath.time().'-'.mb_strtolower(preg_replace('/\s+/', '-', $file->getClientOriginalName()));
        $file->move($filepath, $filename);
        return $filename;
    }
    public function uploadImage(Request $request)
    {
        $user = Auth::user();
        $image = $this->storeImg($request);
        if($image){
            if ($user->image != null){
                $oldpath = $user->image ;
                if(File::exists($oldpath)){unlink($oldpath);}
            }
            $user->update([
                'image'       => $image ,
            ]);
            $notify_ar = "تم تعديل صورة البروفايل " ;
            $notify_en = 'Profile picture has been modified';
            $msg = api_msg($request , $notify_ar ,$notify_en);
            Notification::send($user, new AccountNotification( $notify_ar , $notify_en ));
            return response()->json(api_response( 1 , $msg , new UserProfile($user)), $this-> successStatus);
        }
        else{
            $msg = api_msg($request , 'يوجد خطأ في البيانات يرجي المحاولة في وقت لاحق' ,'There is an error in the data, please try again later');
            return response()->json(api_response( 0 , $msg ), $this->errorStatus);
        }
    }
    public function location( LocationRequest $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $user->currentAddress()->updateOrCreate([],$data);
        $notify_ar = "تم تحديث العنوان بنجاح " ;
        $notify_en = 'The Location has been successfully updated ';
        $msg = api_msg($request , $notify_ar ,$notify_en);
        return response()->json(api_response( 1 , $msg , new UserProfile($user)), $this-> successStatus);
    }

    public function updatePhone(UpdatePhoneRequest $request)
    {
        $user = Auth::user();
        $user->newPhone()->updateOrCreate([],[
            'phone'             => $request->phone,
            'verification_code' => random_int(1000, 9999)
        ]);
        $msg = api_msg($request , 'تم إرسال كود التفعيل' ,'The Verification Code Sent');
//        $phone = $user->phone_key . substr($user->newPhone->phone, 1);
        $phone = $user->newPhone->phone;
        SendSms::Send($phone, $msg. $user->newPhone->verification_code);
        return response()->json(api_response( 1 , $msg), $this-> successStatus);
    }

    public function updatePhoneCheck(updatePhoneCheckRequest $request)
    {
        $user = Auth::user();
        if($user->newPhone->phone == $request->phone && $user->newPhone->verification_code == $request->verification_code){
            $user ->update([
                'phone_verified_at' => Carbon::now() ,
                'phone' => $request->phone ,
                'verification_code' => null
            ]);
            $user->newPhone->delete();
            $notify_ar = 'تم تحديث رقم الجوال بنجاح' ;
            $notify_en = 'Mobile number has been successfully updated';
            $msg = api_msg($request , $notify_ar ,$notify_en);
            Notification::send($user, new AccountNotification( $notify_ar , $notify_en ));
            return response()->json(api_response( 1 , $msg , new UserProfile($user)), $this-> successStatus);
        }
        else{
            $msg = api_msg($request , 'كود التفعيل غير صحيح' ,'invalid verification code');
            return response()->json(api_response( 0 , $msg), $this-> errorStatus);
        }

    }

    public function storeImages($file)
    {
        $filepath = 'images/cuddling/'.date('Y').'/'.date('m').'/';
        $filename = $filepath.time().'-'.mb_strtolower(preg_replace('/\s+/', '-', $file->getClientOriginalName()));
        $file->move($filepath, $filename);
        return $filename;
    }

    public function images( ImagesRequest $request)
    {
        $user = User::where(['is_active' => 1 , 'id' => $request->user_id , 'type_id' => 2])->firstOrFail();
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $cuddling = $this->storeImages($image);
                $user->images()->updateOrCreate([
                    'url' => $cuddling,
                ]);
            }
            $notify_ar = "تم رفع صور مكان الإحتضان بنجاح ";
            $notify_en = 'The images has been successfully uploaded ';
            Notification::send($user, new AccountNotification( $notify_ar, $notify_en));
        }elseif ($request->hasfile('image')) {
            $cuddling = $this->storeImages($request->image);
            $user->images()->updateOrCreate([
                'url' => $cuddling,
            ]);
            $notify_ar = "تم رفع صور مكان الإحتضان بنجاح ";
            $notify_en = 'The images has been successfully uploaded ';
            Notification::send($user, new AccountNotification( $notify_ar, $notify_en));
        } else{
            $notify_ar = 'صور مكان الإحتضان' ;
            $notify_en = 'Photos of the cuddling place';
        }
        $msg = api_msg($request, $notify_ar, $notify_en);
        return response()->json(api_response( 1 , $msg , ImageResource::collection($user->images)), $this-> successStatus);
    }

    public function imagesDelete(Request $request)
    {
        $user = Auth::user();
        $image = Image::where(['user_id'=>$user->id,'id'=>$request->id])->firstOrFail();
        $url  = public_path($image->url);
        if(is_file($url)){File::delete($url);}
        $image->delete();
        $notify_ar = 'تم حذف الصورة بنجاح' ;
        $notify_en = 'The Image deleted successfully';
        $msg = api_msg($request, $notify_ar, $notify_en);
        return response()->json(api_response( 1 , $msg , ImageResource::collection($user->images)), $this-> successStatus);
    }

    public function updateDeviceToken(UpdateDeviceRequest $request)
    {
        $user = Auth::user();
        $user->device_token =$request->device_token;
        $user->device_type = $request->device_type ?? "";
        $user->save();
        $msg = api_msg($request , 'تم تحديث رمز الجهاز' ,'The device token has been updated');
        return response()->json(api_response( 1 , $msg), $this-> successStatus);
    }
}
