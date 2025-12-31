@extends('s_admin_layouts.app')

@section('content')
    <div class="container">
        @include('s_admin.common_pages.page_header')
        <div class="text-end">
            <a href="{{ route('super-admin.product.add') }}" class="btn btn-primary float-end">{{ __('Add New Product') }}</a>
        </div>
        <br>
{{--        Main content goes there--}}
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('Brand') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Slug') }}</th>
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col">{{ __('In Stoke') }}</th>
                        <th scope="col">{{ __('Is Active') }}</th>
                        <th scope="col">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productData ?? [] as $product)
                        @php
                            $is_active = !empty($product->is_active) ? __('Yes') : __('No');
                        @endphp
                        <tr>
                            <td>{{ $product->brand_name ?? '' }}</td>
                            <td>{{ $product->name ?? '' }}</td>
                            <td>{{ $product->slug ?? '' }}</td>
                            <td>{{ $product->price ?? 0 }}</td>
                            <td>{{ $product->stock ?? 0 }}</td>
                            <td>{{ $is_active }}</td>
                            <td>
                                <a href="{{ route('super-admin.product.edit', $product->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                <a href="{{ route('super-admin.product.delete', $product->id) }}" class="btn btn-primary">{{ __('Delete') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
