<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/svg" href="{{ asset('img.png') }}"/>

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}"/>

    <!-- Include app.css and Inter font -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Login</title>
</head>

<body class="DEFAULT_THEME bg-white">
<main>
    <!-- Main Content -->
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="flex flex-col w-full overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">
        <div class="justify-center items-center w-full card lg:flex max-w-md ">
            <div class="w-full card-body">
                <a href="../" class="py-4 block flex justify-center">
                    <img src="{{ asset('img.png') }}" alt="" class="h-16 w-auto mx-auto"/>
                </a>
                <p class="text-lg leading-8 text-gray-600 text-center pb-4">Welcome to My Todo</p>
                <!-- form -->
                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- email -->
                    <div class="mb-4">
                        <label for="forEmail" class="block text-sm font-semibold mb-2 text-gray-600">Email</label>
                        <input type="email" name="email" id="forEmail" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0" aria-describedby="hs-input-helper-text">
                    </div>
                    <!-- password -->
                    <div class="mb-6">
                        <label for="forPassword" class="block text-sm font-semibold mb-2 text-gray-600">Password</label>
                        <input type="password" name="password" id="forPassword" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0" aria-describedby="hs-input-helper-text">
                    </div>
                    <!-- button -->
                    <div class="grid my-6">
                        <button type="submit" class="btn py-[10px] text-base text-white font-medium bg-indigo-600">Login</button>
                    </div>
                    <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20 text-center">
                        New to My Todo? <a href="/auth/register" class="font-semibold text-indigo-600"><span class="absolute inset-0" aria-hidden="true"></span>Create New Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/iconify-icon/dist/iconify-icon.min.js') }}"></script>
<script src="{{ asset('assets/libs/@preline/dropdown/index.js') }}"></script>
<script src="{{ asset('assets/libs/@preline/overlay/index.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>

</body>

</html>
