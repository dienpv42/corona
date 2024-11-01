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
            const value = container.find('.imgPath');

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
                value.val('');
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
            const value = $(this).find('.imgPath').val();

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
            } else {
                if (!value) {
                    const promise2 = new Promise((resolve, reject) => {
                        imagesData.push({
                            label: label,
                            key: key,
                            fileName: '',
                            base64: ''
                        });
                        resolve();
                    });
                    promises.push(promise2);
                }
            }
        });

        return Promise.all(promises).then(() => imagesData);
    }

    // Hàm thiết lập ảnh dựa trên key và đường dẫn ảnh
    function setImageValue(path, key, imageUrl, selector = '.image-upload-item') {
        $(selector).each(function () {
            const container = $(this);
            if (container.data('key') === key) {
                const preview = container.find('.imagePreview');
                const labelAddImage = container.find('.label-add-image');
                const removeButton = container.find('.removeImage');
                const value = container.find('.imgPath');

                value.val(path + imageUrl);
                preview.attr('src', path + imageUrl).show();
                labelAddImage.hide();
                removeButton.show();
            }
        });
    }

    // Hàm thiết lập nhiều giá trị ảnh cùng lúc
    function setMultipleImageValues(path, values, selector = '.image-upload-item') {
        Object.keys(values).forEach(function (key) {
            setImageValue(path, key, values[key], selector);
        });
    }

    // Hàm reset tất cả ảnh về giá trị mặc định
    function resetAllImageInputs(selector = '.image-upload-item') {
        $(selector).each(function () {
            const container = $(this);
            const imageInput = container.find('.imageInput');
            const preview = container.find('.imagePreview');
            const labelAddImage = container.find('.label-add-image');
            const removeButton = container.find('.removeImage');
            const value = container.find('.imgPath');

            value.val('');
            imageInput.val('');
            preview.hide().attr('src', '');
            labelAddImage.show();
            removeButton.hide();
        });
    }

    // Export các hàm ra ngoài để sử dụng
    window.imageUploadLib = {
        initImageUpload: initImageUpload,
        getAllImageInputsData: getAllImageInputsData,
        setImageValue: setImageValue,
        setMultipleImageValues: setMultipleImageValues,
        resetAllImageInputs: resetAllImageInputs
    };
})(jQuery);
