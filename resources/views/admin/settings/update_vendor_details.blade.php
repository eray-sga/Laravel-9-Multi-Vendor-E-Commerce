@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Update Vendor Details</h3>
                            {{-- <h6 class="font-weight-normal mb-0">Update Admin Password</h6> --}}
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">January - March</a>
                                        <a class="dropdown-item" href="#">March - June</a>
                                        <a class="dropdown-item" href="#">June - August</a>
                                        <a class="dropdown-item" href="#">August - November</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($slug=="personal")
                
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Personal Information</h4>
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error: </strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success: </strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                  @endforeach
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                            @endif

                            <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Vendor Username/Email</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="vendor_name">Name</label>
                                    <input type="text" class="form-control" id="vendor_name"
                                        placeholder="Enter Name" name="vendor_name" value="{{$vendorDetails['name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_address">Address</label>
                                    <input type="text" class="form-control" id="vendor_address"
                                        placeholder="Enter Address" name="vendor_address" value="{{$vendorDetails['address']}}">
                                </div>
                                <div class="form-group">
                                    <label for="admin_city">City</label>
                                    <input type="text" class="form-control" id="vendor_city"
                                        placeholder="Enter City" name="vendor_city" value="{{$vendorDetails['city']}}" maxlength="10" minlength="10">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_state">State</label>
                                    <input type="text" class="form-control" id="vendor_state"
                                        placeholder="Enter State" name="vendor_state" value="{{$vendorDetails['state']}}">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_country">Country</label>
                                    <input type="text" class="form-control" id="vendor_country"
                                        placeholder="Enter Country" name="vendor_country" value="{{$vendorDetails['country']}}">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_pincode">Pincode</label>
                                    <input type="text" class="form-control" id="vendor_pincode"
                                        placeholder="Enter Pincode" name="vendor_pincode" value="{{$vendorDetails['pincode']}}">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_pincode">Mobile</label>
                                    <input type="text" class="form-control" id="vendor_mobile"
                                        placeholder="Enter Mobile" name="vendor_mobile" value="{{$vendorDetails['mobile']}}">
                                </div>
                                <div class="form-group">
                                    <label for="admin_image">Photo</label>
                                    <input type="file" class="form-control" id="admin_image"
                                         name="admin_image">
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                        <a target="_blank" href="{{url('admin/images/photos/'.Auth::guard('admin')->user()->image)}}">View Image</a>
                                        <input type="hidden" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}">
                                    @endif
                                </div>
                                
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            @elseif($slug=="business")
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Business Information</h4>
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error: </strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success: </strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                  @endforeach
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                            @endif

                            <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Vendor Username/Email</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="shop_name">Shop Name</label>
                                    <input type="text" class="form-control" id="shop_name"
                                        placeholder="Enter Shop Name" name="shop_name" value="{{$vendorDetails['shop_name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="shop_address">Shop Address</label>
                                    <input type="text" class="form-control" id="shop_address"
                                        placeholder="Enter Shop Address" name="shop_address" value="{{$vendorDetails['shop_address']}}">
                                </div>
                                <div class="form-group">
                                    <label for="shop_city">Shop City</label>
                                    <input type="text" class="form-control" id="shop_city"
                                        placeholder="Enter Shop City" name="shop_city" value="{{$vendorDetails['shop_city']}}" maxlength="10" minlength="10">
                                </div>
                                <div class="form-group">
                                    <label for="shop_state">Shop State</label>
                                    <input type="text" class="form-control" id="shop_state"
                                        placeholder="Enter Shop State" name="shop_state" value="{{$vendorDetails['shop_state']}}">
                                </div>
                                <div class="form-group">
                                    <label for="shop_country">Shop Country</label>
                                    <input type="text" class="form-control" id="shop_country"
                                        placeholder="Enter Shop Country" name="shop_country" value="{{$vendorDetails['shop_country']}}">
                                </div>
                                <div class="form-group">
                                    <label for="shop_pincode">Shop Pincode</label>
                                    <input type="text" class="form-control" id="shop_pincode"
                                        placeholder="Enter Shop Pincode" name="shop_pincode" value="{{$vendorDetails['shop_pincode']}}">
                                </div>
                                <div class="form-group">
                                    <label for="shop_pincode">Shop Mobile</label>
                                    <input type="text" class="form-control" id="shop_mobile"
                                        placeholder="Enter Shop Mobile" name="shop_mobile" value="{{$vendorDetails['shop_mobile']}}">
                                </div>
                                <div class="form-group">
                                    <label for="business_license_number">Business License Number</label>
                                    <input type="text" class="form-control" id="business_license_number"
                                        placeholder="Enter Business License Number" name="business_license_number" value="{{$vendorDetails['business_license_number']}}">
                                </div>
                                <div class="form-group">
                                    <label for="gst_number">GST Number</label>
                                    <input type="text" class="form-control" id="gst_number"
                                        placeholder="Enter GST Number" name="gst_number" value="{{$vendorDetails['gst_number']}}">
                                </div>
                                <div class="form-group">
                                    <label for="pan_number">PAN Number</label>
                                    <input type="text" class="form-control" id="pan_number"
                                        placeholder="Enter PAN Number" name="pan_number" value="{{$vendorDetails['pan_number']}}">
                                </div>
                                <div class="form-group">
                                    <label for="address_proof">Address Proof</label>
                                    <select class="form-control" name="address_proof" id="address_proof">
                                        <option value="Passport" @if ($vendorDetails['address_proof']=='Passport') selected @endif>Passport</option>
                                        <option value="Voting Card" @if ($vendorDetails['address_proof']=='Voting Card') selected @endif>Voting Card</option>
                                        <option value="Pan" @if ($vendorDetails['address_proof']=='Pan') selected @endif>Pan</option>
                                        <option value="Driving Licence" @if ($vendorDetails['address_proof']=='Driving License') selected @endif>Driving Licence</option>
                                        <option value="Aadhar card" @if ($vendorDetails['address_proof']=='Aadhar Card') selected @endif>Aadhar Card</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address_proof_image">Address Proof Image</label>
                                    <input type="file" class="form-control" id="address_proof_image"
                                         name="address_proof_image">
                                    @if (!empty($vendorDetails['address_proof_image']))
                                        <a target="_blank" href="{{url('admin/images/proofs/'.$vendorDetails['address_proof_image'])}}">View Image</a>
                                        <input type="hidden" name="current_address_proof" value="{{ $vendorDetails['address_proof_image'] }}">
                                    @endif
                                </div>
                                
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            @elseif($slug=="bank")
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Bank Information</h4>
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error: </strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success: </strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                  @endforeach
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                            @endif

                            <form class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Vendor Username/Email</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="account_holder_name">Account Holder Name</label>
                                    <input type="text" class="form-control" id="account_holder_name"
                                        placeholder="Enter Account Holder Name" name="account_holder_name" value="{{$vendorDetails['account_holder_name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name"
                                        placeholder="Enter Bank Name" name="bank_name" value="{{$vendorDetails['bank_name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input type="text" class="form-control" id="account_number"
                                        placeholder="Enter Account Number" name="account_number" value="{{$vendorDetails['account_number']}}" maxlength="10" minlength="10">
                                </div>
                                <div class="form-group">
                                    <label for="bank_ifsc_code">Bank IFSC Code</label>
                                    <input type="text" class="form-control" id="bank_ifsc_code"
                                        placeholder="Enter Bank IFSC Code" name="bank_ifsc_code" value="{{$vendorDetails['bank_ifsc_code']}}">
                                </div>
                                
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            @endif
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection
