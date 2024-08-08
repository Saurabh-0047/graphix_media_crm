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
                            <h4 class="box-title">Enter Service Here</h4>
                        </div>
                        @if(session('success'))
                        <span class="text-success">{{ session('success') }}</span>
                        @endif

                        <form method="POST" action="{{ route('admin.project_services.post') }}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Service</label>
                                            <input type="text" class="form-control" name="service" placeholder="Service...">
                                            @if ($errors->has('service'))
                                            <span class="text-danger">{{ $errors->first('service') }}</span>
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
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">All services</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr class="text-dark">
                                        <th>S.NO</th>
                                        <th>Service</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $service->service }}</td>
                                        <td>
                                            <a href="{{ route('admin.project_services.edit', $service->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>&nbsp;&nbsp;&nbsp;
                                            <a href="{{ route('admin.project_services.toggleStatus', $service->id) }}" class="btn {{ $service->status == 1 ? 'btn-danger' : 'btn-success' }} btn-sm">
                                                <i class="fas {{ $service->status == 1 ? 'fa-toggle-off' : 'fa-toggle-on' }}"></i>
                                                {{ $service->status == 1 ? 'Deactivate' : 'Activate' }}
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