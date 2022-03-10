@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{ route('blog-category.create') }}"
                    class="btn btn-primary">{{ trans('words.add') . ' ' . trans('words.blog_category') }} 
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <h2>Blog Categories</h2>
        </div>
        @if (Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($blogCategories as $i => $blogCategory)
                            <tr>
                                <td>{{ $blogCategory->category }}</td>
                                <td>{{ $blogCategory->description }}</td>
                                <td class="text-center">
                                    <a href="{{ route('blog-category.edit', $blogCategory->id) }}"
                                        class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                        data-toggle="tooltip" title="{{ trans('words.edit') }}"> 
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    <a href="{{ route('blog-category.destroy', $blogCategory->id) }}"
                                        class="btn btn-icon waves-effect waves-light btn-danger m-b-5"
                                        onclick="return confirm('{{ trans('words.dlt_warning_text') }}')"
                                        data-toggle="tooltip" title="{{ trans('words.remove') }}"> 
                                        <i class="fa fa-remove"></i> 
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center">
                                @include('admin.pagination', ['paginator' => $blogCategories])
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>



@endsection
