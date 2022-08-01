{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blog Categories</h4>
                    @can('blog-category-create')
                        <a href="{{ route('blog-category.create') }}">
                           <button type="button" class="btn btn-rounded btn-info">
                              <span class="btn-icon-left text-info"> <i class="fa fa-plus color-info"></i> </span>
                              Add
                           </button>
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogCategories as $i => $blogCategory)
                            <tr>
                                <td>{{ $blogCategory->category }}</td>
                                <td>{{ Str::limit($blogCategory->description, 100, '...') }}</td>
                                        <td>
                                            @can('blog-category-edit')
                                             <a href="{{ route('blog-category.edit', $blogCategory->id) }}"
                                                class="btn btn-primary rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                             </a>  
                                            @endcan
                                            @can('blog-category-delete')
                                            <a href="{{ route('blog-category.destroy', $blogCategory->id) }}"
                                                class="btn btn-danger rounded btn-xs action-btn"
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
                                             </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        {{ $blogCategories->render() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
