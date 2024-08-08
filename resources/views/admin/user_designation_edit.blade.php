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
                            <h4 class="box-title">Update Designation Here</h4>
                        </div>
                        @if(session('success'))
                        <span class="text-success">{{ session('success') }}</span>
                        @endif

                        <form method="POST" action="{{ route('admin.user_designation.update', $designations->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Designation</label>
                                            <input type="text" class="form-control" name="designation" placeholder="Designation..." value="{{ old('designation', $designations->designation) }}">
                                            @if ($errors->has('designation'))
                                            <span class="text-danger">{{ $errors->first('designation') }}</span>
                                            @endif
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