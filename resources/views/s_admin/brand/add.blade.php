@extends('s_admin_layouts.app')

@section('content')
    <div class="container">
        @include('s_admin.common_pages.page_header')
        <div class="text-end">
            <a href="{{ route('super-admin.brand.list') }}" class="btn btn-primary float-end">{{ __('List') }}</a>
        </div>
        <br>
        {{--        Main content goes there--}}
        <div class="row mt-4">
            <div class="col-md-12">
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input onkeyup="populateSlug(this)" class="form-control" type="text" id="name" name="name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">{{ __("Slug") }}</label>
                                <input class="form-control" type="text" id="slug" name="slug" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">{{ __("Is Active") }}</label>
                                <select class="form-select" name="is_active" id="is_active" required>
                                    <option value="" disabled>{{ __('Please Select') }}</option>
                                    @foreach(\App\Common\Services\BrandServices::getAllStatus() as $key => $value)
                                        <option value="{{ $key }}">{{ __($value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="brand_image" class="form-label">{{ __("Brand Image") }}</label>
                                <input type="file" class="form-control" id="brand_image" name="brand_image" accept="image/*" />
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary ps-4 pe-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {

        });
        function populateSlug(el) {
            const slug = el.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            $('#slug').val(slug);
        }
    </script>
@endsection
