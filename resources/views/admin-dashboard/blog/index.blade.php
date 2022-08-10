{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')
@section('style')
@endsection
{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blogs</h4>
                    <a href="{{ route('blogs.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>Add
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('blogs.index') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-6 offset-sm-1">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search">
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <select name="category" class="selectpicker show-tick form-control">
                                        <option value="">Blog Category</option>
                                        @foreach ($data['blog-categories'] as $bcategory)
                                            <option value="{{ $bcategory->id }}">
                                                {{ $bcategory->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-1 mt-1">
                                    <button type="submit" class="btn btn-dark btn-md">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                                <div class="col-sm-1 mt-1">
                                    <a href="{{ route('blogs.index') }}" class="btn btn-info btn-md pull-left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                    <h4 class="card-title">Blogs</h4>

                    @can('blog-create')
                     <a href="{{ route('blogs.create') }}">
                           <button type="button" class="btn btn-rounded btn-info">
                              <span class="btn-icon-left text-info">
                                 <i class="fa fa-plus color-info"></i>
                              </span>Add
                           </button>
                     </a>
                    @endcan
                </div>

                <div class="card-body">
                    @if (Session::has('flash_message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Views</th>
                                    <th>Published</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['blogs'] as $i => $blog)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('upload/blogs/' . $blog->image) }}" width="50"
                                                alt="{{ $blog->title }}" />
                                        </td>
                                        <td>
                                            <a href="{{ url('blog/' . $blog->slug) }}" target="_blank">
                                                {{ Str::limit($blog->title, '30', '') }}

                                            </a>
                                        </td>
                                        <td>
                                            <small>{{ $blog->BlogCategory->category ?? '' }}</small>
                                        </td>
                                        <td class="text-center">
                                            {{ $blog->count ?? '0' }}
                                        </td>
                                        <td>
                                            @if ($blog->created_at !== null)
                                            <small>{{ date('d-m-Y', strtotime($blog->created_at)) }}</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($blog->status == 0)
                                                <span
                                                    class="badge badge-circle badge-warning">
                                                    <i class="fa fa-save" aria-hidden="true"></i>
                                                </span>
                                            @else
                                                <span class="badge badge-circle badge-success">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-link" data-toggle="dropdown">
                                                <svg width="24px" height="24px">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24">
                                                        </rect>
                                                        <circle fill="#7e7e7e" cx="5" cy="12" r="2">
                                                        </circle>
                                                        <circle fill="#7e7e7e" cx="12" cy="12" r="2">
                                                        </circle>
                                                        <circle fill="#7e7e7e" cx="19" cy="12" r="2">
                                                        </circle>
                                                    </g>
                                                </svg>
                                            </div>

                                            <div class="dropdown-menu">
                                                @can('blog-edit')
                                                   <a href="{{ route('blogs.status', $blog->id) }}" class="dropdown-item">
                                                      <i class="fa fa-upload"></i>
                                                      {{ $blog->status == 1 ? 'Draft' : 'Publish' }}
                                                </a>

                                                <a href="{{ route('blogs.edit', $blog->id) }}" class="dropdown-item">
                                                      <i class="fa fa-edit"></i> Edit
                                                </a>
                                                @endcan

                                                @can('blog-delete')
                                                   <a href="{{ route('blogs.destroy', $blog->id) }}" class="dropdown-item"
                                                      onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                      <i class="fa fa-trash"></i> Delete
                                                </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        {{ $data['blogs']->render() }}
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
