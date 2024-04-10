@extends('layouts.layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="w-full flex justify-center">
    <div class="w-full mx-2 2xl:w-[80%] max-w-[100rem] py-5">
        <a href="/" class=" bg-[#222222] text-white text-[20px] px-4 py-[5.5px]">Inapoi</a>
        <p class="text-xl font-bold my-5">Adauga proprietate</p>
        <form action="/create" method="post" enctype="multipart/form-data">
            @csrf
            <input type="checkbox" name="exclusive" id="exclusive" value="1">
            <label for="exclusive">Exclusiv</label>
            <div class="grid lg:grid-cols-3 gap-5 md:grid-cols-2 grid-cols-1 mt-10">
                @php
                $city = App\Http\Controllers\PropertyController::getLastId();
                $lastId = $city[0]['id'];
                @endphp
                <input type="hidden" name="id" value="{{$lastId}}">
                <input type="text" name="title" placeholder="Titlu" value="{{$propertyInfo[0]['name']}}" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" name="price" placeholder="Pret" value="{{$propertyInfo[0]['price']}}" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" name="comission" placeholder="Comision" value="{{$propertyInfo[0]['comission']}}" class="border-b-[1px] border-black text-lg outline-none px-3">
            </div>
            <div class="grid lg:grid-cols-4 gap-5 md:grid-cols-2 grid-cols-1 mt-10">
                <input type="number" name="rooms" placeholder="Camere" value="{{$propertyInfo[0]['rooms']}}" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" name="baths" placeholder="Bai" value="{{$propertyInfo[0]['baths']}}" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" name="space" placeholder="Spatiu" value="{{$propertyInfo[0]['space']}}" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" name="year" placeholder="An" value="{{$propertyInfo[0]['year']}}" class="border-b-[1px] border-black text-lg outline-none px-3">
            </div>
            <textarea name="description" placeholder="Descriere" value="" id="" style="resize: none;" cols="30" rows="10" class="p-3 border-[1px] border-black text-lg outline-none w-full mt-10">{{$propertyInfo[0]['description']}}</textarea>
            <div class="grid lg:grid-cols-4 gap-5 md:grid-cols-2 grid-cols-1 mt-10">
                <select name="city" id="city" class="border-b-[1px] border-black text-lg outline-none px-3" onchange="getNeighborhoods()">
                    <option>Selecteaza orasul</option>
                    @foreach($cityInfo as $city)
                    @if($city['id'] == $propertyInfo[0]['city'])
                    <option value="{{$city['id']}}" selected data-nh="{{$propertyInfo[0]['nh']}}" id="selectedCity">{{$city['city']}}</option>
                    @else
                    <option value="{{$city['id']}}">{{$city['city']}}</option>
                    @endif
                    @endforeach
                </select>
                <select name="nh" id="neighborhoodSelect" class="border-b-[1px] border-black text-lg outline-none px-3">
                </select>
                <select name="type" id="type" class="border-b-[1px] border-black text-lg outline-none px-3">
                    <option selected>Selecteaza tipul</option>
                    @if($propertyInfo[0]['type'] == 1)
                    <option value="1" selected>Comercial</option>
                    @else
                    <option value="1">Comercial</option>
                    @endif
                    @if($propertyInfo[0]['type'] == 2)
                    <option value="2" selected>Proiect</option>
                    @else
                    <option value="2">Proiect</option>
                    @endif
                    @if($propertyInfo[0]['type'] == 3)
                    <option value="3" selected>Apartament</option>
                    @else
                    <option value="3">Apartament</option>
                    @endif
                    @if($propertyInfo[0]['type'] == 4)
                    <option value="4" selected>Vila</option>
                    @else
                    <option value="4">Vila</option>
                    @endif
                    @if($propertyInfo[0]['type'] == 4)
                    <option value="5" selected>Teren</option>
                    @else
                    <option value="5">Teren</option>
                    @endif
                </select>
                <select name="selType" id="selType" class="border-b-[1px] border-black text-lg outline-none px-3">
                    <option>Vanzare/Inchiriere</option>
                    @if($propertyInfo[0]['saleType'] == 1)
                    <option value="1" selected>Vanzare</option>
                    <option value="2">Inchiriere</option>
                    @elseif($propertyInfo[0]['saleType'] == 2)
                    <option value="1">Vanzare</option>
                    <option value="2" selected>Inchiriere</option>
                    @endif
                </select>
            </div>
            <div class="grid md:grid-cols-2 gap-5 grid-cols-1 mt-10">
                <input type="text" id="long" name="long" value="{{$locationInfo[0]['lng']}}" placeholder="Longitudine" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" id="lat" name="lat" value="{{$locationInfo[0]['lat']}}" placeholder="Latitudine" class="border-b-[1px] border-black text-lg outline-none px-3">
            </div>
            <textarea name="specs" placeholder="Specificatii (despartite prin ';')" id="specs" style="resize: none;" rows="5" class="p-3 border-[1px] border-black text-lg outline-none w-full mt-10">{{$specInfo}}</textarea>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:grid-cols-4 w-full my-6">
                @foreach($imagesInfo as $images)
                <div>
                    <img src="https://andimob.ro/assets/img/properties/{{$images['imageName']}}" alt="">
                    <form action="/deleteImage/{{$images['id']}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="w-full mt-2 bg-[#222222] text-white">Sterge imaginea</button>
                    </form>
                </div>
                @endforeach
            </div>
            <p class="mt-6">Toate pozele trebuiesc selectate deodata. (Prima poza selectata este poza principala)</p>
            <div class="grid md:grid-cols-2 grid-cols-1 mt-6">
                <div class="flex flex-col items-start">
                    <input type="file" id="fileInput" name="photos[]" multiple accept="image/png, image/jpeg, image/jpg, image/avif">
                    <input type="submit" onclick="saveAll(this)" data-lastid="{{$lastId}}" value="Salvează" class="mt-6 text-[20px] bg-green-600 cursor-pointer px-6 py-1 font-bold text-white">
                </div>
                <div id="fileNames">

                </div>
            </div>
        </form>
        <script>
            document.getElementById('fileInput').addEventListener('change', function(event) {
                const files = event.target.files;
                const fileNamesDiv = document.getElementById('fileNames');

                fileNamesDiv.innerHTML = '';

                for (let i = 0; i < files.length; i++) {
                    const fileName = files[i].name;

                    const p = document.createElement('p');
                    p.classList.add('flex', 'justify-between', 'items-center', 'mb-2', 'cursor-pointer');

                    const fileNameSpan = document.createElement('span');
                    fileNameSpan.textContent = fileName;

                    p.appendChild(fileNameSpan);

                    fileNamesDiv.appendChild(p);
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var cityId = document.getElementById('city').value;
                var neighborhoodSelect = document.getElementById('neighborhoodSelect');
                var selectedCity = document.getElementById('selectedCity').dataset.nh

                neighborhoodSelect.innerHTML = '<option value="">Loading...</option>';

                fetch('/get-neighborhoods/' + cityId)
                    .then(response => response.json())
                    .then(data => {
                        neighborhoodSelect.innerHTML = '<option selected>Selecteaza zona</option>';
                        data.forEach(neighborhood => {
                            if (neighborhood.id == selectedCity) {
                                neighborhoodSelect.innerHTML += '<option value="' + neighborhood.id + '" selected>' + neighborhood.name + '</option>';
                            } else {
                                neighborhoodSelect.innerHTML += '<option value="' + neighborhood.id + '">' + neighborhood.name + '</option>';
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching neighborhoods:', error);
                        neighborhoodSelect.innerHTML = '<option value="">Error fetching neighborhoods</option>';
                    });
            })
        </script>
    </div>
</div>
@endsection