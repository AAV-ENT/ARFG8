<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andimob | Management</title>
    @vite('resources/css/app.css')
</head>

<style>
    #header {
        height: auto;
        background: rgb(52, 52, 52);
        background: radial-gradient(circle, rgb(64, 63, 63) 0%, rgba(34, 34, 34, 1) 100%);
    }

    #headline {
        height: calc(100% - 150px);
    }

    #position {
        top: calc(50% + 100px);
    }

    #hamburgerMenu {
        z-index: 10;
    }

    #imgCover {
        background: rgb(0, 0, 0);
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.3) 25%, rgba(34, 34, 34, 0) 100%);
        transition: background 250ms;
    }

    #imgCover:hover {
        background: rgb(0, 0, 0);
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.75) 25%, rgba(34, 34, 34, 0.25) 100%);
        cursor: pointer;
    }
</style>

<body class="min-h-screen relative">
    <div class="absolute w-screen hidden justify-center h-screen top-0 bg-white" id="hamburgerMenu">
        <div class="relative w-[80%] h-full">
            <div class="flex justify-between items-center mt-12">
                <img src="{{URL::asset('assets/img/logo.png')}}" class="w-[125px] invert" alt="Logo">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="closeMenu()">
                    <path d="M16 2C8.2 2 2 8.2 2 16C2 23.8 8.2 30 16 30C23.8 30 30 23.8 30 16C30 8.2 23.8 2 16 2ZM21.4 23L16 17.6L10.6 23L9 21.4L14.4 16L9 10.6L10.6 9L16 14.4L21.4 9L23 10.6L17.6 16L23 21.4L21.4 23Z" fill="black" />
                </svg>
            </div>
            <div class="flex flex-col justify-between h-[calc(100vh-400px)] mt-12">
                <div class="flex justify-between items-center">
                    <li class="text-4xl list-none" id="menuHover"><a href="index.php" class="font-bold">ACASA</a></li>
                    <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.1966 39.2608C26.9224 39.1474 26.6881 38.9551 26.5233 38.7085C26.3584 38.4619 26.2704 38.1719 26.2703 37.8752V25.8752L8.27031 25.8752C7.87248 25.8752 7.49095 25.7172 7.20964 25.4359C6.92834 25.1546 6.77031 24.773 6.77031 24.3752C6.77031 23.9774 6.92834 23.5958 7.20964 23.3145C7.49095 23.0332 7.87248 22.8752 8.27031 22.8752H26.2703V10.8752C26.2701 10.5784 26.3579 10.2881 26.5227 10.0412C26.6875 9.79434 26.9219 9.6019 27.1961 9.48827C27.4704 9.37464 27.7721 9.34494 28.0633 9.40291C28.3544 9.46089 28.6218 9.60394 28.8316 9.81395L42.3316 23.314C42.471 23.4533 42.5817 23.6187 42.6571 23.8008C42.7326 23.9829 42.7715 24.1781 42.7715 24.3752C42.7715 24.5723 42.7326 24.7675 42.6571 24.9496C42.5817 25.1317 42.471 25.2971 42.3316 25.4365L28.8316 38.9365C28.6217 39.1462 28.3543 39.2889 28.0633 39.3467C27.7722 39.4044 27.4706 39.3745 27.1966 39.2608Z" fill="black" />
                    </svg>
                </div>
                <div class="flex justify-between items-center">
                    <li class="text-4xl list-none" id="menuHover"><a href="properties.php?sel_type=0&sel_imb=0&sel_loc=0" class="font-bold">PROPRIETATI</a></li>
                    <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.1966 39.2608C26.9224 39.1474 26.6881 38.9551 26.5233 38.7085C26.3584 38.4619 26.2704 38.1719 26.2703 37.8752V25.8752L8.27031 25.8752C7.87248 25.8752 7.49095 25.7172 7.20964 25.4359C6.92834 25.1546 6.77031 24.773 6.77031 24.3752C6.77031 23.9774 6.92834 23.5958 7.20964 23.3145C7.49095 23.0332 7.87248 22.8752 8.27031 22.8752H26.2703V10.8752C26.2701 10.5784 26.3579 10.2881 26.5227 10.0412C26.6875 9.79434 26.9219 9.6019 27.1961 9.48827C27.4704 9.37464 27.7721 9.34494 28.0633 9.40291C28.3544 9.46089 28.6218 9.60394 28.8316 9.81395L42.3316 23.314C42.471 23.4533 42.5817 23.6187 42.6571 23.8008C42.7326 23.9829 42.7715 24.1781 42.7715 24.3752C42.7715 24.5723 42.7326 24.7675 42.6571 24.9496C42.5817 25.1317 42.471 25.2971 42.3316 25.4365L28.8316 38.9365C28.6217 39.1462 28.3543 39.2889 28.0633 39.3467C27.7722 39.4044 27.4706 39.3745 27.1966 39.2608Z" fill="black" />
                    </svg>
                </div>
                <div class="flex justify-between items-center">
                    <li class="text-4xl list-none" id="menuHover"><a href="about.php" class="font-bold">DESPRE NOI</a></li>
                    <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.1966 39.2608C26.9224 39.1474 26.6881 38.9551 26.5233 38.7085C26.3584 38.4619 26.2704 38.1719 26.2703 37.8752V25.8752L8.27031 25.8752C7.87248 25.8752 7.49095 25.7172 7.20964 25.4359C6.92834 25.1546 6.77031 24.773 6.77031 24.3752C6.77031 23.9774 6.92834 23.5958 7.20964 23.3145C7.49095 23.0332 7.87248 22.8752 8.27031 22.8752H26.2703V10.8752C26.2701 10.5784 26.3579 10.2881 26.5227 10.0412C26.6875 9.79434 26.9219 9.6019 27.1961 9.48827C27.4704 9.37464 27.7721 9.34494 28.0633 9.40291C28.3544 9.46089 28.6218 9.60394 28.8316 9.81395L42.3316 23.314C42.471 23.4533 42.5817 23.6187 42.6571 23.8008C42.7326 23.9829 42.7715 24.1781 42.7715 24.3752C42.7715 24.5723 42.7326 24.7675 42.6571 24.9496C42.5817 25.1317 42.471 25.2971 42.3316 25.4365L28.8316 38.9365C28.6217 39.1462 28.3543 39.2889 28.0633 39.3467C27.7722 39.4044 27.4706 39.3745 27.1966 39.2608Z" fill="black" />
                    </svg>
                </div>
                <div class="flex justify-between items-center">
                    <li class="text-4xl list-none" id="menuHover"><a href="contact.php" class="font-bold">CONTACT</a></li>
                    <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.1966 39.2608C26.9224 39.1474 26.6881 38.9551 26.5233 38.7085C26.3584 38.4619 26.2704 38.1719 26.2703 37.8752V25.8752L8.27031 25.8752C7.87248 25.8752 7.49095 25.7172 7.20964 25.4359C6.92834 25.1546 6.77031 24.773 6.77031 24.3752C6.77031 23.9774 6.92834 23.5958 7.20964 23.3145C7.49095 23.0332 7.87248 22.8752 8.27031 22.8752H26.2703V10.8752C26.2701 10.5784 26.3579 10.2881 26.5227 10.0412C26.6875 9.79434 26.9219 9.6019 27.1961 9.48827C27.4704 9.37464 27.7721 9.34494 28.0633 9.40291C28.3544 9.46089 28.6218 9.60394 28.8316 9.81395L42.3316 23.314C42.471 23.4533 42.5817 23.6187 42.6571 23.8008C42.7326 23.9829 42.7715 24.1781 42.7715 24.3752C42.7715 24.5723 42.7326 24.7675 42.6571 24.9496C42.5817 25.1317 42.471 25.2971 42.3316 25.4365L28.8316 38.9365C28.6217 39.1462 28.3543 39.2889 28.0633 39.3467C27.7722 39.4044 27.4706 39.3745 27.1966 39.2608Z" fill="black" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full flex justify-center" id="header">
        <div class="w-full mx-2 2xl:w-[80%] max-w-[90rem] py-5">
            <div class="flex justify-between items-center">
                <img src="{{URL::asset('assets/img/logo.png')}}" class="w-[125px]" alt="Logo">
                <div class="text-lg hidden md:block">
                    <a href="index.php" class="text-white mr-5 hover:text-[#D57B01]">ACASA</a>
                    <a href="properties.php?sel_type=0&sel_imb=0&sel_loc=0" class="text-white mr-5 hover:text-[#D57B01]">PROPRIETATI</a>
                    <a href="about.php" class="text-white mr-5 hover:text-[#D57B01]">DESPRE NOI</a>
                    <a href="contact.php" class="text-white mr-5 hover:text-[#D57B01]">CONTACT</a>
                </div>
                <div class="block md:hidden">
                    <svg width="32" height="16" viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="openMenu()">
                        <rect x="5.94849" y="0.588989" width="25.8793" height="3" fill="#fff" />
                        <rect x="0.331543" y="6.63184" width="27.9658" height="3" fill="#fff" />
                        <rect x="7.93262" y="12.6749" width="23.8951" height="3" fill="#fff" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <div class="w-full flex justify-center mt-20 bg-[#222222] absolute bottom-0">
        <div class="w-full mx-2 max-w-[90rem] py-10 grid-cols-1 grid sm:grid-cols-3">
            <div class="flex flex-col justify-center items-center">
                <img src="{{URL::asset('assets/img/logo.png')}}" class="w-[125px]" alt="Logo">
            </div>
            <div class="text-white flex flex-col justify-center items-center my-12 sm:my-0">
                <h2 class="text-center">© Andimob Consulting SRL. <br></h2>
                <p class="text-center">Made by Andimob Marketing & <a href="https://aav-ent.com">AAV ENTERPRISE</a></p>
            </div>
            <div class="flex flex-row justify-center items-center">
                <a href="https://www.instagram.com/andimobrealestate/channel/">
                    <svg class="scale-150 mr-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" fill="#fff" />
                    </svg>
                </a>
                <a href="https://www.facebook.com/Andimobconsulting/">
                    <svg class="scale-150" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" fill="#fff" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
</body>

</html>