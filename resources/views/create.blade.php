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
            <label for="exclusive" class="text-xl">Exclusiv</label>
            <div class="grid lg:grid-cols-3 gap-5 md:grid-cols-2 grid-cols-1 mt-10">
                @php
                $city = App\Http\Controllers\PropertyController::getLastId();
                $lastId = $city[0]['id'];
                @endphp
                <input type="hidden" name="id" value="{{$lastId}}">
                <input type="text" name="title" placeholder="Titlu" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" name="price" placeholder="Pret" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" name="comission" placeholder="Comision" class="border-b-[1px] border-black text-lg outline-none px-3">
            </div>
            <div class="grid lg:grid-cols-4 gap-5 md:grid-cols-2 grid-cols-1 mt-10">
                <input type="number" name="rooms" placeholder="Camere" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" name="baths" placeholder="Bai" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" name="space" placeholder="Spatiu" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" name="year" placeholder="An" class="border-b-[1px] border-black text-lg outline-none px-3">
            </div>
            <textarea name="description" placeholder="Descriere" id="" style="resize: none;" cols="30" rows="10" class="p-3 border-[1px] border-black text-lg outline-none w-full mt-10"></textarea>
            <div class="grid lg:grid-cols-4 gap-5 md:grid-cols-2 grid-cols-1 mt-10">
                <select name="city" id="city" class="border-b-[1px] border-black text-lg outline-none px-3" onchange="getNeighborhoods()">
                    <option selected>Selecteaza orasul</option>
                    @foreach($cities as $city)
                    <option value="{{$city['id']}}">{{$city['city']}}</option>
                    @endforeach
                </select>
                <select name="nh" id="neighborhoodSelect" class="border-b-[1px] border-black text-lg outline-none px-3">
                </select>
                <select name="type" id="type" class="border-b-[1px] border-black text-lg outline-none px-3">
                    <option selected>Selecteaza tipul</option>
                    <option value="1">Comercial</option>
                    <option value="2">Proiect</option>
                    <option value="3">Apartament</option>
                    <option value="4">Vila</option>
                    <option value="5">Teren</option>
                </select>
                <select name="selType" id="selType" class="border-b-[1px] border-black text-lg outline-none px-3">
                    <option selected>Vanzare/Inchiriere</option>
                    <option value="1">Vanzare</option>
                    <option value="2">Inchiriere</option>
                </select>
            </div>
            <div class="grid md:grid-cols-2 gap-5 grid-cols-1 mt-10">
                <input type="text" id="long" name="long" placeholder="Longitudine" class="border-b-[1px] border-black text-lg outline-none px-3">
                <input type="number" id="lat" name="lat" placeholder="Latitudine" class="border-b-[1px] border-black text-lg outline-none px-3">
            </div>
            <textarea name="specs" placeholder="Specificatii (despartite prin ';')" id="specs" style="resize: none;" rows="5" class="p-3 border-[1px] border-black text-lg outline-none w-full mt-10"></textarea>
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
        </script>
    </div>
</div>

<script>
    function saveSpecs(element) {
        var lastId = parseInt(element.dataset.lastid) + 1;

        var long = document.getElementById('long').value;
        var lat = document.getElementById('lat').value;

        var specs = document.getElementById('specs').value;

        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/specs/' + specs + '/' + lastId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Failed to save data');
                }
            })
            .then(data => {
                console.log('Data saved successfully:', data);
            })
            .catch(error => {
                console.error('Error saving data:', error);
            });
    }

    function saveLocation(element) {
        var lastId = parseInt(element.dataset.lastid) + 1;

        var long = document.getElementById('long').value;
        var lat = document.getElementById('lat').value;

        var specs = document.getElementById('specs').value;

        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/location/' + lat + '/' + long + '/' + lastId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Failed to save data');
                }
            })
            .then(data => {
                console.log('Data saved successfully:', data);
            })
            .catch(error => {
                console.error('Error saving data:', error);
            });
    }

    function saveAll(element) {
        saveSpecs(element)
        saveLocation(element)
    }

    function getNeighborhoods() {
        var cityId = document.getElementById('city').value;
        var neighborhoodSelect = document.getElementById('neighborhoodSelect');

        neighborhoodSelect.innerHTML = '<option value="">Loading...</option>';

        fetch('/get-neighborhoods/' + cityId)
            .then(response => response.json())
            .then(data => {
                neighborhoodSelect.innerHTML = '<option selected>Selecteaza zona</option>';
                data.forEach(neighborhood => {
                    neighborhoodSelect.innerHTML += '<option value="' + neighborhood.id + '">' + neighborhood.name + '</option>';
                });
            })
            .catch(error => {
                console.error('Error fetching neighborhoods:', error);
                neighborhoodSelect.innerHTML = '<option value="">Error fetching neighborhoods</option>';
            });
    }
</script>
@endsection