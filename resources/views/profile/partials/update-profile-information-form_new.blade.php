<div class="card">
    <div class="card-header">
        <h4 class="font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h4>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </div>

    <div class="card-body">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <label for="name" >Full Name</label>
                <input id="name" name="name" type="text" class="form-control mt-1 block w-full" value="{{old('name', $user->name)}}" required autofocus autocomplete="name" readonly/>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <!-- PG NO -->
                <label for="pg_no" value="__('PG No')">PG No</label>
                <input id="pg_no" name="pg_no" type="text" class="form-control mt-1 block w-full" value="{{old('pg_no', $user->pg_no)}}" required  readonly/>
                <x-input-error class="mt-2" :messages="$errors->get('pg_no')" />
            </div>

            <div>
                <!-- Mobile -->
                <label for="mobile" value="__('Mobile')">Mobile</label>
                <input id="mobile" name="mobile" type="text" class="form-control mt-1 block w-full" value="{{old('mobile', $user->mobile)}}" required />
                <x-input-error class="mt-2" :messages="$errors->get('mobile')" />
            </div>

            <div>
                <!-- NationalID -->
                <label for="nid" value="__('National ID')">NID</label>
                <input id="nid" name="nid" type="text" class="form-control mt-1 block w-full" value="{{old('nid', $user->nid)}}" required readonly/>
                <x-input-error class="mt-2" :messages="$errors->get('nid')" />
            </div>

            <div>
                <label for="email" value="__('Email')" >Email</label>
                <input id="email" name="email" type="email" class="form-control mt-1 block w-full" value="{{old('email', $user->email)}}" required autocomplete="username" readonly/>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4 mt-2">
                <button class="btn btn-primary">{{ __('Save') }}</button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>

</div>
