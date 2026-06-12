const cards = document.querySelectorAll('.stage .card');
        const dots = document.querySelectorAll('.dot2');
        const titleDisplay = document.getElementById('title-display');
        const names = ['Helder', 'Lívia', 'Enzo', 'João Victor', 'João Henrique'];

        let atual = 0;

        function atualizarCarrossel() {
            for (let i = 0; i < cards.length; i++) {
                cards[i].classList.remove('active', 'prev', 'next', 'prev2', 'next2');
                dots[i].classList.remove('on');
            }

            let anterior = atual - 1;
            if (anterior < 0) { anterior = 4; }

            let anterior2 = anterior - 1;
            if (anterior2 < 0) { anterior2 = 4; }

            let proximo = atual + 1;
            if (proximo > 4) { proximo = 0; }

            let proximo2 = proximo + 1;
            if (proximo2 > 4) { proximo2 = 0; }

            cards[atual].classList.add('active');
            cards[anterior].classList.add('prev');
            cards[proximo].classList.add('next');
            cards[anterior2].classList.add('prev2');
            cards[proximo2].classList.add('next2');

            dots[atual].classList.add('on');
            titleDisplay.textContent = names[atual];
        }

        function avancar() {
            atual = atual + 1;
            if (atual > 4) { atual = 0; }
            atualizarCarrossel();
        }

        function voltar() {
            atual = atual - 1;
            if (atual < 0) { atual = 4; }
            atualizarCarrossel();
        }

        atualizarCarrossel();

        const typingText = document.getElementById('typing-text');
        let wrapper, originalHTML;
        let typingIndex = 0;
        let textResult = '';
        let typingStarted = false;

        if (typingText) {
            originalHTML = typingText.innerHTML.replace(/\s+/g, ' '); 
            
            wrapper = document.createElement('div');
            wrapper.className = 'position-relative';
            typingText.parentNode.insertBefore(wrapper, typingText);
            
            const placeholder = typingText.cloneNode(true);
            placeholder.removeAttribute('id');
            placeholder.classList.add('invisible');
            placeholder.classList.remove('typing-cursor');
            
            wrapper.appendChild(placeholder);
            wrapper.appendChild(typingText);
            
            typingText.classList.add('position-absolute', 'top-0', 'start-0', 'w-100', 'h-100');
            
            const match = originalHTML.match(/^(<span[^>]*>.*?<\/span>)/i);
            if (match) {
                textResult = match[1];
                typingIndex = textResult.length;
            }
            typingText.innerHTML = textResult;
        }

        function typeWriter() {
            if (typingIndex < originalHTML.length) {
                let char = originalHTML.charAt(typingIndex);
                
                if (char === '<') {
                    let tag = '';
                    while (originalHTML.charAt(typingIndex) !== '>' && typingIndex < originalHTML.length) {
                        tag += originalHTML.charAt(typingIndex);
                        typingIndex++;
                    }
                    tag += '>';
                    textResult += tag;
                    typingIndex++;
                    typingText.innerHTML = textResult;
                    typeWriter();
                } else {
                    textResult += char;
                    typingText.innerHTML = textResult;
                    typingIndex++;
                    setTimeout(typeWriter, 35);
                }
            } else {
                typingText.classList.remove('typing-cursor');
            }
        }

        if (typingText && wrapper) {
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && !typingStarted) {
                    typingStarted = true;
                    typeWriter();
                    observer.disconnect();
                }
            }, { rootMargin: "0px 0px -50px 0px" });
            
            observer.observe(wrapper);
        }

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