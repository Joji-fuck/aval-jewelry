gsap.registerPlugin(ScrollTrigger, ScrollSmoother)
if (ScrollTrigger.isTouch !== 1) {
    ScrollSmoother.create({
        wrapper: 'main',
        content: '.content',
        smooth: 1.5,
        effects: true
    })
    gsap.fromTo('.main',
        {opacity: 1},
        {
            opacity: 0,
            duration: 1,
            scrollTrigger: {
                trigger: '.main',
                start: 'top',
                end: 'bottom',
                scrub: true
            }
        }
    )
    // Первая карточка
    gsap.fromTo('#text-1',
        {opacity: 0, y: 50},
        {
            scrollTrigger: {
                trigger: '#text-1',
                start: '-800',
                scrub: true,
                end: '-400'
            },
            duration: 1.5,
            x: -50,
            y: -75,
            opacity: 1,
        });

    gsap.fromTo('#img-1',
        {opacity:0},
        {
            scrollTrigger: {
                trigger: '#img-1',
                start: '-800',
                scrub: true,
                end: '100'
            },
            duration: 1.5,
            x: 50,
            opacity: 1,
        }
    )
    // Вторая карточка
    gsap.fromTo('#img-2',
        {opacity:0},
        {
            scrollTrigger: {
                trigger: '#img-2',
                start: '-600',
                scrub: true,
                end: '-100'
            },
            duration: 1.5,
            x: -50,
            opacity: 1,
        }
    );

    gsap.fromTo('#text-2',
        {opacity: 0, y: 50},
        {
            scrollTrigger: {
                trigger: '#text-2',
                start: '-800',
                scrub: true,
                end: '-400'
            },
            duration: 1.5,
            x: 50,
            y: -75,
            opacity: 1,
        });

    // Третья карточка
    gsap.fromTo('#img-3',
        {opacity:0},
        {
            scrollTrigger: {
                trigger: '#img-3',
                start: '-600',
                scrub: true,
                end: '-100'
            },
            duration: 1.5,
            x: 50,
            opacity: 1,
        }
    );

    gsap.fromTo('#text-3',
        {opacity: 0, y: 10},
        {
            scrollTrigger: {
                trigger: '#text-3',
                start: '-800',
                scrub: true,
                end: '-400'
            },
            duration: 1.5,
            x: -50,
            y: -100,
            opacity: 1,
        });

}

