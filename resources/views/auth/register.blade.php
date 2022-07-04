<x-guest-layout>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <img src="{{ asset('images/logo.png') }}" width="150" height="50">
                    <h2 class="title">Registration Form</h2>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">first name</label>
                                    <input class="input--style-4" type="text" name="fName" id="fName">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
                                    <input class="input--style-4" type="text" name="lName" id="lName">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Birthday</label>
                                    <input class="input--style-4" type="date" name="birthdate" id="birthdate">

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" checked="checked" name="gender" value="male">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" name="gender" value="female">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email" id="email">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" type="text" name="phone_number" id="phone_number">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col">
                                <div class="input-group">
                                    <label class="label">Matricule</label>
                                    <input class="input--style-4" type="text" minlength="8" maxlength="8"
                                        name="matricule" id="matricule">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="label">personnel navigant</label>
                            <div class="rs-select2 js-select-simple select--no-search ml-4">
                                <select name="personnel" id="personnel">
                                    <option disabled="disabled" selected="selected" value="">Choose option
                                    </option>
                                    <option value="CDB">CDB</option>
                                    <option value="OPL">OPL</option>
                                    <option value="PNC">PNC</option>
                                    <option value="CCP">CCP</option>
                                    <option value="CC">CC</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="label">Secteur</label>
                            <div class="rs-select2 js-select-simple select--no-search ml-4">
                                <select name="profession" id="profession">
                                    <option disabled="disabled" selected="selected" value="">Choose option
                                    </option>
                                    <option value="A320">A320</option>
                                    <option value="A330">A330</option>
                                    <option value="B737">B737</option>
                                    <option value="PNC">PNC</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div>
                            <label class="label">mot de passe</label>
                            <input class="input--style-4" type="password" name="password" id="password">
                        </div>
                        <div>
                            <label class="label"> confirmer mot de passe</label>
                            <input class="input--style-4" type="password" name="password_confirmation"
                                id="password_confirmation">

                        </div>


                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo width="82" />
            </a>
        </x-slot>

        <div class="card-body">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" type="email" name="email" :value="old('email')" required />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" type="password"
                                    name="password_confirmation" required />
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button>
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </x-auth-card> --}}
</x-guest-layout>
