@extends('layouts.backend')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('List of Category') }}</h3>
                        <div class="card-tools">
                            <a class="btn btn-info"
                               href="{{ route('admin.categories.create') }}">{{ __('Add New') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-customize">
                            <tr>
                                <th class="text-center" style="width: 10px">{{ __("Serial") }}</th>
                                <th>{{ __("Name") }}</th>
                                <th>{{ __("Slug") }}</th>
                                <th style="width: 40px">{{ __("Action") }}</th>
                            </tr>

                            @forelse($categories as $key=> $category)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning"
                                           href="{{ route('admin.categories.edit',$category->id) }}">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">{{ __("No category found.") }}</td>
                                </tr>
                            @endforelse

                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
