<x-app-layout>
    {{$msg}}
    <br/><br/>
    <label>Sincronizando dados</label>
    <label id="timer"></label>
</x-app-layout>

<script>
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            display.textContent = display.textContent + ".";
            if (display.textContent == '.....') {
                display.textContent = '.'
            }
        }, 1000);
    }
    window.onload = function () {
        var duration = 5 * 1; // Converter para segundos
            display = document.querySelector('#timer'); // selecionando o timer
        startTimer(duration, display); // iniciando o timer
    };
</script>
