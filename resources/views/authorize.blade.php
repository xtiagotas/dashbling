<x-app-layout>
    {{$msg}}
    <br/><br/>
    <label>Você será redirecionado em</label>
    <label id="timer">00:05</label>
</x-app-layout> 

<script>
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            display.textContent = minutes + ":" + seconds;
            if (--timer < 0) {
                timer = duration;
                window.location.href = "{{route('dashboard')}}";
            }
        }, 1000);
    }
    window.onload = function () {
        var duration = 5 * 1; // Converter para segundos
            display = document.querySelector('#timer'); // selecionando o timer
        startTimer(duration, display); // iniciando o timer
    };
</script>
