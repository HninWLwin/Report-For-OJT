<body>

    @if (Route::has('login'))
        @auth
            @extends('layouts.app')
    @else
            @include('auth.login')
                        
        @endauth
    
    @endif
            
</body>
