@extends('platform::app')

@section('body-right')


    <div class="form-signin container h-full p-0 px-sm-5 py-5 my-sm-5">

        <a class="d-flex justify-content-center mb-4" href="{{Dashboard::prefix()}}">
            @includeFirst([config('platform.template.header'), 'platform::header'])
        </a>

        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">

                <div class="bg-white p-5 p-sm-10 rounded shadow-sm">
                    <label for="name" class="col-md-12 col-form-label text-md-center">{{ __('404 | СТРАНИЦА НЕ НАЙДЕНА') }}</label>


                    <div style="margin-top : 20px"></div>

{{--                    <div class="form-group row mb-0">--}}
{{--                        <div class="col-md-6 offset-md-3">--}}
{{--                            <a href="{{ route('auth.login') }}" type="submit" class="btn btn-outline-primary">--}}
{{--                                <?php echo e(__('На главную')); ?>--}}

{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>


                <div class="mt-4 text-center">
                    @includeFirst([config('platform.template.footer'), 'platform::footer'])
                </div>
            </div>
        </div>
    </div>

@endsection
