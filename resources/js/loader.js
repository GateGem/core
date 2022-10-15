const loader = {
    open: () => {
        if (document.getElementById('page-loader')) {
            document.getElementById('page-loader').classList.remove("fadeOut");
        }
    },
    close: () => {
        if (document.getElementById('page-loader')) {
            document.getElementById('page-loader').classList.add("fadeOut");
        }
    }
}
if (window) {
    window.pageLoader = loader;
    window.addEventListener('load', function load() {
        setTimeout(function () {
            window.pageLoader.close();
        }, 100);
    });
}
export default loader;