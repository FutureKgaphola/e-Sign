/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts

window.addEventListener('DOMContentLoaded', event => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

$(document).ready(function () {
    $(document).on('click', '.view_data', function (e) {
        e.preventDefault();
        var userId = $(this).data('userid');
        $.ajax({
            url: 'User/get_user',
            type: 'POST',
            data: { userid: userId },
            dataType: 'json',
            success: function (response) {
                $('#userid').val(response?.id);
                $('#name').val(response?.name);
                $('#position').val(response?.position);
                $('#emp_no').val(response?.emp_no);
                $('#empStatus').val(response?.empStatus);
            },
            error: function (xhr, status, error) {
                console.error('Error occurred:', error);
            }
        });


    });

    $(document).on('click', '.delete_data', function (e) {
        e.preventDefault();
        
        var userId = $(this).data('userid');
        console.log("Selected userId:", userId);  // Confirm the correct value
    
        // Set the userId to the input field inside the modal
        $('#usef').val(userId || "yyyyyyyyyyyyyy");

    });


})

