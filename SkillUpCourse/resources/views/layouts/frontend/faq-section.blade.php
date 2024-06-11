    <section id="FAQ" class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[100px]">
        <div class="flex justify-between items-center">
            <div class="flex flex-col gap-[30px]">
                <div
                    class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                    <div>
                        <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="icon">
                    </div>
                    <p class="font-medium text-sm text-[#FF6129]">Grow Your Career</p>
                </div>
                <div class="flex flex-col">
                    <h2 class="font-bold text-[36px] leading-[52px]">Get Your Answers</h2>
                    <p class="text-lg text-[#475466]">It's time to upgrade skills without limits!</p>
                </div>
                <a href="#"
                    class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980] w-fit">Contact
                    Our Sales</a>
            </div>
            <div class="faq-section flex flex-col items-center gap-[30px] w-[552px] shrink-0 max-h-[600px]">
                <div class="faq-container flex flex-col gap-[30px] overflow-y-auto max-h-[400px] w-full">
                    @forelse ($faqs as $faq)
                        <div class="faq-item flex flex-col p-5 rounded-2xl bg-[#FFF8F4] border-t-4 border-[#FF6129]">
                            <button class="accordion-button flex justify-between gap-1 items-center"
                                data-accordion="accordion-faq-{{ $faq->id }}">
                                <span class="font-semibold text-lg text-left">{!! $faq->question !!}</span>
                                <div class="arrow w-9 h-9 flex shrink-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 12H18" stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 18V6" stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div id="accordion-faq-{{ $faq->id }}"
                                class="accordion-content hide max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out">
                                <p class="leading-[30px] text-[#475466] pt-[10px]">{!! $faq->answer !!}</p>
                            </div>
                        </div>
                    @empty
                        <p>FAQ not available yet</p>
                    @endforelse
                </div>
                @if ($allFaqs->count() > 4)
                    <div class="flex justify-center mt-6 w-full">
                        <button id="loadMoreFaqs"
                            class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">
                            Load More
                        </button>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <script>
        let faqSkip = 4;

        document.getElementById('loadMoreFaqs').addEventListener('click', function() {
            fetch('{{ route('load-more-faqs') }}?skip=' + faqSkip)
                .then(response => response.json())
                .then(data => {
                    const faqContainer = document.querySelector('.faq-container');
                    data.forEach(faq => {
                        const faqItem = document.createElement('div');
                        faqItem.classList.add('faq-item', 'flex', 'flex-col', 'p-5', 'rounded-2xl',
                            'bg-[#FFF8F4]', 'border-t-4', 'border-[#FF6129]');

                        faqItem.innerHTML = `
                    <button class="accordion-button flex justify-between gap-1 items-center" data-accordion="accordion-faq-${faq.id}">
                        <span class="font-semibold text-lg text-left">${faq.question}</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 12H18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 18V6" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                    <div id="accordion-faq-${faq.id}" class="accordion-content hide max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out">
                        <p class="leading-[30px] text-[#475466] pt-[10px]">${faq.answer}</p>
                    </div>
                `;

                        faqContainer.appendChild(faqItem);
                    });

                    faqSkip += data.length;

                    if (data.length < 4) {
                        document.getElementById('loadMoreFaqs').style.display = 'none';
                    }
                })
                .catch(error => console.error('Error loading more FAQs:', error));
        });
    </script>
