@extends('layouts.app', ['expire' => true])
@section('content')
    <form action="{{ route('web.entry.store') }}" method="post">
        @csrf
        <div class="container">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
            <input type="hidden" name="expires" value="minute5" class="expires-value">
            <div class="mb-3">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input name="password" type="password" class="form-control" id="password" placeholder="{{ __('privbin.password') }}">
                            <label for="password">{{ __('privbin.password') }}</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select name="format" class="form-select" id="format">
                                @foreach ($compilers as $compiler)
                                    <option value="{{ $compiler::class }}" {{ $compiler->compilerName == 'plain_text' ? 'selected' : '' }}>
                                        {{ __('privbin.'.$compiler->compilerName) }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="format">{{ __('privbin.format') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea name="content" class="form-control" placeholder="{{ __('privbin.content') }}" id="content" style="min-height: 400px"></textarea>
                    <label for="content">{{ __('privbin.content') }}</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="clearfix">
                    <button type="submit" class="btn btn-lg btn-dark px-5 py-2 float-end d-block d-md-inline-block" data-waves>
                        {{ __('privbin.save') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
