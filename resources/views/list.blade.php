@extends('layouts.layout')

@section('content')
<div class="w-full flex justify-center">
    <div class="w-full mx-2 2xl:w-[80%] max-w-[100rem] py-5">
        <div class="flex items-end w-full">
            <a href="/zone"><button class="float-right block bg-[#23AE00] text-white px-4 py-1 mr-5 font-bold w-[200px]">Adauga zone</button></a><br>
            <a href="/create"><button class="float-right block bg-[#23AE00] text-white px-4 py-1 font-bold w-[200px]">Adauga proprietate</button></a><br>
        </div>
        <div class="shadow-lg w-full px-5 items-center mt-6 py-4">
            <form action="{{$currentURL}}" id="searchForm">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">
                    <div class="flex flex-col">
                        <br>
                        <select name="location" id="locationSelect" class="text-[20px] border-b-[1px] border-black outline-none">
                            @if($searchInfo[0] == 0 || $searchInfo[0] == NULL)
                            <option value="0" selected>Selecteaza locatia</option>
                            @else
                            <option value="0">Selecteaza locatia</option>
                            @endif
                            @php
                            App\Http\Controllers\PropertyController::getAllInfo();
                            @endphp
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <p>Pret</p>
                        <div>
                            <input name="minPrice" type="number" placeholder="Min" value="{{ $searchInfo[1] }}" class="text-[20px] w-[49%] border-b-[1px] border-black outline-none">
                            <input name="maxPrice" type="number" placeholder="Max" value="{{ $searchInfo[2] }}" class="text-[20px] w-[49%] border-b-[1px] border-black outline-none">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p>Spatiu (m<sup>2</sup>)</p>
                        <div>
                            <input name="minSpace" type="number" placeholder="Min" value="{{ $searchInfo[3] }}" class="text-[20px] w-[49%] border-b-[1px] border-black outline-none">
                            <input name="maxSpace" type="number" placeholder="Max" value="{{ $searchInfo[4] }}" class="text-[20px] w-[49%] border-b-[1px] border-black outline-none">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p>Numar camere</p>
                        <div>
                            <input name="minRooms" type="number" placeholder="Min" value="{{ $searchInfo[5] }}" class="text-[20px] w-[49%] border-b-[1px] border-black outline-none">
                            <input name="maxRooms" type="number" placeholder="Max" value="{{ $searchInfo[6] }}" class="text-[20px] w-[49%] border-b-[1px] border-black outline-none">
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Cauta" class="mt-2 bg-[#222222] text-white text-[20px] px-4 py-1">
                    @if($showAll == true)
                    <a href="/" class=" bg-[#222222] text-white text-[20px] px-4 py-[5.5px]">Inapoi</a>
                    @endif
                </div>
            </form>
            <script>
                document.getElementById('searchForm').addEventListener('submit', function(event) {
                    event.preventDefault();

                    var locationSelect = document.getElementById('locationSelect');
                    var location = locationSelect.value
                    var minPrice = this.querySelector('input[name="minPrice"]').value.trim();
                    var maxPrice = this.querySelector('input[name="maxPrice"]').value.trim();
                    var minSpace = this.querySelector('input[name="minSpace"]').value.trim();
                    var maxSpace = this.querySelector('input[name="maxSpace"]').value.trim();
                    var minRooms = this.querySelector('input[name="minRooms"]').value.trim();
                    var maxRooms = this.querySelector('input[name="maxRooms"]').value.trim();


                    console.log(location)
                    console.log(minPrice)
                    console.log(maxPrice)
                    console.log(minSpace)
                    console.log(maxSpace)
                    console.log(minRooms)
                    console.log(maxRooms)

                    if ((location === '' || location === '0' || location === null) && minPrice === '' && maxPrice === '' && minSpace === '' && maxSpace === '' && minRooms === '' && maxRooms === '') {

                    } else {
                        document.getElementById('searchForm').submit()
                    }
                });
            </script>
        </div>
        <div class="w-full my-6 grid gap-3 gap-y-7 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            @foreach($gatherInfo as $property)
            @php
            $type = $property['type'];
            $saleType = $property['saleType'];
            if ($saleType == 1) {
            $saleDisplay = $property['price'];
            $saleTypeDis = 'De vanzare';
            } else {
            $saleDisplay = $property['price'] . '/lună';
            $saleTypeDis = 'De inchiriat';
            }

            switch ($type) {
            case 1:
            $imType = 'Comercial';
            break;
            case 2:
            $imType = 'Proiect';
            break;
            case 4:
            $imType = 'Apartament';
            break;
            case 5:
            $imType = 'Vila';
            break;
            case 6:
            $imType = 'Teren';
            break;
            }

            $beds = $property['rooms'] != null ? $property['rooms'] : '-';
            $baths = $property['baths'] != '' ? $property['baths'] : '-';
            $space = $property['space'] != '' ? $property['space'] : '-';
            $year = $property['year'] != '' ? $property['year'] : '-';
            @endphp
            <div class="shadow-lg flex-col flex justify-between h-[350px]">

                @php
                $img = App\Http\Controllers\PropertyController::getBackgroundImage($property->id)[0]['imageName'];
                @endphp
                <img src="https://andimob.ro/assets/img/properties/{{ $img }}" class="w-full h-[191.51px] object-cover">
                <div class="flex flex-row justify-between items-start px-3">
                    <div class="text-start">
                        <div class="flex items-center">

                            <p class="font-bold">
                                @php
                                $city = App\Http\Controllers\PropertyController::getCityName($property->city)[0]['city'];
                                echo($city);
                                @endphp
                            </p>

                            <p class="font-bold ml-1">
                                @php
                                $city = App\Http\Controllers\PropertyController::getZone($property->nh, $property->city);
                                if($city) {
                                echo ' - ' . $city[0]['name'];
                                }
                                @endphp
                            </p>
                        </div>
                        <p>{{ $imType }}</p>
                    </div>
                    <div class="text-end">
                        <p class="font-bold">€ {{ $saleDisplay }}</p>
                        <p>{{ $property['comission'] }}% comision</p>
                    </div>
                </div>
                <div class="flex flex-row justify-between items-start px-3">
                    <div class="flex">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.9601 10.78V8C21.9601 6.35 20.6101 5 18.9601 5H14.9601C14.1901 5 13.4901 5.3 12.9601 5.78C12.4301 5.3 11.7301 5 10.9601 5H6.96005C5.31005 5 3.96005 6.35 3.96005 8V10.78C3.35005 11.33 2.96005 12.12 2.96005 13V19H4.96005V17H20.9601V19H22.9601V13C22.9601 12.12 22.5701 11.33 21.9601 10.78ZM14.9601 7H18.9601C19.5101 7 19.9601 7.45 19.9601 8V10H13.9601V8C13.9601 7.45 14.4101 7 14.9601 7ZM5.96005 8C5.96005 7.45 6.41005 7 6.96005 7H10.9601C11.5101 7 11.9601 7.45 11.9601 8V10H5.96005V8ZM4.96005 15V13C4.96005 12.45 5.41005 12 5.96005 12H19.9601C20.5101 12 20.9601 12.45 20.9601 13V15H4.96005Z" fill="black" />
                        </svg>
                        <p class="ml-2">{{ $beds }}</p>
                    </div>
                    <div class="flex">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.4136 14.5V15.5C21.4136 17.41 20.3436 19.07 18.7636 19.91L19.4136 22.5H17.4136L16.9136 20.5H7.91364L7.41364 22.5H5.41364L6.06364 19.91C5.26282 19.4852 4.59294 18.8501 4.12603 18.0731C3.65911 17.2961 3.41282 16.4065 3.41364 15.5V14.5H2.41364V12.5H20.4136V5.5C20.4136 5.23478 20.3083 4.98043 20.1207 4.79289C19.9332 4.60536 19.6789 4.5 19.4136 4.5C18.9136 4.5 18.5336 4.84 18.4136 5.29C19.0436 5.83 19.4136 6.63 19.4136 7.5H13.4136C13.4136 6.70435 13.7297 5.94129 14.2923 5.37868C14.8549 4.81607 15.618 4.5 16.4136 4.5H16.5836C16.9936 3.34 18.1036 2.5 19.4136 2.5C20.2093 2.5 20.9723 2.81607 21.535 3.37868C22.0976 3.94129 22.4136 4.70435 22.4136 5.5V14.5H21.4136ZM19.4136 14.5H5.41364V15.5C5.41364 16.2956 5.72971 17.0587 6.29232 17.6213C6.85492 18.1839 7.61799 18.5 8.41364 18.5H16.4136C17.2093 18.5 17.9723 18.1839 18.535 17.6213C19.0976 17.0587 19.4136 16.2956 19.4136 15.5V14.5Z" fill="black" />
                        </svg>
                        <p class="ml-2">{{ $baths }}</p>
                    </div>
                    <div class="flex">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.64099 8.5H6.64099M4.64099 12.5H7.64099M4.64099 16.5H6.64099M8.64099 4.5V6.5M12.641 4.5V7.5M16.641 4.5V6.5M5.64099 4.5H19.641C19.9062 4.5 20.1606 4.60536 20.3481 4.79289C20.5356 4.98043 20.641 5.23478 20.641 5.5V10.5C20.641 10.7652 20.5356 11.0196 20.3481 11.2071C20.1606 11.3946 19.9062 11.5 19.641 11.5H12.641C12.3758 11.5 12.1214 11.6054 11.9339 11.7929C11.7463 11.9804 11.641 12.2348 11.641 12.5V19.5C11.641 19.7652 11.5356 20.0196 11.3481 20.2071C11.1606 20.3946 10.9062 20.5 10.641 20.5H5.64099C5.37577 20.5 5.12142 20.3946 4.93388 20.2071C4.74635 20.0196 4.64099 19.7652 4.64099 19.5V5.5C4.64099 5.23478 4.74635 4.98043 4.93388 4.79289C5.12142 4.60536 5.37577 4.5 5.64099 4.5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <p class="ml-2">{{ $space }} m<sup>2</sup></p>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-[16px] w-[16px]" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_121_484)">
                                <path d="M41.0767 45.2545H4.51416C2.17979 45.2545 0.29541 43.3702 0.29541 41.0358V7.28578C0.29541 4.95141 2.17979 3.06703 4.51416 3.06703H41.0767C43.411 3.06703 45.2954 4.95141 45.2954 7.28578V41.0358C45.2954 43.3702 43.411 45.2545 41.0767 45.2545ZM4.51416 5.87953C3.72666 5.87953 3.10791 6.49828 3.10791 7.28578V41.0358C3.10791 41.8233 3.72666 42.442 4.51416 42.442H41.0767C41.8642 42.442 42.4829 41.8233 42.4829 41.0358V7.28578C42.4829 6.49828 41.8642 5.87953 41.0767 5.87953H4.51416Z" fill="black" />
                                <path d="M12.9517 11.5045C12.1642 11.5045 11.5454 10.8858 11.5454 10.0983V1.66078C11.5454 0.873282 12.1642 0.254532 12.9517 0.254532C13.7392 0.254532 14.3579 0.873282 14.3579 1.66078V10.0983C14.3579 10.8858 13.7392 11.5045 12.9517 11.5045ZM32.6392 11.5045C31.8517 11.5045 31.2329 10.8858 31.2329 10.0983V1.66078C31.2329 0.873282 31.8517 0.254532 32.6392 0.254532C33.4267 0.254532 34.0454 0.873282 34.0454 1.66078V10.0983C34.0454 10.8858 33.4267 11.5045 32.6392 11.5045ZM43.8892 17.1295H1.70166C0.91416 17.1295 0.29541 16.5108 0.29541 15.7233C0.29541 14.9358 0.91416 14.317 1.70166 14.317H43.8892C44.6767 14.317 45.2954 14.9358 45.2954 15.7233C45.2954 16.5108 44.6767 17.1295 43.8892 17.1295Z" fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_121_484">
                                    <rect width="45" height="45" fill="black" transform="translate(0.29541 0.254532)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <p class="ml-2">{{ $year }}</p>
                    </div>
                </div>
                <div class="px-3 w-full">
                    <div class="flex justify-between mb-1">
                        <p class="w-[49%] cursor-pointer text-center text-white bg-[#222222] uppercase">{{ $saleTypeDis }}</p>
                        <a href="/modify/{{ $property->id }}" class="w-[49%] cursor-pointer text-center text-white bg-[#D57B01]">MODIFICA</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($showAll != true)
        <nav class="flex justify-center items-center mt-10">
            <ul class="inline-flex -space-x-px text-sm">
                @if($page == 0)
                <li class="prev">
                    <a href="?page={{ $page }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Inapoi</a>
                </li>
                @else
                <li class="prev">
                    <a href="?page={{ $page - 1 }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Inapoi</a>
                </li>
                @endif
                @for($i = 0; $i < 4; $i++) <li>
                    <a href="?page={{ $i }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{ $i + 1 }}</a>
                    </li>
                    @endfor

                    <li class="next">
                        <a href="?page={{ $page + 1 }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">Inainte</a>
                    </li>
            </ul>
        </nav>
        @endif
    </div>
</div>
@endsection