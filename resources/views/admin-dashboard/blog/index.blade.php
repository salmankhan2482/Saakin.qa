{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')
@section('style')
    <style>
        .table thead th{
            color: black;
            font-size: 0.95rem;
        }

        .pagination{
            list-style-type:none;
            display:flex;
            justify-content: center;
        }

        .page-item{
            display: list-item;
            padding: 5px 4px;
        }
    </style>
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
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search" >
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <select name="category" class="selectpicker show-tick form-control" >
                                        <option value="">Blog Category</option>
                                            @foreach ($data['blog-categories'] as $bcategory)
                                                <option value="{{ $bcategory->id }}" >
                                                    {{ $bcategory->category }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <button type="submit" class="btn btn-dark  pull-right">
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
                            </span>Add</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th class="text-center width-100">{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['blogs'] as $i => $blog)
                                    <tr>
                                        <td>{{ Str::limit($blog->title, '25', '...') }}</td>
                                        <td>{{ Str::limit($blog->slug, '25', '...') }}</td>
                                        <td>{{$blog->BlogCategory->category ?? ''}} </td>
                                        <td>
                                            <img src="{{asset('upload/blogs/'.$blog->image)}}" width="100" 
                                                alt="{{ $blog->id.'- blog image' }}"/>
                                        </td>
                                        <td>
                                            <a  href="{{ route('blogs.edit' , $blog->id) }}"
                                                class="btn btn-info rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a  href="{{ route('blogs.destroy' , $blog->id) }}"
                                                class="btn btn-danger rounded btn-xs action-btn"
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
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
