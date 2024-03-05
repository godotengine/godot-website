(function () {
    document.addEventListener('DOMContentLoaded', () => {
        function scrollTargetIntoView(target) {
            // Set timeout so that we execute on the next frame to make sure the target is ready.
            setTimeout(() => target.scrollIntoView(), 0);
        }

        const downloadToggles = document.querySelectorAll('.preview-download-toggle');
        downloadToggles.forEach((item) => {
            const toggleLink = item.querySelector('h4');
            const openTarget = document.getElementById(item.getAttribute('data-open-target'));
            const closeTarget = document.getElementById(item.getAttribute('data-close-target'));
            toggleLink.addEventListener('click', (e) => {
                if (item.classList.contains('active')) {
                    item.classList.remove('active');
                    toggleLink.textContent = '{{ T "partials.downloadVersion.showAllDownloads" }}';
                    scrollTargetIntoView(closeTarget);
                } else {
                    item.classList.add('active');
                    toggleLink.textContent = '{{ T "partials.downloadVersion.hideAllDownloads" }}';
                    scrollTargetIntoView(openTarget);
                }
            });
        });
    });
})();
