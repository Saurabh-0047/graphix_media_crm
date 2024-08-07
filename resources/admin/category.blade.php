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
                            <h4 class="box-title">Enter Details Here</h4>
                        </div>
                        <form method="POST" action="{{ route('admin.category.post') }}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Category Name</label>
                                            <input type="text" class="form-control" name="category" placeholder="Category Name...">
                                            @if ($errors->has('category'))
                                            <span class="text-danger">{{ $errors->first('category') }}</span>
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
                            <h4 class="box-title">All Categories</h4>
                        </div>
                        
                        <div class="table-responsive">
                            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr class="text-dark">
                                        <td>S.NO</td>
                                        <td>Category</td>
                                        <td>Action</td>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{ $category->category }}</td>
                                        <td>{{$category->created_at}}</td>
                                    </tr>
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