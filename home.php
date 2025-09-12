<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="/icons/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ChibiHaven - Home</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter and Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto:wght@700;900&display=swap" rel="stylesheet">
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Preload critical hero images for faster initial load -->
    <link rel="preload" as="image" href="https://host.chibihaven.fun/images/slider-banners/lord-of-the-mysteries-desktop.png" fetchpriority="high">
    <link rel="preload" as="image" href="https://host.chibihaven.fun/images/slider-banners/lord-of-the-mysteries-mobile.png" fetchpriority="high">
    <link rel="preload" as="image" href="https://host.chibihaven.fun/images/slider-banners/black-butler-desktop.png?v=2" fetchpriority="high">
    <link rel="preload" as="image" href="https://host.chibihaven.fun/images/slider-banners/black-butler-mobile.png" fetchpriority="high">
    <link rel="preload" as="image" href="https://host.chibihaven.fun/images/slider-banners/The-Children-of-Shiunji-Family-desktop.png?v=3" fetchpriority="high">
    <link rel="preload" as="image" href="https://host.chibihaven.fun/images/slider-banners/The-Children-of-Shiunji-Family-mobile.png?v=3" fetchpriority="high">
    <link rel="preload" as="image" href="https://host.chibihaven.fun/images/slider-banners/dan-da-dan-desktop.png" fetchpriority="high">
    <link rel="preload" as="image" href="https://host.chibihaven.fun/images/slider-banners/dan-da-dan-mobile.jpg?v=2" fetchpriority="high">
    
    <style>
        /* Header */

        /* Custom font for a more professional look */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d0d0d; /* Dark background */
            min-height: 200vh; /* Ensure the page is scrollable for demonstration */
            padding-top: 60px; /* Add padding equal to header height to prevent content overlap */
            overflow: hidden; /* Hide scrollbar initially while loading */
        }
        .text-crunchyroll-orange {
            color: #F47521; /* Crunchyroll's signature orange */
        }
        /* Custom animation for link hover effect */
        .nav-link-animation {
            position: relative;
            overflow: hidden;
        }
        .nav-link-animation::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: #F47521; /* Crunchyroll orange */
            transform: translateX(-100%);
            transition: transform 0.3s ease-out;
        }
        /* Apply hover effect only on larger screens (desktop) */
        @media (min-width: 1024px) { /* Corresponds to Tailwind's 'lg' breakpoint */
            .nav-link-animation:hover::after {
                transform: translateX(0);
            }
        }

        /* Transparent and blurred header */
        .header-transparent-blur {
            background-color: rgba(10, 10, 10, 0.8); /* Semi-transparent black */
            backdrop-filter: blur(10px); /* Apply blur effect */
            -webkit-backdrop-filter: blur(10px); /* For Safari compatibility */
            position: fixed; /* Make the header fixed at the top */
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000; /* Ensure it stays on top of other content */
            transition: transform 0.3s ease-out; /* Smooth transition for hiding/showing */
        }
        /* Class to hide the header by moving it up */
        .header-hidden {
            transform: translateY(-100%);
        }

        /* Dropdown specific styles (reused for both browse and profile) */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 5px); /* Position below the parent link */
            left: 0;
            background-color: rgba(26, 26, 26, 0.95); /* Dark background for dropdown with slight transparency */
            backdrop-filter: blur(5px); /* Add blur to dropdown as well */
            -webkit-backdrop-filter: blur(5px);
            min-width: 160px; /* Default min-width */
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.4);
            z-index: 100;
            border-radius: 0.5rem; /* Rounded corners */
            overflow: hidden;
            opacity: 0; /* For transition */
            transform: translateY(-10px); /* For transition */
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
        }
        /* Only show dropdown if the parent .dropdown element has the .active class */
        .dropdown.active .dropdown-menu {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        .dropdown-menu a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: flex; /* Use flex for icon and text alignment */
            align-items: center;
            transition: background-color 0.2s ease-in-out;
        }
        .dropdown-menu a i {
            margin-right: 10px; /* Space between icon and text */
            width: 20px; /* Fixed width for icons for alignment */
            text-align: center;
        }
        .dropdown-menu a:hover {
            background-color: #2a2a2a; /* Slightly lighter on hover */
            color: #F47521; /* Orange text on hover */
        }

        /* Adjust profile dropdown to open to the right/left depending on space */
        .profile-dropdown .dropdown-menu {
            right: 0; /* Align to the right of the profile icon */
            left: auto; /* Override default left:0 */
            min-width: 250px; /* Wider for profile details */
            padding: 0; /* Remove default padding from dropdown-menu */
        }

        .profile-dropdown-header {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            justify-content: space-between; /* Distribute space between items */
            gap: 0.75rem; /* Add some gap between items */
        }

        .profile-dropdown-header img {
            flex-shrink: 0; /* Prevent image from shrinking */
            width: 48px;
            height: 48px;
            border-radius: 50%;
            margin-right: 0.75rem; /* Keep margin for spacing from info */
            object-fit: cover;
            border: 2px solid #F47521; /* Orange border for profile pic */
        }

        .profile-info {
            flex-grow: 1; /* Allow profile info to take up available space */
            min-width: 0; /* Important for flex-grow to work correctly with text overflow */
        }

        .profile-info h3 {
            font-weight: 600;
            font-size: 1rem;
            color: white;
            margin-bottom: 0.25rem;
            white-space: nowrap; /* Prevent text wrapping initially */
            overflow: hidden;
            text-overflow: ellipsis; /* Add ellipsis for overflowed text */
        }

        .profile-info p {
            font-size: 0.8rem;
            color: #F47521; /* Orange for premium */
            display: flex;
            align-items: center;
        }
        .profile-info p i {
            margin-right: 5px;
            font-size: 0.7rem;
        }

        .edit-profile-icon {
            flex-shrink: 0; /* Prevent icon from shrinking */
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
            margin-left: auto; /* Push icon to the far right */
        }
        .edit-profile-icon:hover {
            color: #F47521;
        }

        /* Style for the profile dropdown icon and caret */
        #profile-dropdown-button {
            display: flex;
            align-items: center;
            gap: 4px; /* Space between user icon and caret */
            padding: 0.5rem; /* Adjust padding for visual balance */
            border-radius: 9999px; /* Make it fully rounded like a button */
            transition: background-color 0.2s ease-in-out;
        }
        #profile-dropdown-button:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Subtle hover background */
        }
        #profile-dropdown-button .fa-user-circle {
            font-size: 1.5rem; /* Larger user icon */
        }
        #profile-dropdown-button .fa-chevron-down {
            font-size: 0.75rem; /* Smaller caret icon */
            transition: transform 0.3s ease-out;
        }
        .profile-dropdown.active #profile-dropdown-button .fa-chevron-down {
            transform: rotate(180deg); /* Rotate caret when dropdown is active */
        }

        /* Logo specific styles */
        .header-logo {
            max-height: 40px; /* Maximum height for the logo */
            max-width: 150px; /* Maximum width for the logo */
            width: auto; /* Allow width to adjust proportionally within max-width */
            height: auto; /* Allow height to adjust proportionally within max-height */
            object-fit: contain; /* Ensure the entire image is visible within its bounds */
        }

        /* Header Ends */
        
        /* Mobile Bottom Navigation */
        .mobile-nav {
            display: none;
            /* hidden by default */

        }

        .mobile-nav .nav-item {
            color: #aaa;
            text-decoration: none;
            font-size: 0.8rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.3s;
        }

        .mobile-nav .nav-item i {
            font-size: 1.7rem;
            margin-bottom: 3px;
        }

        .mobile-nav .nav-item.active,
        .mobile-nav .nav-item:hover {
            color: #f39c12;
        }

        /* Show only on mobile */
        @media (max-width: 768px) {

            header nav {
                display: none;
            }

            .arrow,
            .arrow-block {
                display: none !important
            }

            .mobile-nav {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background: #111;
                justify-content: space-around;
                align-items: center;
                padding: 10px 0;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.7);
                z-index: 999;
            }

            .anime-section {
                padding-bottom: 80px;
                /* Footer height + margin */
            }
        }

        /* Header Ends */

        
        /* Custom styles for smooth scrolling and consistent font */
        html {
            scroll-behavior: smooth;
            will-change: scroll-position;
        }
        body {
            font-family: 'Inter', sans-serif; /* Changed to Inter for general text */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            -webkit-overflow-scrolling: touch; /* Enable momentum scrolling on iOS */
            background-color: #0D0D0D; /* Dark background */
            color: #FFFFFF; /* White text */
            /* Removed padding-bottom for mobile nav */
        }

        /* Custom scrollbar styling for Webkit browsers (Chrome, Safari, Edge) */
        body::-webkit-scrollbar {
            width: 8px; /* Width of the vertical scrollbar */
        }

        body::-webkit-scrollbar-track {
            background: #1A1A1A; /* Darker track for the body */
            border-radius: 10px;
        }

        body::-webkit-webkit-scrollbar-thumb {
            background: #F48B01; /* Primary Accent (Orange) */
            border-radius: 10px;
        }

        body::-webkit-scrollbar-thumb:hover {
            background: #FF9900; /* Brighter Orange on hover */
        }

        /* Horizontal scroll container specific styles */
        .horizontal-scroll-container::-webkit-scrollbar {
            height: 8px; /* Height of the horizontal scrollbar */
        }

        .horizontal-scroll-container::-webkit-scrollbar-track {
            background: #2d3748; /* Darker track */
            border-radius: 10px;
        }

        .horizontal-scroll-container::-webkit-scrollbar-thumb {
            background: #F48B01; /* Orange */
            border-radius: 10px;
        }

        .horizontal-scroll-container::-webkit-scrollbar-thumb:hover {
            background: #FF9900; /* Brighter Orange on hover */
        }
        .horizontal-scroll-container {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            will-change: scroll-position;
        }

        /* Shine effect for cards and buttons */
        .shine-effect-card, .shine-button {
            position: relative;
            overflow: hidden;
            z-index: 1; /* Ensure the card itself has a z-index */
        }

        .shine-effect-card::before, .shine-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 70%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0) 100%);
            transform: skewX(-20deg);
            transition: left 0.7s ease-in-out;
            pointer-events: none;
            z-index: 20; /* Ensure shine effect is above hover overlay */
        }

        .shine-effect-card:hover::before, .shine-button:hover::before {
            left: 130%;
        }

        /* UPDATED: Custom hover effect for anime cards - No scale */
        .anime-card-hover-effect {
            transition: box-shadow 0.3s ease-in-out; /* Only shadow transition */
        }

        .anime-card-hover-effect:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6); /* Even stronger shadow */
        }

        /* Add a subtle brightness change to the image on hover */
        .anime-card-hover-effect img {
            transition: filter 0.3s ease-in-out;
        }

        .anime-card-hover-effect:hover img {
            filter: brightness(1.1); /* Slightly brighter on hover */
        }

        /* Removed Reveal on scroll styles */
        /*
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
            will-change: opacity, transform;
        }

        .reveal-on-scroll.active {
            opacity: 1;
            transform: translateY(0);
        }
        */

        /* Profile Dropdown Container - Should always be visible */
        .profile-dropdown {
            /* Removed opacity, transform, and pointer-events from here */
            /* These properties should only apply to the dropdown-menu, not the container itself */
            position: relative; /* Keep for positioning dropdown-menu */
            display: inline-block; /* Keep for layout */
        }

        /* Categories Dropdown Transition */
        .categories-dropdown {
            transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
            transform: translateY(-10px);
            opacity: 0;
            pointer-events: none;
        }

        .categories-dropdown.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        /* Hero Section Specific Styles */
        .hero-section {
            position: relative; /* Ensure children are positioned relative to this */
            height: 600px; /* Default height for mobile, adjusted */
            display: flex;
            align-items: flex-end; /* Align content to the bottom */
            justify-content: flex-start;
            padding: 12rem 2rem 4rem 2rem; /* Adjusted padding: increased top, reduced bottom */
            overflow: hidden; /* Hide overflowing parts of the image */
            /* Ensure touch actions are not blocked by other elements */
            touch-action: pan-y; /* Allow vertical scrolling, but handle horizontal */
        }

        /* Dynamic background image for the slider */
        #heroBackgroundImage {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0; /* Start hidden */
            transition: opacity 1s ease-in-out; /* Fade transition */
        }

        #heroBackgroundImage.active {
            opacity: 1; /* Show active image */
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            /* Gradient for bottom fade: Starts transparent at top, fades to dark background at bottom */
            background: linear-gradient(to bottom, rgba(13,13,13,0) 0%, rgba(13,13,13,0.7) 70%, #0D0D0D 100%); /* Adjusted gradient stops */
        }
        .hero-overlay::before { /* Add a left-to-right gradient for text area */
            content: '';
            position: absolute;
            inset: 0;
            /* UPDATED: Stronger black gradient from left for content readability */
            background: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 40%, rgba(0,0,0,0.3) 70%, rgba(0,0,0,0) 100%);
            z-index: -1; /* Behind the main overlay */
        }


        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 600px; /* Adjusted max-width for content */
            text-shadow: 0 2px 8px rgba(0,0,0,0.8); /* Text shadow for readability */
            margin-left: 2rem; /* Push content from the left edge */
            margin-bottom: 0; /* Adjusted: Pushed content closer to the bottom of hero section */
            opacity: 0; /* Start hidden */
            transition: opacity 1s ease-in-out; /* Fade transition for content */
            /* Ensure content inside is aligned to the start (top) on desktop */
            display: flex; /* Make it a flex container */
            flex-direction: column; /* Stack children vertically */
            align-items: flex-start; /* Align children to the start (left) */
        }

        .hero-content.active {
            opacity: 1;
        }

        .hero-content h1 { /* Base styles for hero title */
            color: #FFFFFF;
            font-weight: 900; /* Extra bold */
            line-height: 1; /* Tighter line height */
            margin-bottom: 1rem;
            /* Font size for h1 is now handled by image sizing or default text styling */
        }

        /* NEW: Custom font classes for hero titles (font-size handled via Tailwind classes in JS) */
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-bebas { font-family: 'Bebas Neue', sans-serif; }
        .font-pacifico { font-family: 'Pacifico', cursive; }
        .font-pressstart { font-family: 'Press Start 2P', cursive; }


        .hero-content p {
            font-size: 1.125rem; /* Larger paragraph text */
            line-height: 1.6;
            margin-bottom: 1.5rem;
            color: #E0E0E0; /* Slightly lighter text for description */
        }

        .hero-content .watch-button {
            padding: 0.8rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 9999px; /* Fully rounded */
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease; /* Removed transform transition */
            transform: scale(1); /* Ensure initial scale is 1 */
        }

        /* Specific styles for the new hero section elements */
        .hero-info-line {
            display: flex;
            align-items: center;
            gap: 0.75rem; /* Space between elements */
            margin-bottom: 1rem;
            font-size: 0.95rem;
            color: #BFBFBF; /* Lighter gray for info */
        }

        .hero-info-line .rating-badge {
            background-color: rgba(255, 255, 255, 0.15); /* Semi-transparent white */
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 600;
            color: #FFFFFF;
        }

        .hero-info-line .sub-dub {
            background-color: rgba(255, 255, 255, 0.15);
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 600;
            color: #FFFFFF;
        }

        /* Navigation arrows for hero section */
        .hero-nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0,0,0,0.5);
            color: white;
            padding: 1rem;
            border-radius: 50%;
            cursor: pointer;
            z-index: 20;
            opacity: 0; /* Initially hidden */
            transition: opacity 0.3s ease-in-out, background-color 0.2s ease, transform 0.2s ease;
        }
        /* UPDATED: More noticeable hover effect for arrows */
        .hero-nav-arrow:hover {
            background-color: rgba(0,0,0,0.8); /* Darker black on hover for better visibility */
            transform: translateY(-50%) scale(1.1); /* Slight scale up on hover */
        }
        .hero-nav-arrow.left { left: 1rem; }
        .hero-nav-arrow.right { right: 1rem; }

        /* Class to make arrows visible on hover */
        .hero-nav-arrow.visible {
            opacity: 1;
        }

        /* Carousel dots for hero section */
        .hero-dots-container {
            position: absolute;
            bottom: 1rem; /* Position at the bottom */
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            display: flex;
            gap: 0.5rem;
        }
        .hero-dot {
            width: 10px;
            height: 10px;
            background-color: rgba(255,255,255,0.4);
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .hero-dot.active {
            background-color: #F48B01; /* Active dot color */
            transform: scale(1.2);
        }

        /* NEW EP ADDED CARD STYLES (based on image_b9c151.png) */
        /* Changed from div to a for direct navigation */
        .episode-card-new-ep {
            background-color: #1A1A1A;
            border-radius: 0; /* Sharp corners */
            overflow: hidden;
            position: relative;
            width: 250px; /* Default width for mobile */
            flex-shrink: 0;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            display: block; /* Make it block to take full width */
            text-decoration: none; /* Remove underline for link */
            color: inherit; /* Inherit text color */
        }

        .episode-card-new-ep:hover {
            transform: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
        }

        .episode-card-new-ep .thumbnail-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            overflow: hidden;
            border-radius: 0; /* Sharp top corners */
        }

        .episode-card-new-ep .thumbnail-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0; /* Sharp top corners */
        }

        .episode-card-new-ep .play-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            border-radius: 0; /* Sharp top corners */
        }

        .episode-card-new-ep:hover .play-overlay {
            opacity: 1;
        }

        .episode-card-new-ep .play-overlay svg {
            color: white;
            width: 40px;
            height: 40px;
        }

        .episode-card-new-ep .time-remaining-badge {
            position: absolute;
            bottom: 0.5rem;
            right: 0.5rem;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 0.75rem;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            z-index: 10;
        }

        .episode-card-new-ep .new-episode-badge {
            position: absolute;
            top: 0.5rem;
            left: 0.5rem;
            background-color: #FF005C; /* Primary Accent */
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
            padding: 0.2rem 0.5rem;
            border-radius: 9999px; /* Fully rounded */
            z-index: 10;
        }

        .episode-card-new-ep .content-area-pc {
            display: flex; /* Always flex for PC */
            flex-direction: column;
            padding: 0.75rem;
            text-align: left;
        }

        .episode-card-new-ep .content-area-pc .series-title-pc {
            font-size: 0.9rem;
            color: #BFBFBF;
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .episode-card-new-ep .content-area-pc .episode-title-pc {
            font-size: 1rem;
            font-weight: 600;
            color: #FFFFFF;
            margin-bottom: 0.5rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .episode-card-new-ep .content-area-pc .status-text-pc {
            font-size: 0.8rem;
            color: #A0A0A0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Overlaid text for mobile - hidden by default on PC, shown on mobile */
        .overlaid-text-mobile {
            display: none; /* Hidden by default on PC */
        }

        /* Movie Card Specific Styles */
        .movie-card {
            background-color: #1A1A1A;
            border-radius: 0; /* Sharp corners */
            overflow: hidden;
            position: relative;
            width: 280px; /* Default width for mobile */
            flex-shrink: 0;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .movie-card:hover {
            transform: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
        }

        .movie-card .thumbnail-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            overflow: hidden;
            border-radius: 0; /* Sharp top corners */
        }

        .movie-card .thumbnail-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0; /* Sharp top corners */
        }

        .movie-card .n-logo {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            background-color: #E50914; /* Netflix Red */
            color: white;
            font-weight: bold;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            z-index: 10;
        }

        /* Content below the image for movie cards */
        .movie-card-content {
            padding: 0.75rem;
            text-align: left;
        }

        .movie-card-content .title {
            font-size: 1rem;
            font-weight: 600;
            color: #FFFFFF;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .movie-card-content .info-line {
            font-size: 0.8rem;
            color: #A0A0A0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        /* Mobile-specific adjustments for hero section */
        @media (max-width: 767px) { /* Targets screens smaller than md breakpoint */
            .hero-section {
                height: auto; /* Allow height to be determined by content */
                min-height: 60vh; /* Adjusted minimum height for mobile hero (smaller) */
                align-items: flex-end; /* Align content to the bottom */
                justify-content: center; /* Center content horizontally */
                padding: 12rem 1rem 4rem 1rem; /* Adjusted padding for mobile (reduced top) */
            }

            #heroBackgroundImage {
                object-position: top; /* Align image to the top on mobile */
            }

            .hero-content {
                max-width: 90%; /* Make content narrower on mobile */
                margin-left: 0; /* Remove left margin */
                margin-bottom: 0; /* Adjusted: Pushed content closer to the bottom of hero section */
                text-align: center; /* Center text on mobile */
                align-items: center; /* Center items for mobile */
            }

            .hero-content p {
                display: block; /* Ensure it's displayed */
                font-size: 0.9rem; /* Smaller font for mobile synopsis */
                line-height: 1.4;
                margin-bottom: 1rem; /* Adjusted margin */
                max-height: 2.8em; /* Limit to 2 lines (approx 1.4 * 2 = 2.8em) */
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-box-orient: vertical;
            }

            .hero-info-line {
                justify-content: center; /* Center info line items */
                margin-bottom: 0.75rem;
                font-size: 0.85rem;
            }

            .hero-content .watch-button {
                padding: 0.6rem 2rem; /* Smaller padding for mobile button */
                font-size: 1rem; /* Smaller font size for mobile button */
            }

            .hero-content .flex-wrap {
                justify-content: center; /* Center buttons on mobile */
            }

            /* Explicitly hide the View Details button on mobile */
            #heroDetailsButton {
                display: none !important;
            }

            .hero-nav-arrow {
                display: none !important; /* Hide arrows on mobile */
            }
            /* Removed .hero-dots-container display: none !important; */

            /* Mobile specific adjustments for episode-card-new-ep */
            .episode-card-new-ep {
                width: 250px; /* Reverted to original width for mobile */
                height: auto; /* Allow height to adjust */
            }
            .episode-card-new-ep .thumbnail-wrapper {
                padding-bottom: 56.25%; /* 16:9 aspect ratio */
                height: auto;
            }
            .episode-card-new-ep .content-area-pc {
                display: none; /* Hide below-thumbnail text on mobile */
            }
            .overlaid-text-mobile {
                display: flex; /* Show overlaid text on mobile */
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
                padding: 0.75rem; /* Original padding */
                flex-direction: column;
                align-items: flex-start;
                justify-content: flex-end;
                color: white;
                font-size: 0.8rem; /* Original font size */
                height: 50%; /* Cover bottom half of thumbnail */
                pointer-events: none; /* Allow clicks to pass through to thumbnail */
            }
            .overlaid-text-mobile .series-title-mobile {
                font-size: 0.8rem; /* Original font size */
                color: #BFBFBF;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                width: 100%;
            }
            .overlaid-text-mobile .episode-title-mobile {
                font-size: 0.9rem; /* Original font size */
                font-weight: 600;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                width: 100%;
            }
            .overlaid-text-mobile .status-text-mobile {
                font-size: 0.7rem; /* Original font size */
                color: #A0A0A0;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                width: 100%;
            }

            /* Mobile specific adjustments for movie cards */
            .movie-card {
                width: 280px; /* Maintain width for mobile */
                height: auto;
            }
            .movie-card-content {
                padding: 0.5rem; /* Reduced padding */
            }
            .movie-card-content .title {
                font-size: 0.9rem; /* Smaller title */
            }
            .movie-card-content .info-line {
                font-size: 0.7rem; /* Smaller info line */
            }
        }

        /* General anime card (not new ep added) */
        .anime-card-hover-effect {
            border-radius: 0; /* Sharp corners */
        }
        .anime-card-hover-effect img {
            border-radius: 0; /* Sharp top corners */
        }
        
        /* Loading Overlay Styles */
        #loading-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.9); /* Darker background */
            backdrop-filter: blur(10px); /* Blur the content underneath */
            -webkit-backdrop-filter: blur(10px); /* For Safari */
            z-index: 2000; /* Ensure it's on top of everything */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
            opacity: 1;
            visibility: visible;
        }

        #loading-overlay.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none; /* Allow clicks to pass through once hidden */
        }

        /* Custom Cube Loader Styles */
        .loading-container {
            --uib-size: 45px;
            --uib-color: #F47521; /* Crunchyroll Orange */
            --uib-speed: 1.75s;
            display: flex;
            align-items: flex-end;
            padding-bottom: 20%;
            justify-content: space-between;
            width: var(--uib-size);
            height: calc(var(--uib-size) * 0.6);
        }
        
        .loading-cube {
            flex-shrink: 0;
            width: calc(var(--uib-size) * 0.2);
            height: calc(var(--uib-size) * 0.2);
            animation: jump var(--uib-speed) ease-in-out infinite;
        }
        
        .loading-cube__inner {
            display: block;
            height: 100%;
            width: 100%;
            border-radius: 25%;
            background-color: var(--uib-color);
            transform-origin: center bottom;
            animation: morph var(--uib-speed) ease-in-out infinite;
            transition: background-color 0.3s ease;
        }
        
        .loading-cube:nth-child(2) {
            animation-delay: calc(var(--uib-speed) * -0.36);
        }
        .loading-cube:nth-child(2) .loading-cube__inner {
            animation-delay: calc(var(--uib-speed) * -0.36);
        }
        .loading-cube:nth-child(3) {
            animation-delay: calc(var(--uib-speed) * -0.2);
        }
        .loading-cube:nth-child(3) .loading-cube__inner {
            animation-delay: calc(var(--uib-speed) * -0.2);
        }
        
        @keyframes jump {
            0% { transform: translateY(0px); }
            30% { transform: translateY(0px); animation-timing-function: ease-out; }
            50% { transform: translateY(-200%); animation-timing-function: ease-in; }
            75% { transform: translateY(0px); animation-timing-function: ease-in; }
        }
        
        @keyframes morph {
            0% { transform: scaleY(1); }
            10% { transform: scaleY(1); }
            20%, 25% { transform: scaleY(0.6) scaleX(1.3); animation-timing-function: ease-in-out; }
            30% { transform: scaleY(1.15) scaleX(0.9); animation-timing-function: ease-in-out; }
            40% { transform: scaleY(1); }
            70%, 85%, 100% { transform: scaleY(1); }
            75% { transform: scaleY(0.8) scaleX(1.2); }
        }

        /* Details Popup Styles */
        #details-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.7); /* Dark semi-transparent overlay */
            backdrop-filter: blur(5px); /* Blur effect for background content */
            -webkit-backdrop-filter: blur(5px);
            z-index: 1050; /* Above header, below loading overlay */
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-out, visibility 0.3s ease-out;
        }

        #details-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        #details-popup {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%; /* Full width on mobile */
            max-width: 500px; /* Max width on desktop */
            height: 100%;
            background-color: #0D0D0D; /* Dark background */
            color: white;
            z-index: 1060; /* Above overlay */
            transform: translateX(100%); /* Start off-screen to the right */
            transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); /* Smooth slide animation */
            display: flex;
            flex-direction: column;
        }

        #details-popup.active {
            transform: translateX(0); /* Slide into view */
        }

        @media (min-width: 768px) { /* Adjust for larger screens */
            #details-popup {
                width: 40%; /* Take up 40% of screen width on desktop */
                min-width: 400px; /* Minimum width to ensure content is readable */
            }
        }
        @media (min-width: 1024px) { /* Adjust for even larger screens */
            #details-popup {
                width: 35%; /* Slightly narrower on very large screens */
            }
        }

        .details-popup-header {
            position: relative;
            width: 100%;
            height: 350px; /* Default height for desktop */
            overflow: hidden;
            display: flex;
            align-items: flex-end; /* Align content to bottom */
            padding: 1rem;
            background-color: #000; /* Fallback/fill for object-fit: cover */
            flex-shrink: 0; /* Prevent header from shrinking */
        }

        /* NEW: Mobile specific adjustment for details popup header height */
        @media (max-width: 767px) {
            .details-popup-header {
                height: 30vh; /* Use 30% of viewport height for responsiveness */
                min-height: 180px; /* Ensure a minimum height */
                padding-bottom: 0.5rem; /* Reduced padding at bottom for mobile */
            }
        }

        .details-popup-header img.background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Changed to cover to remove black bars */
            object-position: center top; /* Focus on the top part of the image */
            filter: brightness(0.6); /* Dim the background image */
            z-index: 1;
        }

        .details-popup-header .overlay-gradient {
            position: absolute;
            inset: 0;
            /* Stronger gradient at the bottom for smooth transition to black content */
            background: linear-gradient(to top, rgba(13,13,13,1) 0%, rgba(13,13,13,0.9) 30%, rgba(13,13,13,0.6) 60%, rgba(13,13,13,0) 100%);
            z-index: 2;
        }

        .details-popup-header .title-content {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Left align title and logo */
            width: 100%;
            padding-left: 0.5rem; /* Small left padding for mobile */
        }

        .details-popup-header .title-logo {
            max-height: 70px; /* Default max height for title logo */
            width: auto;
            object-fit: contain;
            margin-bottom: 0.5rem;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.6));
        }

        @media (max-width: 767px) {
            .details-popup-header .title-logo {
                max-height: 48px; /* Slightly smaller logo on mobile */
                margin-bottom: 0.25rem; /* Reduced margin */
            }
        }


        .details-popup-header .main-title {
            font-size: 2.25rem; /* Large title */
            font-weight: 700;
            line-height: 1.1;
            text-shadow: 0 2px 4px rgba(0,0,0,0.8);
            margin-bottom: 0.5rem;
        }

        @media (max-width: 767px) {
            .details-popup-header .main-title {
                font-size: 1.75rem; /* Smaller title on mobile */
                margin-bottom: 0.25rem; /* Reduced margin */
            }
        }

        .details-popup-header .info-line {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            color: #BFBFBF;
        }
        @media (max-width: 767px) {
            .details-popup-header .info-line {
                font-size: 0.75rem; /* Smaller info line on mobile */
                gap: 0.5rem; /* Reduced gap */
            }
            .details-popup-header .info-line .badge {
                padding: 0.15rem 0.5rem; /* Smaller padding for badges */
            }
        }

        .details-popup-header .info-line .badge {
            background-color: rgba(255, 255, 255, 0.15);
            padding: 0.2rem 0.6rem;
            border-radius: 0.25rem;
            font-weight: 600;
            color: #FFFFFF;
        }

        .details-popup-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            padding: 0.5rem;
            cursor: pointer;
            z-index: 10; /* Ensure it's above other header elements */
            transition: background-color 0.2s ease;
        }
        .details-popup-close:hover {
            background-color: rgba(0, 0, 0, 0.9);
        }

        .details-popup-content {
            flex-grow: 1;
            overflow-y: auto; /* Enable scrolling for content */
            padding: 1.5rem;
            background-color: #0D0D0D; /* Ensure consistent background */
            padding-bottom: 7rem; /* Add padding for the sticky footer button */
        }

        /* Custom scrollbar for popup content */
        .details-popup-content::-webkit-scrollbar {
            width: 8px;
        }
        .details-popup-content::-webkit-scrollbar-track {
            background: #1A1A1A;
            border-radius: 10px;
        }
        .details-popup-content::-webkit-scrollbar-thumb {
            background: #F48B01;
            border-radius: 10px;
        }
        .details-popup-content::-webkit-scrollbar-thumb:hover {
            background: #FF9900;
        }

        /* Season Selector */
        .season-selector {
            margin-bottom: 1.5rem;
        }

        .season-selector label {
            display: block;
            font-size: 0.9rem;
            color: #BFBFBF;
            margin-bottom: 0.5rem;
        }

        .season-selector select {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: #1A1A1A;
            border: 1px solid #333;
            border-radius: 0.5rem;
            color: white;
            font-size: 1rem;
            appearance: none; /* Remove default arrow */
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%20viewBox%3D%220%200%20292.4%20292.4%22%3E%3Cpath%20fill%3D%22%23ffffff%22%20d%3D%22M287%20197.6L146.2%2056.8%205.4%20197.6z%22%2F%3E%3C%2Fsvg%3E'); /* Custom arrow */
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 0.8em;
            cursor: pointer;
            transition: border-color 0.2s ease, background-color 0.2s ease;
        }

        .season-selector select:hover,
        .season-selector select:focus {
            border-color: #F47521;
            background-color: #2A2A2A;
            outline: none;
        }

        .episode-list-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            cursor: pointer;
            transition: background-color 0.2s ease;
            text-decoration: none; /* Ensure links don't have underlines */
            color: inherit; /* Inherit text color */
        }
        .episode-list-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        .episode-list-item:last-child {
            border-bottom: none;
        }
        .episode-list-item img {
            width: 120px; /* Fixed thumbnail width */
            height: 67.5px; /* 16:9 aspect ratio */
            object-fit: cover;
            border-radius: 0.25rem;
            flex-shrink: 0;
        }
        .episode-list-item .episode-info {
            flex-grow: 1;
            min-width: 0; /* Important for text-overflow to work */
        }
        .episode-list-item .episode-info .ep-number {
            font-size: 0.8rem;
            color: #BFBFBF;
        }
        .episode-list-item .episode-info .ep-title {
            font-size: 1rem;
            font-weight: 600;
            color: #FFFFFF;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; /* Ensures ellipsis for long titles */
        }

        /* Load More Episodes Button */
        .load-more-button {
            width: 100%;
            padding: 0.75rem 1.5rem;
            background-color: #2A2A2A;
            color: #F47521;
            border: 1px solid #F47521;
            border-radius: 0.5rem;
            font-weight: 600;
            margin-top: 1.5rem;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        .load-more-button:hover {
            background-color: #F47521;
            color: white;
        }

        /* Sticky Footer for Popup Button */
        .details-popup-footer {
            position: sticky;
            bottom: 0;
            width: 100%;
            background-color: #0D0D0D; /* Match popup background */
            padding: 1.5rem;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.5); /* Shadow to separate from content */
            z-index: 10; /* Ensure it's above scrolling content */
        }

        /* Specific styles for the "Start Watching" button within the popup footer */
        .details-popup-footer .watch-button {
            /* Adjusted padding to make it vertically smaller */
            padding: 0.6rem 2.5rem; /* Reduced vertical padding */
            /* Removed border-radius for sharp edges */
            border-radius: 0; /* Sharp edges */
            /* Added gradient background */
            background: linear-gradient(to right, #f05c0c, #FF8C00); /* Orange to slightly lighter orange */
            transition: background 0.3s ease; /* Smooth transition for hover */
        }

        .details-popup-footer .watch-button:hover {
            background: linear-gradient(to right, #FF8C00, #f05c0c); /* Reverse gradient on hover */
        }

        /* Responsive Card Sizing and Text Wrapping for Larger Screens */
        @media (min-width: 1024px) { /* lg breakpoint */
            /* Standard Anime Card */
            .anime-card-hover-effect {
                width: 12rem; /* Default for lg, approx 192px */
            }
            /* New Episode Card */
            .episode-card-new-ep {
                width: 18rem; /* Default for lg, approx 288px */
            }
            /* Movie Card */
            .movie-card {
                width: 20rem; /* Default for lg, approx 320px */
            }

            /* REMOVED: Rules that allowed text wrapping on larger screens */
            /* This ensures ellipsis is always applied for long titles */
            /*
            .anime-card-hover-effect .p-2 h4,
            .anime-card-hover-effect .p-2 p,
            .movie-card-content .title,
            .movie-card-content .info-line,
            .episode-card-new-ep .content-area-pc .series-title-pc,
            .episode-card-new-ep .content-area-pc .episode-title-pc,
            .episode-card-new-ep .content-area-pc .status-text-pc {
                white-space: normal;
                overflow: visible;
                text-overflow: clip;
            }
            */
            
            /* Increase font size for better readability on larger screens */
            .anime-card-hover-effect .p-2 h4 { font-size: 1.125rem; } /* text-lg */
            .anime-card-hover-effect .p-2 p { font-size: 0.875rem; } /* text-sm */

            .movie-card-content .title { font-size: 1.125rem; } /* text-lg */
            .movie-card-content .info-line { font-size: 0.875rem; } /* text-sm */

            .episode-card-new-ep .content-area-pc .series-title-pc { font-size: 1rem; } /* text-base */
            .episode-card-new-ep .content-area-pc .episode-title-pc { font-size: 1.125rem; } /* text-lg */
            .episode-card-new-ep .content-area-pc .status-text-pc { font-size: 0.875rem; } /* text-sm */

            /* Hide mobile overlaid text on large screens (already hidden by default, but ensure) */
            .overlaid-text-mobile {
                display: none !important;
            }
        }

        @media (min-width: 1280px) { /* xl breakpoint */
            /* Further increase card sizes for very large screens */
            .anime-card-hover-effect {
                width: 14rem; /* approx 224px */
            }
            .episode-card-new-ep {
                width: 20rem; /* approx 320px */
            }
            .movie-card {
                width: 22rem; /* approx 352px */
            }
        }

        /* Loading More Content Indicator */
        #loading-more-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
            color: #BFBFBF;
            font-size: 1rem;
            text-align: center;
        }
        #loading-more-content.hidden {
            display: none;
        }
        /* Spinner for loading more content */
        .loading-spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #F47521;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin-bottom: 0.5rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Loading Overlay - Initially visible -->
    <div id="loading-overlay">
        <div class="loading-container">
            <div class="loading-cube"><div class="loading-cube__inner"></div></div>
            <div class="loading-cube"><div class="loading-cube__inner"></div></div>
            <div class="loading-cube"><div class="loading-cube__inner"></div></div>
        </div>
        <p class="text-white text-lg mt-8">Loading ChibiHaven...</p>
    </div>

    <header class="header-transparent-blur text-white shadow-lg">
        <nav class="container mx-auto px-4 py-3 flex items-center justify-between flex-wrap">
            <!-- Logo/Brand Name -->
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <a href="home" class="font-bold text-2xl tracking-tight flex items-center">
                    <img src="icons/logo1.png?v=3" alt="ChibiHaven Logo" class="header-logo">
                </a>
            </div>

            <!-- Mobile Menu Button (Hamburger) -->
            <div class="block lg:hidden">
                <button id="menu-button" class="flex items-center px-3 py-2 border rounded text-gray-400 border-gray-600 hover:text-white hover:border-white focus:outline-none focus:ring-2 focus:ring-white">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v15z"/></svg>
                </button>
            </div>

            <!-- Navigation Links (visible in mobile dropdown) -->
            <div id="mobile-nav-links" class="w-full block flex-grow lg:flex lg:items-center lg:w-auto hidden">
                <!-- Centered Navigation Links -->
                <div class="text-sm w-full lg:w-auto lg:flex lg:justify-center lg:flex-1">
                    <a href="home" class="block mt-4 lg:inline-block lg:mt-0 text-gray-300 hover:text-white mr-4 px-3 py-2 rounded-md transition-colors duration-200 nav-link-animation">
                        Home
                    </a>
                    
                    <!-- Browse Dropdown -->
                    <div class="relative inline-block text-left dropdown block mt-4 lg:inline-block lg:mt-0">
                        <a href="" id="browse-dropdown-button" class="text-gray-300 hover:text-white mr-4 px-3 py-2 rounded-md transition-colors duration-200 nav-link-animation cursor-pointer flex items-center">
                            Browse
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="series/browse">Genres</a>
                            <a href="series/browse">New Releases</a>
                            <a href="series/browse">Alphabetical</a>
                        </div>
                    </div>
                    <a href="manga" class="block mt-4 lg:inline-block lg:mt-0 text-gray-300 hover:text-white mr-4 px-3 py-2 rounded-md transition-colors duration-200 nav-link-animation">
                        Manga
                    </a>
                </div>
            </div>

            <!-- Search Icon and Profile Dropdown (visible only on desktop, hidden on mobile) -->
            <div class="hidden lg:flex items-center ml-auto">
                <div class="relative mr-4">
                    <a href="search" class="block text-gray-400 hover:text-white transition-colors duration-200">
                        <i class="fas fa-search text-xl p-2"></i>
                    </a>
                </div>
                
                <!-- Profile Dropdown -->
            <?php if (isset($_SESSION['username'])): ?>
            <!-- ✅ Profile Dropdown (If Logged In) -->
            <div class="relative inline-block text-left dropdown profile-dropdown">
                <a href="#" id="profile-dropdown-button"
                    class="block text-gray-400 hover:text-white transition-colors duration-200 cursor-pointer">
                    <i class="fas fa-user-circle"></i>
                    <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                    <div class="profile-dropdown-header">
                        <img src="https://placehold.co/48x48/F47521/ffffff?text=:|" alt="Profile Picture">
                        <div class="profile-info">
                            <h3>
                                <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </h3>
                        </div>
                        <a href="/personal/profile" class="edit-profile-icon"><i class="fas fa-pencil-alt"></i></a>
                    </div>
                    <a href="home.php"><i class="fas fa-cog"></i> Settings</a>
                    <a href="home.php"><i class="fas fa-bookmark"></i> Watchlist</a>
                    <a href="/Backend/logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                </div>
            </div>
            <?php else: ?>
            <!-- ❌ Login/Register (If Not Logged In) -->
            <div class="flex items-center gap-3">
                <a href="/Backend/login.php"
                    class="text-gray-400 hover:text-white transition-colors duration-200 px-3 py-2 rounded-md">Login</a>
                <a href="/Backend/register.php"
                    class="text-gray-400 hover:text-white transition-colors duration-200 px-3 py-2 rounded-md border border-gray-500 hover:border-white">Register</a>
            </div>
            <?php endif; ?>
        </div>
        </nav>
    </header>

    <!-- Hero Section (Full Width) -->
    <section id="heroSection" class="hero-section">
        <img id="heroBackgroundImage" src="image_2c931d.png" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000 ease-in-out" loading="eager" decoding="async" fetchpriority="high">
        <div class="hero-overlay"></div>
        <div id="heroContent" class="hero-content">
            <!-- Title - This will now dynamically hold either text or an image -->
            <h1 id="heroTitle" class="text-white font-extrabold mb-4 leading-tight text-center md:text-left">
                <!-- Content will be dynamically set by JavaScript -->
            </h1>

            <!-- Info Line: Age Rating | Sub | Dub -->
            <div class="hero-info-line mb-4">
                <span id="heroContentRating" class="rating-badge">16+</span>
                <span id="heroSubDub" class="sub-dub">Sub | Dub</span>
            </div>

            <!-- Description -->
            <p id="heroDescription" class="text-lg text-gray-200 mb-6 line-clamp-3">
                One of the Lords of Dark Beasts, Clevatess's reign shatters when he revives a hero he personally slayed and adopts an orphaned humanoid baby—the last hope to save a dying world. Now bound together, what fate awaits this unlikely...
            </p>

            <!-- Buttons -->
            <div class="flex items-center flex-wrap gap-4">
                <a id="heroWatchButton" href="/clevatess.php" class="watch-button bg-[#f05c0c] hover:bg-[#f05c0c] text-white font-semibold py-3 px-6 rounded-full transition duration-300 shine-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-circle mr-2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                    START WATCHING E1
                </a>
                <!-- "View Details" button is now visible and opens the popup -->
                <a id="heroDetailsButton" href="#" class="watch-button bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-full transition duration-300 shine-button">
                    View Details
                </a>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <div class="hero-nav-arrow left hidden md:block">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
        </div>
        <div class="hero-nav-arrow right hidden md:block">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
        </div>

        <!-- Carousel Dots -->
        <div class="hero-dots-container flex">
            <!-- Dots will be dynamically generated here -->
        </div>
    </section>

    <!-- Main Content Area (now dynamically populated) -->
    <main class="flex-grow pt-12 pb-8 px-4 md:px-8 lg:px-12">
        <!-- Dynamic sections will be inserted here by JavaScript -->
        <!-- Loading More Content Indicator -->
        <div id="loading-more-content" class="hidden">
            <div class="loading-spinner"></div>
            <p>Loading more content...</p>
        </div>
    </main><br><br>

    <!-- Footer -->
    <footer class="bg-[#1A1A1A] p-6 mt-12 shadow-inner text-center text-[#A0A0A0]">
        <div class="container mx-auto">
            <p>&copy; <span id="currentYear"></span> ChibiHaven. All rights reserved.</p>
        </div>
    </footer>

    <!-- Details Popup Structure -->
    <div id="details-overlay"></div>
    <div id="details-popup">
        <div class="details-popup-header">
            <img id="popup-background-image" src="" alt="Background Image" class="background-image">
            <div class="overlay-gradient"></div>
            <div class="title-content">
                <!-- The title logo will be displayed here if available -->
                <img id="popup-title-logo" src="" alt="Title Logo" class="title-logo hidden">
                <!-- The main title text will be displayed here if no logo -->
                <h2 id="popup-main-title" class="main-title"></h2>
                <div class="info-line">
                    <span id="popup-content-rating" class="badge"></span>
                    <span id="popup-sub-dub" class="badge"></span>
                </div>
            </div>
            <button id="details-popup-close" class="details-popup-close text-white text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="details-popup-content">
            <p id="popup-synopsis" class="text-gray-300 mb-6 leading-relaxed"></p>
            
            <!-- Season Selector -->
            <div id="season-selector-container" class="season-selector hidden">
                <label for="season-select">Select Season:</label>
                <select id="season-select"></select>
            </div>

            <h3 class="text-xl font-bold mb-4">Episodes</h3>
            <div id="popup-episode-list" class="flex flex-col gap-2">
                <!-- Episodes will be dynamically inserted here -->
            </div>
            <p id="no-episodes-message" class="text-gray-400 text-center mt-4 hidden">No episodes available.</p>
            
            <!-- Load More Episodes Button -->
            <button id="load-more-episodes-button" class="load-more-button hidden"></button>
        </div>
        <!-- Sticky footer for the "Start Watching" button -->
        <div class="details-popup-footer">
            <a id="popup-watch-button" href="#" class="watch-button bg-[#f05c0c] hover:bg-[#f05c0c] text-white font-semibold py-3 px-6 rounded-full transition duration-300 shine-button w-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-circle mr-2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                START WATCHING
            </a>
        </div>
    </div>

    <!-- JavaScript for dynamic content and interactivity -->
    <script>
        // Static array for slider images with associated content
        const heroSlidesData = [
            {
                image: 'https://host.chibihaven.fun/images/slider-banners/lord-of-the-mysteries-desktop.png', 
                mobileImage: 'https://host.chibihaven.fun/images/slider-banners/lord-of-the-mysteries-mobile.png', 
                title: 'Lord Of The Mysteries',
                titleImage: 'https://host.chibihaven.fun/images/title-logo/lord-of-mystries.png',
                contentRating: '14+',
                subDub: 'Dubbed',
                description: 'In Victorian-era London, Ciel Phantomhive, a young earl, is served by Sebastian Michaelis, a demon butler with extraordinary powers. Together, they solve mysteries and out the Queen\'s orders, all while Sebastian awaits the day he can consume Ciel\'s soul.',
                watchUrl: 'watch/Series/Lord-of-The-Mysteries.php?episode=1',
                detailsUrl: '',
                synopsis: 'In Victorian-era London, Ciel Phantomhive, a young earl, is served by Sebastian Michaelis, a demon butler with extraordinary powers. Together, they solve mysteries and out the Queen\'s orders, all while Sebastian awaits the day he can consume Ciel\'s soul.',
                episodes: {
                    "Season 1": [
                        { episodeNumber: 1, episodeTitle: 'The Fool', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/lord-of-the-mysteries/ep1.jpg', url: 'watch/Series/Lord-of-The-Mysteries.php?episode=1' },
                    ],
                }
             },
             {
                image: 'https://host.chibihaven.fun/images/slider-banners/black-butler-desktop.png?v=2', 
                mobileImage: 'https://host.chibihaven.fun/images/slider-banners/black-butler-mobile.png', 
                title: 'Black Butler',
                titleImage: 'https://host.chibihaven.fun/images/title-logo/black-butler.png', 
                contentRating: '16+',
                subDub: 'Dubbed',
                description: 'Ciel Phantomhive is the most powerful boy in all of England, but he bears the scars of unspeakable suffering. Forced to watch as his beloved parents were brutally murdered, Ciel was subsequently abducted and violently tortured. Desperate to end his suffering, the boy traded his own soul for a chance at vengeance, casting his lot with the one person on whom he could depend: Sebastian, a demon Butler summoned from the very pits of hell. Together, they’ll prowl the darkest alleys of London on a mission to snuff out those who would do evil.',
                watchUrl: 'watch/Black-Butler.php?episode=1',
                detailsUrl: 'details/black-butler.php',
                synopsis: 'Ciel Phantomhive is the most powerful boy in all of England, but he bears the scars of unspeakable suffering. Forced to watch as his beloved parents were brutally murdered, Ciel was subsequently abducted and violently tortured. Desperate to end his suffering, the boy traded his own soul for a chance at vengeance, casting his lot with the one person on whom he could depend: Sebastian, a demon Butler summoned from the very pits of hell. Together, they’ll prowl the darkest alleys of London on a mission to snuff out those who would do evil.',
                // UPDATED: Episodes now an object keyed by season
                episodes: {
                    "S4: Public School Arc": [
                        { "episodeNumber": 1, "episodeTitle": "His Butler, at School", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep1.jpg", "url": "watch/Series/Black-Butler.php?episode=1" },
  { "episodeNumber": 2, "episodeTitle": "His Butler, in Disguise", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep2.jpg", "url": "watch/Series/Black-Butler.php?episode=2" },
  { "episodeNumber": 3, "episodeTitle": "His Butler, Plotting", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep3.jpg", "url": "watch/Series/Black-Butler.php?episode=3" },
  { "episodeNumber": 4, "episodeTitle": "His Butler, Colluding", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep4.jpg", "url": "watch/Series/Black-Butler.php?episode=4" },
  { "episodeNumber": 5, "episodeTitle": "His Butler, Gaining Admittance", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep5.jpg", "url": "watch/Series/Black-Butler.php?episode=5" },
  { "episodeNumber": 6, "episodeTitle": "His Butler, Scheming", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep6.jpg", "url": "watch/Series/Black-Butler.php?episode=6" },
  { "episodeNumber": 7, "episodeTitle": "His Butler, Final Match", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep7.jpg", "url": "watch/Series/Black-Butler.php?episode=7" },
  { "episodeNumber": 8, "episodeTitle": "His Butler, Locking Up", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep8.jpg", "url": "watch/Series/Black-Butler.php?episode=8" },
  { "episodeNumber": 9, "episodeTitle": "His Butler, Having a Laugh", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep9.jpg", "url": "watch/Series/Black-Butler.php?episode=9" },
  { "episodeNumber": 10, "episodeTitle": "His Butler, Assenting", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep10.jpg", "url": "watch/Series/Black-Butler.php?episode=10" },
  { "episodeNumber": 11, "episodeTitle": "His Butler, Taking Off", "thumbnail": "https://host.chibihaven.fun/images/Anime-ep-thumbnails/black-butler/season4/ep11.jpg", "url": "watch/Series/Black-Butler.php?episode=11" }
                    ],
                    "S4: Emerald Witch Arc": [
                        
                    ]
                }
            },
            {
                image: 'https://host.chibihaven.fun/images/slider-banners/The-Children-of-Shiunji-Family-desktop.png?v=3', 
                mobileImage: 'https://host.chibihaven.fun/images/slider-banners/The-Children-of-Shiunji-Family-mobile.png?v=3', 
                title: 'THE SHIUNJI FAMILY CHILDREN',
                titleImage: 'https://host.chibihaven.fun/images/title-logo/The-shiunji-family-children.png',
                contentRating: '16+',
                subDub: 'Dubbed',
                description: 'The Shiunji Family Children follows the daily lives and complex relationships within the eccentric Shiunji family, known for their extraordinary talents and peculiar dynamics. Each sibling possesses a unique genius, leading to a mix of heartwarming and comedic situations as they navigate their unusual family life.',
                watchUrl: 'watch/Series/The-Shiunji-Family-Children.php?episode=1',
                detailsUrl: '',
                synopsis: 'The Shiunji Family Children follows the daily lives and complex relationships within the eccentric Shiunji family, known for their extraordinary talents and peculiar dynamics. Each sibling possesses a unique genius, leading to a mix of heartwarming and comedic situations as they navigate their unusual family life.',
                episodes: {
                    "Season 1": [
  { "episodeNumber": 1, "episodeTitle": "What If...?", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep1.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=1" },
  { "episodeNumber": 2, "episodeTitle": "Now What", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep2.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=2" },
  { "episodeNumber": 3, "episodeTitle": "For Now", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep3.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=3" },
  { "episodeNumber": 4, "episodeTitle": "Respectively", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep4.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=4" },
  { "episodeNumber": 5, "episodeTitle": "Perhaps", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep5.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=5" },
  { "episodeNumber": 6, "episodeTitle": "Now's the Time", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep6.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=6" },
  { "episodeNumber": 7, "episodeTitle": "Surely", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep7.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=7" },
  { "episodeNumber": 8, "episodeTitle": "Since Then", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep8.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=8" },
  { "episodeNumber": 9, "episodeTitle": "Not Yet", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep9.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=9" },
  { "episodeNumber": 10, "episodeTitle": "Finally", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep10.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=10" },
  { "episodeNumber": 11, "episodeTitle": "So Then", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep11.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=11" },
  { "episodeNumber": 12, "episodeTitle": "Still", "thumbnail": "img/Anime-ep-thumbnails/the shiunji family children/ep12.jpg", "url": "watch/Series/The-Shiunji-Family-Children.php?episode=12" }
]
                }
            },
            {
                image: 'https://host.chibihaven.fun/images/slider-banners/dan-da-dan-desktop.png', 
                mobileImage: 'img/slider-banners/dan-da-dan-mobile.jpg?v=2', 
                title: 'DAN DA DAN',
                titleImage: 'https://host.chibihaven.fun/images/title-logo/dan-da-dan.png',
                contentRating: '16+',
                subDub: 'Dubbed',
                description: 'Momo Ayase and Okarun, two high school students, find themselves entangled in a supernatural battle between aliens and spirits. Their bizarre adventures unfold as they try to prove the existence of the supernatural to each other, leading to hilarious and action-packed encounters.',
                watchUrl: 'watch/Dan-Da-Dan.php?episode=1',
                detailsUrl: 'details/dan-da-dan.php',
                synopsis: 'Momo Ayase and Okarun, two high school students, find themselves entangled in a supernatural battle between aliens and spirits. Their bizarre adventures unfold as they try to prove the existence of the supernatural to each other, leading to hilarious and action-packed encounters.',
                // UPDATED: Episodes now an object keyed by season
                episodes: {
                    "Season 1": [
                        { episodeNumber: 1, episodeTitle: 'That\'s How Love Starts, Ya Know?', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep1.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=1' },
                        { episodeNumber: 2, episodeTitle: 'That\'s a Space Alien, Ain\'t It?!', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep2.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=2' },
                        { episodeNumber: 3, episodeTitle: 'It\'s a Granny vs. Granny Clash!', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep3.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=3' },
                        { episodeNumber: 4, episodeTitle: 'Kicking Turbo Granny\'s Ass', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep4.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=4' },
                        { episodeNumber: 5, episodeTitle: 'Like, Where Are Your Balls?!', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep5.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=5' },
                        { episodeNumber: 6, episodeTitle: 'A Dangerous Woman Arrives', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep6.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=6' },
                        { episodeNumber: 7, episodeTitle: 'To a Kinder World', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep7.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=7' },
                        { episodeNumber: 8, episodeTitle: 'I\'ve Got This Funny Feeling', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep8.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=8' },
                        { episodeNumber: 9, episodeTitle: 'Merge! Serpo Dover Demon Nessie!', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep9.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=9' },
                        { episodeNumber: 10, episodeTitle: 'Have You Ever Seen a Cattle Mutilation?', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep10.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=10' },
                        { episodeNumber: 11, episodeTitle: 'First Love', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep11.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=11' },
                        { episodeNumber: 12, episodeTitle: 'Let\'s Go to the Cursed House', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season1/ep12.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=12' }
                    ],
                    "Season 2": [
                        { episodeNumber: 13, episodeTitle: 'Like, This Is the Legend of the Giant Snake', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season2/ep1.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=13' },
                        { episodeNumber: 14, episodeTitle: 'The Evil Eye', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season2/ep2.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=14' },
                        { episodeNumber: 15, episodeTitle: 'You Won’t Get Away With This!', thumbnail: 'https://host.chibihaven.fun/images/Anime-ep-thumbnails/dan-da-dan/season2/ep3.jpg', url: 'watch/Series/Dan-Da-Dan.php?episode=15' }
                    ]
                }
            },
        ];

        let currentSlideIndex = 0;
        let slideInterval;
        const slideDuration = 5000; // 5 seconds

        // DOM elements for slider
        let heroSection; // New: Reference to the hero section itself
        let heroBackgroundImage;
        let heroContent; // New reference for the content block
        let heroTitle;
        let heroDescription;
        let heroContentRating;
        let heroSubDub;
        let heroWatchButton;
        let heroDetailsButton; // New: Reference to the View Details button
        let heroDots;
        let heroLeftArrow;
        let heroRightArrow;

        // Touch swipe variables
        let touchStartX = 0;
        let touchEndX = 0;
        const swipeThreshold = 50; // Minimum pixels to register a swipe

        // DOM element references for home page content
        let mainContentArea; // Reference to the main content area to append sections
        let loadingOverlay; // Reference to the loading overlay

        // Details Popup DOM elements
        let detailsOverlay;
        let detailsPopup;
        let popupBackgroundImage;
        let popupTitleLogo;
        let popupMainTitle;
        let popupContentRating;
        let popupSubDub;
        let popupSynopsis;
        let popupWatchButton;
        let popupEpisodeList;
        let noEpisodesMessage;
        let detailsPopupCloseButton;
        let seasonSelectorContainer; // New: Season selector container
        let seasonSelect; // New: Season dropdown element
        let loadMoreEpisodesButton; // New: Load more button

        // State variables for details popup episode list
        let currentPopupItemData = null; // Stores the full data of the item currently in the popup
        let currentDisplayedSeason = null; // Stores the key of the currently selected season (e.g., "Season 1")
        let currentDisplayedEpisodeCount = 0; // How many episodes are currently visible
        const episodesPerLoad = 12; // Number of episodes to show initially and load per click

        // Infinite Scroll Variables
        let allHomeAnimeData = []; // Stores the full fetched data
        let loadedSectionCount = 0; // How many sections have been appended to the DOM
        const sectionsToLoadPerChunk = 3; // Number of sections to load each time
        let isLoadingMoreContent = false; // Flag to prevent multiple rapid load calls
        let loadingMoreIndicator; // Reference to the loading indicator element

        /**
         * Sanitizes a string to be used in a URL slug.
         * Converts to lowercase, replaces spaces with hyphens, and removes non-alphanumeric characters.
         * @param {string} title - The input string (e.g., anime title).
         * @returns {string} The URL-friendly slug.
         */
        function createSlug(title) {
            return title
                .toLowerCase()
                .replace(/\s+/g, '-')          // Replace spaces with hyphens
                .replace(/[^a-z0-9-]/g, '')     // Remove non-alphanumeric characters (except hyphens)
                .replace(/--+/g, '-')           // Replace multiple hyphens with a single hyphen
                .replace(/^-+|-+$/g, '');       // Trim hyphens from start/end
        }

        /**
         * Renders a single anime card HTML structure for standard anime sections.
         * @param {Object} anime - The anime object.
         * @param {boolean} isCarousel - True if the card is for a horizontal carousel, false for a grid.
         * @returns {string} The HTML string for the anime card.
         */
        function createAnimeCardHtml(anime, isCarousel) {
            const cardSizingClasses = isCarousel ? 'w-28 flex-shrink-0 md:w-40 lg:w-48 xl:w-56' : '';
            const imageUrl = anime.image || 'https://placehold.co/280x420/1a202c/e2e8f0?text=No+Image';

            return `
                <div class="
                    bg-[#1A1A1A] shadow-xl overflow-hidden
                    group cursor-pointer shine-effect-card anime-card-hover-effect
                    ${cardSizingClasses}"
                >
                    <div class="relative w-full aspect-[2/3]">
                        <img
                            src="${imageUrl}"
                            alt="${anime.title}"
                            class="absolute inset-0 w-full h-full object-cover bg-black"
                            loading="lazy"
                            decoding="async"
                            onerror="this.onerror=null;this.src='https://placehold.co/280x420/1a202c/e2e8f0?text=No+Image';"
                        />
                        <div class="absolute inset-0 z-10 bg-transparent pointer-events-auto"></div>
                    </div>
                    <div class="p-2">
                        <h4 class="text-sm font-semibold text-white text-left whitespace-nowrap truncate">
                            ${anime.title}
                        </h4>
                        <p class="text-xs text-[#BFBFBF] mt-1">
                            ${anime.infoLine || ''}
                        </p>
                    </div>
                </div>
            `;
        }

        /**
         * Renders an episode card HTML structure for the "New Ep Added" section.
         * @param {Object} anime - The anime object.
         * @returns {string} The HTML string for the episode card.
         */
        function createNewEpisodeCardHtml(anime) {
            const newEpisodeBadge = anime.isNew ? `
                <span class="new-episode-badge">
                    NEW EP ${anime.season ? `S${anime.season}` : ''}${anime.episodeNumber ? ` E${anime.episodeNumber}` : ''}
                </span>
            ` : '';

            const imageUrl = anime.image || 'https://placehold.co/400x225/0D0D0D/FFFFFF?text=No+Image';

            return `
                <a href="${anime.url || '#'}" class="episode-card-new-ep w-64 md:w-72 lg:w-80 xl:w-96">
                    <div class="thumbnail-wrapper">
                        <img
                            src="${imageUrl}"
                            alt="${anime.seriesTitle} - ${anime.episodeTitle}"
                            loading="lazy"
                            decoding="async"
                            onerror="this.onerror=null;this.src='https://placehold.co/400x225/0D0D0D/FFFFFF?text=No+Image';"
                        />
                        <div class="play-overlay">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-circle">
                                <circle cx="12" cy="12" r="10"/>
                                <polygon points="10 8 16 12 10 16 10 8" fill="currentColor"/>
                            </svg>
                        </div>
                        ${anime.timeRemaining ? `<span class="time-remaining-badge">${anime.timeRemaining}</span>` : ''}
                        ${newEpisodeBadge}
                        <div class="absolute inset-0 z-10 bg-transparent pointer-events-auto"></div>
                        <div class="overlaid-text-mobile">
                            <p class="series-title-mobile">${anime.seriesTitle}</p>
                            <h4 class="episode-title-mobile">${anime.episodeTitle}</h4>
                            <p class="status-text-mobile">${anime.infoLine || ''}</p>
                        </div>
                    </div>
                    <div class="content-area-pc">
                        <p class="series-title-pc">${anime.seriesTitle}</p>
                        <h4 class="episode-title-pc">${anime.episodeTitle}</h4>
                        <p class="status-text-pc">${anime.infoLine || ''}</p>
                    </div>
                </a>
            `;
        }

        /**
         * Renders a movie card HTML structure for sections with cardType "movie".
         * @param {Object} movie - The movie object.
         * @returns {string} The HTML string for the movie card.
         */
        function createMovieCardHtml(movie) {
            const nLogo = movie.hasNLogo ? `<span class="n-logo">N</span>` : '';
            const imageUrl = movie.image || 'https://placehold.co/280x158/0D0D0D/FFFFFF?text=No+Image';

            return `
                <div class="movie-card shine-effect-card anime-card-hover-effect w-72 md:w-80 lg:w-96 xl:w-112">
                    <div class="relative w-full aspect-[16/9]">
                        <img
                            src="${imageUrl}"
                            alt="${movie.title}"
                            class="absolute inset-0 w-full h-full object-cover bg-black"
                            loading="lazy"
                            decoding="async"
                            onerror="this.onerror=null;this.src='https://placehold.co/280x158/0D0D0D/FFFFFF?text=No+Image';"
                        />
                        ${nLogo}
                        <div class="absolute inset-0 z-10 bg-transparent pointer-events-auto"></div>
                    </div>
                    <div class="movie-card-content">
                        <h4 class="title">${movie.title}</h4>
                        <p class="info-line">${movie.infoLine || ''}</p>
                    </div>
                </div>
            `;
        }

        /**
         * Appends a given set of section data to the main content area.
         * @param {Array} sectionsToAppend - Array of section objects to append.
         */
        function appendSectionsToDOM(sectionsToAppend) {
            console.log("appendSectionsToDOM called with data:", sectionsToAppend);
            if (!mainContentArea) {
                console.error("Main content area not found for rendering sections.");
                return;
            }

            if (!Array.isArray(sectionsToAppend) || sectionsToAppend.length === 0) {
                console.warn("No valid section data to append.");
                return;
            }

            sectionsToAppend.forEach(section => {
                const sectionName = section.name;
                const cardType = section.cardType;
                const items = section.items;

                console.log(`Appending section: ${sectionName}, type: ${cardType}, items count: ${items ? items.length : 0}`);

                if (!sectionName || !cardType || !Array.isArray(items) || items.length === 0) {
                    console.warn(`Skipping malformed or empty section during append: ${sectionName || 'Unnamed Section'}`);
                    return;
                }

                const sectionElement = document.createElement('section');
                const sectionMarginTopClass = window.innerWidth <= 767 ? 'mt-0' : 'mt-8';
                sectionElement.className = `w-full py-4 ${sectionMarginTopClass}`;

                const sectionTitle = document.createElement('h2');
                sectionTitle.className = 'text-3xl font-bold mb-6 text-[#FFFFFF]';
                sectionTitle.textContent = sectionName;
                sectionElement.appendChild(sectionTitle);

                const carouselContainer = document.createElement('div');
                carouselContainer.className = 'flex overflow-x-auto pb-4 space-x-4 horizontal-scroll-container';

                items.forEach(item => {
                    let cardHtml = '';
                    switch (cardType) {
                        case 'newEpisode':
                            cardHtml = createNewEpisodeCardHtml(item);
                            break;
                        case 'movie':
                            cardHtml = createMovieCardHtml(item);
                            break;
                        case 'anime':
                            cardHtml = createAnimeCardHtml(item, true);
                            break;
                        default:
                            console.warn(`Unknown cardType: "${cardType}" for section: "${sectionName}". Skipping item.`);
                            break;
                    }
                    
                    if (cardHtml) {
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = cardHtml;
                        const cardElement = tempDiv.firstElementChild;

                        if (cardType === 'anime' || cardType === 'movie') {
                            cardElement.setAttribute('data-item-data', encodeURIComponent(JSON.stringify(item)));
                            cardElement.addEventListener('click', () => {
                                try {
                                    openDetailsPopup(JSON.parse(decodeURIComponent(cardElement.dataset.itemData)));
                                } catch (e) {
                                    console.error("Error parsing itemData for popup:", e, cardElement.dataset.itemData);
                                }
                            });
                        }
                        carouselContainer.appendChild(cardElement);
                    }
                });

                sectionElement.appendChild(carouselContainer);
                mainContentArea.insertBefore(sectionElement, loadingMoreIndicator); // Insert before the loading indicator
                console.log(`Section "${sectionName}" appended to main content area.`);
            });
        }

        /**
         * Loads the next chunk of content sections.
         */
        function loadNextContentChunk() {
            if (isLoadingMoreContent || loadedSectionCount >= allHomeAnimeData.length) {
                console.log("Already loading or all content loaded.");
                return;
            }

            isLoadingMoreContent = true;
            loadingMoreIndicator.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling while loading

            setTimeout(() => { // Simulate network delay
                const startIndex = loadedSectionCount;
                const endIndex = Math.min(startIndex + sectionsToLoadPerChunk, allHomeAnimeData.length);
                const sectionsToLoad = allHomeAnimeData.slice(startIndex, endIndex);

                if (sectionsToLoad.length > 0) {
                    appendSectionsToDOM(sectionsToLoad);
                    loadedSectionCount += sectionsToLoad.length;
                }

                loadingMoreIndicator.classList.add('hidden');
                document.body.style.overflow = 'auto'; // Restore scrolling
                isLoadingMoreContent = false;

                if (loadedSectionCount >= allHomeAnimeData.length) {
                    console.log("All sections loaded.");
                    // Optionally remove scroll listener or hide indicator permanently
                    window.removeEventListener('scroll', handleScroll);
                }
            }, 500); // Simulate a short loading time
        }

        /**
         * Handles scroll events to trigger loading more content.
         */
        function handleScroll() {
            const scrollHeight = document.documentElement.scrollHeight;
            const scrollTop = document.documentElement.scrollTop;
            const clientHeight = document.documentElement.clientHeight;
            const scrollBuffer = 300; // Load when 300px from bottom

            if (scrollTop + clientHeight >= scrollHeight - scrollBuffer) {
                loadNextContentChunk();
            }
        }

        /**
         * Updates the background image and content of the hero section.
         * @param {number} index - The index of the slide to display.
         */
        function updateHeroSlider(index) {
            if (!heroBackgroundImage || !heroContent || !heroTitle || !heroDescription || !heroContentRating || !heroSubDub || !heroWatchButton || !heroDetailsButton || !heroDots) return;

            const currentSlideData = heroSlidesData[index];

            const imageUrl = window.innerWidth <= 767 && currentSlideData.mobileImage
                             ? currentSlideData.mobileImage
                             : currentSlideData.image;

            heroBackgroundImage.classList.remove('active');
            heroContent.classList.remove('active');

            setTimeout(() => {
                heroBackgroundImage.src = imageUrl;

                heroTitle.innerHTML = '';
                if (currentSlideData.titleImage) {
                    const titleImgElement = document.createElement('img');
                    titleImgElement.src = currentSlideData.titleImage;
                    titleImgElement.alt = currentSlideData.title;
                    titleImgElement.className = 'w-full h-auto object-contain drop-shadow-lg ' +
                                                (window.innerWidth <= 767 ? 'max-h-32' : 'max-h-24');
                    heroTitle.appendChild(titleImgElement);
                } else {
                    heroTitle.textContent = currentSlideData.title;
                    heroTitle.classList.add('font-roboto', 'text-5xl', 'md:text-6xl');
                }

                heroDescription.textContent = currentSlideData.description;
                heroContentRating.textContent = currentSlideData.contentRating;
                heroSubDub.textContent = currentSlideData.subDub;
                heroWatchButton.href = currentSlideData.watchUrl;
                
                heroDetailsButton.classList.remove('hidden');
                heroDetailsButton.onclick = (event) => {
                    event.preventDefault();
                    openDetailsPopup(currentSlideData);
                };

                heroBackgroundImage.classList.add('active');
                heroContent.classList.add('active');

            }, 500);

            heroDots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });

            currentSlideIndex = index;
        }

        /**
         * Advances the slider to the next image automatically.
         */
        function nextSlide() {
            let newIndex = (currentSlideIndex + 1) % heroSlidesData.length;
            updateHeroSlider(newIndex);
        }

        /**
         * Moves the slider to the previous image.
         */
        function prevSlide() {
            let newIndex = (currentSlideIndex - 1 + heroSlidesData.length) % heroSlidesData.length;
            updateHeroSlider(newIndex);
        }

        /**
         * Starts the automatic slider interval.
         */
        function startSlider() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, slideDuration);
        }

        /**
         * Resets the slider interval (on manual interaction).
         */
        function resetSliderInterval() {
            clearInterval(slideInterval);
            startSlider();
        }

        /**
         * Collects all unique image URLs from hero slides and dynamic sections.
         * @param {Array} sectionsData - Data from homepagedata.json.
         * @returns {Array<string>} An array of unique image URLs.
         */
        function collectAllImageUrls(sectionsData) {
            const imageUrls = new Set();

            heroSlidesData.forEach(slide => {
                if (slide.image) imageUrls.add(slide.image);
                if (slide.mobileImage) imageUrls.add(slide.mobileImage);
                if (slide.titleImage) imageUrls.add(slide.titleImage);
                if (slide.detailImage) imageUrls.add(slide.detailImage);
            });

            if (Array.isArray(sectionsData)) {
                sectionsData.forEach(section => {
                    if (Array.isArray(section.items)) {
                        section.items.forEach(item => {
                            if (item.image) imageUrls.add(item.image);
                            if (item.detailImage) imageUrls.add(item.detailImage);
                            if (item.titleImage) imageUrls.add(item.titleImage);
                            if (item.episodes) {
                                if (Array.isArray(item.episodes)) {
                                    item.episodes.forEach(ep => {
                                        if (ep.thumbnail) imageUrls.add(ep.thumbnail);
                                    });
                                } else if (typeof item.episodes === 'object') {
                                    for (const seasonKey in item.episodes) {
                                        if (Object.hasOwnProperty.call(item.episodes, seasonKey)) {
                                            item.episodes[seasonKey].forEach(ep => {
                                                if (ep.thumbnail) imageUrls.add(ep.thumbnail);
                                            });
                                        }
                                    }
                                }
                            }
                        });
                    }
                });
            }
            return Array.from(imageUrls);
        }

        /**
         * Waits for all specified images to load.
         * @param {Array<string>} urls - An array of image URLs to load.
         * @returns {Promise<void>} A promise that resolves when all images are loaded.
         */
        function waitForImagesToLoad(urls) {
            const imagePromises = urls.map(url => {
                return new Promise((resolve, reject) => {
                    const img = new Image();
                    img.onload = () => resolve();
                    img.onerror = () => {
                        console.warn(`Failed to load image: ${url}`);
                        resolve();
                    };
                    img.src = url;
                });
            });
            return Promise.all(imagePromises);
        }

        /**
         * Renders the episodes for the currently selected season, respecting the load more/hide logic.
         */
        function renderEpisodes() {
            popupEpisodeList.innerHTML = '';
            
            const episodesForCurrentSeason = Array.isArray(currentPopupItemData.episodes[currentDisplayedSeason])
                ? currentPopupItemData.episodes[currentDisplayedSeason]
                : [];
            
            const totalEpisodesInSeason = episodesForCurrentSeason.length;

            if (totalEpisodesInSeason === 0) {
                noEpisodesMessage.classList.remove('hidden');
                loadMoreEpisodesButton.classList.add('hidden');
                return;
            } else {
                noEpisodesMessage.classList.add('hidden');
            }

            const episodesToDisplay = episodesForCurrentSeason.slice(0, currentDisplayedEpisodeCount);

            episodesToDisplay.forEach(episode => {
                const episodeItem = document.createElement('a');
                episodeItem.href = episode.url || '#';
                episodeItem.className = 'episode-list-item';
                episodeItem.innerHTML = `
                    <img src="${episode.thumbnail || 'https://placehold.co/160x90/2a2a2a/ffffff?text=EP'}" alt="Episode ${episode.episodeNumber} Thumbnail" onerror="this.onerror=null;this.src='https://placehold.co/160x90/2a2a2a/ffffff?text=EP';">
                    <div class="episode-info">
                        <p class="ep-number">EPISODE ${episode.episodeNumber}</p>
                        <h4 class="ep-title">${episode.episodeTitle}</h4>
                    </div>
                `;
                popupEpisodeList.appendChild(episodeItem);
            });

            if (currentDisplayedEpisodeCount < totalEpisodesInSeason) {
                loadMoreEpisodesButton.textContent = 'Load More Episodes';
                loadMoreEpisodesButton.classList.remove('hidden');
            } else if (totalEpisodesInSeason > episodesPerLoad) {
                loadMoreEpisodesButton.textContent = 'Hide Episodes';
                loadMoreEpisodesButton.classList.remove('hidden');
            } else {
                loadMoreEpisodesButton.classList.add('hidden');
            }
        }

        /**
         * Handles the click event for the "Load More" / "Hide Episodes" button.
         */
        function toggleLoadMoreEpisodes() {
            const episodesForCurrentSeason = currentPopupItemData.episodes[currentDisplayedSeason] || [];
            const totalEpisodesInSeason = episodesForCurrentSeason.length;

            if (currentDisplayedEpisodeCount < totalEpisodesInSeason) {
                currentDisplayedEpisodeCount = Math.min(currentDisplayedEpisodeCount + episodesPerLoad, totalEpisodesInSeason);
            } else {
                currentDisplayedEpisodeCount = episodesPerLoad;
            }
            renderEpisodes();
        }

        /**
         * Populates the season dropdown and displays episodes for the selected season.
         * @param {string} [seasonKey] - The key of the season to display. Defaults to the first season.
         */
        function displayEpisodesForSeason(seasonKey) {
            if (!currentPopupItemData || !currentPopupItemData.episodes || Object.keys(currentPopupItemData.episodes).length === 0) {
                console.warn("No episode data available for season selection or item is malformed.");
                seasonSelectorContainer.classList.add('hidden');
                popupEpisodeList.innerHTML = '';
                noEpisodesMessage.classList.remove('hidden');
                loadMoreEpisodesButton.classList.add('hidden');
                return;
            }

            const seasonKeys = Object.keys(currentPopupItemData.episodes);

            const currentDropdownOptions = Array.from(seasonSelect.options).map(opt => opt.value);
            const needsRebuild = seasonKeys.length !== currentDropdownOptions.length || !seasonKeys.every(key => currentDropdownOptions.includes(key));

            if (needsRebuild || seasonSelect.dataset.lastItem !== currentPopupItemData.title) {
                seasonSelect.innerHTML = '';
                seasonKeys.forEach(key => {
                    const option = document.createElement('option');
                    option.value = key;
                    option.textContent = key;
                    seasonSelect.appendChild(option);
                });
                seasonSelect.dataset.lastItem = currentPopupItemData.title;
            }

            currentDisplayedSeason = seasonKey || seasonKeys[0];
            seasonSelect.value = currentDisplayedSeason;
            
            if (seasonKeys.length > 1) {
                seasonSelectorContainer.classList.remove('hidden');
            } else {
                seasonSelectorContainer.classList.add('hidden');
            }

            currentDisplayedEpisodeCount = episodesPerLoad;
            renderEpisodes();
        }

        /**
         * Opens the details popup with the provided item data.
         * @param {Object} itemData - The data object for the anime/movie.
         */
        function openDetailsPopup(itemData) {
            console.log("Opening popup with data:", itemData);
            if (!detailsPopup || !detailsOverlay) {
                console.error("Details popup elements not found.");
                return;
            }

            let normalizedEpisodes = {};
            if (itemData.episodes) {
                if (Array.isArray(itemData.episodes)) {
                    normalizedEpisodes["Season 1"] = itemData.episodes;
                } else if (typeof itemData.episodes === 'object' && itemData.episodes !== null) {
                    normalizedEpisodes = itemData.episodes;
                }
            }
            currentPopupItemData = { ...itemData, episodes: normalizedEpisodes };

            popupBackgroundImage.src = itemData.detailImage || itemData.image || 'https://placehold.co/800x450/1A1A1A/FFFFFF?text=No+Image';
            popupBackgroundImage.alt = itemData.title || itemData.seriesTitle || 'Item Image';

            if (itemData.titleImage) {
                popupTitleLogo.src = itemData.titleImage;
                popupTitleLogo.alt = itemData.title || itemData.seriesTitle || 'Title Logo';
                popupTitleLogo.classList.remove('hidden');
                popupMainTitle.classList.add('hidden');
            } else {
                popupTitleLogo.classList.add('hidden');
                popupMainTitle.classList.remove('hidden');
                popupMainTitle.textContent = itemData.title || itemData.seriesTitle || 'Details';
            }
            
            popupContentRating.textContent = itemData.contentRating || 'N/A';
            popupSubDub.textContent = itemData.subDub || 'N/A';
            
            popupSynopsis.textContent = itemData.synopsis || 'No synopsis available.';
            popupWatchButton.href = itemData.watchUrl || itemData.url || '#';
            popupWatchButton.textContent = 'START WATCHING';

            displayEpisodesForSeason();

            detailsOverlay.classList.add('active');
            detailsPopup.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        /**
         * Closes the details popup.
         */
        function closeDetailsPopup() {
            if (!detailsPopup || !detailsOverlay) return;

            detailsPopup.classList.remove('active');
            detailsOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
            currentPopupItemData = null;
            currentDisplayedSeason = null;
            currentDisplayedEpisodeCount = 0;
            seasonSelect.innerHTML = '';
            seasonSelect.dataset.lastItem = '';
        }

        /**
         * Initializes the page elements and content after all images are loaded.
         */
        async function loadAllContentAndHideLoadingScreen() {
            console.log('loadAllContentAndHideLoadingScreen called');

            loadingOverlay = document.getElementById('loading-overlay');
            mainContentArea = document.querySelector('main');
            loadingMoreIndicator = document.getElementById('loading-more-content');

            // Set current year in footer
            const currentYearElement = document.getElementById('currentYear');
            if (currentYearElement) {
                currentYearElement.textContent = new Date().getFullYear();
            }

            // Get slider elements
            heroSection = document.getElementById('heroSection');
            heroBackgroundImage = document.getElementById('heroBackgroundImage');
            heroContent = document.getElementById('heroContent');
            heroTitle = document.getElementById('heroTitle');
            heroDescription = document.getElementById('heroDescription');
            heroContentRating = document.getElementById('heroContentRating');
            heroSubDub = document.getElementById('heroSubDub');
            heroWatchButton = document.getElementById('heroWatchButton');
            heroDetailsButton = document.getElementById('heroDetailsButton');
            heroLeftArrow = document.querySelector('.hero-nav-arrow.left');
            heroRightArrow = document.querySelector('.hero-nav-arrow.right');
            const heroDotsContainer = document.querySelector('.hero-dots-container');

            // Get Details Popup elements
            detailsOverlay = document.getElementById('details-overlay');
            detailsPopup = document.getElementById('details-popup');
            popupBackgroundImage = document.getElementById('popup-background-image');
            popupTitleLogo = document.getElementById('popup-title-logo');
            popupMainTitle = document.getElementById('popup-main-title');
            popupContentRating = document.getElementById('popup-content-rating');
            popupSubDub = document.getElementById('popup-sub-dub');
            popupSynopsis = document.getElementById('popup-synopsis');
            popupWatchButton = document.getElementById('popup-watch-button');
            popupEpisodeList = document.getElementById('popup-episode-list');
            noEpisodesMessage = document.getElementById('no-episodes-message');
            detailsPopupCloseButton = document.getElementById('details-popup-close');
            seasonSelectorContainer = document.getElementById('season-selector-container');
            seasonSelect = document.getElementById('season-select');
            loadMoreEpisodesButton = document.getElementById('load-more-episodes-button');


            // Add event listeners for details popup
            if (detailsOverlay) {
                detailsOverlay.addEventListener('click', closeDetailsPopup);
            }
            if (detailsPopupCloseButton) {
                detailsPopupCloseButton.addEventListener('click', closeDetailsPopup);
            }
            if (seasonSelect) {
                seasonSelect.addEventListener('change', (event) => {
                    displayEpisodesForSeason(event.target.value);
                });
            }
            if (loadMoreEpisodesButton) {
                loadMoreEpisodesButton.addEventListener('click', toggleLoadMoreEpisodes);
            }


            // Dynamically create dots based on heroSlidesData length
            if (heroDotsContainer) {
                heroDotsContainer.innerHTML = '';
                heroSlidesData.forEach((_, index) => {
                    const dot = document.createElement('span');
                    dot.className = 'hero-dot';
                    dot.dataset.index = index;
                    dot.addEventListener('click', () => {
                        updateHeroSlider(index);
                        resetSliderInterval();
                    });
                    heroDotsContainer.appendChild(dot);
                });
                heroDots = document.querySelectorAll('.hero-dot');
            }

            // Add event listeners for arrows
            if (heroLeftArrow) {
                heroLeftArrow.addEventListener('click', () => {
                    prevSlide();
                    resetSliderInterval();
                });
            }
            if (heroRightArrow) {
                heroRightArrow.addEventListener('click', () => {
                    nextSlide();
                    resetSliderInterval();
                });
            }

            // Add mouseenter/mouseleave events to hero section for arrow visibility
            if (heroSection && heroLeftArrow && heroRightArrow) {
                heroSection.addEventListener('mouseenter', () => {
                    heroLeftArrow.classList.add('visible');
                    heroRightArrow.classList.add('visible');
                });
                heroSection.addEventListener('mouseleave', () => {
                    heroLeftArrow.classList.remove('visible');
                    heroRightArrow.classList.remove('visible');
                });
            }

            // Add touch event listeners for swipe on mobile
            if (heroSection) {
                heroSection.addEventListener('touchstart', (e) => {
                    if (window.innerWidth <= 767) {
                        touchStartX = e.touches[0].clientX;
                    }
                });

                heroSection.addEventListener('touchmove', (e) => {
                    if (window.innerWidth <= 767) {
                        touchEndX = e.touches[0].clientX;
                    }
                });

                heroSection.addEventListener('touchend', () => {
                    if (window.innerWidth <= 767) {
                        const deltaX = touchEndX - touchStartX;
                        if (deltaX > swipeThreshold) {
                            prevSlide();
                            resetSliderInterval();
                        } else if (deltaX < -swipeThreshold) {
                            nextSlide();
                            resetSliderInterval();
                        }
                        touchStartX = 0;
                        touchEndX = 0;
                    }
                });
            }

            try {
                console.log("Attempting to fetch homepagedata.json...");
                const response = await fetch('Data/homepagedata.json'); 
                
                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(`HTTP error! status: ${response.status}, message: ${errorText}`);
                }
                allHomeAnimeData = await response.json(); // Store all data globally
                console.log("homepagedata.json fetched successfully. Data:", allHomeAnimeData);

                // Collect all image URLs from hero slides and fetched data
                const allImageUrls = collectAllImageUrls(allHomeAnimeData);
                console.log("Collected Image URLs:", allImageUrls);

                // Wait for all images to load
                await waitForImagesToLoad(allImageUrls);
                console.log("All critical images loaded.");

                // Now that images are loaded, populate the content
                updateHeroSlider(currentSlideIndex); // Set initial image and content
                startSlider(); // Start automatic cycling

                // Load initial content sections
                loadNextContentChunk(); 
                window.addEventListener('scroll', handleScroll); // Add scroll listener for infinite scroll

                // Hide loading overlay after initial content is rendered and images are loaded
                loadingOverlay.classList.add('hidden');
                document.body.style.overflow = 'auto'; // Set overflow to 'auto' to enable scrolling
                console.log("Loading overlay hidden. Page ready.");

            } catch (error) {
                console.error("Error during page initialization:", error);
                mainContentArea.innerHTML = `<p class="text-red-500 text-center mt-10">Failed to load content: ${error.message}. Please check console for details.</p>`;
                loadingOverlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Initialize the page once the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', () => {
            document.body.style.overflow = 'hidden';
            loadAllContentAndHideLoadingScreen();
            lucide.createIcons();
        });

        // Add a resize listener to update the hero slider image on orientation/size change
        window.addEventListener('resize', () => {
            updateHeroSlider(currentSlideIndex);
        });
    </script>
    <script>
        // Header Animations
        const menuButton = document.getElementById('menu-button');
        const mobileNavLinks = document.getElementById('mobile-nav-links');
        const browseDropdownButton = document.getElementById('browse-dropdown-button');
        const profileDropdownButton = document.getElementById('profile-dropdown-button');
        const header = document.querySelector('header');
        let lastScrollY = 0;
        const scrollThreshold = 50;

        menuButton.addEventListener('click', () => {
            mobileNavLinks.classList.toggle('hidden');
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024 && !mobileNavLinks.classList.contains('hidden')) {
                mobileNavLinks.classList.add('hidden');
            }
        });

        browseDropdownButton.addEventListener('click', function (event) {
            event.preventDefault();
            this.parentElement.classList.toggle('active');
            if (profileDropdownButton.parentElement.classList.contains('active')) {
                profileDropdownButton.parentElement.classList.remove('active');
            }
        });

        profileDropdownButton.addEventListener('click', function (event) {
            event.preventDefault();
            this.parentElement.classList.toggle('active');
            if (browseDropdownButton.parentElement.classList.contains('active')) {
                browseDropdownButton.parentElement.classList.remove('active');
            }
        });

        document.addEventListener('click', function (event) {
            if (window.innerWidth >= 1024) {
                const allDropdowns = document.querySelectorAll('.dropdown');
                allDropdowns.forEach(dropdown => {
                    if (dropdown && !dropdown.contains(event.target)) {
                        dropdown.classList.remove('active');
                    }
                });
            }
        });

        window.addEventListener('scroll', () => {
            if (window.scrollY > lastScrollY && window.scrollY > scrollThreshold) {
                header.classList.add('header-hidden');
            } else if (window.scrollY < lastScrollY || window.scrollY < scrollThreshold) {
                header.classList.remove('header-hidden');
            }
            lastScrollY = window.scrollY;
        });
    </script>
 <!-- Mobile Bottom Navigation -->
 <nav class="mobile-nav">
    <a href="home" class="nav-item active">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="series/browse" class="nav-item">
        <i class="fas fa-th-large"></i>
        <span>Browse</span>
    </a>
    <a href="search" class="nav-item">
        <i class="fas fa-search"></i>
        <span>Search</span>
    </a>
    <a href="profile" class="nav-item">
        <i class="fas fa-user"></i>
        <span>Profile</span>
    </a>
 </nav>
</body>
</html>
