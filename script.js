document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab");
    const forms = document.querySelectorAll(".booking-form");
    
    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            tabs.forEach(t => t.classList.remove("active"));
            forms.forEach(f => f.classList.remove("active"));
            
            tab.classList.add("active");
            document.querySelector(tab.dataset.target).classList.add("active");
        });
    });

    let slideIndex = 0;
    function showSlides() {
        let slides = document.querySelectorAll(".slides");
        slides.forEach(slide => slide.style.display = "none");
        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1 }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 4000);
    }
    showSlides();
});
