const header = document.getElementById('main-header');
        let isScrolling = false;

        window.addEventListener('scroll', function () {
            if (!isScrolling) {
                window.requestAnimationFrame(function () {
                    if (window.scrollY >= window.innerHeight - 70) {
                        header.classList.add('bg-purple-transparent', 'border-bottom', 'border-1', 'border-purple2');
                    } else {
                        header.classList.remove('bg-purple-transparent', 'border-bottom', 'border-1', 'border-purple2');
                    }
                    isScrolling = false;
                });
                isScrolling = true;
            }
        }, { passive: true });

        window.dispatchEvent(new Event('scroll'));

