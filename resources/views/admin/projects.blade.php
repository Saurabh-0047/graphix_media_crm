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
                            <h4 class="box-title">All Projects</h4>
                        </div>


                        <div class="table-responsive">
                            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr class="text-dark">
                                        <th>S.NO</th>
                                        <th>Business Name</th>
                                        <th>Client Name</th>
                                        <th>Contact Number</th>
                                        <th>Email Id</th>
                                        <th>Address</th>
                                        <th>Website</th>
                                        <th>Packages</th>
                                        <th>Remarks</th>
                                        <th>Sold By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>Business Name</td>
                                        <td>Client Name</td>
                                        <td>Contact Number</td>
                                        <td>Email Id</td>
                                        <td>Address</td>
                                        <td>Website</td>
                                        <td>Packages</td>
                                        <td>Remarks</td>
                                        <td>Sold By</td>
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