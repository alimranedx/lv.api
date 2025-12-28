@extends('s_admin_layouts.app')

@section('content')
    <div class="container">
        @include('s_admin.common_pages.page_header')
        <div class="text-end">
            <a href="{{ route('super-admin.product.list') }}" class="btn btn-primary float-end">{{ __('List') }}</a>
        </div>
        <br>
        {{--        Main content goes there--}}
        <div class="row mt-4">
            <div class="col-md-12">
                <form method="post" action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <select class="selectpicker w-100"
                                        id="brand" name="brand[]"
                                        data-live-search="true"
                                        data-style="btn-light"
                                        title="Select Brand"
                                        multiple
                                        >
                                    <option value="">Nothing selected</option>
                                    <option>Apple</option>
                                    <option>Samsung</option>
                                    <option>Xiaomi</option>
                                </select>
                            </div>

                        </div>
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
                                <label for="slug" class="form-label">{{ __("Desciption") }}</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">{{ __("Price") }}</label>
                                <input class="form-control" type="number" id="price" name="price" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">{{ __("Stock") }}</label>
                                <input class="form-control" type="number" id="stock" name="stock" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">{{ __("Is Active") }}</label>
                                <select class="form-select" name="is_active" id="is_active" required>
                                    <option value="" disabled>{{ __('Please Select') }}</option>
                                    @foreach(\App\Common\Services\ProductServices::getAllStatus() as $key => $value)
                                        <option value="{{ $key }}">{{ __($value) }}</option>
                                    @endforeach
                                </select>
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
