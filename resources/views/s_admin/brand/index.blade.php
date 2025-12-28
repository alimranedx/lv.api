@extends('s_admin_layouts.app')

@section('content')
    <div class="container">
        @include('s_admin.common_pages.page_header')
        <div class="text-end">
            <a href="{{ route('super-admin.brand.add') }}" class="btn btn-primary float-end">{{ __('Add New Brand') }}</a>
        </div>
        <br>
{{--        Main content goes there--}}
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Slug') }}</th>
                        <th scope="col">{{ __('Is Active') }}</th>
                        <th scope="col">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brandData ?? [] as $brand)
                        @php
                            $is_active = !empty($brand->is_active) ? __('Yes') : __('No');
                        @endphp
                        <tr>
                            <td>{{ $brand->name ?? '' }}</td>
                            <td>{{ $brand->slug ?? '' }}</td>
                            <td>{{ $is_active }}</td>
                            <td>
                                <a href="{{ route('super-admin.brand.edit', $brand->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                <a href="{{ route('super-admin.brand.delete', $brand->id) }}" class="btn btn-primary">{{ __('Delete') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
