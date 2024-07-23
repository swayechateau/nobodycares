<style>
    .slider {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        background-color: #ccc;
        border-radius: 34px;
        transition: background-color 0.4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
        background-image: url('https://img.icons8.com/ios-filled/50/000000/sun.png');
        background-size: 18px;
        background-position: center;
        background-repeat: no-repeat;
    }

    .slider input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
        background-image: url('https://img.icons8.com/ios-filled/50/000000/moon-symbol.png');
    }
</style>

<label class="slider relative cursor-pointer block">
    <input type="checkbox" class="absolute opacity-0 w-0 h-0">
    <span class="slider absolute block bg-gray-300 w-full h-full rounded-full transition-colors duration-300 ease-in-out"></span>
</label>
