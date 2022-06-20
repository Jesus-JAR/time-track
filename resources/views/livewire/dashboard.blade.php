<div class="flex justify-center items-center pt-20">
    <div>
        <div class="pb-16">
            <h1 class="text-ochre-700 font-serif text-5xl text-center">{{ \Carbon\Carbon::now()->format('l jS \of F') }}</h1>
        </div>

        <div class="flex text-ochre-400 font-serif text-5xl justify-center pb-16">
            <div id="reloj" class="reloj">00 : 00 : 00
            </div>
        </div>

        <div class="text-ochre-600 font-serif text-decoration-line underline text-5xl text-center pb-20">
            @foreach($logins ?? '' as $login)
                {{ \Carbon\Carbon::parse($login->last_login)->diffForHumans(now()) }}
            @endforeach
        </div>
    </div>

</div>
