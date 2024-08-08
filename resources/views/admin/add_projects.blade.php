<!DOCTYPE html>
<html>
@include('admin.includes.head')

<body>
    @include('admin.includes.header')
    @include('admin.includes.sidemenu')
    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="row">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Add New Project Here</h4>
                        </div>
                        @if(session('success'))
                        <span class="text-success">{{ session('success') }}</span>
                        @endif

                        <form method="POST" action="{{ route('admin.add_project.post') }}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Business Name</label>
                                            <input type="text" class="form-control" name="business_name" placeholder="Business Name..." value="{{ old('business_name') }}">
                                            @if ($errors->has('business_name'))
                                            <span class="text-danger">{{ $errors->first('business_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Client Name</label>
                                            <input type="text" class="form-control" name="client_name" placeholder="Client Name..." value="{{ old('client_name') }}">
                                            @if ($errors->has('client_name'))
                                            <span class="text-danger">{{ $errors->first('client_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>


                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Select Services:</label><br>

                                            <div class="container">
                                                <div class="row">
                                                    @foreach ($services as $service)
                                                    <div class="col-md-3">
                                                        @php
                                                        // Get the previously submitted values for the checkboxes
                                                        $checkedValues = old('packages', []);
                                                        // Check if the current service should be checked
                                                        $isChecked = in_array($service->service, $checkedValues);
                                                        @endphp
                                                        <input type="checkbox" id="checkbox_{{$service->id}}" name="packages[]" class="chk-col-primary" value="{{$service->service}}" {{ $isChecked ? 'checked' : '' }} />
                                                        <label for="checkbox_{{$service->id}}" class="label_text">{{$service->service}}</label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @if ($errors->has('packages'))
                                                <span class="text-danger">{{ $errors->first('packages') }}</span>
                                                @endif
                                            </div>


                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Contact Number</label>
                                            <input type="text" class="form-control" name="contact_no" placeholder="Contact Number..." value="{{ old('contact_no') }}">
                                            @if ($errors->has('contact_no'))
                                            <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Email Id</label>
                                            <input type="text" class="form-control" name="email_id" placeholder="Email Id..." value="{{ old('email_id') }}">
                                            @if ($errors->has('email_id'))
                                            <span class="text-danger">{{ $errors->first('email_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address..." value="{{ old('address') }}">
                                            @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Website</label>
                                            <input type="text" class="form-control" name="website" placeholder="Website..." value="{{ old('website') }}">
                                            @if ($errors->has('website'))
                                            <span class="text-danger">{{ $errors->first('website') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Project Remarks</label>
                                            <textarea class="form-control" name="remarks" placeholder="Project Remarks...">{{ old('remarks') }}</textarea>
                                            @if ($errors->has('remarks'))
                                            <span class="text-danger">{{ $errors->first('remarks') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Sold By</label>
                                            <select class="form-control" name="sold_by_id">
                                                <option value="">Select User</option>
                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ old('sold_by_id') == $user->id ? 'selected' : '' }}>{{ $user->user_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('sold_by_id'))
                                            <span class="text-danger">{{ $errors->first('sold_by_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Assigned To</label>
                                            @foreach ($users as $user)
                                            @if ($user->designation_id != 8)
                                            <div class="col-md-3">
                                                @php
                                                // Get the previously submitted values for the checkboxes
                                                $assignedToValues = old('assigned_to', []);
                                                // Check if the current user should be checked
                                                $isChecked = in_array($user->id, $assignedToValues);
                                                @endphp
                                                <input type="checkbox" id="assigned_{{$user->id}}" name="assigned_to[]" class="chk-col-primary" value="{{$user->id}}" {{ $isChecked ? 'checked' : '' }} />
                                                <label for="assigned_{{$user->id}}" class="label_text">{{$user->user_name}}</label>
                                            </div>
                                            @endif
                                            @endforeach
                                            @if ($errors->has('assigned_to'))
                                            <span class="text-danger">{{ $errors->first('assigned_to') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger">Cancel</button>
                        <input type="submit" name="sub" class="btn btn-info pull-right" value="Submit">
                    </div>
                    </form>
                </div>
        </div>
        </section>
    </div>
    </div>
    @include('admin.includes.footer')
    @include('admin.includes.js')
</body>

</html>