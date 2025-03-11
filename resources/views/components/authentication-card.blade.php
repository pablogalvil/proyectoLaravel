<style>
    body{
        color: white;
    }
    div.fondo{
        background-color: #43444c;
        color: white;
    }

    div.fondo div{
        color: white;
        background-color:rgb(104, 105, 117);
    }

    div.fondo div *{
        color: white;
    }

    div.fondo div * * input{
        color: black;
    }
</style>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 fondo">

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
