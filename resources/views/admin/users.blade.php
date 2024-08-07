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
                            <h4 class="box-title">Enter Users Here</h4>
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

                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Designation</label>
                                            <select class="form-control" name="designation_id">
                                                <option value="">Select Designation</option>
                                                @foreach ($designations as $designation)
                                                <option value="{{ $designation->id }}" {{ old('designation_id') == $designation->id ? 'selected' : '' }}>
                                                    {{ $designation->designation }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">User Name</label>
                                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="User Name" value="{{ old('user_name') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">User Id</label>
                                            <input type="text" name="user_id" id="user_id" class="form-control" placeholder="User Id" value="{{ old('user_id') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">User Phone</label>
                                            <input type="text" name="user_phone" id="user_phone" class="form-control" placeholder="User Phone" value="{{ old('user_phone') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">User Email</label>
                                            <input type="text" name="user_email" id="user_email" class="form-control" placeholder="User Email" value="{{ old('user_email') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="User Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('admin.users') }}" class="btn btn-danger">Cancel</a>
                                <input type="submit" class="btn btn-info pull-right" value="Submit">
                            </div>
                        </form>

                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">All Users</h4>
                        </div>


                        <div class="table-responsive">
                            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr class="text-dark">
                                        <th>S.NO</th>
                                        <th>Designation</th>
                                        <th>User Name</th>
                                        <th>User Id</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($user_details as $users)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $users->designation->designation ?? 'N/A' }}</td>
                                        <td>{{ $users->user_name }}</td>
                                        <td>{{ $users->user_id }}</td>
                                        <td>{{ $users->user_email }}</td>
                                        <td>{{ $users->user_phone }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $users->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>&nbsp;&nbsp;&nbsp;
                                            <a href="{{ route('admin.users.toggleStatus', $users->id) }}" class="btn {{ $users->status == 1 ? 'btn-warning' : 'btn-success' }} btn-sm">
                                                <i class="fas {{ $users->status == 1 ? 'fa-toggle-off' : 'fa-toggle-on' }}"></i>
                                                {{ $users->status == 1 ? 'Deactivate' : 'Activate' }}
                                            </a>


                                        </td>


                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @include('admin.includes.footer')
    @include('admin.includes.js')
</body>

</html>