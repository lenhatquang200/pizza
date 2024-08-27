document.addEventListener('DOMContentLoaded', function () {
    function getScale() {
        return 1;
    }

    function renderPDF(pdfUrl, containerId) {
        if (!pdfUrl) {
            console.error('No PDF URL provided');
            return;
        }

        pdfjsLib.getDocument(pdfUrl).promise.then(function (pdf) {
            var numPages = pdf.numPages;
            var container = document.getElementById(containerId);
            container.innerHTML = ''; // Clear previous content

            function renderPage(pageNum) {
                pdf.getPage(pageNum).then(function (page) {
                    var containerWidth = container.clientWidth;
                    var scale = getScale(containerWidth);
                    var viewport = page.getViewport({ scale: scale });

                    var canvas = document.createElement('canvas');
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    // Create a wrapper for each page to control the layout
                    var pageWrapper = document.createElement('div');
                    pageWrapper.className = 'pdf-page-wrapper';
                    pageWrapper.style.marginBottom = '20px'; // Add spacing between pages
                    pageWrapper.appendChild(canvas);
                    container.appendChild(pageWrapper);

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext).promise.then(function () {
                        console.log('Page ' + pageNum + ' rendered');
                    });
                });
            }

            // Render all pages
            for (var i = 1; i <= numPages; i++) {
                renderPage(i);
            }
        }).catch(function (error) {
            console.error('Error loading PDF:', error);
        });
    }

    // Find all pdf-viewer containers and render PDFs
    document.querySelectorAll('[data-pdf-url]').forEach(function (element, index) {
        var pdfUrl = element.getAttribute('data-pdf-url');
        renderPDF(pdfUrl, element.id);
    });

    // Re-render on window resize
    window.addEventListener('resize', function () {
        document.querySelectorAll('[data-pdf-url]').forEach(function (element) {
            var pdfUrl = element.getAttribute('data-pdf-url');
            renderPDF(pdfUrl, element.id);
        });
    });
});
