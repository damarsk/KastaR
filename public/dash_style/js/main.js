$(document).ready(function() {
    // Add CSS for dropdown transitions
    $('<style>')
        .append(`
            .sidebar-menu .dropdown-menu {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease-out;
                display: block !important;
                padding: 0;
            }
            
            .sidebar-menu li.dropdown.open > .dropdown-menu {
                max-height: 1000px; /* Large enough to contain content */
                transition: max-height 0.5s ease-in;
            }
            
            .sidebar-menu .dropdown-menu > li > a {
                transform: translateX(-10px);
                transition: all 0.3s ease;
            }
            
            .sidebar-menu li.dropdown.open > .dropdown-menu > li > a {
                transform: translateX(0);
            }
            
            /* Add transition delay for each item */
            .sidebar-menu .dropdown-menu > li:nth-child(1) > a { transition-delay: 0.1s; }
            .sidebar-menu .dropdown-menu > li:nth-child(2) > a { transition-delay: 0.15s; }
            .sidebar-menu .dropdown-menu > li:nth-child(3) > a { transition-delay: 0.2s; }
            .sidebar-menu .dropdown-menu > li:nth-child(4) > a { transition-delay: 0.25s; }
            .sidebar-menu .dropdown-menu > li:nth-child(5) > a { transition-delay: 0.3s; }
            
            .arrow i {
                transition: transform 0.3s ease;
            }
            
            .arrow i.rotate-90 {
                transform: rotate(90deg);
            }
        `)
        .appendTo('head');

    // Sidebar Toggle
    $('#sidebar-toggle').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('is-collapsed');
    });

    // Handle window resize
    function handleResize() {
        if ($(window).width() <= 991) {
            $('body').removeClass('is-collapsed');
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

    // Mobile sidebar toggle
    $('.mobile-toggle').on('click', function(e) {
        e.preventDefault();
        $('.sidebar').toggleClass('sidebar-visible sidebar-hidden');
    });

    // Close sidebar when clicking outside on mobile
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
});