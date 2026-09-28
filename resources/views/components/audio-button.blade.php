@props(['buttonName' => 'default', 'text' => 'Écouter'])

<button 
    type="button"
    class="audio-button inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150 ml-2"
    data-button-name="{{ $buttonName }}"
    onclick="playAudio('{{ $buttonName }}')"
>
    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
    </svg>
    {{ $text }}
</button>

<audio id="audio-{{ $buttonName }}" class="hidden">
    <source src="{{ asset('audio/' . $buttonName . '.mp3') }}" type="audio/mpeg">
</audio>

<script>
function playAudio(buttonName) {
    const audio = document.getElementById('audio-' + buttonName);
    if (audio) {
        // Stop all other audios
        document.querySelectorAll('audio').forEach(a => {
            if (a.id !== 'audio-' + buttonName) {
                a.pause();
                a.currentTime = 0;
            }
        });
        
        if (audio.paused) {
            audio.play();
        } else {
            audio.pause();
            audio.currentTime = 0;
        }
    } else {
        console.log('Audio file not found for: ' + buttonName);
    }
}
</script>
