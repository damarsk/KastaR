$(document).ready(function() {
    // Sidebar Toggle
    $('#sidebar-toggle').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('is-collapsed');
        $('.sidebar').removeClass('sidebar-hidden');
    });

    // Handle window resize
    function handleResize() {
        if ($(window).width() <= 991) {
            $('body').removeClass('is-collapsed');
        } else {
            $('.sidebar').removeClass('sidebar-hidden');
            $('.sidebar').removeClass('sidebar-visible');
        }
    }

    // Initial check and bind resize event
    handleResize();
    $(window).on('resize', handleResize);

    // Dropdown Toggle with animations
    $('.sidebar-menu li.dropdown').each(function() {
        var $dropdown = $(this);

        // Handle dropdown toggle click
        $dropdown.find('> a.dropdown-toggle').on('click', function(e) {
            e.preventDefault();

            var $currentDropdown = $dropdown;

            // If the clicked dropdown is not open, close all dropdowns first
            if (!$currentDropdown.hasClass('open')) {
                $('.sidebar-menu li.dropdown.open').each(function() {
                    var $openDropdown = $(this);
                    $openDropdown.removeClass('open');
                    $openDropdown.find('.arrow i').removeClass('rotate-90');
                });
            }

            // Toggle current dropdown with slight delay for smooth animation
            setTimeout(function() {
                $currentDropdown.toggleClass('open');
                $currentDropdown.find('> a .arrow i').toggleClass('rotate-90');
            }, $currentDropdown.hasClass('open') ? 0 : 50);
        });
    });

    $('.mobile-toggle').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('is-collapsed');
        $('.sidebar').removeClass('sidebar-visible');
    });

    $(document).on('click', function(e) {
        if ($(window).width() <= 991) {
            if (!$(e.target).closest('.sidebar').length &&
                !$(e.target).closest('.mobile-toggle').length &&
                !$(e.target).closest('#sidebar-toggle').length) {
                $('.sidebar').removeClass('sidebar-visible').addClass('sidebar-hidden');
            }
        }
    });

    // Handle hover functionality for collapsed state
    if ($(window).width() >= 992) {
        $('.sidebar').hover(
            function() {
                if ($('body').hasClass('is-collapsed')) {
                    $(this).addClass('expanded');
                }
            },
            function() {
                $(this).removeClass('expanded');
            }
        );
    }

    // Handle Validator
    $('.needs-validation').each(function() {
        $(this).on('submit', function(event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            $(this).addClass('was-validated');
        });
    });
});
