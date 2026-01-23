(()=>{
    let tocNav = document.querySelector("#toc-nav");
    let sectionElements = document.querySelectorAll("section.section-header");
    let navElement = tocNav.querySelector(`a[href='#${sectionElements[0].id}']`);
    navElement.classList.add("current");
    
    let setCurrentSection = function(sectionElement){
        if(!sectionElement) return;

        let newNaveElement = tocNav.querySelector(`a[href='#${sectionElement.id}']`);
        let previousNavElement = navElement;

        if (newNaveElement == previousNavElement) return;

        if (newNaveElement) {
            navElement = newNaveElement;
            navElement.classList.add("current");
        }

        if (previousNavElement) {
            previousNavElement.classList.remove("current");
        }
    }

    const options = {
        rootMargin: "0px",
        scrollMargin: "0px",
        threshold: 0.0,
    };

    const observerCallback = function(_entries, _observer){
        let lastElement = undefined;
        sectionElements.forEach((el)=>{            
            if(el.getBoundingClientRect().y > innerHeight) return;
            lastElement = el;
        });
        setCurrentSection(lastElement);
    };

    const observer = new IntersectionObserver(observerCallback, options);

    sectionElements.forEach((element)=>{
        observer.observe(element);
    });


})();