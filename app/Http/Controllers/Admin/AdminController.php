<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function updateAdminPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            //check if current password enterted by admin is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                //Check if new password is matching with confirm password
                if($data['confirm_password']==$data['new_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully!');
                } else{
                    return redirect()->back()->with('error_message', 'New password and Confirm Password does not match!');
                }

            } else {
                return redirect()->back()->with('error_message', 'Your current password is incorrect!');
            }
        }

        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();

        //istekten gelen parola değerini dbde karşılaştıracak
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $rules = [
                'admin_name'=>'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile'=>'required|numeric',
            ];

            $customMessages = [
                'admin_name.required' => 'Name is required',
                'admin_name.regex' => 'Valid Name is required',
                'admin_mobile.required' => 'Valid mobile is required',
                'admin_mobile.numeric' => 'Valid mobile is required',
            ];

            $this->validate($request,$rules,$customMessages);

            //Upload admin photo
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate new image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'admin/images/photos/'.$imageName;
                    //upload the image
                    Image::make($image_tmp)->save($imagePath);
                }
            } else if(!empty($data['current_admin_image'])){
                $imageName = $data['current_admin_image'];
            } else{
                $imageName = "";
            }
            
            Admin::where('id',Auth::guard('admin')->user()->id)->update(['name'=>$data['admin_name'],'mobile'=>$data['admin_mobile'],'image'=>$imageName]);
            return redirect()->back()->with('success_message','Admin details updated successfully!');
        }
        return view('admin.settings.update_admin_details');
    }

    public function updateVendorDetails($slug, Request $request){
        if($slug=="personal"){
            if($request->isMethod('post')){
                $data = $request->all();
                //echo "<pre>"; print_r($data); die;

                $rules = [
                    'vendor_name'=>'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_city'=>'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile'=>'required|numeric',
                ];
    
                $customMessages = [
                    'vendor_name.required' => 'Name is required',
                    'vendor_city.required' => 'City is required',
                    'vendor_name.regex' => 'Valid Name is required',
                    'vendor_city.regex' => 'Valid City is required',
                    'vendor_mobile.required' => 'Valid mobile is required',
                    'vendor_mobile.numeric' => 'Valid mobile is required',
                ];
    
                $this->validate($request,$rules,$customMessages);
    
                //Upload admin photo
                if($request->hasFile('vendor_image')){
                    $image_tmp = $request->file('vendor_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate new image name
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'admin/images/photos/'.$imageName;
                        //upload the image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if(!empty($data['current_vendor_image'])){
                    $imageName = $data['current_vendor_image'];
                } else{
                    $imageName = "";
                }
                
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['name'=>$data['vendor_name'],'mobile'=>$data['vendor_mobile'],'image'=>$imageName]);
                //update in vendors table
                Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update(['name'=>$data['vendor_name'],'mobile'=>$data['vendor_mobile'],'address'=>$data['vendor_address'],'city'=>$data['vendor_city'],'state'=>$data['vendor_state'],'country'=>$data['vendor_country'],'pincode'=>$data['vendor_pincode']]);
                return redirect()->back()->with('success_message','Vendor details updated successfully!');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        } else if($slug=="business"){

            if($request->isMethod('post')){
                $data = $request->all();
                //echo "<pre>"; print_r($data); die;

                $rules = [
                    'shop_name'=>'required|regex:/^[\pL\s\-]+$/u',
                    'shop_city'=>'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile'=>'required|numeric',
                    'address_proof'=>'required',
                ];
    
                $customMessages = [
                    'shop_name.required' => 'Name is required',
                    'shop_city.required' => 'City is required',
                    'shop_name.regex' => 'Valid Name is required',
                    'shop_city.regex' => 'Valid City is required',
                    'shop_mobile.required' => 'Valid mobile is required',
                    'shop_mobile.numeric' => 'Valid mobile is required',
                ];
    
                $this->validate($request,$rules,$customMessages);
    
                //Upload admin photo
                if($request->hasFile('address_proof_image')){
                    $image_tmp = $request->file('address_proof_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate new image name
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'admin/images/proofs/'.$imageName;
                        //upload the image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if(!empty($data['current_address_proof'])){
                    $imageName = $data['current_address_proof'];
                } else{
                    $imageName = "";
                }
                
                //update in vendors business details table
                VendorsBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(['shop_name'=>$data['shop_name'],'shop_mobile'=>$data['shop_mobile'],'shop_address'=>$data['shop_address'],'shop_city'=>$data['shop_city'],'shop_state'=>$data['shop_state'],'shop_country'=>$data['shop_country'],'shop_pincode'=>$data['shop_pincode'],'business_license_number'=>$data['business_license_number'],'gst_number'=>$data['gst_number'],'pan_number'=>$data['pan_number'],'address_proof'=>$data['address_proof'],'address_proof_image'=>$imageName]);
                return redirect()->back()->with('success_message','Vendor details updated successfully!');
            }
            $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        } else if($slug=="bank"){
            if($request->isMethod('post')){
                $data = $request->all();
                //echo "<pre>"; print_r($data); die;

                $rules = [
                    'account_holder_name'=>'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name'=>'required|regex:/^[\pL\s\-]+$/u',
                    'account_number'=>'required|numeric',
                    'bank_ifsc_code'=>'required',
                ];
    
                $customMessages = [
                    'account_holder_name.required' => 'Account Holder Name is required',
                    'account_holder_name.regex' => 'Valid Account Holder Name is required',
                    'bank_name.required' => 'Bank Name is required',
                    'account_number.required' => 'Valid Account Number is required',
                    'account_number.numeric' => 'Valid Account Number is required',
                    'bank_ifsc_code.required' => 'Bank IFSC Code is required',
                ];
    
                $this->validate($request,$rules,$customMessages);
    
                //update in vendors bank details table
                VendorsBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(['account_holder_name'=>$data['account_holder_name'],'bank_name'=>$data['bank_name'],'account_number'=>$data['account_number'],'bank_ifsc_code'=>$data['bank_ifsc_code']]);
                return redirect()->back()->with('success_message','Vendor details updated successfully!');
            }
            $vendorDetails = VendorsBankDetail::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }

        return view('admin.settings.update_vendor_details')->with(compact('slug','vendorDetails'));
    }

    public function login(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required',
            ];

            $this->validate($request, $rules, $customMessages);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid email or password');
            }
        }

        return view('admin.login');
    }

    public function admins($type=null){
        $admins = Admin::query();
        //url de type değeri geliyorsa /vendor /subadmins gibi
        if(!empty($type)){
            $admins = $admins->where('type',$type);
            $title = ucfirst($type)."s"; //gelen type'ı ilk harfi büyük olarak yaz örn: Vendor
        } else{
            $title = "All Admins/Subadmins/Vendors";
        }
        $admins = $admins->get()->toArray();
        return view('admin.admins.admins')->with(compact('admins','title'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
