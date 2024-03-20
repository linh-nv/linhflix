// trending tab movie
document.addEventListener('DOMContentLoaded', function () {
    // Get all tab elements
    var tabs = document.querySelectorAll('.trending-tab li');
    // Get all content divs
    var contentDivs = document.querySelectorAll('.trending-list-items > div');
    // Add click event listeners to each tab
    tabs.forEach(function (tab, index) {
        tab.addEventListener('click', function () {
            // Remove 'active' class from all tabs
            tabs.forEach(function (t) {
                t.classList.remove('active-tab');
            });

            // Add 'active' class to the clicked tab
            tab.classList.add('active-tab');

            // Hide all content divs
            contentDivs.forEach(function (contentDiv) {
                contentDiv.style.display = 'none';
            });

            // Display the content div corresponding to the clicked tab
            contentDivs[index].style.display = 'block';
        });
    });
});
