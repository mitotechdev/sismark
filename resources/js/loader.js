window.addEventListener("load", function() {
    const loader = document.querySelector("#loader");
    loader.classList.add("loader-hidden");
    loader.addEventListener("transitioned", () => {
        document.body.removeChild("#loader");
    })
})