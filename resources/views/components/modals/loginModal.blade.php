<div class="hidden" id="loginModal">
    <div class="login-modal absolute top-0 left-0 h-screen w-full opacity-50 bg-black">
    </div>
    <div tabindex="-1" aria-hidden="true" class="login-modal absolute top-0 left-0 h-screen w-full flex justify-center overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full w-1/2 max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Log in
                    </h3>            
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="grid gap-4 mb-4 pb-4 grid-cols-2 border-b dark:border-gray-600">
                            <div class="col-span-2">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="newRoomName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label mb-2 text-sm font-medium text-gray-900 dark:text-white" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link right-5 absolute mb-2 text-xs font-small text-gray-900 dark:text-white" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                            </div>
                        </div>
                        <div class="col-span-2 flex justify-end">
                            <button id="btn-login" type="submit" class="text-white inline-flex  items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <button id="close-room-modal" type="button" onclick="closeModal('loginModal')" class="absolute top-0 right-0 border border-gray-300 bg-gray-300 w-8 h-8 rounded-full text-red-500 hover:text-white hover:bg-red-500 hover:border-red-500">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
</div>
 