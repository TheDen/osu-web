{{--
    Copyright 2015-2017 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends('master', ['body_additional_classes' => 'osu-layout--body-dark'])

@section('content')
    <div class="osu-page">
        <div class="osu-page-header osu-page-header--password-reset">
            <h1 class="osu-page-header__title">
                {{ trans('password_reset.title') }}
            </h1>
        </div>
    </div>

    <div class="osu-page osu-page--password-reset">
        {!! Form::open([
            'route' => 'password-reset',
            'class' => 'password-reset js-form-error',
            'method' => $isStarted ? 'PUT' : 'POST',
            'data-remote' => true,
            'data-reload-on-success' => '1',
            'data-skip-ajax-error-popup' => '1',
        ]) !!}
            @if ($isStarted)
                {!! trans('password_reset.started.title', ['username' => session('password_reset.username')]) !!}

                <a
                    href="{{ route('password-reset') }}"
                    data-method="DELETE"
                    data-remote="1"
                >
                    {{ trans('password_reset.button.cancel') }}
                </a>

                <a
                    href="{{ route('password-reset', ['username' => session('password_reset.username')]) }}"
                    data-method="POST"
                    data-remote="1"
                >
                    {{ trans('password_reset.button.resend') }}
                </a>

                <label class="password-reset__input-group">
                    {{ trans('password_reset.started.verification_key') }}

                    <input name="key" class="password-reset__input" autofocus>

                    <span class="password-reset__error js-form-error--error"></span>
                </label>

                <label class="password-reset__input-group">
                    {{ trans('password_reset.started.password') }}

                    <input type="password" class="password-reset__input" name="user_password[password]">

                    <span class="password-reset__error js-form-error--error"></span>
                </label>

                <label class="password-reset__input-group">
                    {{ trans('password_reset.started.password_confirmation') }}

                    <input type="password" class="password-reset__input" name="user_password[password_confirmation]">

                    <span class="password-reset__error js-form-error--error"></span>
                </label>

                <div class="password-reset__input-group">
                    <button class="btn-osu-big btn-osu-big--password-reset">
                        {{ trans('password_reset.button.set') }}
                    </button>
                </div>
            @else
                <label class="password-reset__input-group">
                    {{ trans('password_reset.starting.username') }}

                    <input name="username" class="password-reset__input" autofocus>
                </label>

                <div class="password-reset__input-group">
                    <button class="btn-osu-big btn-osu-big--password-reset">
                        {{ trans('password_reset.button.start') }}
                    </button>
                </div>
            @endif
        {!! Form::close() !!}
    </div>
@endsection
