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
                            <h4 class="box-title">Edit User</h4>
                        </div>
                        @if(session('success'))
                        <span class="text-success">{{ session('success') }}</span>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Designation</label>
                                            <select class="form-control" name="designation_id">
                                                <option value="">Select Designation</option>
                                                @foreach ($designations as $designation)
                                                <option value="{{ $designation->id }}" {{ $user->designation_id == $designation->id ? 'selected' : '' }}>
                                                    {{ $designation->designation }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">User Name</label>
                                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="User Name" value="{{ old('user_name', $user->user_name) }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">User Id</label>
                                            <input type="text" name="user_id" id="user_id" class="form-control" placeholder="User Id" value="{{ old('user_id', $user->user_id) }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">User Phone</label>
                                            <input type="text" name="user_phone" id="user_phone" class="form-control" placeholder="User Phone" value="{{ old('user_phone', $user->user_phone) }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">User Email</label>
                                            <input type="text" name="user_email" id="user_email" class="form-control" placeholder="User Email" value="{{ old('user_email', $user->user_email) }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Password (Leave blank to keep current)</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="User Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('admin.users') }}" class="btn btn-danger">Cancel</a>
                                <input type="submit" class="btn btn-info pull-right" value="Update">
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
