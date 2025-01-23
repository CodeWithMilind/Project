
// Toggle heart icon active state
document.querySelectorAll('.wishlist-btn').forEach(button => {
    button.addEventListener('click', function () {
        this.classList.toggle('active');
    });
});
