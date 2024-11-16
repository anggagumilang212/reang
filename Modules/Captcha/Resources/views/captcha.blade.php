<div class="slider-captcha">
    <div class="puzzle-container">
        <img src="{{ asset('images/puzzlebg.jpg') }}" class="puzzle-background">
        <div class="slider-piece" id="sliderPiece"></div>
    </div>
    <div class="slider-container">
        <div class="slider" id="slider"></div>
        <input type="hidden" name="captcha_position" id="captchaPosition">
    </div>
</div>

<style>
    .slider-captcha {
        width: 300px;
        margin: 20px auto;
    }

    .puzzle-container {
        position: relative;
        height: 150px;
        background: #f0f0f0;
        overflow: hidden;
    }

    .slider-container {
        position: relative;
        height: 40px;
        background: #e0e0e0;
        margin-top: 10px;
    }

    .slider {
        position: absolute;
        width: 40px;
        height: 40px;
        background: #4CAF50;
        cursor: pointer;
    }

    .slider-piece {
        position: absolute;
        width: 40px;
        height: 40px;
        background: #4CAF50;
    }

    .puzzle-background {
        z-index: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('slider');
        const sliderPiece = document.getElementById('sliderPiece');
        const captchaPosition = document.getElementById('captchaPosition');
        let isDragging = false;
        let startX;
        let sliderLeft;

        slider.addEventListener('mousedown', function(e) {
            isDragging = true;
            startX = e.pageX - slider.offsetLeft;
        });

        document.addEventListener('mousemove', function(e) {
            if (!isDragging) return;

            e.preventDefault();
            let newX = e.pageX - startX;

            // Batasi pergerakan slider
            if (newX < 0) newX = 0;
            if (newX > 260) newX = 260;

            slider.style.left = newX + 'px';
            sliderPiece.style.left = newX + 'px';
            captchaPosition.value = newX;
        });

        document.addEventListener('mouseup', function() {
            if (!isDragging) return;
            isDragging = false;

            // Verifikasi posisi
            fetch('/verify-captcha', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        position: parseInt(captchaPosition.value)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        slider.style.background = '#4CAF50';
                        // Trigger event berhasil
                        document.dispatchEvent(new CustomEvent('captchaVerified'));
                    } else {
                        slider.style.background = '#f44336';
                        setTimeout(() => {
                            slider.style.left = '0px';
                            sliderPiece.style.left = '0px';
                            slider.style.background = '#4CAF50';
                        }, 1000);
                    }
                });
        });
    });
</script>
