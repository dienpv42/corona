var init = {
    conf: {
        ajax_sending: false
    },
    showNoty: function(message, type) {
        console.log(111111)
        // Cấu hình chung cho toastr
        toastr.options = {
            closeButton: true,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 30000000000000000,
            extendedTimeOut: 1000,
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
            iconClass: ''
        };

        // Tạo icon SVG cho success và error
        var successIcon = `
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <path d="M22 11.5799V12.4999C21.9988 14.6563 21.3005 16.7545 20.0093 18.4817C18.7182 20.2088 16.9033 21.4723 14.8354 22.0838C12.7674 22.6952 10.5573 22.6218 8.53447 21.8744C6.51168 21.1271 4.78465 19.746 3.61096 17.9369C2.43727 16.1279 1.87979 13.9879 2.02168 11.8362C2.16356 9.68443 2.99721 7.63619 4.39828 5.99694C5.79935 4.35768 7.69279 3.21525 9.79619 2.74001C11.8996 2.26477 14.1003 2.4822 16.07 3.35986" stroke="#6FBE44" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22 4.5L12 14.51L9 11.51" stroke="#6FBE44" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>`;

        var errorIcon = `
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <g clip-path="url(#clip0_2740_12851)">
                    <path d="M12 0.5C5.37262 0.5 0 5.87262 0 12.5C0 19.1278 5.37262 24.5 12 24.5C18.6278 24.5 24 19.1278 24 12.5C24 5.87262 18.6278 0.5 12 0.5ZM12 23.0236C6.21037 23.0236 1.5 18.2896 1.5 12.5C1.5 6.71033 6.21037 1.99995 12 1.99995C17.7896 1.99995 22.5 6.71035 22.5 12.5C22.5 18.2896 17.7896 23.0236 12 23.0236ZM16.2424 8.25763C15.9495 7.96475 15.4748 7.96475 15.1819 8.25763L12 11.4395L8.81812 8.25763C8.52525 7.96475 8.0505 7.96475 7.75725 8.25763C7.46438 8.5505 7.46438 9.02525 7.75725 9.31812L10.9391 12.5L7.75725 15.6819C7.46438 15.9744 7.46438 16.4499 7.75725 16.7424C8.05013 17.0353 8.52487 17.0353 8.81812 16.7424L12 13.5605L15.1819 16.7424C15.4748 17.0353 15.9495 17.0353 16.2424 16.7424C16.5352 16.4499 16.5352 15.9744 16.2424 15.6819L13.0605 12.5L16.2424 9.31812C16.5356 9.02487 16.5356 8.55013 16.2424 8.25763Z" fill="#DA2462"/>
                </g>
                <defs>
                    <clipPath id="clip0_2740_12851">
                        <rect width="24" height="24" fill="white" transform="translate(0 0.5)"/>
                    </clipPath>
                </defs>
            </svg>`;

        // Tùy chỉnh màu nền và icon dựa theo loại thông báo
        if (type === 'success') {
            toastr.success(`${message}`);
        } else if (type === 'error') {
            toastr.error(`${message}`);
        }
    }
}