<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Image;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\VendorsBankDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\VendorsBusinessDetail;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function updateAdminPassword(Request $request)
    {
        //echo "<pre>"; print_r(Auth::guard('admin')->user()); die;

        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            //check if current password entered by admin is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                //check if the new password is matching with confirm password
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully!');
                } else {
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password is not Match');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your Current Password is Icorrect!');
            }
        }

        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;

        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateAdminDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
            ];

            $customMessages = [
                'admin_name.required' => 'Name is Required',
                'admin_name.regex' => 'Valid Name is Required',
                'admin_mobile.required' => 'Mobile is Required',
                'admin_mobile.numeric' => 'Valid Mobile is Required',
            ];

            $this->validate($request, $rules, $customMessages);
            //uploade admin photo
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                if ($image_tmp->isValid()) {
                    //get imgae extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //generate new image
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/images/photos/' . $imageName;
                    //upload the image
                    Image::make($image_tmp)->save($imagePath);
                }
            } else if (!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            } else {
                $imageName = "";
            }

            //update Admin details
            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name' => $data['admin_name'],
                'mobile' => $data['admin_mobile'], 'image' => $imageName
            ]);
            return redirect()->back()->with('success_message', 'Admin Details updated successfully!');
        }

        return view('admin.settings.update_admin_details');
    }

    public function updateVendorDetails(Request $request, $slug)
    {
        if ($slug == "personal") {
            if ($request->isMethod('post')) {
                $data = $request->all();
                //echo "<pre>"; print_r($data); die;

                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|numeric',
                ];

                $customMessages = [
                    'vendor_name.required' => 'Name is Required',
                    'vendor_city.required' => 'Name is Required',
                    'vendor_name.regex' => 'Valid Name is Required',
                    'vendor_city.regex' => 'Valid City is Required',
                    'vendor_mobile.required' => 'Mobile is Required',
                    'vendor_mobile.numeric' => 'Valid Mobile is Required',
                ];

                $this->validate($request, $rules, $customMessages);
                //uploade admin photo
                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        //get imgae extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //generate new image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/images/photos/' . $imageName;
                        //upload the image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = "";
                }

                //update in Admin table
                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'name' => $data['vendor_name'],
                    'mobile' => $data['vendor_mobile'], 'image' => $imageName
                ]);
                //update in Vendor table
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update([
                    'name' => $data['vendor_name'],
                    'mobile' => $data['vendor_mobile'],
                    'address' => $data['vendor_address'],
                    'city' => $data['vendor_city'],
                    'state' => $data['vendor_state'],
                    'country' => $data['vendor_country'],
                    'pincode' => $data['vendor_pincode'],
                ]);

                return redirect()->back()->with('success_message', 'Vendor Details updated successfully!');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        } else if ($slug == "business") {
            if ($request->isMethod('post')) {
                $data = $request->all();
                //echo "<pre>"; print_r($data); die;

                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                    'address_proof' => 'required',
                    'address_proof_image' => 'required|image',
                ];

                $customMessages = [
                    'shop_name.required' => 'Name is Required',
                    'shop_city.required' => 'Name is Required',
                    'shop_name.regex' => 'Valid Name is Required',
                    'shop_city.regex' => 'Valid City is Required',
                    'shop_mobile.required' => 'Mobile is Required',
                    'shop_mobile.numeric' => 'Valid Mobile is Required',
                    'address_proof.required' => 'Address Proof is Required',
                    'address_proof_image.required' => 'Address Proof Image is Required',
                    'address_proof_image.image' => 'Address Proof Image is Required',
                ];

                $this->validate($request, $rules, $customMessages);
                //uploade Address proof image
                if ($request->hasFile('address_proof_image')) {
                    $image_tmp = $request->file('address_proof_image');
                    if ($image_tmp->isValid()) {
                        //get imgae extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //generate new image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/images/proofs/' . $imageName;
                        //upload the image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_address_proof_image'])) {
                    $imageName = $data['current_address_proof_image'];
                } else {
                    $imageName = "";
                }

                //update in Vendor Business  table
                VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                    'shop_name' => $data['shop_name'],
                    'shop_mobile' => $data['shop_mobile'],
                    'shop_address' => $data['shop_address'],
                    'shop_city' => $data['shop_city'],
                    'shop_state' => $data['shop_state'],
                    'shop_country' => $data['shop_country'],
                    'shop_pincode' => $data['shop_pincode'],
                    'shop_website' => $data['shop_website'],
                    'business_license_number' => $data['business_license_number'],
                    'gst_number' => $data['gst_number'],
                    'pan_number' => $data['pan_number'],
                    'address_proof' => $data['address_proof'],
                    'address_proof_image' => $imageName,
                ]);

                return redirect()->back()->with('success_message', 'Vendor Details updated successfully!');
            }
            $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        } else if ($slug == "bank") {
            if ($request->isMethod('post')) {
                $data = $request->all();
                //echo "<pre>"; print_r($data); die;

                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required',
                    'account_number' => 'required|numeric',
                    'bank_ifsc_code' => 'required',
                ];

                $customMessages = [
                    'account_holder_name.required' => 'Account Holder Name is Required',
                    'account_holder_name.regex' => 'Valid Account Holder Name is Required',
                    'bank_name.required' => 'Bank Name is Required',
                    'account_number.required' => 'Account Number is Required',
                    'account_number.numeric' => 'Account Number is Required',
                    'bank_ifsc_code.required' => 'Bank IFSC Code is Required',
                ];

                $this->validate($request, $rules, $customMessages);

                //update in Vendor Bank Details  table
                VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                    'account_holder_name' => $data['account_holder_name'],
                    'bank_name' => $data['bank_name'],
                    'account_number' => $data['account_number'],
                    'bank_ifsc_code' => $data['bank_ifsc_code'],
                ]);

                return redirect()->back()->with('success_message', 'Vendor Bank Details Details updated successfully!');
            }
            $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }
        return view('admin.settings.update_vendor_details')->with(compact('slug', 'vendorDetails'));
    }

    public function login(Request $request)
    {
        //echo $password = Hash::make('123456');
        if ($request->isMethod('post')) {
            $data = $request->all();
            /* echo "<pre>";
            print_r($data);
            die; */

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                'email.required' => 'Email is required!',
                'email.email' => 'valid Email is required!',
                'password.required' => 'Password is required!',
            ];

            $this->validate($request, $rules, $customMessages);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email Or Password');
            }
        }

        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
