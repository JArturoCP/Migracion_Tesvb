@push('scripts')
    <script>
        (() => {
            const guide = document.getElementById('modal_guia');
            const carousel = guide?.querySelector('.carousel');
            if (!carousel) return;

            const slides = [...carousel.querySelectorAll('.carousel-inner > .item')];
            if (!slides.length) return;

            let current = Math.max(0, slides.findIndex(slide => slide.classList.contains('active')));
            let timer;
            function show(index) {
                current = (index + slides.length) % slides.length;
                slides.forEach((slide, position) => {
                    slide.hidden = position !== current;
                    slide.classList.toggle('active', position === current);
                });
                carousel.querySelectorAll('[data-slide-to]').forEach(indicator => {
                    indicator.classList.toggle('active', Number(indicator.dataset.slideTo) === current);
                });
            }

            show(current);
            carousel.addEventListener('click', event => {
                const control = event.target.closest('[data-slide], [data-slide-to]');
                if (!control) return;
                event.preventDefault();
                window.clearInterval(timer);
                if (control.hasAttribute('data-slide-to')) {
                    show(Number(control.dataset.slideTo));
                } else {
                    show(current + (control.dataset.slide === 'prev' ? -1 : 1));
                }
            });
            if (carousel.dataset.ride === 'carousel') {
                $(guide).on('shown.bs.modal', () => {
                    window.clearInterval(timer);
                    timer = window.setInterval(() => show(current + 1), 7000);
                }).on('hidden.bs.modal', () => window.clearInterval(timer));
            }
        })();
    </script>
@endpush
