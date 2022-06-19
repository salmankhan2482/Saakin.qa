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
                    <h4 class="card-title">Search Blog</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('blogs.index') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-4 offset-sm-2">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search">
                                </div>
                                <div class="col-sm-3 mt-2 mt-sm-0">
                                    <select name="category" class="selectpicker show-tick form-control">
                                        <option value="">Blog Category</option>
                                        @foreach ($data['blog-categories'] as $bcategory)
                                            <option value="{{ $bcategory->id }}">
                                                {{ $bcategory->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-1 mt-2">
                                    <button type="submit" class="btn btn-dark btn-sm">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['blogs'] as $i => $blog)
                                    <tr>
                                        <td>
                                            <a href="{{ url('blog/' . $blog->slug) }}" target="_blank">
                                                {{ Str::limit($blog->title, '25', '...') }}
                                            </a>
                                        </td>
                                        <td>{{ Str::limit($blog->slug, '25', '...') }}</td>
                                        <td>{{ $blog->BlogCategory->category ?? '' }} </td>
                                        <td>
                                            @if ($blog->status == 0)
                                                <strong
                                                    class="border border-danger bg-danger text-white p-1">Drafted</strong>
                                            @else
                                                <strong class="border border-info bg-info text-white p-1">Published</strong>
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ asset('upload/blogs/' . $blog->image) }}" width="100"
                                                alt="{{ $blog->title }}" />
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('blogs.status', $blog->id) }}" class="dropdown-item">
                                                    <i class="fa fa-upload"></i>
                                                    {{ $blog->status == 1 ? 'Draft' : 'Publish' }}
                                                </a>

                                                <a href="{{ route('blogs.edit', $blog->id) }}" class="dropdown-item">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <a href="{{ route('blogs.destroy', $blog->id) }}" class="dropdown-item"
                                                    onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
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
