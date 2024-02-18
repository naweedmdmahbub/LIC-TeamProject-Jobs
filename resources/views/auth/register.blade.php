<x-guest-layout  class="max-width-38rem">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="">Role</label>
            <select
            class="px-4 py-2 border focus:ring-gray-500 focus:rgb(59 130 246 / 0.5) w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
            name="role"
            autocomplete="off" id="role_select">
            @foreach($roles as $role)
                <option value="{{ $role }}"> {{ $role }}</option>
            @endforeach
        </select>
        @error('role')
            <p class="text-red-700">{{ $message }}</p>
        @enderror
     </div>

            <div style="display: inline-flex">
                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mx-1 mt-1 w-45" type="text" name="name" :value="old('name')" placeholder="Enter Your Name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                <!-- Email -->
                  <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mx-1 mt-1 w-45" type="text" name="email" :value="old('email')" placeholder="Enter Your Email"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
            </div>

            <!--start candidates info-->
            <div id="candidates_info">
               <div style="display: inline-flex">
                     <!-- Experience -->
                <div class="mt-4">
                    <x-input-label for="experience" :value="__('Experience')" />
                    <x-text-input id="experience" class="mx-1 block mt-1 w-45" type="text" name="experience" :value="old('experience')" placeholder="Enter Your Exprience"/>
                    <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                </div>
                <!-- Address -->
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="mx-1 block mt-1 w-45" type="text" name="address" :value="old('address')" placeholder="Enter Your Address"/>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
               </div>

               <div style="display: inline-flex">
                 <!-- designation -->
                 <div class="mt-4">
                    <x-input-label for="designation" :value="__('Designation')" />
                    <x-text-input id="designation" class="mx-1 block mt-1 w-45" type="text" name="designation" :value="old('designation')" placeholder="Enter Your Designation"/>
                    <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                </div>

                 <!-- Skill -->
                <div class="mt-4">
                    <x-input-label for="skill" :value="__('Skil')" />
                    <x-text-input id="skill" class="block mt-1 w-45 mx-1" type="text" name="skill" :value="old('skill')" placeholder="Enter Your Skill"/>
                    <x-input-error :messages="$errors->get('skill')" class="mt-2" />
                </div>
               </div>
            </div>
            <!--end candidates info-->

            <!--start company info-->
            <div style="display: none" id="company_info">
                <!-- Experience -->
                <div class="mt-4">
                    <x-input-label for="website" :value="__('Website')" />
                    <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website')" placeholder="Enter Your Website"/>
                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                </div>
                <!-- Address -->
                <div class="mt-4">
                    <x-input-label for="contact" :value="__('Contact')" />
                    <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact" :value="old('contact')" placeholder="Enter Your Contact"/>
                    <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                </div>

                <!-- designation -->
                <div class="mt-4">
                    <x-input-label for="location" :value="__('Location')" />
                    <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" placeholder="Enter Your Location"/>
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>
            </div>
            <!--end company info-->

      <div style="display: inline-flex">
          <!-- Password -->
          <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mx-1 block mt-1 w-45"
                            type="password"
                            name="password"
                             placeholder="Enter Your Password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="mx-1 block mt-1 w-45"
                            type="password"
                            name="password_confirmation" placeholder="Enter Your Confirm Password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
      </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

  <script>
    $("#role_select").on("change",function(){
        const type = $(this).val();
        if(type === 'candidate'){
            $("#candidates_info").show();
            $("#company_info").hide();
        }else if(type === 'company'){
            $("#company_info").show();
            $("#candidates_info").hide();
        }
    });
</script>
</x-guest-layout>




