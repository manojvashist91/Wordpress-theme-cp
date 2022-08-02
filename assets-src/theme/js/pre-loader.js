window.addEventListener("load", function() {
    setTimeout(() => {
        window.dispatchEvent(new Event('touchend'));
        window.dispatchEvent(new Event('click'));
        console.log('load');
    }, 2500);
});
