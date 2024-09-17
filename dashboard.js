document.addEventListener("DOMContentLoaded", function () {
    const boards = document.querySelectorAll('.board');

    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function handleScroll() {
        boards.forEach(function (board) {
            if (isElementInViewport(board)) {
                board.classList.add('appear');
            }
        });
    }

    window.addEventListener('scroll', handleScroll);
    handleScroll();
});
