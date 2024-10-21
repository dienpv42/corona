(function ($) {
    // Hàm khởi tạo xử lý ảnh
    function initImageUpload(selector = '.image-upload-item') {
        // Duyệt qua tất cả các phần tử dựa trên selector
        $(selector).each(function () {
            const container = $(this);
            const imageInput = container.find('.imageInput');
            const preview = container.find('.imagePreview');
            const labelAddImage = container.find('.label-add-image');
            const removeButton = container.find('.removeImage');

            imageInput.on('change', function (event) {
                const file = event.target.files[0];
                const reader = new FileReader();

                if (file) {
                    reader.onload = function (e) {
                        labelAddImage.hide();
                        preview.attr('src', e.target.result).show();
                        removeButton.show();
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeButton.on('click', function () {
                imageInput.val('');
                preview.hide().attr('src', '');
                labelAddImage.show();
                removeButton.hide();
            });
        });
    }

    // Hàm để lấy dữ liệu từ tất cả các ảnh dưới dạng base64
    function getAllImageInputsData(selector = '.image-upload-item') {
        const imagesData = [];
        const promises = [];

        // Duyệt qua tất cả các phần tử dựa trên selector
        $(selector).each(function () {
            const imageInput = $(this).find('.imageInput')[0];
            const file = imageInput.files[0]; // Lấy file đã được chọn
            const label = $(this).data('label'); // Lấy giá trị từ data-label
            const key = $(this).data('key'); // Lấy giá trị từ data-key

            if (file) {
                const reader = new FileReader();
                const promise = new Promise((resolve, reject) => {
                    reader.onload = function (e) {
                        imagesData.push({
                            label: label,
                            key: key,
                            fileName: file.name,
                            base64: e.target.result
                        });
                        resolve();
                    };
                    reader.onerror = reject;
                });

                reader.readAsDataURL(file);
                promises.push(promise);
            }
        });

        return Promise.all(promises).then(() => imagesData);
    }

    // Export các hàm ra ngoài để sử dụng
    window.imageUploadLib = {
        initImageUpload: initImageUpload,
        getAllImageInputsData: getAllImageInputsData
    };
})(jQuery);
