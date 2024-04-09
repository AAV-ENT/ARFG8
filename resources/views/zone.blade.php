@extends('layouts.layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .hoverText:hover {
        background-color: #222222;
        color: white;
        transition: all 100ms;
        padding-left: 3px;
    }
</style>
<div class="w-full flex justify-center">
    <div class="w-full mx-2 2xl:w-[80%] max-w-[100rem] py-5">
        <a href="/" class=" bg-[#222222] text-white text-[20px] px-4 py-[5.5px]">Inapoi</a>
        <p class="text-xl font-bold my-5">Adauga zone</p>
        <div class="grid grid-cols-2">
            <div class="border-[1px] border-black py-5 px-3 border-r-none">
                @foreach($cities as $city)
                <p class="hover:bg-[#222222] hover:text-white cursor-pointer hoverText" data-city="{{$city['id']}}" onclick="getNeighborhoods(this)">{{$city['city']}}</p>
                @endforeach
                <div class="flex mt-6">
                    @csrf
                    <input type="text" name="cityName" id="cityName" placeholder="Introdu numele orasului" class="border-b-[1px] border-black">
                    <input type="submit" value="Salvează" onclick="save()" class="ml-2 bg-[#D57B01] text-white px-3 font-bold py-1">
                </div>
            </div>
            <div class="border-[1px] border-black px-3 py-5" id="showZones">

            </div>
        </div>
        <script>
            function save() {
                var cityName = document.getElementById('cityName').value;
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                console.log('/saveCity/' + cityName);
                fetch('/saveCity/' + cityName, {
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
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error saving data:', error);
                    });
            }

            function getNeighborhoods(element) {
                var neighborhoodSelect = document.getElementById('showZones');
                var cityId = element.dataset.city;

                neighborhoodSelect.innerHTML = '';
                neighborhoodSelect.showZones = '<option value="">Loading...</option>';

                fetch('/get-neighborhoods/' + cityId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(neighborhood => {
                            neighborhoodSelect.innerHTML += '<p>' + neighborhood.name + '</p>';
                        });

                        var inputField = document.createElement('input');
                        inputField.type = 'text';
                        inputField.name = 'zoneName';
                        inputField.id = 'zoneName';
                        inputField.placeholder = 'Introdu numele zonei';
                        inputField.className = 'border-b-[1px] border-black';

                        var submitButton = document.createElement('input');
                        submitButton.type = 'submit';
                        submitButton.dataset.city = element.dataset.city;
                        submitButton.value = 'Salvează';
                        submitButton.onclick = function() {
                            saveZone(submitButton);
                        };;
                        submitButton.className = 'ml-2 bg-[#D57B01] text-white px-3 font-bold py-1';

                        neighborhoodSelect.appendChild(inputField);
                        neighborhoodSelect.appendChild(submitButton);
                    })
                    .catch(error => {
                        console.error('Error fetching neighborhoods:', error);
                    });


            }

            function saveZone(element) {
                var zoneName = document.getElementById('zoneName').value;
                var cityId = element.dataset.city;
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('/saveZone/' + cityId + '/' + zoneName, {
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
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error saving data:', error);
                    });
            }
        </script>
    </div>
</div>
@endsection