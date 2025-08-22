<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="UTF-8">
        <link rel="icon" href="{{ asset('/favicon.ico')}}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css')}}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}?v=<?=rand(0,100)?>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
                <!-- Scripts -->
      <!--  @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>
   <body> 
    <script src="https://cdn.tiny.cloud/1/i6ybrmn0kzl60u1t9selri6rtei0l5id0v7gnhvkby96atim/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea.tinymce',
        height: 400,
        plugins: 'lists link image code table fullscreen',
        toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code fullscreen',
        branding: false,
        menubar: true,
      });
    </script>
    <div class="wrapper">
            @include('admin.layouts.navigation')
               <div class="main">
            <!-- Page Heading -->
                 @include('admin.layouts.header')
            <!-- Page Content -->
            <main class="content px-3 py-4">
                {{ $slot }}
            </main>
        </div>  
    </div>  
    @stack('scripts')
<script src="{{ asset('assets/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/js/script.js')}}"></script>
<script type="text/javascript">
  function date_picker() {
    document.querySelectorAll('.date-picker').forEach((el) => {
      flatpickr(el, {
        dateFormat: "m/d/Y",
        altInput: true,
        altFormat: "F j, Y",
        defaultDate: el.value || null, 
        allowInput: true 
      });
    });
  }
date_picker();
</script>
</body>
</html>
